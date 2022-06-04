<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Contact;
use App\Models\User;
use App\Models\Cat;

use Image;
use DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index()
    {
        return view('backend.pages.index');
    }

    public function Contact(Request $request)
    {
        if(request()->ajax())
        {
            $data = Contact::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
    
                        return $button;
                    })
                   
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.contact');
    }
    
    public function destroy($id)
    {
        if(request()->ajax()){

  

            $data = Contact::findOrFail($id); //find id here

      

            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        } 
    }

    public function Restuarant()
    {
        $category=Cat::All();
         if(request()->ajax())
        {
            $data = User::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                    
                    
                        if($data->status == 0){
                          $button .= '<button type="button" name="status" id="'.$data->id.'" class="status btn btn-danger btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Deactive</button>';
                        }
                        else{
                            $button .= '<button type="button" name="status" id="'.$data->id.'" class="status btn btn-info btn-sm mr-1"><i class="fa fa-check"></i>&nbsp;Active</button>';
                        }

                        return $button;
                    })
                    ->addColumn('name', function($data){
                         $button ='<p class="mb-0">'.$data->res_name.' </p>';
                         $button .='<p class="mb-0">'.$data->email.' </p>';
                        return $button;
                    })

                     ->addColumn('details', function($info){
                        $button ='<p class="mb-0"><b>Address: </b>'.$info->street_address.' </p>';
                    
                        $button .= '<p class="mb-0"> <b>WebSite: </b>'.$info->website_url.' </p>';
                        

                        return $button;
                    })
                    ->rawColumns(['action', 'name','details'])
                    ->make(true);
        }
        return view('backend.pages.restuarent_list.index');
    }
    public function Block($id)
    {
        $data=User::find($id);
        $temp="";

        if($data->status == "1"){
            $temp=0;
        }

        if($data->status =="0"){
           $temp=1;
        }
        $data->status=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }


    public function delete($id)
    {
       if(request()->ajax()){

            $data = User::findOrFail($id); //find id here

            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        }
    }

}
