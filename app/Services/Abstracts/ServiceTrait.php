<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2019-01-24
 */
namespace App\Services\Abstracts;

use App\Servers\Http;
use Uniondrug\Framework\Container;
use Uniondrug\ServiceSdk\Sdk;

/**
 * @property Sdk $serviceSdk
 * @package App\Services\Abstracts
 */
trait ServiceTrait
{
    /**
     * 读取Swoole实例
     * @return Http
     * @throws \Exception
     */
    public function getSwoole()
    {
        /**
         * @var Container $di
         */
        $di = $this->di;
        $swoole = $di->getShared('server');
        if ($swoole instanceof \Swoole\Server) {
            return $swoole;
        }
        throw new \Exception("only work with swoole mode");
    }
}
