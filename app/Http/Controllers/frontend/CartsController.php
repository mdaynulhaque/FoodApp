<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Auth;
class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.carts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    
    public function store(Request $request)
    {

       $this->validate($request,[
        'product_id' => 'required'
        ],
        [
            'product_id.required'=>'please Give a product'
       ]); 
       if (Auth::check()) {
         $cart=Cart::where('user_id',Auth::id())
       ->where('product_id',$request->product_id)
       ->where('order_id',null)
       ->first();
       }else{
        $cart=Cart::where('ip_address',request()->ip())
       ->where('product_id',$request->product_id)
       ->where('order_id',null)
       ->first();
       }

       if (!is_null($cart)) {
          $cart->increment('product_quantity');
       }else{
        $cart=new Cart();
           if (Auth::check()) {
               $cart->user_id=Auth::id();
           }
           $cart->ip_address=request()->ip();
           $cart->product_id=$request->product_id;
           $cart->save();
       }

       
       return json_encode(['status'=>'success' ,'Message'=>'Item added is success','totalItems' =>Cart::totalItems()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

   
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(request()->ajax()){

            $data = Cart::findOrFail($id); //find id here
            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        } 
    }



    public function Plus($id)
    {
        $data=Cart::find($id);
        $data->increment('product_quantity');
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }

    public function Minus($id)
    {
        $data=Cart::find($id);
       (int)$a= $data->product_quantity;
        
        if($a>1){
          $data->decrement('product_quantity');
           $success=$data->save();
           if($success){
                  return 'ok';
              }else{
                  return 'error';
             }
        }
        else{
          return response()->json(['error' => 'Data Added Failed.']);
        }
       

    }
}
