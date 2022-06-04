<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\FoodItem;
use App\Models\Cat;
use App\Models\Contact;

use DB;


class PagesController extends Controller
{
    public function index()
    {
        $sliders=Slider::all();
        $category=Cat::all();
        $products=Product::orderBy('id','desc')->paginate(3);
    	return view('frontend.pages.index',compact('products','sliders','category'));
    }
    


    public function contacts()
    {
    	return view('frontend.pages.contact');
    }




    public function search(Request $request)
    {
        $search=$request->search;
        $products=Product::orWhere('title','like','%'.$search.'%')
        ->orWhere('description','like','%'.$search.'%')
        ->orWhere('price','like','%'.$search.'%')
        ->orWhere('quantity','like','%'.$search.'%')
        ->orderBy('id','desc')
        ->paginate(3);
        return view('frontend.pages.product.search',compact('search','products'));
    }




    public function products()
    {
    	$products=Product::orderBy('id','desc')->paginate(9);
    	return view('frontend.pages.product.index',compact('products'));
    }







    public function product_show($id)
    {
        $product=Product::where('id',$id)->first();
        if (!is_null($product)) {
            return view('frontend.pages.product.show',compact('product'));
        }
        else{
            session()->flash('errors','NO Item Found');
            return redirect()->route('admin.product.index');
        }
    }




    public function Category($id)
    {
        
        $products=Product::Where('cat_id',$id)
        ->orderBy('id','desc')
        ->paginate(9);
        return view('frontend.pages.product.category-product',compact('products'));
    }



    // contact.store
    public function store(Request $request)
    {
       $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required'
        ],
        ); 

    $contact=new Contact();
    $contact->name=$request->name;
    $contact->subject=$request->subject;
    $contact->email=$request->email;
    $contact->message=$request->message;


    $contact->save();
    return redirect()->route('index');

    }


    public function indexproductapi()
    {
        $res = DB::select('SELECT  c.name, f.item_name, f.description, f.price, f.image_small,f.image2_small,u.res_name FROM food_items f, cats c,  users u WHERE f.restu_id=u.id and f.status="1" GROUP by f.id');

        return Response()->json(["datas"=>$res]);
    }
    public function indexcategoryapi()
    {
        return Response()->json(["datas"=>Cat::all()]);
    }

    public function product_showapi($id)
    {
        $product=DB::select('SELECT  c.name, f.item_name, f.description, f.price, f.image_small,f.image2_small,u.res_name FROM food_items f, cats c,  users u WHERE f.restu_id=u.id and f.status="1" and f.cat_id=c.id and f.id='.$id.' GROUP by f.id');
        if(!is_null($product)) {
            return Response()->json($product);
        }
        else{
            return Response()->json(["Message"=>"Product not found"]);
        }
    }
  
   
}
