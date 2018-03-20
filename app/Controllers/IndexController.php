<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Controllers;

/**
 * Default Route Controller
 * @package App\Controllers
 * @RoutePrefix("")
 */
class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return 'hello world!';
    }
}
