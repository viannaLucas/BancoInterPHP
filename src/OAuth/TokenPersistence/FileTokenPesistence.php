<?php

namespace viannaLucas\BancoInterPhp\OAuth\TokenPersistence;

use viannaLucas\BancoInterPhp\OAuth\Token;
use viannaLucas\BancoInterPhp\OAuth\TokenPersistenceStrategy;

class FileTokenPesistence implements TokenPersistenceStrategy
{
    public function __construct(
        protected string $fullPathFile
    ) {

    }

    public function loadToken(): ?Token
    {
        if(!is_file($this->fullPathFile) && !is_readable($this->fullPathFile)) {
            return null;
        }
        $tokenUnserialized = unserialize((string)file_get_contents($this->fullPathFile));
        if($tokenUnserialized === false){
            return null;
        }
        return $tokenUnserialized;
    }

    public function saveToken(Token $token): bool
    {
        return file_put_contents($this->fullPathFile, serialize($token)) !== false;
    }
}
