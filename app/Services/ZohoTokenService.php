<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ZohoTokenService
{
    public function getAccessToken(): string
    {
        $token = Cache::get('zoho_access_token');
        if (!$token) {
            $token = $this->refreshAccessToken();
        }
        return $token;
    }

    public function refreshAccessToken(): string
    {
        $refreshToken = config('services.zoho.refresh_token');
        $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'refresh_token' => $refreshToken,
            'client_id'     => config('services.zoho.client_id'),
            'client_secret' => config('services.zoho.client_secret'),
            'grant_type'    => 'refresh_token',
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to refresh Zoho token: ' . $response->body());
        }

        $accessToken = $response->json()['access_token'];
        Cache::put('zoho_access_token', $accessToken, now()->addMinutes(5));
        return $accessToken;
    }
}
