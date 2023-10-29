<?php

namespace App\Core\JWT;

use App\Modules\User\DTO\User;
use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;

class JWTFactory {
    public function __construct() {}

    public function makeFromUser(User $user): JWT {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText(JWT_SECRET_KEY);
        
        $now   = new DateTimeImmutable();
        $accessToken = $tokenBuilder
            ->identifiedBy($user->getId())
            ->issuedAt($now)
            ->expiresAt($now->modify(sprintf('+%d hour', TOKEN_HOURS_EXPIRATION)))
            ->withClaim('email', $user->getEmail())
            ->getToken($algorithm, $signingKey);
        
        return new JWT($accessToken->toString());
    }
}