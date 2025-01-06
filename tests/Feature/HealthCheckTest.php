<?php

declare(strict_types=1);

use function Pest\Laravel\getJson;

test('the healthcheck endpoint works', function () {
    getJson('/api/healthcheck')
        ->assertOk()
        ->assertJson(['status' => 'ok']);
});
