<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\District;
use App\Models\Customer;
use Illuminate\Http\Request;
use Str;
use Auth;
use File;
Use Image;
Use Exception;
use Stevebauman\Location\Facades\Location;
use App\Models\Thana;
use App\Notifications\VerifyRegistration;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $districts=District::orderBy('priority','asc')->get();
       // $thanas=Thana::orderBy('name','asc')->get();
        return view('auth.register',compact('districts'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'res_name' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'district_id' => ['required'],
            'thana_id' => ['required'],
            'phone_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $rules = array(
            'res_name' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'district_id' => ['required'],
            'thana_id' => ['required'],
            'phone_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user=new User();
            $user->res_name = $request->res_name;
             $user->website_url = $request->website;
              $user->district_id =$request->district_id;
              $user->thana_id = $request->thana_id;
              $user->phone_no = $request->phone_no;
              $user->street_address = $request->street_address;
              $user->email = $request->email;
              $user->password = Hash::make($request->password);
              $user->remember_token = str::random(50);
              $user->status= 0;
           
       $user->save();
        // $user->notify(new VerifyRegistration($user));
        // session()->flash('success' , 'A confirmation mail has sent to you...Please check and confirm your mail');
        
        return redirect()->route('login');
      

    }

    public function registeruser(Request $request)
    {
        $user=new Customer();
            $user->cust_name = $request->cust_name;
             $user->phone_no = $request->phone_no;
              $user->district_id = $request->district_id;
              $user->thana_id = $request->thana_id;
              $user->zipcode = $request->zipcode;
              $user->street_address = $request->street_address;
              $user->email = $request->email;
              $user->password = Hash::make($request->password);
              $user->status= 1;
           
       try{
        $save=$user->save();
        if($save){
          return Response()->json(["Message"=>"Successfully","statusCode"=>"200"]);
        }
       }
       catch(Exception $e)
        {
            return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);
        }
        // $user->notify(new VerifyRegistration($user));
        // session()->flash('success' , 'A confirmation mail has sent to you...Please check and confirm your mail');

       return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);
        
    }
    // sdelect auto
    public function Thana($id)
    {
        $data=Thana::where('district_id',$id)->get();
        return json_encode($data);
    }
}
