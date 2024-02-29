<?php

namespace viannaLucas\BancoInterPhp\OAuth;

interface TokenPersistenceStrategy
{
    public function saveToken(Token $token): bool;
    public function loadToken(): ?Token;
}
