<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-11-08
 */
namespace App\Commands;

use GuzzleHttp\Client;
use Uniondrug\Console\Command;

/**
 * Consul服务操作
 * ```
 * php console consul OP [OPTIONS]
 * ```
 * @package App\Commands
 */
class ConsulCommand extends Command
{
    /**
     * 命令名称
     * @var string
     */
    protected $signature = 'consul
                            {op : 操作类型}
                            {--domain=YES : 计算服务地址时是否使用域名, 可选: YES、NO}
                            {--docker=NO : 是否在Docker容中运行, 可选: YES、NO}
                            {--service-ip= : Service服务地址/IP}
                            {--service-port= : Service服务端口/Port}
                            {--consul-ip= : Consul数据中心地址/IP}
                            {--consul-port= : Consul数据中心端口/Port}
                            {--app-path= : 项目路径, 默认为当前项目}';
    /**
     * 命令描述
     * @var string
     */
    protected $description = 'Consul服务管理';
    /**
     * 项目路径
     * @var string
     */
    private $appPath;
    private $appConfig;
    private $appEnvironment;
    private $appInDomain = true;
    private $appInDocker = false;
    /**
     * Consul服务数据
     * 按不同的操作模式自动分配consul服务数据
     * @var array
     */
    private $consulData = [];
    private $consulIp;
    private $consulPort = 8500;
    /**
     * 是否允许使用Shell脚本
     * @var bool
     */
    private $shellDisabled = true;

    /**
     * @inheritdoc
     */
    public function handle()
    {
        // 1. 前置检查
        $this->shellDisabled = !function_exists('shell_exec');
        $this->appEnvironment = $this->di->environment();
        $this->appPath = $this->input->getOption('app-path');
        $this->appPath || $this->appPath = realpath($this->di->appPath().'/../');
        $this->appInDomain = "YES" === strtoupper((string) $this->input->getOption('domain'));
        $this->appInDocker = "YES" === strtoupper((string) $this->input->getOption('docker'));
        $this->output->writeln("[DEBUG] 运行在Docker容器 - ".($this->appInDocker ? 'YES' : 'NO'));
        $this->output->writeln("[DEBUG] 计算服务地址时使用域名 - ".($this->appInDomain ? 'YES' : 'NO'));
        $this->output->writeln("[DEBUG] 允许执行SHELL脚本 - ".($this->shellDisabled ? 'OFF' : 'ON'));
        $this->output->writeln("[DEBUG] 项目路径 - {$this->appPath}");
        // 2. 读取项目配置
        $this->loadConfig("app");
        $this->loadConfig("server");
        $this->loadConsul();
        // 3. 渲染Consul服务数据
        $this->render();
        $this->loadConsulApi();
        // n. 选择操作类型
        $op = (string) $this->input->getArgument('op');
        $op === '' || $op = strtolower($op);
        switch ($op) {
            case 'deregister' :
                $this->handleDeregister();
                break;
            case 'register' :
                $this->handleRegister();
                break;
            default :
                $this->handleError($op);
                break;
        }
    }

    /**
     * 注册Consul服务
     */
    private function handleDeregister()
    {
        if (!$this->consulIp || !$this->consulPort) {
            $this->error("[ERROR] 未定义Consul数据中心API地址");
            return;
        }
        $url = "http://{$this->consulIp}:{$this->consulPort}/v1/agent/service/deregister/{$this->consulData['Name']}";
        $this->info("[DEBUG] 注册服务 - ".json_encode($this->consulData));
        $this->sendRequest("PUT", $url);
    }

    /**
     * 取消服务注册
     */
    private function handleRegister()
    {
        if (!$this->consulIp || !$this->consulPort) {
            $this->error("[ERROR] 未定义Consul数据中心API地址");
            return;
        }
        $url = "http://{$this->consulIp}:{$this->consulPort}/v1/agent/service/register";
        $this->info("[DEBUG] 删除服务 - ".json_encode($this->consulData));
        $this->sendRequest("PUT", $url, $this->consulData);
    }

    /**
     * 未定义操作
     * @param string $op
     */
    private function handleError(string $op)
    {
        $this->error("[ERROR] 暂不支持{$op}操作");
    }

    /**
     * 单文件导入
     * @param string $name
     * @return bool
     */
    private function loadConfig(string $name)
    {
        $file = "{$this->appPath}/config/{$name}.php";
        // 1. not found
        if (!file_exists($file)) {
            $this->error("[ERROR] 配置文件{$name}未找到");
            return false;
        }
        // 2. is array
        $data = include($file);
        if (!is_array($data)) {
            $this->error("[ERROR] 配置文件{$name}未返回合法Array数据");
            return false;
        }
        // 3. merge
        $this->output->writeln("[DEBUG] 配置文件{$name}导入完成");
        $key = $this->appEnvironment;
        $defaults = isset($data['default']) && is_array($data['default']) ? $data['default'] : [];
        $section = isset($data[$key]) && is_array($data[$key]) ? $data[$key] : [];
        $this->appConfig[$name] = array_merge($defaults, $section);
        return true;
    }

