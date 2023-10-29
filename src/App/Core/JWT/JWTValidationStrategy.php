<?php

namespace App\Core\JWT;

use App\Modules\User\DTO\User;
use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;

class JWTValidationStrategy {
    public function __construct() {}

    public function validate(JWT $jwt): bool {
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($jwt->getAccessToken());

        return (new Validator())->validate($token, new IdentifiedBy(JWT_SIGNING_KEY));
    }
}