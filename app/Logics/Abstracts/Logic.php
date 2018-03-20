<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Logics\Abstracts;

use App\Services\Abstracts\ServiceTrait;

/**
 * 业务逻辑基类
 * 1. 目录`app/Logics`下的文件自`Controller`移值, 用途
 *    a): 便于复用
 *    b): 多路并行(http / command / task)
 * <code>
 * // in controller
 * $response = ExampleLogic::factory($this->request->getJsonRawBody());
 * $this->serviceServer->withObject($response)->response();
 * </code>
 * @package App\Logics
 */
abstract class Logic
{
    /**
     * 导入IDE定义
     * 1. property
     * 2. method
     */
    use ServiceTrait;

    /**
     * 逻辑工厂模式
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public static function factory($payload = null)
    {
        $logic = new static();
        return $logic->run($payload);
    }

    /**
     * 运行业务逻辑
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    abstract function run($payload);
}
