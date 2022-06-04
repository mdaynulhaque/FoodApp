<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class VerificationsController extends Controller
{
    public function verified($remember_token)
    {
    	$user=User::where('remember_token',$remember_token)->first();
    	if (!is_null($user)) {
    		$user->status=1;
    		$user->remember_token=null;
    		$user->save();
    	session()->flash('success','You are Registered Succssfully !! Login Now');
    	return redirect('login');
    	}else{
    		session()->flash('errors','Sorry !! Your token is not Matched');
    	return redirect('/');
    	}
    	
    	
    }
}
