<?php

namespace Tests\Feature\Models;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_product()
    {
        $data = Product::factory()->make()->toArray();
        Product::create($data);
        $this->assertDatabaseHas('products',$data);
    }

    public function test_product_relationship_with_cart()
    {
        $count = rand(2,10);
        $data = Product::factory()->has(Cart::factory()->count($count))->create();
        $this->assertCount($count,$data->carts);
        $this->assertTrue($data->carts->first() instanceof Cart);
    }
}
