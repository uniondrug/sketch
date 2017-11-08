<?php
/**
 * IndexController.php
 *
 */
namespace App\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->response->setJsonContent(['msg' => 'hello']);
    }

    public function showAction()
    {
        return $this->response->setJsonContent(['msg' => 'show']);
    }
}
