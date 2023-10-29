<?php

namespace App\Modules\Auth\Controller;

use App\Core\ErrorHandler\JsonHandler;
use App\Core\JWT\JWTFactory;
use App\Modules\Auth\DTO\Request\LoginRequest;
use App\Modules\Auth\Resource\TokenResource;
use App\Modules\Auth\Service\AuthService;
use App\Modules\User\UserAPIFacade;
use Framework\Controller\Controller;
use Framework\Request\Request;
use Framework\Response\JsonResource;

class AuthController extends Controller
{
    private JsonResource $tokenResource;
    private AuthService $authService;

    public function __construct()
    {
        $this->errorHandler = new JsonHandler();
        $this->tokenResource = new TokenResource();
        $this->authService = new AuthService();
    }

    public function login(Request $request)
    {
        $dto = LoginRequest::fromRequest($request);
        $jwt = $this->authService->login($dto->getLogin(), $dto->getPassword());

        return $this->tokenResource->exportFromArray(["accessToken" => $jwt->getAccessToken()]);
    }
}
