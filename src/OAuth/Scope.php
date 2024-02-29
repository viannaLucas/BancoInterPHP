<?php

namespace viannaLucas\BancoInterPhp\OAuth;

enum Scope: string
{
    case ExtratoRead = 'extrato.read'; // Consulta de Extrato e Saldo
    case BoletoCobrancaRead = 'boleto-cobranca.read'; // Consulta de boletos e exportação para PDF
    case BoletoCobrancaWrite = 'boleto-cobranca.write'; // Emissão e cancelamento de boletos
    case PagamentoBoletoWrite = 'pagamento-boleto.write'; // Pagamento de titulo com código de barras
    case PagamentoBoletoRead = 'pagamento-boleto.read'; // Obter dados completos do titulo a partir do código de barras ou da linha digitável
    case PagamentoDarfWrite = 'pagamento-darf.write'; // Pagamento de DARF sem código de barras
    case CobrancaWrite = 'cob.write'; // Alteração de cobranças imediatas
    case CobrancaRead = 'cob.read'; // Consulta de cobranças imediatas
    case CobrancaVencimentoWrite = 'cobv.write'; // Alteração de cobranças com vencimento
    case CobrancaVencimentoRead = 'cobv.read'; // Consulta de cobranças com vencimento
    case PixWrite = 'pix.write'; // Alteração de pix
    case PixRead = 'pix.read'; // Consulta de pix
    case WebhookRead = 'webhook.read'; // Consulta do webhook
    case WebhookWrite = 'webhook.write'; // Alteração do webhook
    case PayloadLocationWrite = 'payloadlocation.write'; // Alteração de payloads
    case PayloadLocationRead = 'payloadlocation.read'; // Consulta de payloads
    case PagamentoPixWrite = 'pagamento-pix.write'; // Pagamento de pix
    case PagamentoPixRead = 'pagamento-pix.read'; // Consulta de pix
    case WebhookBankingWrite = 'webhook-banking.write'; // Alteração de webhooks da API Banking
    case WebhookBankingRead = 'webhook-banking.read'; // Consulta do webhooks da API Banking

    /**
     * 
     * @param array<Scope> $scopes
     * @return string
     */
    public static function convertToString(array $scopes): string
    {
        $scopeValues = [];
        foreach($scopes as $scope) {
            $scopeValues[] = $scope->value;
        }
        return implode(' ', $scopeValues);
    }
}
