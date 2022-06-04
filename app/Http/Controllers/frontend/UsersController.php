<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use App\Models\District;
use Str;
use File;
Use Image;
use App\Models\Thana;
use App\Models\Product;
use App\Models\Order;

class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$user=Auth::user();
    	return view('frontend.pages.user.dashboard',compact('user'));
    }
    public function profile()
     {
     	 $districts=District::orderBy('id','desc')->get();
     	 $thanas=Thana::orderBy('id','desc')->get();
	    $user=Auth::user();
    	return view('frontend.pages.user.profile',compact('user','districts','thanas'));
    }
    public function update(Request $request,$id)
    {
    	        $request->validate([

            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'phone_no' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            
        ]);
    	$user=User::find($id);
    	$user->first_name=$request->first_name;
    	$user->last_name=$request->last_name;
    	
    	$user->phone_no=$request->phone_no;
    	$user->street_address=$request->street_address;
    	$user->ip_address=request()->ip();
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);

    	$image = $request->file('image');
        if ($image) {

            //delete image
            if(!empty($data->image)){

                $imgPath =$data->image;
                $delImg = unlink($imgPath);
            }



            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/images/users/';
            $image_url = $upload_path . $image_full_name;

            // image resize start here
            $resize_image = Image::make($image->getRealPath());
             $resize_image->resize(100, 100, function($constraint){
                 $constraint->aspectRatio();
            })->save($upload_path . $image_full_name);
             // end resize image here


             
            // data update from here
             $user->avatar = $image_url;

        }

    	$user->save();
    	session()->flash('success', 'Updated successfully your Accounts');
    	return back();
    }
    public function history()
    {
    	$user=Auth::user();
    	$orders=Order::where('user_id', Auth::user()->id)
        ->orderBy('id','desc')->paginate(3);
        
    	return view('frontend.pages.user.history',compact('user','orders'));
    }

    public function Thana($id)
    {
        $data=Thana::where('district_id',$id)->get();
        return json_encode($data);
    }
}
