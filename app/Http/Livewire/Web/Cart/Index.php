<?php

namespace App\Http\Livewire\Web\Cart;

use App\Http\Controllers\Payment\PaymentController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class Index extends Component
{
    public $Load = false ;
    public $products;
    public $carts;
    public $buyProduct ;
    public $cartEmpty = true;
    public $TransportationCost;
    public $Buy = false;

    public $PayPrice;
    public $TotalPrice = 0;
    public $AllDiscount = 0;
    public $TotalPriceOld = 0;
    public $TotalPriceNew = 0;

    public $address ;
    public $zipCode ;
    public $state ;

    public $process = false;
    public $processMessage = null;

    protected $listeners = ['LoadContent'];

    public function LoadContent()
    {
        $user = auth()->user();

        if ($user){
            $carts = Cart::where('user_id' , auth()->user()->id)->get();
            $this->carts = $carts;
        }else {
            return $this->redirect(route('login'));
        }

        if ($carts != null){
            $this->cartEmpty = false ;
            foreach ($carts as $cart) {
                $productNew = Product::where('id' , $cart->product_id)->with(['photos' , 'categories', 'categories.activeDiscount' , 'activeDiscount' , 'activeWarehouses'])->first();
                $this->products[] = $productNew;
                $this->buyProduct[$productNew->id]['color'] = $cart['color'];
                $this->buyProduct[$productNew->id]['size'] = $cart['size'];

           }
        }else{
            $this->cartEmpty = true ;
        }

        if (!empty($this->products)) {
            $LocalTotalPrice = 0;
            $Transportation = [];
            foreach ($this->products as $product) {
                $this->buyProduct[$product->id] += [
                    'Old' => $product->price ,
                    'OldCount' => $product->price ,
                    'Normal' => $product->price ,
                    'New' => $product->price ,
                ];
                if(! array_key_exists('count' , $this->buyProduct[$product->id])){
                    $this->buyProduct[$product->id]['count'] = 1 ;
                }
                $this->buyProduct[$product->id]['can'] = false ;
                foreach ($product->activeWarehouses as $warehouse) {
                    foreach ($this->carts as $cart) {
                        if ($cart['color'] == $warehouse['color'] && $cart['size'] == $warehouse['size']) {
                            if ($warehouse->available != 0 && $warehouse->quantity > 0 ) {
                                $this->buyProduct[$product->id]['Old'] = $warehouse->price;
                                $this->buyProduct[$product->id]['OldCount'] = $warehouse->price;
                                $this->buyProduct[$product->id]['Normal'] = $warehouse->price;
                                $this->buyProduct[$product->id]['New'] = $warehouse->price;
                                $this->buyProduct[$product->id]['can'] = true;
                                $this->buyProduct[$product->id]['warehouses'] = $warehouse->quantity;
                                $this->buyProduct[$product->id]['product_id'] = $warehouse->product_id;
                                $this->buyProduct[$product->id]['transportation'] = $warehouse->transportation_cost;
                                $this->buyProduct[$product->id]['hex'] = $warehouse->hex;
                                $Transportation[] = intval($warehouse->transportation_cost);
                            }else{
                                $cart->delete();
                                $this->buyProduct[$product->id]['can'] = false;
                                $this->buyProduct[$product->id]['canMessage'] = "در حال حاضر متاسفانه این کالا با این مشخصات موجود نیست !";
                                $message = 'محصول ' . $product->name . ' دیگر موجود نمیباشد به همین علت از سبد خرید شما حذف شد ! ' ;
                                $this->addError('notCan' , $message);
                            }
                        }
                    }
                }

                if ($this->buyProduct[$product->id]['can']) {
                    if (!$product->activeDiscount->isEmpty()) {
                        $discount = $product->activeDiscount->last();
                        $ValueDiscount = $this->buyProduct[$product->id]['New'] / 100 * $discount->quantity;

                        $this->AllDiscount += $ValueDiscount;

                        $this->buyProduct[$product->id]['New'] -= $ValueDiscount;
                        $this->buyProduct[$product->id]['Normal'] = $this->buyProduct[$product->id]['New'];


                        $this->buyProduct[$product->id]['discount'] = [
                            'id' => $discount->id,
                            'product' => $product,
                            'discount' => $discount,
                            'discount_amount' => $ValueDiscount,
                            'old_price' => $this->buyProduct[$product->id]['Old'],
                            'new_price' => $this->buyProduct[$product->id]['New'],
                        ];

                        $this->TotalPriceOld += $this->buyProduct[$product->id]['Old'];
                        $this->TotalPriceNew += $this->buyProduct[$product->id]['New'];
                    } else {
                        foreach ($product->categories as $category) {

                            if (!$category->activeDiscount->isEmpty()) {
                                $discount = $category->activeDiscount->last();
                                $ValueDiscount = $this->buyProduct[$product->id]['New'] / 100 * $discount->quantity;
                                $this->AllDiscount += $ValueDiscount;

                                $this->buyProduct[$product->id]['New'] -= $ValueDiscount;
                                $this->buyProduct[$product->id]['Normal'] = $this->buyProduct[$product->id]['New'];


                                $this->buyProduct[$product->id]['discount'] = [
                                    'id' => $discount->id,
                                    'product' => $product,
                                    'discount' => $discount,
                                    'discount_amount' => $ValueDiscount,
                                    'old_price' => $this->buyProduct[$product->id]['Old'],
                                    'new_price' => $this->buyProduct[$product->id]['New'],
                                ];

                                $this->TotalPriceOld += $this->buyProduct[$product->id]['Old'];
                                $this->TotalPriceNew += $this->buyProduct[$product->id]['New'];
                            }
                        }
                    }


                    $this->TotalPrice += $this->buyProduct[$product->id]['Old'];
                    $LocalTotalPrice += $this->buyProduct[$product->id]['New'];
                }
            }

            $Transportation = $Transportation ? $Transportation : [1 , 2];
            $this->TransportationCost = max($Transportation);
            $this->PayPrice = $this->TransportationCost + $LocalTotalPrice;
        }else{
            $this->cartEmpty = true ;
        }


        $this->Load = true ;
        $this->dispatchBrowserEvent('LoadCustom');

    }

    public function deleteCart($id)
    {
        $cart = Cart::where('product_id' , $id)->where('user_id' , auth()->id());
        if ($cart){
            $cart->delete();
            $this->dispatchBrowserEvent('LoadContent');
            return $this->redirect(route('checkout.index'));
        }
    }

    public function deleteAllCart()
    {
        $cart = Cart::where('user_id' , auth()->id());
        if ($cart){
            $cart->delete();
            $this->dispatchBrowserEvent('LoadContent');
            return $this->redirect(route('checkout.index'));
        }
    }

    public function goBuy()
    {
        $this->Buy = true ;
        $this->Load = false ;
    }

    public function getBuy()
    {
        $this->validate([
            'state' => 'required' ,
            'zipCode' => 'required|integer' ,
            'address' => 'required' ,
        ]);

        $order = Order::create([
            'user_id' => auth()->user()->id ,
            'transportation_cost' =>    $this->TransportationCost ,
            'transportation_cost_status' =>    0 ,
            'total_price' => $this->TotalPrice + $this->TransportationCost,
            'payment_price' => $this->PayPrice ,
            'payment_status' => 0 ,
            'zip_code' => $this->zipCode ,
            'address' => $this->address ,
            'state' => $this->state ,
        ]);


        foreach ($this->buyProduct as  $buyProduct){
            if (array_key_exists('discount' , $buyProduct)){
                $order->discounts()->attach($buyProduct['discount']['discount']['id']);
            }
            $orderItem = OrderItem::create([
                'order_id' => $order->id ,
                'product_id' => $buyProduct['discount']['product']['id'] ?? $buyProduct['product_id'],
                'price' => $buyProduct['New'] ,
                'quantity' => $buyProduct['count'],
                'total' => $buyProduct['Normal'] * $buyProduct['count']
            ]);
        }

        $api = env('PAYMENT_TOKEN') ;
        $user = auth()->user();
        $token =  PaymentController::CustomCreatePay($api , $order->payment_price , $user->number , $order->id  , 'buy');
        $order->token = $token;
        $order->save();
        $go = "https://pay.ir/pg/$token";
        return $this->redirect($go);
    }

    public function ChangeCount($value , Product $product)
    {
        if ($value == 0){
            return ;
        }
        if ($value > $this->buyProduct[ $product->id ]['warehouses']){
            $this->addError('count' , null);
            return ;
        }
        $this->buyProduct[ $product->id ]['OldCount'] = $this->buyProduct[ $product->id ]['Old'] * $value;
        $this->buyProduct[ $product->id ]['New'] = $this->buyProduct[ $product->id ]['Normal'] * $value;
        $this->buyProduct[$product->id]['count'] = $value;
        $TotalLocal = 0;
        $this->TotalPrice = 0;
        foreach ($this->buyProduct as $buyProduct) {
            $this->TotalPrice += $buyProduct['OldCount'];
            if (array_key_exists('discount' , $buyProduct)){
                $TotalLocal += $buyProduct['New'];
                $buyProduct['discount']['discount_amount'] = $buyProduct['OldCount'] - $buyProduct['New'];
            }else{
                $TotalLocal += $buyProduct['New'];
            }
        }
        $this->PayPrice = $TotalLocal + $this->TransportationCost;
        $this->AllDiscount = $this->TotalPrice - $TotalLocal;
    }

    public function render()
    {
        return view('livewire.web.cart.index')->layout('layouts.home'   , [
            'style' => 'cart.css' ,
            'script' => 'cart.js' ,
            'title' => 'سبد خرید' ,
        ]);
    }
}
