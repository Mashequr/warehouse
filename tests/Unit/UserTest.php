<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@user.com',
            'password' => '1234'
        ]);

        $this->actingAs($user);

        $this->assertAuthenticated();
    }
}
