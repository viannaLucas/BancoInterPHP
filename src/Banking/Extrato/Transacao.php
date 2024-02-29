<?php

namespace viannaLucas\BancoInterPhp\Banking\Extrato;

use DateTime;

class Transacao
{
    public function __construct(
        protected DateTime $dataEntrada,
        protected string $tipoTransacao,
        protected string $tipoOperacao,
        protected float $valor,
        protected string $titulo,
        protected string $descricao,
    ) {

    }

    public function getDataEntrada(): \DateTime
    {
        return $this->dataEntrada;
    }

    public function getTipoTransacao(): string
    {
        return $this->tipoTransacao;
    }

    public function getTipoOperacao(): string
    {
        return $this->tipoOperacao;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }
}
