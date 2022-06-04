<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;

use App\Models\Subcat;
use App\Models\Cat;
use DataTables;
use Validator;

class ThanaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index( Request $request)
    {
        $districts=District::all();
      if(request()->ajax())
        {
            $data = Thana::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                       
                        

                            $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>';
                       
                       
                       

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                        

                     

                        return $button;
                    })
                    
                   
                      ->addColumn('district', function($data){
                          $button ='<p>'.$data->district->name.' </p>';
                    

                          return $button;
                    })

                    ->rawColumns(['action','district'])
                    ->make(true);
        }
        return view('backend.pages.thana.index',compact('districts'));
    }


   
     public function destroy($id)
    {
        if(request()->ajax()){

  

            $data = Thana::findOrFail($id); //find id here

      

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
            'district_id'    =>  'required',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = new Thana();


        //save data database in rooms table 

        $data->name = $request->name;
        $data->district_id = $request->district_id;
   
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
            $data = Thana::findOrFail($id);
            return $data;
        }

    }






    public function update(Request $request)
    {
            $rules = array(
            'name'    =>  'required',
            'district_id'    =>  'required',
 
        );


        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // update id start
        $id = $request->updateId;
        $data =  Thana::find($id);
        //end update id


    
        //save data database in rooms table 

        $data->name = $request->name;
        $data->district_id = $request->district_id;
      


        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Update successfully.']);
        }
        else{
             return response()->json(['success' => 'Data Update Failed.']);
        }

    }
}