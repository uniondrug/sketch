<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-03-19
 */

namespace App\Tasks\Abstracts;

use App\Services\Abstracts\ServiceTrait;
use Uniondrug\Server\Task\TaskHandler;

/**
 * @package App\Logics\Abstracts\Logic
 */
abstract class Task extends TaskHandler
{
    /**
     * 导入IDE定义
     * 1. property
     * 2. method
     */
    use ServiceTrait;
}
