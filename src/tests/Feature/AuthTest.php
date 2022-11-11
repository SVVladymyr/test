<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
    * Register as default API user and get token back.
    *
    * @return void
    */
    public function testRegister()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 10; $i++)
        {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $response = $this->post('/api/register', [
            'name'     => "Test",
            'email'    => $randomString . "@test.com",
            'password' => "123456"
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'authorisation' => ['token']
            ]);
    }

    /**
    * Login as default API user and get token back.
    *
    * @return void
    */
    public function testLogin()
    {
        $user = User::find(1);
        $response = $this->post('/api/login', [
            'email'    => $user->email,
            'password' => "123456"
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'authorisation' => ['token']
            ]);
    }
}
