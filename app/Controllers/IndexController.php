<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2018-03-19
 */
namespace App\Controllers;

use App\Controllers\Abstracts\Base;
use App\Logics\Example\AddLogic;
use App\Models\Example;
use Uniondrug\ServiceSdk\ServiceSdk;

/**
 * @package App\Controllers
 * @RoutePrefix("/index")
 */
class IndexController extends Base
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->serviceServer->withSuccess();
    }
}
