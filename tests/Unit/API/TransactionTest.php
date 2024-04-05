<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('can create transaction', function () {
    $user = \App\Models\User::factory()->create();
    $subscription = \App\Models\Subscription::factory()->create(['user_id' => $user->id]);

    $data = [
        'subscription_id' => $subscription->id,
        'price'           => 100
    ];

    $response = $this->postJson("/api/user/{$user->id}/transaction", $data);

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);
});
