<?php

namespace viannaLucas\BancoInterPhp;

class ApiConfiguration
{
    public const BASE_URL = 'https://cdpj.partners.bancointer.com.br/';
    
    /**
     * 
     * @param string $clientId
     * @param string $clientSecret
     * @param array<\viannaLucas\BancoInterPhp\OAuth\Scope> $scopes
     * @param string $fileCertPath
     * @param string $fileCertKey
     */
    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected array $scopes,
        protected string $fileCertPath,
        protected string $fileCertKey,
    ) {

    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }
    
    /**
     * 
     * @return array<\viannaLucas\BancoInterPhp\OAuth\Scope>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getFileCertPath(): string
    {
        return $this->fileCertPath;
    }

    public function getFileCertKey(): string
    {
        return $this->fileCertKey;
    }
}
