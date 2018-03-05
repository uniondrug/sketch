<?php
/**
 * IndexController.php
 *
 */

namespace App\Controllers;

use App\Structs\UserStruct;
use Uniondrug\Framework\Controllers\ServiceServerController;

/**
 * Class IndexController
 *
 * @package App\Controllers
 * @RoutePrefix("")
 */
class IndexController extends ServiceServerController
{
    /**
     * @return \Phalcon\Http\Response
     * @throws \Uniondrug\Validation\Exceptions\ParamException
     * @Route("/")
     */
    public function indexAction()
    {
        $user = $this->validationService->checkInput($this->request->get(), UserStruct::class);
        return $this->serviceServer->withObject($user->toArray())->response();
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
