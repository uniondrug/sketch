<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-03-19
 */

namespace App\Controllers;

use App\Controllers\Abstracts\Base;
use App\Logics\Example\AddLogic;

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
        //    $payload = $this->request->getJsonRawBody();
        $payload = new \stdClass();
        $payload->id = 10001;
        $payload->name = 'payload name';

        // 2. call runtime logic
        $result = AddLogic::factory($payload);

        // 3. response
        return $this->serviceServer->withStruct($result);
    }
}
