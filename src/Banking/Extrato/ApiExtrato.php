<?php

namespace viannaLucas\BancoInterPhp\Banking\Extrato;

use DateTime;
use Exception;
use viannaLucas\BancoInterPhp\ApiBancoInter;
use viannaLucas\BancoInterPhp\ApiHelper\PagedResponse;
use viannaLucas\BancoInterPhp\Banking\Extrato\Transacao;
use viannaLucas\BancoInterPhp\Banking\Extrato\TransacaoCompleta;

class ApiExtrato extends ApiBancoInter
{

    /**
     * 
     * @param DateTime $dataInicio
     * @param DateTime $dataFim
     * @return array<\viannaLucas\BancoInterPhp\Banking\Extrato\Transacao>
     */
    public function extrato(
        DateTime $dataInicio,
        DateTime $dataFim
    ): array
    {
        $params = [
            'dataInicio' => $dataInicio->format('Y-m-d'),
            'dataFim' => $dataFim->format('Y-m-d'),
        ];
        /** @var object{transacoes: array<object{
         *  dataEntrada:string, tipoTransacao:string, tipoOperacao:string,
         *  valor: string, titulo: string, descricao: string }>} */
        $objResp = $this->validateResponse($this->getRequest('banking/v2/extrato', $params));
        $extratoList = [];
        foreach ($objResp->transacoes as $transacao) {
            $extratoList[] = new Transacao(
                DateTime::createFromFormat('Y-m-d', $transacao->dataEntrada),
                $transacao->tipoTransacao,
                $transacao->tipoOperacao,
                floatval($transacao->valor),
                $transacao->titulo,
                $transacao->descricao
            );
        }
        return $extratoList;
    }

    /**
     *
     * @param DateTime $dataInicio
     * @param DateTime $dataFim
     * @return string Pdf file content in base64 encode
     * @throws Exception
     */
    public function extratoExportar(
        DateTime $dataInicio,
        DateTime $dataFim
    ): string
    {
        $params = [
            'dataInicio' => $dataInicio->format('Y-m-d'),
            'dataFim' => $dataFim->format('Y-m-d'),
        ];
        $objResp = $this->validateResponse($this->getRequest('banking/v2/extrato/exportar', $params));
        return $objResp->pdf;
    }
    
    /**
     * 
     * @param DateTime $dataInicio
     * @param DateTime $dataFim
     * @param int $pagina
     * @param int $tamanhoPagina
     * @param string $tipoOperacao
     * @param string $tipoTransacao
     * @return PagedResponse
     * 
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function extratoCompleto(
        DateTime $dataInicio,
        DateTime $dataFim,
        int $pagina = 0,
        int $tamanhoPagina = 50,
        string $tipoOperacao = '',
        string $tipoTransacao = ''
    ): PagedResponse
    {
        $params = [
            'dataInicio' => $dataInicio->format('Y-m-d'),
            'dataFim' => $dataFim->format('Y-m-d'),
            'pagina' => $pagina,
            'tamanhoPagina' => $tamanhoPagina,
        ];
        if ($tipoOperacao != '') {
            $params['tipoOperacao'] = $tipoOperacao;
        }
        if ($tipoTransacao != '') {
            $params['tipoTransacao'] = $tipoTransacao;
        }

        $objResp = $this->validateResponse($this->getRequest('banking/v2/extrato/completo', $params));
        $extratoList = [];
        foreach ($objResp->transacoes as $transacao) {
            $extratoList[] = new TransacaoCompleta(
                $transacao->idTransacao,
                \DateTime::createFromFormat('Y-m-d H:i:s.v', $transacao->dataInclusao),
                \DateTime::createFromFormat('Y-m-d', $transacao->dataTransacao),
                $transacao->tipoTransacao,
                $transacao->tipoOperacao,
                $transacao->valor,
                $transacao->titulo,
                $transacao->descricao,
                $transacao->detalhes ?? null,
            );
        }
        return new PagedResponse(
            $objResp->totalPaginas,
            $objResp->totalElementos,
            (bool) $objResp->ultimaPagina,
            (bool) $objResp->primeiraPagina,
            $objResp->tamanhoPagina,
            $objResp->numeroDeElementos,
            $extratoList
        );
    }
}