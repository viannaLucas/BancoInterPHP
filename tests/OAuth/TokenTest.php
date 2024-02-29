<?php

namespace viannaLucas\BancoInterPhp\Test\OAuth;

use \PHPUnit\Framework\TestCase;
use \viannaLucas\BancoInterPhp\OAuth\Token;
use viannaLucas\BancoInterPhp\Test\DataProvider;

final class TokenTest extends TestCase
{
    public function testCanSerializeUnserialize(): void
    {
        $token = DataProvider::token();
        $serializedToken = serialize($token);
        $unserializedToken = unserialize($serializedToken);
        $this->assertEquals(true, $unserializedToken instanceof Token, 'Error serialization token.');
        
        $this->assertEquals($token->getAccessToken(), $unserializedToken->getAccessToken(), 'accessToken after unserialized error');
        $this->assertEquals($token->getExpiresIn(), $unserializedToken->getExpiresIn(), 'expireIn after unserialized error');
        $this->assertEquals($token->getScope(), $unserializedToken->getScope(), 'scope after unserialized error');
        $this->assertEquals($token->getTokenType(), $unserializedToken->getTokenType(), 'tokenType after unserialized error');
    }
    
    public function testCanDefineExpired(): void
    {
        $iterations = 10;
        $now = (new \DateTime());
        foreach(range(0, $iterations) as $i){
            $isExpired = $i%2 == 0;
            $token = DataProvider::token($isExpired);
            $expire = new \DateTime();
            $expire->setTimestamp($token->getExpiresIn());
            $errorText = 'Error verify token is expired: Now: '
                .$now->format('Y-m-d H:i:s').' - Token:'.$expire->format('Y-m-d H:i:s');
            $this->assertEquals($isExpired, $token->isExpired(), $errorText);
        }
    }
}