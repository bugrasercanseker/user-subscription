<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('can create subscription', function () {
    $user = \App\Models\User::factory()->create();

    $data = [
        'renewal_at' => today()->addMonth()
    ];

    $response = $this->postJson("/api/user/{$user->id}/subscription", $data);

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);
});

test('can update subscription', function () {
    $user = \App\Models\User::factory()->create();
    $subscription = \App\Models\Subscription::factory()->create(['user_id' => $user->id]);

    $data = [
        'renewal_at' => today()->addMonth()
    ];

    $response = $this->putJson("/api/user/{$user->id}/subscription/{$subscription->id}", $data);

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);
});

test('can delete subscription', function () {
    $user = \App\Models\User::factory()->create();
    $subscription = \App\Models\Subscription::factory()->create(['user_id' => $user->id]);

    $data = [
        'renewal_at' => today()->addMonth()
    ];

    $response = $this->deleteJson("/api/user/{$user->id}/subscription/{$subscription->id}", $data);

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);
});
