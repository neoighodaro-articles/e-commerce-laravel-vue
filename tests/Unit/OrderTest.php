<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    public function testCreateOrder()
    {
        $data  = [
                    'product' => 1,
                    'quantity' => 20,
                    'address' => "No place like home"
                ];
        $user   = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/orders',$data);
        $response->assertStatus(200);
        $response->assertJson(['status'        => true]);
        $response->assertJson(['message'       => "Order Created!"]);
        $response->assertJsonStructure(['data' => [
                                'id',
                                'product_id',
                                'user_id',
                                'quantity',
                                'address',
                                'created_at',
                                'updated_at'
                        ]]);
    }

    public function testGetAllOrders()
    {
        $user             = factory(\App\User::class)->create();
        $response         = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);
        $response->assertJsonStructure(
                [
                        [
                                'id',
                                'product_id',
                                'user_id',
                                'quantity',
                                'address',
                                'created_at',
                                'updated_at'
                        ]
                ]
            );
    }

    public function testDeliverOrder()
    {
        $user      = factory(\App\User::class)->create();
        $response  = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);

        $order     = $response->getData()[0];

        $update    = $this->actingAs($user, 'api')->json('PATCH', '/api/orders/'.$order->id."/deliver");
        $update->assertStatus(200);
        $update->assertJson(['message' => "Order Delivered!"]);

        $updatedOrder = $update->getData('data');
        $this->assertTrue($updatedOrder['data']['is_delivered']);
        $this->assertEquals($updatedOrder['data']['id'], $order->id);
    }

    public function testUpdateOrder()
    {
        $user      = factory(\App\User::class)->create();
        $response  = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);

        $order     = $response->getData()[0];

        $update    = $this->actingAs($user, 'api')->json('PATCH', '/api/orders/'.$order->id,['quantity' => ($order->id+5)]);
        $update->assertStatus(200);
        $update->assertJson(['message' => "Order Updated!"]);
    }

    public function testDeleteOrder()
    {
        $user     = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);

        $order    = $response->getData()[0];

        $update   = $this->actingAs($user, 'api')->json('DELETE', '/api/orders/'.$order->id);
        $update->assertStatus(200);
        $update->assertJson(['message' => "Order Deleted!"]);
    }
}
