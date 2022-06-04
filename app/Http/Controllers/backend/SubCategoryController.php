<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subcat;
use App\Models\Cat;
use DataTables;
use Validator;

class SubCategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index( Request $request)
    {
        $categories=Cat::all();
      if(request()->ajax())
        {
            $data = Subcat::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                       
                        

                            $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>';
                       
                       
                       

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                        

                     

                        return $button;
                    })
                    
                   
                      ->addColumn('cat', function($data){
                         $button ='<p><b> Category: </b>'.$data->category->name.' </p>';
                    

                         return $button;
                    })

                    ->rawColumns(['action','cat'])
                    ->make(true);
        }
        return view('backend.pages.category.subcategory',compact('categories'));
    }


   
     public function destroy($id)
    {
        if(request()->ajax()){

  

            $data = Subcat::findOrFail($id); //find id here

      

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
            'cat_id'    =>  'required',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = new Subcat();


        //save data database in rooms table 

        $data->name = $request->name;
        $data->cat_id = $request->cat_id;
   
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
            $data = Subcat::findOrFail($id);
            return $data;
        }

    }






    public function update(Request $request)
    {
            $rules = array(
            'name'    =>  'required',
            'cat_id'    =>  'required',
 
        );


        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // update id start
        $id = $request->updateId;
        $data =  Subcat::find($id);
        //end update id


    
        //save data database in rooms table 

        $data->name = $request->name;
        $data->cat_id = $request->cat_id;
      


        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Update successfully.']);
        }
        else{
             return response()->json(['success' => 'Data Update Failed.']);
        }

    }
}
