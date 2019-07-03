<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2019-07-03
 */
namespace App\Logics\Abstracts;

use App\Services\Abstracts\ServiceTrait;
use Uniondrug\Framework\Logics\Logic as FrameworkLogic;

/**
 * @package App\Logics\Abstracts\Logic
 */
abstract class Logic extends FrameworkLogic
{
    /**
     * 导入IDE定义
     * 1. property
     * 2. method
     */
    use ServiceTrait;
}
