<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Services;

use App\Models\Example;
use App\Services\Abstracts\Service;
use App\Structs\Requests\Example\AddStruct;

/**
 * @package App\Services
 */
class ExampleService extends Service
{
    public function add(AddStruct $add)
    {
        $model = new Example();
        $model->id = $add->id;
        $model->name = $add->name;
        return $model;
    }
}
