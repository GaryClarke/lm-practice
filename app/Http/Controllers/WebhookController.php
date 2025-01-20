<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\ErrorHandler;
use App\DTOs\Webhook;
use App\Handlers\HandlerDelegator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class WebhookController extends Controller
{
    public function __construct(
        readonly private HandlerDelegator $handlerDelegator,
        readonly private ErrorHandler $errorHandler,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $platform = $this->determinePlatform($request);
        $payload = $request->all();

        try {
            $webhook = new Webhook($platform, $payload);
            $this->handlerDelegator->delegate($webhook);
            return new JsonResponse(status: 204);
        } catch (Throwable $throwable) {
            $this->errorHandler->handle($throwable);
            return new JsonResponse(status: Response::HTTP_BAD_REQUEST);
        }
    }

    private function determinePlatform(Request $request): string
    {
        return strtolower($request->header('X-Webhook-Source', 'unknown'));
    }
}
