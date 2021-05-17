<?php

namespace Tests\Unit;

use App\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class ProfileTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function userLogin()
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@user.com',
            'password' => '1234'
        ]);

        $this->actingAs($user);
    }

    public function testViewProfile()
    {
        $this->userLogin();

        $response = $this->call('GET', '/stock/profile');

        $response->assertOk();
    }

    public function testChangePassword()
    {
        $this->userLogin();

        $response = $this->call('POST', '/stock/profile/changepassword', [
            'curr_pass' => '1234',
            'new_pass' => '4321',
            'conf_pass' => '4321'
        ]);

        $response->assertStatus(302);
    }
}
