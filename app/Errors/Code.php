<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Errors;

/**
 * 错误码定义
 * 1. 对外暴露int型错误码
 * 2. 静态属性$plus用于在$code前递加固定值, 以应用间区分
 * @package App\Errors
 */
use Uniondrug\Framework\Errors\Code as FrameworkErrorCode;

/**
 * 错误码定义
 * @package App\Errors
 */
class Code extends FrameworkErrorCode
{
    const FAILURE_CREATE = 1;
    const FAILURE_UPDATE = 2;
    const FAILURE_DELETE = 3;
    protected static $codeMessages = [
        Code::FAILURE_CREATE => "添加记录失败",
        Code::FAILURE_UPDATE => "编辑记录失败",
        Code::FAILURE_DELETE => "删除记录失败",
    ];
    protected static $codePlus = 1000;
}
