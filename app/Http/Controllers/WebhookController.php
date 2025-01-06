<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(status: 204);
    }
}
