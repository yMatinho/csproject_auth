<?php

namespace App\Modules\Auth\Controller;

use App\Core\ErrorHandler\JsonHandler;
use App\Modules\User\UserAPIFacade;
use Framework\Controller\Controller;
use Framework\Request\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->errorHandler = new JsonHandler();
    }

    public function login(Request $request) {
        $dto = (new UserAPIFacade())->findByCredentials("heyjude5", "teste");

        return ["username"=>$dto->getUser()->getUsername()];
    }
}
