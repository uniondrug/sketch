<?php
/**
 * IndexController.php
 *
 */

namespace App\Controllers;

use Uniondrug\Framework\Controllers\ServiceServerController;

/**
 * Class IndexController
 *
 * @package App\Controllers
 */
class IndexController extends ServiceServerController
{
    public function indexAction()
    {
        return $this->serviceServer->withSuccess()->response();
    }

    /**
     * @Route("/show")
     * @return \Phalcon\Http\Response
     */
    public function showAction()
    {
        return $this->serviceServer->withObject(['hello' => 'world'])->response();
    }
}
