<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Services;

use App\Errors\Code;
use App\Errors\Error;
use App\Models\Example;
use App\Services\Abstracts\Service;
use App\Structs\Requests\Example\AddStruct;

/**
 * @package App\Services
 */
class ExampleService extends Service
{
    public function add(AddStruct $struct)
    {
        $model = new Example();
        $model->id = $struct->id;
        $model->name = $struct->name;
        return $model;
        // example with no database connection, and
        // follow codes ignored
        // if ($model->create()){
        //     return $model;
        // }
        // throw new Error(Code::FAILURE_CREATE, "添加 %d 号数据失败", $struct->id);
    }
}
