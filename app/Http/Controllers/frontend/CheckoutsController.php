<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;
class CheckoutsController extends Controller
{
    public function index()
    {
    	$payments=Payment::orderBy('priority','asc')->get();
    	return view('frontend.pages.checkout',compact('payments'));
    }
    public function store(Request $request)
    {
    	// $request->validate([

    	// ]);
    	$order=new Order();
    	if ($request->payment_method_id!='cash_in') {
    		if ($request->tid==null || empty($request->tid)) {
    			session()->flash('errors','please give transaction ID');
    			return back();
    		}
          $order->transaction_id=  $request->tid;
    	}
    	$order->name =$request->name;
    	$order->email =$request->email;
    	$order->phone_no =$request->phone_no;
    	$order->shipping_address =$request->shipping_address;
    	$order->message =$request->message;
    	$order->ip_address =request()->ip();
        $order->amount =$request->amount;
    	if (Auth::check()) {
    		$order->user_id=Auth::id();
    	}
    	$order->payment_id =Payment::where('short_name',$request->payment_method_id)->first()->id;
    	$order->save();

    	foreach (Cart::totalCarts() as $cart) {
    		$cart->order_id =$order->id;
    		$cart->save();
    	}


    	session()->flash('success','Your Order Successfully completed');
    	return redirect()->route('carts');
    
    }
}
