<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UniqueRequest;
use App\Http\Resources\CartResource;
use App\Http\Services\StockService;
use App\Http\Traits\CartTrait;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CartController extends Controller
{
    use CartTrait;
    protected $total            = 0;
    protected $cart             = [];
    protected $stockService     = [];
    protected $count            = [];
    protected $product_id       = [];
    public function store(CartRequest $request)
    {
        DB::beginTransaction();
        try {
            // set properties
            $this->product_id       = $request->input('product_id');
            $this->count            = $request->input('count');
            $this->stockService     = new StockService();

            // get product object
            $product    = Product::find($request->input('product_id'));

            // creat or get cart
            $this->cart = Cart::firstOrCreate([
                'unique_id' => $request->input('unique_id')
            ]);

            // detach old count product and calculate total amount
            $this->total = $this->calculateTotal();

            // check stock when user save product
            if ($this->stockService->getStock($product->id) < $this->count){
                DB::rollBack();
                return $this->set_error(['count' => [__('Product stock is not enough')]]);
            }
            // add new product
            $this->addNewProduct($product);

            DB::commit();
            return new CartResource($this->cart->fresh());
        }catch (Exception $e){
            DB::rollBack();
            return $this->set_error(['error' => [__('Storage operation has failed')]]);
        }
    }

    public function show($unique_id)
    {
        $cart = Cart::where('unique_id',$unique_id)->first();
        return !empty($cart) ? new CartResource($cart) :
            $this->set_response(['data' => [__('your shopping cart is empty')]]);
    }

    public function delete(DeleteRequest $request,StockService $stockService)
    {
        // set properties
        $this->product_id   = $request->input('product_id');
        $this->stockService = $stockService;
        $this->cart         = Cart::where('unique_id',$request->input('unique_id'))->first();
        $product            = Product::find($request->input('product_id'));

        // check product exists in cart or not
        if (empty($this->cart->products) || empty($product)){
            return $this->set_response(['data' => [__('your shopping cart is empty')]]);
        }

        // detach old count product and calculate total amount
        $this->total = $this->calculateTotal();
        $this->cart->update(['total' => $this->total]);

        return new CartResource($this->cart->fresh());
    }

    public function destroy(UniqueRequest $request,StockService $stockService)
    {
        $cart = Cart::where('unique_id',$request->input('unique_id'))->first();
        if (empty($cart->products)){
            return $this->set_response(['data' => [__('your shopping cart is empty')]]);
        }
        // detach products
        foreach ($cart->products as $cart_product){
            $cart->products()->detach($cart_product->id);
            $stockService->addStock($cart_product->id,$cart_product->pivot->count);
        }
        // delete cart
        $cart->delete();
        return $this->set_response(['data' => [__('your shopping cart is empty')]]);
    }
}
