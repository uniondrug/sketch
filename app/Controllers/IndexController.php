<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2019-07-03
 */
namespace App\Controllers;

use App\Controllers\Abstracts\Base;

/**
 * @package App\Controllers
 * @RoutePrefix("/index")
 */
class IndexController extends Base
{
    /**
     * @ignore
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->serviceServer->withSuccess();
    }
}
