<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Auth;
use Illuminate\Http\Request;

use Session;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


    public function login(Request $request)
    {

        $this->validate($request,[
          'email'=>'required|string',
           'password'=>'required|string',
        ]);
        $user=User::where('email',$request->email)->first();
       

            if (Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'1'],$request->remember)) {
                return redirect()->intended(route('user.dashboard')); 
            }
        
        
        // if (!is_null($user)) {
        //        $user->notify(new VerifyRegistration($user));
        //        session()->flash('success' , 'A New confirmation mail has sent to you...Please check and confirm your mail');
        //        return redirect('/');
        // }
            
         session()->flash('error' , 'Please Login first or contact with administrator ');
        return redirect()->route('login');
    
    }
    public function loginuser(Request $request){
        define('DB_SERVER','localhost');
        define('DB_USER','root');
        define('DB_PASS' ,'');
        define('DB_NAME', 'fooddelivery');
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if (mysqli_connect_errno())
        {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
         header("Content-type: application/json; charset=utf-8");
        $email=$request->email; //take input
        $password=$request->password;
    

        $query="SELECT * FROM `customers` WHERE email='$email'";
        $sql=mysqli_query($con,$query); //insert data query
        $to=mysqli_num_rows($sql);

        if ($to==1) {
            $row=mysqli_fetch_array($sql);
            $pa=$row['password'];   
           if(Hash::check($password, $pa) == TRUE){
            $user=Customer::where('email',$request->email)
            ->where('password',$pa)
            ->first();
            return Response()->json(["Message"=>"Successfully","statusCode"=>"200",'userinfo'=>$user]);
           }
           else{
            return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);
           }
        }
       
        else{
            return Response()->json(["Message"=>"Failed","statusCode"=>"201"]);
        }

    }

}
