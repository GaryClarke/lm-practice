<?php

declare(strict_types=1);

namespace App\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

readonly class AudienceGridClient implements AudienceGridClientInterface
{
    private string $apiUrl;

    public function __construct(
    ) {
        $this->apiUrl = config('services.audiencegrid.api_url');
    }

    /**
     * @param array<string, mixed> $data
     */
    public function post(array $data): Response
    {
        return Http::post($this->apiUrl, $data);
    }
}
