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
     * @Validators(type=int,options={min:1,max:10})
     */
    public $id;
    /**
     * 只读属性
     * @var string
     */
    public $name;
}
