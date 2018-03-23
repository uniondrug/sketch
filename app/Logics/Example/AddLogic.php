<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Logics\Example;

use App\Logics\Abstracts\Logic;
use App\Structs\Results\Example\Row;

class AddLogic extends Logic
{
    /**
     * @inheritdoc
     */
    function run($payload)
    {
        // 业务代码
        $data = [];
        return Row::factory($data);
    }
}
