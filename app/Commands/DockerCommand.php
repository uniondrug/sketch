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
    public $applicationUrl = "https://github.com/uniondrug/sketch.git";
    public $controlUrl = "https://github.com/uniondrug/docker.git";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        // 1. initialize
        $this->container = Di::getDefault();
        $this->dockerfile = "";
        // 2. remote
        $origin = shell_exec("git remote -v");
        if (preg_match("/origin\s+(\S+)/", $origin, $m) > 0) {
            $this->applicationUrl = $m[1];
        }
        // 3. docker file contents
        $this->appendHeader();
        $this->appendSeparator()->appendGitFiles()->appendGitRepositories();
        $this->appendSeparator()->appendEnvironments();
        // 4. path
        $path = realpath($this->container->appPath()."/../");
        // 5.
        $dockerfile = "{$path}/Dockerfile";
        if ($fp = @fopen($dockerfile, 'wb+')) {
            fwrite($fp, $this->dockerfile);
            fclose($fp);
        }
        // 6.
        $this->appendShellfile();
        $shellfile = "{$path}/dockerfile.sh";
        if ($fp = @fopen($shellfile, 'wb+')) {
            fwrite($fp, $this->shellfile);
            fclose($fp);
        }
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

    private function appendEnvironments()
    {
        $name = $this->container->getConfig()->path('app.appName', 'sketch');
        $mode = $this->container->getConfig()->path('app.dockerMode', 'swoole');
        $port = 80;
        $host = $this->container->getConfig()->path('server.host', null);
        if ($host && preg_match("/:(\d+)/", $host, $m)) {
            $port = $m[1];
        }
        $tpl = <<<'TMP'
# 环境变量
ENV DOCKER_MODE="{{DOCKER_MODE}}"
ENV SERVICE_NAME="{{SERVICE_NAME}}"
ENV SERVICE_PORT="{{SERVICE_PORT}}"

# 端口与入口
WORKDIR /uniondrug/app
EXPOSE {{SERVICE_PORT}}
# ENTRYPOINT ["/usr/local/bin/shell.sh"]

TMP;
        $tpl = preg_replace([
            "/\{\{DOCKER_MODE\}\}/",
            "/\{\{SERVICE_NAME\}\}/",
            "/\{\{SERVICE_PORT\}\}/",
        ], [
            $mode,
            $name,
            $port
        ], $tpl);
        return $this->append($tpl);
    }

    private function appendGitFiles()
    {
        $this->append("# Copy application Directories and files");
        $path = realpath($this->container->appPath().'/../');
        $d = dir($path);
        $di = [
            'log',
            'tmp'
        ];
        $fi = [
            '.gitignore',
            'console',
            'server'
        ];
        while (false != ($e = $d->read())) {
            if (preg_match("/^\./", $e)) {
                continue;
            }
            $x = "{$path}/{$e}";
            if (is_dir($x)) {
                if (in_array($e, $di)) {
                    continue;
                }
            } else if (is_file($x)) {
                if (in_array($e, $fi)) {
                    continue;
                }
            }
            $this->append("COPY {$e} /uniondrug/app/{$e}");
        }
        return $this;
    }

    private function appendGitRepositories()
    {
        $tpl = <<<'TMP'
# 应用仓库
RUN cd /uniondrug/app && mkdir log tmp && \
    cd /uniondrug/tmp && git clone {{APP_CTL}} . &&\
    php install && \
    chmod +x /usr/local/bin/shell.sh && \
    chown -R uniondrug:uniondrug /uniondrug
TMP;
        $tpl = preg_replace([
            "/\{\{APP_URL\}\}/",
            "/\{\{APP_CTL\}\}/",
        ], [
            $this->applicationUrl,
            $this->controlUrl
        ], $tpl);
        return $this->append($tpl);
    }

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
