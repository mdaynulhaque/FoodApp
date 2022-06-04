<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\District;
use Illuminate\Http\Request;
use Str;
use Auth;
use File;
Use Image;
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
        $thanas=Thana::orderBy('name','asc')->get();
        return view('auth.register',compact('districts','thanas'));
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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
        $user=new User();
            $user->first_name = $request->first_name;
             $user->last_name = $request->last_name;
              $user->district_id = $request->district_id;
              $user->thana_id = $request->thana;
              $user->phone_no = $request->phone_no;
              $user->street_address = $request->street_address;
              $user->ip_address =request()->ip();
              $user->email = $request->email;
              $user->password = Hash::make($request->password);
              $user->remember_token = str::random(50);
              $user->status= 0;
           
       $user->save();
        $user->notify(new VerifyRegistration($user));
        session()->flash('success' , 'A confirmation mail has sent to you...Please check and confirm your mail');
        
        return redirect()->route('index');

    }
    // sdelect auto
    public function Thana($id)
    {
        $data=Thana::where('district_id',$id)->get();
        return json_encode($data);
    }
}
