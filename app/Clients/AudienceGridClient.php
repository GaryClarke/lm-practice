<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AudienceGridClient implements AudienceGridClientInterface
{
    private const string API_URL = 'https://api.audiencegrid.com/events';

    /**
     * @param array<string, mixed> $data
     */
    public function post(array $data): Response
    {
        return Http::post(self::API_URL, $data);
    }
}
