<?php

namespace viannaLucas\BancoInterPhp\ApiHelper;

class PagedResponse
{   
    /**
     * 
     * @param int $totalPaginas
     * @param int $totalElementos
     * @param bool $ultimaPagina
     * @param bool $primeiraPagina
     * @param int $tamanhoPagina
     * @param int $numeroDeElementos
     * @param array<Object> $itens
     */
    public function __construct(
        protected int $totalPaginas,
        protected int $totalElementos,
        protected bool $ultimaPagina,
        protected bool $primeiraPagina,
        protected int $tamanhoPagina,
        protected int $numeroDeElementos,
        protected array $itens
    ) {

    }

    public function getTotalPaginas(): int
    {
        return $this->totalPaginas;
    }

    public function getTotalElementos(): int
    {
        return $this->totalElementos;
    }

    public function getUltimaPagina(): bool
    {
        return $this->ultimaPagina;
    }

    public function getPrimeiraPagina(): bool
    {
        return $this->primeiraPagina;
    }

    public function getTamanhoPagina(): int
    {
        return $this->tamanhoPagina;
    }

    public function getNumeroDeElementos(): int
    {
        return $this->numeroDeElementos;
    }
    
    /**
     * 
     * @return array<Object>
     */
    public function getItens(): array
    {
        return $this->itens;
    }
}
