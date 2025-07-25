<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZohoService
{
    private string $baseUrl;
    private string $token;
    public function __construct(ZohoTokenService $zohoTokenService)
    {
        $this->baseUrl = config('services.zoho.base_url');
        $this->token = $zohoTokenService->getAccessToken();
    }

    public function createAccount(array $accountData): string
    {
        $response = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/Accounts", [
                'data' => [$accountData],
            ]);

        $response->throw();

        $data = $response->json();
        if (data_get($data, 'data.0.code') === 'SUCCESS') {
            return data_get($data, 'data.0.details.id');
        }

        throw new \Exception('Account creation failed or invalid response structure.' . $response->body());
    }

    public function createDeal(array $dealData): array
    {
        $response = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/Deals", [
                'data' => [$dealData],
            ]);

        $response->throw();
        return $response->json();
    }

    protected function headers(): array
    {
        return [
            'Authorization' => 'Zoho-oauthtoken ' . $this->token,
            'Content-Type'  => 'application/json',
        ];
    }
}
