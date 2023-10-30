<?php

namespace App\Modules\Auth\Controller;

use App\Core\ErrorHandler\JsonHandler;
use App\Core\JWT\JWTFactory;
use App\Modules\Auth\DTO\Request\LoginRequest;
use App\Modules\Auth\DTO\Request\ValidateRequest;
use App\Modules\Auth\Resource\TokenResource;
use App\Modules\Auth\Resource\ValidationResource;
use App\Modules\Auth\Service\AuthService;
use App\Modules\User\UserAPIFacade;
use Framework\Controller\Controller;
use Framework\Exception\HttpException;
use Framework\Request\Request;
use Framework\Response\JsonResource;
use Framework\Singleton\Router\HttpDefaultCodes;

class AuthController extends Controller
{
    private JsonResource $tokenResource;
    private JsonResource $validationResource;
    private AuthService $authService;

    public function __construct()
    {
        $this->errorHandler = new JsonHandler();
        $this->tokenResource = new TokenResource();
        $this->validationResource = new ValidationResource();
        $this->authService = new AuthService();
    }

    public function login(Request $request)
    {
        $dto = LoginRequest::fromRequest($request);
        $jwt = $this->authService->login($dto->getLogin(), $dto->getPassword());

        return $this->tokenResource->exportFromArray(["accessToken" => $jwt->getAccessToken()]);
    }

    public function validate(Request $request)
    {
        $dto = ValidateRequest::fromRequest($request);

        if(!$this->authService->validate($dto->getAccessToken()))
            throw new HttpException("Unauthorized", HttpDefaultCodes::UNAUTHORIZED);

        return $this->validationResource->exportFromArray([]);
    }
}
