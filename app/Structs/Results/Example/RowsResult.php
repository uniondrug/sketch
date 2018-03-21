<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Structs\Results\Example;

use Uniondrug\Structs\ListStruct;

/**
 * @package App\Structs\Results
 */
class RowsResult extends ListStruct
{
    /**
     * @var Row[]
     */
    public $body;
}
