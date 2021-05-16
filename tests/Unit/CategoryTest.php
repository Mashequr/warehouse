<?php

namespace Tests\Unit;

use App\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    public function testViewCategoryPage()
    {
        $this->userLogin();

        $response = $this->call('GET','/category/add');

        $response->assertOk();
    }

    public function testAddCategory()
    {
        $this->userLogin();

        $response = $this->call('POST','/category/save',[
            'catname' => 'TestCat'
        ]);

        $this->assertDatabaseHas('categorys',[
            'catname' => 'TestCat'
        ]);
    }

    public function testDeleteCategory()
    {
        $this->userLogin();

        $this->call('POST','/category/save',[
            'catid' => '10',
            'catname' => 'TestCat'
        ]);

        $response = $this->call('POST','/category/delete',[
            'catid' => '10'
        ]);


        $this->assertDatabaseMissing('categorys',[
            'catid' => '10'
        ]);
    }

}
