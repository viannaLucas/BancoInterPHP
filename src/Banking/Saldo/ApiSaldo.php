<?php

namespace viannaLucas\BancoInterPhp\Banking\Saldo;

use viannaLucas\BancoInterPhp\ApiBancoInter;

class ApiSaldo extends ApiBancoInter
{
    public function saldo(\DateTime $dataSaldo): Saldo
    {
        $params = [
            'dataSaldo' => $dataSaldo->format('Y-m-d'),
        ];
        
        $objResp = $this->validateResponse($this->getRequest('banking/v2/saldo', $params));
        return new Saldo(
            $objResp->disponivel?? null,
            $objResp->bloqueadoCheque ?? null,
            $objResp->bloqueadoJudicialmente ?? null,
            $objResp->bloqueadoAdministrativo ?? null,
            $objResp->limite ?? null,
        );
    }
}
