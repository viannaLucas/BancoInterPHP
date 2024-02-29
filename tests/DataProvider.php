<?php

namespace viannaLucas\BancoInterPhp\Test;

use DateInterval;
use DateTime;
use viannaLucas\BancoInterPhp\OAuth\Scope;
use viannaLucas\BancoInterPhp\OAuth\Token;


class DataProvider
{
    
    public static function token(bool $expired = true): Token
    {
        $allScopes = Scope::cases();
        $randonQntScopes = random_int(1, count($allScopes));
        $indexsRand = array_rand($allScopes, $randonQntScopes);
        if(!is_array($indexsRand)){
            $indexsRand = [$indexsRand];
        }
        $scopes = [];
        foreach ($indexsRand as $index){
            $scopes[] = $allScopes[$index];
        }
        $data = new DateTime();
        
        if($expired === true){ // 3600 is default time token is valid in secounds
            $data = $data->sub(new DateInterval('PT3600S'));
        }else{
            $data = $data->add(new DateInterval('PT3600S'));
        }
        return new Token(random_bytes(15), 'client_credentials', $data->getTimestamp(), Scope::convertToString($scopes));
    }
}