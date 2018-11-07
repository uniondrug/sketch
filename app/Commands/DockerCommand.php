<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-10-31
 */
namespace App\Commands;

use Phalcon\Di;
use Uniondrug\Console\Command;
use Uniondrug\Framework\Container;

/**
 * 构建Docker镜像
 * ```
 * php console docker init -e release
 *                    help
 * ```
 * @package App\Commands
 */
class DockerCommand extends Command
{
    /**
     * 命令名称
     * @var string
     */
    protected $signature = 'docker';
    /**
     * 命令描述
     * @var string
     */
    protected $description = '构建Dockerfile';
    /**
     * @var Container
     */
    public $container;
    public $dockerfile = "";
    public $shellfile = "";
    public $controlUrl = "https://github.com/uniondrug/docker.git";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        // 1. initialize
        $this->container = Di::getDefault();
        $this->dockerfile = "";
        // 3. docker file contents
        $this->appendHeader();
        $this->appendSeparator()->appendGitFiles()->appendGitRepositories();
        $this->appendSeparator()->appendEnvironments();
        // 4. path
        $path = realpath($this->container->appPath()."/../");
        // 5. export docker file
        $dockerfile = "{$path}/Dockerfile";
        if ($fp = @fopen($dockerfile, 'wb+')) {
            fwrite($fp, $this->dockerfile);
            fclose($fp);
        }
        // 6. export shell
        $this->appendShellfile();
        $shellfile = "{$path}/dockerfile.sh";
        if ($fp = @fopen($shellfile, 'wb+')) {
            fwrite($fp, $this->shellfile);
            fclose($fp);
        }
        // 7. run builder
        $image = $this->container->getConfig()->path('app.appName', 'sketch');
        $version = $this->container->getConfig()->path('app.appVersion', 'latest');
        $cmd = 'cd '.$path.' && docker build --rm -t '.$image.':'.$version.' . > /dev/null && echo "完成['.$image.':'.$version.']镜像构建."';
        echo shell_exec($cmd);
    }

    private function append(string $line)
    {
        $line = trim($line);
        $this->dockerfile .= "{$line}\n";
        return $this;
    }

    private function appendSeparator()
    {
        return $this->append("\n");
    }

    /**
     * 设置基础镜像
     * @return DockerCommand
     */
    private function appendHeader()
    {
        $tpl = <<<'TMP'
#
# 构建Docker镜像
# 本文件由脚本生成, 请不要修改
# 时间: {{TIME}}
#
FROM {{IMAGE}}
TMP;
        $tpl = preg_replace([
            "/\{\{TIME\}\}/",
            "/\{\{IMAGE\}\}/",
        ], [
            date('Y-m-d H:i O'),
            $this->container->getConfig()->path('app.dockerImage', 'uniondrug:base')
        ], $tpl);
        return $this->append($tpl);
    }

    /**
     * 设置镜像环境变量
     * @return DockerCommand
     */
    private function appendEnvironments()
    {
        $name = $this->container->getConfig()->path('app.appName', 'sketch');
        $version = $this->container->getConfig()->path('app.appVersion', 'latest');
        $mode = $this->container->getConfig()->path('app.dockerMode', 'swoole');
        $tpl = <<<'TMP'
# 环境变量
ENV SERVICE_MODE="{{SERVICE_MODE}}"
ENV SERVICE_NAME="{{SERVICE_NAME}}"
ENV SERVICE_VERSION="{{SERVICE_VERSION}}"
ENV SERVICE_IP=""
ENV SERVICE_PORT="80"
# 端口与入口
WORKDIR /uniondrug/app
EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint"]
CMD ["start", "-e", "production"]
TMP;
        $tpl = preg_replace([
            "/\{\{SERVICE_MODE\}\}/",
            "/\{\{SERVICE_NAME\}\}/",
            "/\{\{SERVICE_VERSION\}\}/"
        ], [
            $mode,
            $name,
            $version
        ], $tpl);
        return $this->append($tpl);
    }

    /**
     * 拷入项目文件
     * @return $this
     */
    private function appendGitFiles()
    {
        $this->append("# 拷贝项目文件");
        $this->append("# 1. 目录");
        $this->append("# 2. 文件");
        $path = realpath($this->container->appPath().'/../');
        $d = dir($path);
        $di = [
            'app',
            'config',
            'public',
            'vendor'
        ];
        $fi = [
            'composer.json',
            'consul.json',
            'README.md'
        ];
        while (false != ($e = $d->read())) {
            if (preg_match("/^\./", $e)) {
                continue;
            }
            $x = "{$path}/{$e}";
            if (is_dir($x)) {
                if (!in_array($e, $di)) {
                    continue;
                }
            } else if (is_file($x)) {
                if (!in_array($e, $fi)) {
                    continue;
                }
            }
            $this->append("COPY {$e} /uniondrug/app/{$e}");
        }
        return $this;
    }

    /**
     * 拷贝工具
     * @return DockerCommand
     */
    private function appendGitRepositories()
    {
        $tpl = <<<'TMP'
# 应用仓库
# 1. 补全项目目录
# 2. Clone工具项目/github
# 3. 变项属主
RUN cd /uniondrug/app && mkdir log tmp && \
    cd /uniondrug/tmp && git clone {{APP_CTL}} . && git checkout master && \
    php install && \
    chmod +x /usr/local/bin/entrypoint && \
    chown -R uniondrug:uniondrug /uniondrug
TMP;
        $tpl = preg_replace([
            "/\{\{APP_CTL\}\}/",
        ], [
            $this->controlUrl
        ], $tpl);
        return $this->append($tpl);
    }

    /**
     * 生成构建镜像脚本
     * @return $this
     */
    private function appendShellfile()
    {
        $tpl = <<<'TMP'
#!/bin/sh
docker build --rm -t {{IMAGE}}:{{VERSION}} .
TMP;
        $image = $this->container->getConfig()->path('app.appName', 'sketch');
        $version = $this->container->getConfig()->path('app.appVersion', 'latest');
        $tpl = preg_replace([
            "/\{\{IMAGE\}\}/",
            "/\{\{VERSION\}\}/",
        ], [
            $image,
            $version
        ], $tpl);
        $this->shellfile = $tpl;
        return $this;
    }
}
