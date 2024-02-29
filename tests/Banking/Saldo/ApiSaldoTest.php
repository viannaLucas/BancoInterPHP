<?php

use PHPUnit\Framework\TestCase;
use viannaLucas\BancoInterPhp\ApiConfiguration;
use viannaLucas\BancoInterPhp\Banking\Saldo\ApiSaldo;
use viannaLucas\BancoInterPhp\OAuth\TokenPersistence\EncryptFileTokenPesistence;
use viannaLucas\BancoInterPhp\Response;

class ApiSaldoTest extends TestCase
{
    public function testRequestSaldoSuccess(){
        $apiSaldo = $this->getMokedApiSaldo();
        
        $bodyResponse = '{
  "bloqueadoCheque": 240.25,
  "disponivel": 2850.55,
  "bloqueadoJudicialmente": 510.35,
  "bloqueadoAdministrativo": 510.35,
  "limite": 510.35
}';
        $apiSaldo->expects($this->once())
            ->method('getRequest')
            ->willReturn(new Response(200, $bodyResponse));
        
        $data = DateTime::createFromFormat('Y-m-d', '2023-09-01');
        $saldo = $apiSaldo->saldo($data);
        $this->assertEquals($saldo->getDisponivel(), 2850.55, 'Sando disponível incorreto');
    }
    
    public function testRequestSaldoErrorResponse()
    {
        $apiSaldo = $this->getMokedApiSaldo();
        
        $this->expectExceptionMessage('Error request. Http Error Code: '.'403');
        $apiSaldo->expects($this->once())
            ->method('getRequest')
            ->willReturn(new Response(403, ''));
        
        $data = DateTime::createFromFormat('Y-m-d', '2023-09-01');
        $apiSaldo->saldo($data);
    }
    
    public function testRequestSaldoErrorJson()
    {
        $apiSaldo = $this->getMokedApiSaldo();
        
        $this->expectExceptionMessage('Invalid response json format');
        $apiSaldo->expects($this->once())
            ->method('getRequest')
            ->willReturn(new Response(200, 'kjaljlaj'));
        
        $data = DateTime::createFromFormat('Y-m-d', '2023-09-01');
        $apiSaldo->saldo($data);
    }
    
    private function getMokedApiSaldo(): mixed
    {
        return $this->getMockBuilder(ApiSaldo::class)
            ->setConstructorArgs([
                new ApiConfiguration('', '', [], '', ''), 
                new EncryptFileTokenPesistence('', '')
            ])
            ->onlyMethods(['getRequest'])
            ->getMock();
    }
}