<?php

namespace Tests\Feature\Models;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_cart()
    {
        $data = Cart::factory()->make()->toArray();
        Cart::create($data);
        $this->assertDatabaseHas('carts',$data);
    }

    public function test_cart_relationship_with_product()
    {
        $count  = rand(2,10);
        $data   = Cart::factory()->has(Product::factory()->count($count))->create();
        $this->assertCount($count,$data->products);
        $this->assertTrue($data->products->first() instanceof Product);
    }
}
