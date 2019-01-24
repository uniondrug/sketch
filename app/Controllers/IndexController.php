<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-03-19
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
