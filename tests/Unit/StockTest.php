<?php

namespace Tests\Unit;

use App\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StockTest extends TestCase
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

    public function testAddStockPage()
    {
        $this->userLogin();

        $response = $this->call('GET','/stock/add');

        $response->assertOk();
    }

    public function testSaveStock()
    {
        $this->userLogin();

        $this->call('POST','/stock/save',[
            'stockid' => 'ST20212224ITM420455',
            'category' => 'Electronics',
            'description' => 'Nokia 3310',
            'quantity' => '50',
            'amount' => '30',
            'unit' => 'kg',
            'client' => '10',
            'stockdate' => '2021-05-05',
            'stockuntil' => '2021-05-14'
        ]);

        $this->assertDatabaseHas('stocks',[
            'stockid' => 'ST20212224ITM420455'
        ]);
    }

    public function testConfirmStock()
    {
        $this->userLogin();

        $this->call('POST','/stock/save',[
            'stockid' => 'ST20212224ITM420455',
            'category' => 'Electronics',
            'description' => 'Nokia 3310',
            'quantity' => '50',
            'amount' => '30',
            'unit' => 'kg',
            'client' => '10',
            'stockdate' => '2021-05-05',
            'stockuntil' => '2021-05-14'
        ]);

        $response = $this->call('GET','/stock/confirm/ST20212224ITM420455');

        $response->assertOk();
    }

    public function testConfirmInvoice()
    {
        $this->userLogin();

        $response = $this->call('POST','/stock/confirm/invoice',[
            'stockid' => 'ST20212224ITM420455',
            'total' => '1500',
            'paid' => '1000',
            'due' => '500',
            'paymethod' => 'Bkash'
        ]);

        $response->assertStatus(302);
    }

    public function testViewStocks()
    {
        $this->userLogin();

        $response = $this->call('GET','/stock/viewstocks');

        $response->assertOk();
    }

    public function testDeleteStock()
    {
        $this->userLogin();

        $this->call('POST','/stock/save',[
            'stockid' => 'ST20212224ITM420455',
            'category' => 'Electronics',
            'description' => 'Nokia 3310',
            'quantity' => '50',
            'amount' => '30',
            'unit' => 'kg',
            'client' => '10',
            'stockdate' => '2021-05-05',
            'stockuntil' => '2021-05-14'
        ]);

        $this->call('POST','/stock/confirm/invoice',[
            'stockid' => 'ST20212224ITM420455',
            'total' => '1500',
            'paid' => '1000',
            'due' => '500',
            'paymethod' => 'Bkash'
        ]);

        $this->call('POST','/stock/deletestocks',[
            'stockid' => 'ST20212224ITM420455'
        ]);

        $this->assertDatabaseMissing('stocks',[
            'stockid' => 'ST20212224ITM420455'
        ]);

        $this->assertDatabaseMissing('invoices',[
            'stockid' => 'ST20212224ITM420455'
        ]);

    }

    public function testViewInvoice()
    {
        $this->userLogin();

        $this->call('POST','/client/save',[
            'clientid' => '10',
            'clientname' => 'TestClient',
            'email' => 'TestEmail',
            'contact' => '1280',
            'address' => 'TestAddress'
        ]);

        $this->call('POST','/stock/save',[
            'stockid' => 'ST20212224ITM420455',
            'category' => 'Electronics',
            'description' => 'Nokia 3310',
            'quantity' => '50',
            'amount' => '30',
            'unit' => 'kg',
            'client' => '10',
            'stockdate' => '2021-05-05',
            'stockuntil' => '2021-05-14'
        ]);

        $this->call('POST','/stock/confirm/invoice',[
            'stockid' => 'ST20212224ITM420455',
            'total' => '1500',
            'paid' => '1000',
            'due' => '500',
            'paymethod' => 'Bkash'
        ]);

        $response = $this->call('GET','/stock/viewinvoice/ST20212224ITM420455');

        $response->assertOk();
    }

    public function testDischargeStocks()
    {
        $this->userLogin();

        $this->call('POST','/client/save',[
            'clientid' => '10',
            'clientname' => 'TestClient',
            'email' => 'TestEmail',
            'contact' => '1280',
            'address' => 'TestAddress'
        ]);

        $this->call('POST','/stock/save',[
            'stockid' => 'ST20212224ITM420455',
            'category' => 'Electronics',
            'description' => 'Nokia 3310',
            'quantity' => '50',
            'amount' => '30',
            'unit' => 'kg',
            'client' => '10',
            'stockdate' => '2021-05-05',
            'stockuntil' => '2021-05-14'
        ]);

        $this->call('POST','/stock/confirm/invoice',[
            'stockid' => 'ST20212224ITM420455',
            'total' => '1500',
            'paid' => '1000',
            'due' => '500',
            'paymethod' => 'Bkash'
        ]);
    }
}
