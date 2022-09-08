<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TransAction;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    public static function createPay($api , $amount , $mobile , $factorNumber ,$description)
    {
        $redirect = route('pay.callback');
        $result = PaymentController::send($api, $amount, $redirect, $mobile, $factorNumber, $description);
        if($result->status) {
            $go = "https://pay.ir/pg/$result->token";
            return redirect($go);
        } else {
            return redirect()->route('pay.fail' , ['message' => $result->errorMessage]);
        }
    }

    public static function CustomCreatePay($api , $amount , $mobile , $factorNumber ,$description)
    {
        $redirect = env('PAYMENT_CALLBACK_URL');
        $result = PaymentController::send($api, $amount, $redirect, $mobile, $factorNumber, $description);
        if($result->status) {
            return $result->token;
        } else {
            return redirect()->route('pay.fail' , ['message' => $result->errorMessage]);
        }
    }

    public function fail()
    {
        $message = 'پرداخت انجام نشد !';
        if (request()->has('message')){
            $message = request()->message;
        }
        Session::flash('error' , [$message]);
        return redirect()->route('products');
    }

    public function callback(Request $request)
    {
        if ($request->status == 0){
            $order = Order::where('token' , $request->token)->first();
             TransAction::create([
                'user_id' => auth()->user()->id ,
                'order_id' => $order->id ,
                'price' => $order->payment_price ,
                'token' => $request->token ,
                'trans_id' => null ,
                'card_number' => null ,
                'trace_number' => null ,
                'message' => null ,
                'status' => false
            ]);
            return redirect()->route('pay.fail');
        }

        if ($request->status == 1){
            $api = env('PAYMENT_TOKEN');
            $token = $_GET['token'];
            $result = static::verify($api,$token);
            if(isset($result->status)){
                if($result->status == 1){
                    $user = auth()->user();
                    $order = Order::findOrFail($result->factorNumber);
                    $order->payment_status = true;
                    $order->save();
                    $tracking_code = explode(' ' , microtime())[1] + rand(1 , 999999) ;
                    $carts = Cart::where(['user_id' => $user->id ])->get();
                    foreach ($carts as $cart) {
                        $warehouse = Warehouse::where('product_id' , $cart['product_id'])
                                                ->where('color' , $cart['color'])
                                                ->where('size' , $cart['size'])->first();
                        $orderItems = OrderItem::where('order_id' , $order->id)->get() ;
                        foreach ($orderItems as $item) {
                            if ($item['product_id'] == $warehouse['product_id']){
                                $warehouse->quantity = $warehouse->quantity - $item->quantity;
                                if ($warehouse->quantity == 0){
                                    $warehouse->available = false ;
                                }
                                $warehouse->save();
                            }
                        }
                        $cart->delete();
                    }

                    TransAction::create([
                        'user_id' => $user->id ,
                        'order_id' => $order->id ,
                        'price' => $result->amount ,
                        'token' => $token ,
                        'trans_id' => $result->transId ,
                        'card_number' => $result->cardNumber ,
                        'trace_number' => $result->traceNumber ,
                        'message' => $result->message ,
                        'status' => true ,
                        'tracking_code' => $tracking_code ,
                    ]);
                    Session::flash('success' , 'تراکنش با موفقیت انجام شد');
                    return redirect()->route('payment.index');
                } else {
                    return redirect()->route('pay.fail');
                }
            } else {
                if($_GET['status'] == 0){
                    return redirect()->route('pay.fail' , ['message' => 'پرداخت ناموفق بود']);
                }
            }
        }
    }

    public static function send($api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null) {
        return static::curl_post('https://pay.ir/pg/send', [
            'api'          => $api,
            'amount'       => $amount,
            'redirect'     => $redirect,
            'mobile'       => $mobile,
            'factorNumber' => $factorNumber,
            'description'  => $description,
        ]);
    }

    public static function verify($api, $token) {
        return static::curl_post('https://pay.ir/pg/verify', [
            'api' 	=> $api,
            'token' => $token,
        ]);
    }

    public static function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res);
    }

}
