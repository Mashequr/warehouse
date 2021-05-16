<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use App\User;

class BasicTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testIndex()
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@user.com',
            'password' => '1234'
        ]);

        $this->actingAs($user);

        $response = $this->call('GET','/home');

        $response->assertOk();
    }
}
