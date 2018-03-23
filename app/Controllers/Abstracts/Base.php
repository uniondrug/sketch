<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Controllers\Abstracts;

use App\Services\Abstracts\ServiceTrait;
use Uniondrug\Framework\Controllers\Controller as FrameworkController;

/**
 * 控制器基类
 * 1. 默认自`Uniondrug\Framework\Controllers\Controller`继承, 按应用场景选择或重定义
 * 2. 导入`ServiceTrait`用于对IDE的Service友好支持(如: $this->exampleService 等价于 new ExampleService())
 * @package App\Controllers
 */
abstract class Base extends FrameworkController
{
    /**
     * 导入IDE定义
     * 1. property
     * 2. method
     */
    use ServiceTrait;
}