    /**
     * 从consul.json导入服务配置
     * @return bool
     */
    private function loadConsul()
    {
        // 1. not found
        $data = [];
        $name = "consul.json";
        $file = "{$this->appPath}/{$name}";
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $temp = json_decode($json, JSON_UNESCAPED_UNICODE);
            if (is_array($temp)) {
                $data = $temp;
            } else {
                $this->error("[ERROR] 服务文件{$name}不是有效的JSON数据");
            }
        } else {
            $this->error("[ERROR] 服务文件{$name}未找到");
        }
        // 2. parsed
        // 3. formatted
        $data['Name'] = isset($data['Name']) && $data['Name'] !== '' ? trim($data['Name']) : '';
        $data['Address'] = isset($data['Address']) && $data['Address'] !== '' ? trim($data['Address']) : '';
        $data['Port'] = isset($data['Port']) && is_numeric($data['Port']) ? (int) $data['Port'] : 0;
        $data['Tags'] = isset($data['Tags']) && is_array($data['Tags']) ? $data['Tags'] : [];
        // 4. update
        $this->output->writeln("[DEBUG] 服务文件{$name}导入完成");
        $this->consulData = $data;
        return true;
    }

    /**
     * 载入CONSUL服务地址
     */
    private function loadConsulApi()
    {
        // IP地址
        // 1. 入参第一优先级
        // 2. 环境变量/容器中有效
        // 3. 物理IP地址(ip addr|ifonfig)
        $consulIp = (string) $this->input->getOption('consul-ip');
        if ($consulIp === '' && $this->appInDocker) {
            $ip = trim(shell_exec('echo ${CONSUL_IP}'));
            if ($ip !== '') {
                $consulIp = $ip;
            }
        }
        $consulIp || $consulIp = $this->readIpAddr();
        $consulIp || $consulIp = $this->readIfConfig();
        $consulIp && $this->consulIp = $consulIp;
        // 端口号
        // 1. 入参第一优先级
        // 2. 环境变量/容器中有效
        $consulPort = (string) $this->input->getOption('consul-port');
        if ($consulPort === '' && $this->appInDocker) {
            $port = trim(shell_exec('echo ${CONSUL_PORT}'));
            if ($port !== '' && preg_match("/^[0-9]+$/", $port)) {
                $consulPort = $port;
            }
        }
        $consulPort && $this->consulPort = $consulPort;
    }

    /**
     * @param string $name
     * @return null|string
     */
    private function readIpAddr(string $name = 'eth0')
    {
        // 1. shell disabled
        if ($this->shellDisabled) {
            return null;
        }
        // 2. exec
        $regexp = "/^\d+\.\d+\.\d+\.\d+$/";
        $script = "ip -o -4 addr list {$name} | head -n1 | awk '{print \$4}' | cut -d/ -f1";
        $result = shell_exec($script);
        if ($result !== '') {
            $result = trim($result);
            // 3. success
            if (preg_match($regexp, $result) > 0) {
                return $result;
            }
            // 4. secondary
            if ($name === 'eth0') {
                return $this->readIpAddr('en0');
            }
        }
        // 5. not found
        return null;
    }

    /**
     * @return null|string
     */
    private function readIfConfig()
    {
        // 1. shell disabled
        if ($this->shellDisabled) {
            return null;
        }
        // 2. 读取Shell结果
        $result = shell_exec("ifconfig");
        // 3. 格式化数据
        $result = trim($result);
        $result = "\n".preg_replace("/\n\s+/", "\t", $result);
        if (preg_match_all("/\n(e[a-z]+0)([^\n]+)/", $result, $m) === 0) {
            return null;
        }
        // 4. 遍历匹配
        $primary = '';
        $secondary = '';
        foreach ($m[1] as $i => $name) {
            // 5. 空值
            $value = trim($m[2][$i]);
            if ($value === '') {
                return null;
            }
            if (preg_match_all("/inet\s+[^\d]*(\d+\.\d+\.\d+\.\d+)/", $value, $v) === 0) {
                continue;
            }
            // 6. 业务
            $name === 'eth0' && $primary = $v[1][0];
            $name === 'en0' && $secondary = $v[1][0];
        }
        // 7. 首选
        if ($primary !== '') {
            return $primary;
        }
        // 8. 次选
        if ($secondary !== '') {
            return $secondary;
        }
        // 9. 匹配失败
        return null;
    }

    /**
     * 渲染Consul数据
     */
    private function render()
    {
        $this->renderName();
        $this->renderAddress();
        $this->renderPort();
        $this->renderTags();
    }

    /**
     * 服务地址
     */
    private function renderAddress()
    {
        // 1. 第1优选级/入参覆盖
        $serviceIp = $this->input->getOption('service-ip');
        if ($serviceIp) {
            $this->consulData['Address'] = $serviceIp;
            return;
        }
        // 2. 第2优先级/延用配置
        if ($this->consulData['Address'] !== '') {
            return;
        }
        // 3. 第3优先级/环境变量
        if ($this->appInDocker && !$this->shellDisabled) {
            $serviceIp = trim(shell_exec('echo ${SERVICE_IP}'));
            if ($serviceIp !== '') {
                $this->consulData['Address'] = $serviceIp;
                return;
            }
        }
        // 4. 第4优先级/读取网卡
        if ($this->appInDomain) {
            $serviceIp = $this->appConfig['app']['appName'].'.';
            // 4.1 域名模式/此处硬编码
            switch ($this->appEnvironment) {
                case 'production' :
                    $serviceIp .= 'uniondrug.cn';
                    break;
                case 'release' :
                    $serviceIp .= 'turboradio.cn';
                    break;
                case 'testing' :
                    $serviceIp .= 'test.dovecot.cn';
                    break;
                default :
                    $serviceIp .= 'dev.dovecot.cn';
                    break;
            }
            $this->consulData['Address'] = $serviceIp;
            return;
        }
        // 4.2 IP模式
        $serviceIp = $this->readIpAddr();
        $serviceIp || $serviceIp = $this->readIfConfig();
        if ($serviceIp !== '') {
            $this->consulData['Address'] = $serviceIp;
            return;
        }
    }

    /**
     * 服务名称
     */
    private function renderName()
    {
        if ($this->consulData['Name'] !== '') {
            return;
        }
        $name = $this->appConfig['app']['appName'];
        $name || $name = 'sketch';
        $this->consulData['Name'] = $name;
    }

    /**
     * 服务端口
     */
    private function renderPort()
    {
        // 1. 第1优选级/入参覆盖
        $servicePort = $this->input->getOption('service-port');
        if ($servicePort) {
            $this->consulData['Port'] = (int) $servicePort;
            return;
        }
        // 2. 第2优先级/延用配置
        if ($this->consulData['Port'] !== 0) {
            return;
        }
        // 3. 第3优先级/环境变量
        if ($this->appInDocker && !$this->shellDisabled) {
            $servicePort = trim(shell_exec('echo ${SERVICE_PORT}'));
            if ($servicePort !== '') {
                $this->consulData['Port'] = (int) $servicePort;
                return;
            }
        }
        // 4. 第4优先级/固定80模式
        if ($this->appInDomain) {
            $this->consulData['Port'] = 80;
            return;
        }
        // 4.2 IP模式
        $host = isset($this->appConfig['server'], $this->appConfig['server']['host']) ? $this->appConfig['server']['host'] : '';
        if (preg_match("/:(\d+)/", $host, $m) > 0) {
            $this->consulData['Port'] = (int) $m[1];
        }
    }

    /**
     * 服务标签
     */
    private function renderTags()
    {
        // 1. IMAGE
        $image = isset($this->appConfig['app']['dockerImage']) ? $this->appConfig['app']['dockerImage'] : '';
        $image || $image = 'uniondrug:base';
        $imageTag = "{$this->appEnvironment}:{$image}";
        if (!in_array($imageTag, $this->consulData['Tags'])) {
            $this->consulData['Tags'][] = $imageTag;
        }
        // 2. StartMode
        $mode = isset($this->appConfig['app']['dockerMode']) ? $this->appConfig['app']['dockerMode'] : '';
        $mode || $mode = 'swoole';
        if (!in_array($mode, $this->consulData['Tags'])) {
            $this->consulData['Tags'][] = $mode;
        }
    }

    /**
     * 发起ConsulAPI请求
     * @param string     $method
     * @param string     $url
     * @param array|null $data
     */
    private function sendRequest(string $method, string $url, array $data = null)
    {
        $this->info("[DEBUG] 发起{$method}请求到{$url}");
        $options = [];
        if (is_array($data)) {
            $options['json'] = $data;
        }
        try {
            $client = new Client();
            $stream = $client->request($method, $url, $options);
            if ($stream->getStatusCode() === 200) {
                $this->info("[DEBUG] 请求完成 {$stream->getBody()->getContents()}");
                return;
            }
            $reason = $stream->getReasonPhrase();
            throw new \Exception(preg_replace("/\n/", " ", trim($reason)));
        } catch(\Throwable $e) {
            $this->error("[ERROR] 请求失败 - {$e->getMessage()}");
        }
    }
}
