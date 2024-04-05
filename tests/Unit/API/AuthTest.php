<?php

uses(Tests\TestCase::class, \Illuminate\Foundation\Testing\RefreshDatabase::class);

test('user can register successfully', function () {
    $data = [
        'name'      => 'John Doe',
        'email'     => 'john.doe@example.com',
        'password'  => 'password'
    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(200)->assertJson([
        'status' => true,
    ]);
});

test('register return validation error for name', function () {
    $data = [
        'email'     => 'john.doe@example.com',
        'password'  => 'password'
    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(422)->assertJsonStructure([
        'errors' => [
            'name'
        ],
    ]);
});

test('register return validation error for email', function () {
    $data = [
        'name'      => 'John Doe',
        'password'  => 'password'
    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(422)->assertJsonStructure([
        'errors' => [
            'email'
        ],
    ]);
});

test('register return validation error for password', function () {
    $data = [
        'name'      => 'John Doe',
        'email'     => 'john.doe@example.com',
    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(422)->assertJsonStructure([
        'errors' => [
            'password'
        ],
    ]);
});
