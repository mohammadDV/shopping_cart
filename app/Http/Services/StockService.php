<?php

namespace App\Http\Services;

use App\Models\Product;

class StockService {

    public function getStock($id){
        return Product::select('stock')->where('id',$id)->first()->stock;
    }

    public function reduceStock($id,$count){
        return Product::where('id',$id)->decrement('stock', $count);
    }

    public function addStock($id,$count){
        return Product::where('id',$id)->increment('stock', $count);
    }
}
