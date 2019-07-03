<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2019-07-03
 */
namespace App\Services\Abstracts;

use Uniondrug\Framework\Services\Service as FrameworkService;

/**
 * @package App\Services
 */
abstract class Service extends FrameworkService
{
    use ServiceTrait;
}
