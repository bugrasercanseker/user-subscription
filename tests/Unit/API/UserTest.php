<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('User response as expected', function () {
    $user = \App\Models\User::factory()->create();
    $subscriptions = \App\Models\Subscription::factory()->count(2)->create(['user_id' => $user->id]);
    $transactions = \App\Models\Transaction::factory()->count(10)->create(['user_id' => $user->id]);

    $response = $this->getJson("/api/user/{$user->id}");

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);

    $response->assertJsonStructure([
        'data' => [
            'user',
            'subscriptions',
            'transactions'
        ]
    ]);
});
