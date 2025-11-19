<?php

namespace App\Services\Inter;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class InterApiService
{
    private string $baseUrl;
    private string $clientId;
    private string $clientSecret;
    private string $certificate;
    private string $certPassword;

    public function __construct()
    {
        $this->baseUrl = config('services.inter.base_url');
        $this->clientId = config('services.inter.client_id');
        $this->clientSecret = config('services.inter.client_secret');
        $this->certificate = storage_path('app/inter/certificado.p12');
        $this->certPassword = config('services.inter.cert_password');
    }

    private function getHttpClient(): PendingRequest
    {
        return Http::withOptions([
            'cert' => [$this->certificate, $this->certPassword],
            'ssl_key' => [$this->certificate, $this->certPassword],
        ]);
    }

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    private function getAuthToken(): string
    {
        $response = $this->getHttpClient()
            ->asForm()
            ->post("{$this->baseUrl}/oauth/v2/token", [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'boleto-cobranca.write boleto-cobranca.read',
            ]);

        if (!$response->successful()) {
            throw new Exception("Erro ao obter token: " . $response->body());
        }

        return $response->json()['access_token'];
    }

    /**
     * @throws Exception
     */
    private function uploadCertificate(): void
    {
        if (!file_exists($this->certificate)) {
            throw new Exception("Certificado não encontrado em: {$this->certificate}");
        }
    }

    /**
     * GERA UM BOLETO
     * @throws Exception
     */
    public function generateBillet(array $data): array
    {
        try {
            $this->uploadCertificate();

            $token = $this->getAuthToken();

            $response = $this->getHttpClient()
                ->withToken($token)
                ->post("{$this->baseUrl}/cobranca/v2/boletos", $data);

            if (!$response->successful()) {
                throw new Exception("Erro ao gerar boleto: " . $response->body());
            }
        } catch (ConnectionException $e) {
            throw new Exception("Erro ao gerar boleto: " . $e->getMessage());
        }

        return $response->json();
    }

    /**
     * Consulta um boleto
     * @throws Exception
     */
    public function getBillet(string $numero): array
    {
        $token = $this->getAuthToken();

        $response = $this->getHttpClient()
            ->withToken($token)
            ->get("{$this->baseUrl}/cobranca/v2/boletos/{$numero}");

        if (!$response->successful()) {
            throw new Exception("Erro ao consultar boleto: " . $response->body());
        }

        return $response->json();
    }
}
