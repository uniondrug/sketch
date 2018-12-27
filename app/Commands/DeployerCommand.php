<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-12-27
 */
namespace App\Commands;

use Phalcon\Di;
use Phar;
use Uniondrug\Console\Command;
use Uniondrug\Framework\Container;

/**
 * 构建PHAR部署包
 * @package App\Commands
 */
class DeployerCommand extends Command
{
    /**
     * 命令名称
     * @var string
     */
    protected $signature = 'deployer
                            {--app-path= : 项目路径, 默认为当前项目}';
    /**
     * 命令描述
     * @var string
     */
    protected $description = '构建PHAR部署包';
    /**
     * @var Container
     */
    protected $container;
    /**
     * @var Phar
     */
    protected $phar;
    protected $pharName;
    protected $pharFile;
    protected $pharPath;
    protected $pharScans = [
        'app',
        'config',
        'public',
        'vendor'
    ];
    /**
     * 文件数
     * @var int
     */
    protected $pharScansCount = 0;
    /**
     * 文件名规则
     * @var array
     */
    protected $pharScansFilesRexps = [
        "/\.php$/"
    ];

    /**
     * @return mixed
     */
    public function handle()
    {
        $this->container = Di::getDefault();
        $this->pharPath = realpath($this->container->logPath().'/../');
        $this->pharName = $this->container->getConfig()->path('app.appName').'-'.$this->container->getConfig()->path('app.appVersion').'.phar';
        $this->pharFile = $this->pharPath.'/'.$this->pharName;
        $this->begin();
        foreach ($this->pharScans as $name) {
            $this->scan($name);
        }
        $this->setStub();
        $this->commit();
    }

    private function begin()
    {
        if (file_exists($this->pharFile)) {
            unlink($this->pharFile);
        }
        $this->phar = new Phar($this->pharFile, 0, $this->pharName);
        $this->phar->setSignatureAlgorithm(Phar::SHA1);
        $this->phar->startBuffering();
    }

    private function scan(string $name)
    {
        $path = $this->pharPath.'/'.$name;
        if (!is_dir($path)) {
            return;
        }
        $d = dir($path);
        while (false !== ($e = $d->read())) {
            // 1. ignore
            if ($e == '.' || $e == '..') {
                continue;
            }
            // 2. is directory
            $x = $path.'/'.$e;
            $z = $name.'/'.$e;
            if (is_dir($x)) {
                $this->scan($z);
                continue;
            }
            // 3. is file
            foreach ($this->pharScansFilesRexps as $rexp) {
                if (preg_match($rexp, $e) > 0) {
                    $this->scanAdder($z);
                    break;
                }
            }
        }
        $d->close();
    }

    private function scanAdder(string $file)
    {
        $this->pharScansCount++;
        $mode = 100;
        if ($this->pharScansCount % $mode === 0) {
            $diff = $this->pharScansCount / $mode;
            echo "File: ".(($diff - 1) * $mode)." - ".($diff * $mode)."\n";
        }
        $this->phar->addFromString($file, file_get_contents($this->pharPath.'/'.$file));
    }

    private function setStub()
    {
        $stub = <<<STUB
#!/usr/bin/env php
<?php
Phar::mapPhar('{$this->pharName}');
require 'phar://{$this->pharName}/public/index.php';
__HALT_COMPILER();
STUB;
        $this->phar->setStub($stub);
    }

    private function commit()
    {
        $this->phar->addFile('consul.json');
        $this->phar->compressFiles(Phar::GZ);
        $this->phar->stopBuffering();
        $size = sprintf('%.02f MB', round((filesize($this->pharFile) / 1024) / 1024, 2));
        echo "File: {$this->pharScansCount} - end\n";
        echo "Name: {$this->pharName}\n";
        echo "Size: {$size}\n";
    }
}
