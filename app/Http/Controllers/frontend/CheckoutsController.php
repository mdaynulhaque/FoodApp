<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;
use DB;
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
      public function storecart(Request $request)
    {
      $orderid= $this->generateUniqueCode();
        $order=new Order();
        $order->payment_id= $request->payment_id; //$request->tid;
        $order->user_id =$request->user_id;
        $order->name =$request->name;
        $order->email =$request->email;
        $order->phone_no =$request->phone_no;
        $order->shipping_address =$request->shipping_address;
        $order->message =$request->message;
        $order->restuarant ="";
        $order->amount =$request->amount;
        $order->product="";
        $order->quantity=$request->quantity;
        $order->orderid=$orderid;
        
        $save=$order->save();

        if($save){
           DB::table('carts')
                    ->where('user_id',$request->user_id)
                    ->where('status','0')
                    ->update(['status' => 1,'orderid'=>$orderid]);
            return Response()->json(["Message"=>"Successfully","statusCode"=>"200"]);
        }
        return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);;
    
    }
    public function generateUniqueCode()
    {
        do {

            $code = random_int(100000, 999999);

        } while (Order::where("id", "=", $code)->first());
        return $code;

    }
}
