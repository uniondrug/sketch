<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-03-19
 */
namespace App\Logics\Example;

use App\Logics\Abstracts\Logic;
use App\Models\Example;
use App\Structs\Requests\Example\AddStruct;
use App\Structs\Results\Example\Row;

class AddLogic extends Logic
{
    /**
     * @inheritdoc
     */
    function run($payload)
    {
        // 1. 入参
        $input = AddStruct::factory($payload);
        /**
         * @var Example $model
         */
        // 2. 数据操作
        $model = $this->exampleService->add($input);
        /// 3. 返回上层结果
        return Row::factory($model);


//        // 业务代码
//        $param = AddStruct::factory($payload);
//        $this->db->begin();
//        try {
//            $this->exampleService->add($param);
//            $this->example2Servcice->add($Param2);
//            $this->db->commit();
//        } catch(\Exception $e) {
//            $this->db->rollback();
//        }
    }
}
