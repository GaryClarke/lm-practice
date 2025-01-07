<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Webhook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $platform = $this->determinePlatform($request);
        $payload = $request->all();

        $webhook = new Webhook($platform, $payload);

        return new JsonResponse(status: 204);
    }

    private function determinePlatform(Request $request): string
    {
        return strtolower($request->header('X-Webhook-Source', 'unknown'));
    }
}
