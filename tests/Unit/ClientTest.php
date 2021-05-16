<?php

namespace Tests\Unit;

use App\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ClientTest extends TestCase
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
    public function testViewClientPage()
    {
        $this->userLogin();

        $response = $this->call('GET','/clients/add');

        $response->assertOk();
    }

    public function testAddClient()
    {
        $this->userLogin();

        $response = $this->call('POST','/clients/save',[
            'clientname' => 'TestClient',
            'email' => 'TestEmail',
            'contact' => '1280',
            'address' => 'TestAddress'
        ]);

        $this->assertDatabaseHas('clients',[
            'clientname' => 'TestClient',
            'email' => 'TestEmail',
            'contact' => '1280',
            'address' => 'TestAddress'
        ]);
    }

    public function testDeleteClient()
    {
        $this->userLogin();

        $this->call('POST','/client/save',[
            'clientid' => '10',
            'clientname' => 'TestClient',
            'email' => 'TestEmail',
            'contact' => '1280',
            'address' => 'TestAddress'
        ]);

        $response = $this->call('POST','/clients/delete',[
            'cid' => '10'
        ]);


        $this->assertDatabaseMissing('clients',[
            'clientid' => '10'
        ]);
    }

}
