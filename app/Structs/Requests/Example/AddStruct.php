<?php
/**
 * 用户信息结构。举例用，实际用不到可以删除。
 */
namespace App\Structs\Requests\Example;

use Uniondrug\Structs\Struct;

/**
 * @package App\Structs
 * @property string $lastLogin
 */
class AddStruct extends Struct
{
    /**
     * 用户名，读写
     * @var string
     * @Validator(type=string, required=true, options={min: 3, max: 10})
     */
    public $username;
    /**
     * 只读属性
     * @var string
     */
    protected $lastLogin;
}
