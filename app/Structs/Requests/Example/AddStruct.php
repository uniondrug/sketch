<?php
/**
 * 用户信息结构。举例用，实际用不到可以删除。
 */
namespace App\Structs\Requests\Example;

use Uniondrug\Structs\Struct;

/**
 * @package App\Structs
 */
class AddStruct extends Struct
{
    /**
     * @var int
     * @validator(options={min:1,max:10},required)
     */
    public $id;
    /**
     * 只读属性
     * @var string
     * @validator(empty,type=mobile)
     */
    public $name;
    /**
     * @var int
     * @validator(options={min:1,max:100},required)
     */
    public $age;
}
