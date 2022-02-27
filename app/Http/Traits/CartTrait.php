<?php

namespace App\Http\Traits;


trait CartTrait {
    public function calculateTotal()
    {
        foreach ($this->cart->products as $cart_product){
            if ($cart_product->id == $this->product_id){
                $this->cart->products()->detach($this->product_id);
                $this->stockService->addStock($cart_product->id,$cart_product->pivot->count);
            }else{
                $this->total += $cart_product->price * $cart_product->pivot->count;
            }
        }
        return $this->total;
    }

    public function addNewProduct($product)
    {
        $this->cart->products()->attach($this->product_id,['count' => $this->count]);
        $this->total += $product->price * $this->count;
        $this->stockService->reduceStock($product->id,$this->count);
        $this->cart->update(['total' => $this->total]);
    }
}
