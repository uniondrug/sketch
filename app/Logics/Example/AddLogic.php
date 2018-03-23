<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Logics\Example;

use App\Logics\Abstracts\Logic;
use App\Structs\Requests\Example\AddStruct;
use App\Structs\Results\Example\Row;

class AddLogic extends Logic
{
    /**
     * @inheritdoc
     */
    function run($payload)
    {
        // 业务代码
        $struct = AddStruct::factory($payload);
        $model = $this->exampleService->add($struct);
        return Row::factory($model);
    }
}
