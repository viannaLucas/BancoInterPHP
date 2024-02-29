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

//cria as configurações da api, 
$apiConfiguration = new ApiConfiguration($clientId, $clientSecret, $scopes, $fileCertPath, $fileCertKey);

//guardando os dados do token, importante pois há limites de requisição de tokens na API
//desta forma reaproveitar os tokens até seu vencimento evita receber erros de 
//limite excedido
$fullPath = realpath('./').'/token.obj';
$tokenPersistence = new EncryptFileTokenPesistence($fullPath, 'jujuba_sa');

// cria a o objeto de conexão/requisição com a api e faz o controle do token
$oAuth = new OAuth($apiConfiguration, $tokenPersistence);

//datas do intervalo que deseja o extrato, no exemplo últimos 30 dias
$dataInicio = (new \DateTime())->sub(DateInterval::createFromDateString('30 day'));
$dataFim = (new DateTime());

// cria objeto que fará requisição da API das funções de extrato
$apiExtrato = new ApiExtrato($apiConfiguration, $tokenPersistence);

//dados das movimentação do período solicitado
print_r($apiExtrato->extrato($dataInicio, $dataFim));

//dados das movimentações detalhadas do período solicitado
print_r($apiExtrato->extratoCompleto($dataInicio, $dataFim, 1, 5));

//solicita o extrato no formato PDF dos dados das movimentações do intervalo informado
file_put_contents('./extrato.pdf', base64_decode($apiExtrato->extratoExportar($dataInicio, $dataFim)));

//Cria objeto que fará requisicao da API das funções de saldo
$apiSaldo = new ApiSaldo($apiConfiguration, $tokenPersistence);
//dados de saldo de um determinado dia
print_r($apiSaldo->saldo($dataInicio));