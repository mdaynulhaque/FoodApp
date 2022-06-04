<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Thana;
use App\Models\District;

use DataTables;
use Validator;

class DistrictController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
	public function index()
    {
         if(request()->ajax())
        {
            $data = District::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                       
                        

                            $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>';
                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                        return $button;
                    })
                   
                      ->addColumn('details', function($info){
                        $button ='<p class="mb-0">'.$info->name.' </p>';
                       
                        return $button;
                    })
                    ->rawColumns(['action', 'details'])
                    ->make(true);
        }
        return view('backend.pages.district.index');
    }
    




    public function destroy($id)
    {
        if(request()->ajax()){

  
            $data = District::findOrFail($id); //find id here

      

            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        } 
    }




    public function store(Request $request)
    {
    	$rules = array(
            'name'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = new District();


        //save data database in rooms table 

        $data->name = $request->name;
   
        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Added successfully.']);
        }
        else{
             return response()->json(['success' => 'Data  Added Failed.']);
        }
    }







    public function edit($id)
    {
    	   if(request()->ajax())
        {
            $data = District::findOrFail($id);
            return $data;
        }

    }




    public function update(Request $request)
    {
            $rules = array(
            'name'    =>  'required',
 
        );


        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // update id start
        $id = $request->updateId;
        $data =  District::find($id);
        //end update id


    
        //save data database in rooms table 

        $data->name = $request->name;
      


        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Update successfully.']);
        }
        else{
             return response()->json(['success' => 'Data Update Failed.']);
        }

    }
    
}
