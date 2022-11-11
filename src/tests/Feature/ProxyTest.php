<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use Tests\TestCase;
use App\Models\User;

class ProxyTest extends TestCase
{
    /**
     * Proxy list test.
     *
     * @return void
     */
    public function test_list_request()
    {
        $user = User::find(1);
        $token = Auth::attempt([
            'email'    => $user->email,
            'password' => '123456'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ])->post('api/proxies/list');

        $response->assertStatus(200);
    }

    /**
     * Test proxy export.
     *
     * @return void
     */
    public function test_export_request()
    {
        $user = User::find(1);
        $token = Auth::attempt([
            'email'    => $user->email,
            'password' => '123456'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ])->post('/api/proxies/export', ['format' => '192.168.0.1:25@login:password']);

        $response->assertStatus(200);
    }
}
