<?php

namespace viannaLucas\BancoInterPhp\Banking\Saldo;

class Saldo
{
    /**
     * @var bloqueadoJudicialmente
     * @SuppressWarnings(PHPMD.LongVariable) maintain compatible with api names
     * @var bloqueadoAdministrativo
     * @SuppressWarnings(PHPMD.LongVariable) maintain compatible with api names
     */
    public function __construct(
        protected float $disponivel,
        protected ?float $bloqueadoCheque,
        protected ?float $bloqueadoJudicialmente,
        protected ?float $bloqueadoAdministrativo,
        protected ?float $limite,
    ) {

    }

    public function getBloqueadoCheque(): float
    {
        return $this->bloqueadoCheque;
    }

    public function getDisponivel(): float
    {
        return $this->disponivel;
    }

    public function getBloqueadoJudicialmente(): float
    {
        return $this->bloqueadoJudicialmente;
    }

    public function getBloqueadoAdministrativo(): float
    {
        return $this->bloqueadoAdministrativo;
    }

    public function getLimite(): float
    {
        return $this->limite;
    }
}
