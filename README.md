# BancoInterPHP
SDK para API do Banco Inter 

Para instalar usando composer:

    composer require viannalucas/banco-inter-php 

Exemplo de uso:

```php 
<?php

require './vendor/autoload.php';

use viannaLucas\BancoInterPhp\ApiConfiguration;
use viannaLucas\BancoInterPhp\Banking\Extrato\ApiExtrato;
use viannaLucas\BancoInterPhp\Banking\Saldo\ApiSaldo;
use viannaLucas\BancoInterPhp\OAuth\OAuth;
use viannaLucas\BancoInterPhp\OAuth\Scope;
use viannaLucas\BancoInterPhp\OAuth\TokenPersistence\EncryptFileTokenPesistence;


//dados do app criados utilizando sua conta do banco inter
$clientId = 'fornecido/criado pelo Banco Inter';
$clientSecret = 'fornecido/criado pelo banco Inter';
$scopes = Scope::cases();
$fileCertPath = '/path/to/Inter API_Certificado.crt';
$fileCertKey = '/path/to/Inter API_Chave.key';

$apiConfiguration = new ApiConfiguration($clientId, $clientSecret, $scopes, $fileCertPath, $fileCertKey);

//guardando os dados do token, importante pois há limites de requisição de tokens na API
$fullPath = realpath('./').'/token.obj';
$tokenPersistence = new EncryptFileTokenPesistence($fullPath, 'sua senha para criptografia');
$oAuth = new OAuth($apiConfiguration, $tokenPersistence);

$dataInicio = (new DateTime())->format('Y-m-d');
$dataFim = (new \DateTime())->sub(DateInterval::createFromDateString('30 day'))->format('Y-m-d');

$apiExtrato = new ApiExtrato($apiConfiguration, $tokenPersistence);
//print_r($apiExtrato->consultarExtrato($dataInicio, $dataFim));
//print_r($apiExtrato->extratoCompleto($dataInicio, $dataFim, 1, 5));
//file_put_contents('./extrato.pdf', base64_decode($apiExtrato->extratoExportar($dataInicio, $dataFim)));

$apiSaldo = new ApiSaldo($apiConfiguration, $tokenPersistence);
print_r($apiSaldo->saldo($dataInicio));