<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Controllers;

use App\Controllers\Abstracts\Base;
use App\Logics\Example\AddLogic;
use App\Structs\Requests\Example\AddStruct;

/**
 * @package App\Controllers
 * @RoutePrefix("/")
 */
class IndexController extends Base
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // 1. build input payload
        $payload = [];

        // 2. build input struct
        $struct = AddStruct::factory($payload);

        // 3. call runtime logic
        $result = AddLogic::factory($struct);

        // 4. response
        return $this->serviceServer->withObject($result)->response();
    }
}
