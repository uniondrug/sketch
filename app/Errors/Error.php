<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Errors;

/**
 * 异常/Exception
 * <code>
 * throw new Error(Code::CONSTANT_NAME);
 * throw new Error(Code::CONSTANT_NAME, "message");
 * throw new Error(Code::CONSTANT_NAME, "no %d message", 1);
 * </code>
 * @package App\Services
 */
class Error extends \Exception
{
    /**
     * @param int         $code
     * @param string|null $message
     * @param array       ...$_
     */
    public function __construct(int $code, string $message = null, ... $_)
    {
        $errno = Code::getCode($code);
        if ($message === null) {
            $error = Code::getMessage($code);
        } else {
            $argLength = func_num_args();
            if ($argLength == 2) {
                $error = $message;
            } else {
                $args = array_slice(func_get_args(), 1);
                $error = call_user_func_array('sprintf', $args);
            }
        }
        parent::__construct($error, $errno, null);
    }
}
