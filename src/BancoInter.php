<?php

namespace viannaLucas\BancoInterPhp;

use viannaLucas\BancoInterPhp\OAuth\OAuth;

class BancoInter
{
    public function __construct(
        protected OAuth $oAuth,
    ) {

    }

}
