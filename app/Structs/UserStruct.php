<?php
/**
 * 用户信息结构
 */

namespace App\Structs;

use Uniondrug\Structs\Struct;

/**
 * Class UserStruct
 *
 * @package App\Structs
 * @property string $lastLogin
 */
class UserStruct extends Struct
{
    /**
     * 用户名，读写
     *
     * @var string
     */
    public $username;

    /**
     * 只读属性
     *
     * @var string
     */
    protected $lastLogin;
}
