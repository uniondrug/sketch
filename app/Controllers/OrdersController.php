<?php
/**
 * OrdersController.php
 *
 */
namespace App\Controllers;

use Phalcon\Mvc\Controller;

class OrdersController extends Controller
{
    public function indexAction()
    {
        return $this->response->setJsonContent(['msg' => $this->config->path('app.appName')]);
    }

    public function listAction()
    {
        $params = $this->dispatcher->getParams();
        $param = $this->dispatcher->getParam(0, 'string');
        return $this->response->setJsonContent(['params' => $params, 'param0' => $param]);
    }
}
