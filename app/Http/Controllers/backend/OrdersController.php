<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index(Request $request)
    
    {
      if(request()->ajax())
        {
            $data = Order::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                            if($data->is_seen_by_admin==1){
                              $button .= '<button type="button" id="'.$data->id.'" class="admin btn btn-info btn-sm mr-1"><i class="fa fa-check"></i>&nbsp;Seen</button>';  
                            }
                            else{
                                 $button .= '<button type="button" id="'.$data->id.'" class="admin btn btn-warning btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Unseen</button>';  
                            }
                          
                            if($data->is_paid==1){
                                 $button .= '<button type="button" id="'.$data->id.'" class="paid btn btn-info btn-sm mr-1"><i class="fa fa-check"></i>&nbsp;Paid</button>';
                            }
                            else{
                                 $button .= '<button type="button" id="'.$data->id.'" class="paid btn btn-warning btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Unpaid</button>';
                            }

                            if($data->is_completed ==1){
                                 $button .= '<button type="button" id="'.$data->id.'" class="complete btn btn-info btn-sm mr-1"><i class="fa fa-check"></i>&nbsp;Complete</button>';
                            }
                            else{
                                $button .= '<button type="button" id="'.$data->id.'" class="complete btn btn-warning btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Uncomplete</button>';
                            }
                            if($data->is_cancel ==1){
                                 $button .= '<button type="button" id="'.$data->id.'" class="cancel btn btn-danger btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Cancel</button><br>';
                            }
                            else{
                                $button .= '<button type="button" id="'.$data->id.'" class="cancel btn btn-info btn-sm mr-1"><i class="fa fa-check"></i> &nbsp; Not Cancel</button><br>';
                            }

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';

                             $button .= '<a  href="'. route('view.order',$data->id) .'" class="view btn btn-info btn-sm mr-1"><i class="fa fa-camera"></i>&nbsp;View</a>';

                        return $button;
                    })
                   
                    ->addColumn('details', function($data){
                      $button ='<div class="row"> 
                                    <div class="col-md-6 text-right">
                                        <b>Orderer Name:</b>
                                    </div>
                                    <div class="col-md-6">
                                        '.$data->name.'
                                    </div>
                                </div>';
                     $button .='<div class="row"> 
                                    <div class="col-md-6 text-right">
                                        <b>Orderer Phone_No:</b>
                                    </div>
                                    <div class="col-md-6">
                                        '.$data->phone_no.'
                                    </div>
                                </div>';
                       $button .='<div class="row"> 
                                    <div class="col-md-6 text-right">
                                        <b>Orderer Address:</b>
                                    </div>
                                    <div class="col-md-6">
                                        '.$data->shipping_address.'
                                    </div>
                                </div>';
                       $button .='<div class="row"> 
                                    <div class="col-md-6 text-right">
                                        <b>Orderer Email:</b>
                                    </div>
                                    <div class="col-md-6">
                                        '.$data->email.'
                                    </div>
                                </div>';
                         return $button;
                    })
                    ->rawColumns(['action', 'details'])
                    ->make(true);
        }
    	return view('Backend.pages.order.index');
    }
    

    // seen by admin
    public function Seen($id)
    {
        $data=Order::find($id);
        $temp="";

        if($data->is_seen_by_admin == "1"){
            $temp=0;
        }

        if($data->is_seen_by_admin =="0"){
           $temp=1;
        }
        $data->is_seen_by_admin=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }



    // is paid
     public function Paid($id)
    {
        $data=Order::find($id);
        $temp="";

        if($data->is_paid == "1"){
            $temp=0;
        }

        if($data->is_paid =="0"){
           $temp=1;
        }
        $data->is_paid=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }

    // is_completed
     public function Complete($id)
    {
        $data=Order::find($id);
        $temp="";

        if($data->is_completed == "1"){
            $temp=0;
        }

        if($data->is_completed =="0"){
           $temp=1;
        }
        $data->is_completed=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }


    // is_cancel
     public function Cancel($id)
    {
        $data=Order::find($id);
        $temp="";

        if($data->is_cancel == "1"){
            $temp=0;
        }

        if($data->is_cancel =="0"){
           $temp=1;
        }
        $data->is_cancel=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }





    public function destroy($id)
    {
        if(request()->ajax()){

            $data = Order::findOrFail($id); //find id here

      

            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        } 
    }


    // view data
    //  public function View($id)
    // {
    //        if(request()->ajax())
    //     {
    //         $data = Order::findOrFail($id);
    //         return $data;
    //     }

    // }

    public function View($id){
        $order=Order::find($id);
        $cart=Cart::where('order_id',$id)->get();

       return view('backend.pages.order.order',compact('cart','order'));       
    }
   
}
