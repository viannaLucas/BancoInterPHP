<?php

namespace viannaLucas\BancoInterPhp\Banking\Extrato;

class TransacaoCompleta
{
    public function __construct(
        protected string $idTransacao,
        protected \DateTime $dataInclusao,
        protected \DateTime $dataTransacao,
        protected string $tipoTransacao,
        protected string $tipoOperacao,
        protected string $valor,
        protected string $titulo,
        protected string $descricao,
        protected ?object $detalhes,
    ) {

    }

    public function getIdTransacao(): string
    {
        return $this->idTransacao;
    }

    public function getDataInclusao(): \DateTime
    {
        return $this->dataInclusao;
    }

    public function getDataTransacao(): \DateTime
    {
        return $this->dataTransacao;
    }

    public function getTipoTransacao(): string
    {
        return $this->tipoTransacao;
    }

    public function getTipoOperacao(): string
    {
        return $this->tipoOperacao;
    }

    public function getValor(): string
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

    public function getDetalhes(): ?object
    {
        return $this->detalhes;
    }
}
