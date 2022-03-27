<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
    public function add_product()
    {
        $product_categories=ProductCategory::all();
        return view('product.add_product',compact('product_categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_title'=>'required',
            'subtitle'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'language'=>'required',
            'popular'=>'required',
            'product_description'=>'required',
        ]);
        $product=new Product();
        $product->product_title=$request->get('product_title');
        $product->product_subtitle=$request->get('subtitle');
        $product->regular_price=$request->get('regular_price');
        $product->promotional_price=$request->get('promotional_price');
        $product->status=$request->get('status');
        $product->tax_class=$request->get('tax_class');
        $product->language=$request->get('language');
        $product->popular=$request->get('popular');
        $product->product_description=$request->get('product_description');
        $product_image = "";
        if (empty($product_image)) {
            $product_image = "product.jpg";
        }
        if($request->hasFile('product_image')){
            $image = $request->product_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/products',$filename);
            $product_image = $filename;

        }
        $product->product_image = $product_image;
        if ($request->get('new_category')==null) {
            $product->product_category = $request->get('category');

        }
        else
        {
            $category=new ProductCategory();
            $category->name=$request->get('new_category');
            $category->save();
            $product->product_category =$category->id;
        }
        $product->save();
        return redirect()->back()->with('alert', 'Insert Recorde successfully');
    }
    public function list_product()
    {
        $products=Product::orderBy('created_at','ASC')->get();
        $count=$products->count();
        $published=Product::where('status','1')->count();
        $draft=Product::where('status','0')->count();
        $deleted=Product::onlyTrashed()->count();
        $product_categories=ProductCategory::all();
        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('draft',$draft);
        Session::put('deleted',$deleted);
        $trash=false;
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        return view('product.list_product',compact('products','product_categories','trash'));

    }
    public function search(Request $request)
    {
        $trash=false;
        $product_categories=ProductCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }
        switch ($request->input('action'))

        {
            case 'all':
                $products=Product::orderBy('created_at','ASC')->get();
                break;
            case 'published':
                $products=Product::where('status','1')->orderBy('created_at','ASC')->get();
                break;
            case 'draft':
                $products=Product::where('status','0')->orderBy('created_at','ASC')->get();
                break;
            case 'deleted':
                $products=Product::onlyTrashed()->get();
                $trash=true;
                break;
            case 'category':
                $products=Product::where('product_category',$request->category)->get();
                $trash=true;
                break;


        }
        return view('product.list_product',compact('products','product_categories','trash'));


    }
    public function searchCategory(Request $request)
    {
        $trash=false;
        $product_categories=ProductCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $products=Product::where('product_category',$category)->orderBy('created_at','Desc')->get();
        return view('product.list_product',compact('products','product_categories','trash'));
    }
    public function destroy($id)
    {
        product::where('id',$id)->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
       $product= product::where('id',$id)->first();
        $product_categories=ProductCategory::all();
        return view('product.edit_product',compact('product','product_categories'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'product_title'=>'required',
            'subtitle'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'language'=>'required',
            'popular'=>'required',
            'product_description'=>'required',
        ]);
        $product = product::where('id', $id)->first();
        $product->product_title=$request->get('product_title');
        $product->product_subtitle=$request->get('subtitle');
        $product->regular_price=$request->get('regular_price');
        $product->promotional_price=$request->get('promotional_price');
        $product->status=$request->get('status');
        $product->tax_class=$request->get('tax_class');
        $product->language=$request->get('language');
        $product->popular=$request->get('popular');
        $product->product_description=$request->get('product_description');

        if($request->hasFile('product_image')){
            $path = public_path()."/images/products/".$product->product_image;
            unlink($path);
            $image = $request->product_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/products',$filename);
            $product_image = $filename;

        }else{
            $product_image = $product->product_image ;
        }
            $product->product_image= $product_image;
        if ($request->get('new_category')==null) {
            $product->product_category = $request->get('category');

        }
        else
        {
            $category=new ProductCategory();
            $category->name=$request->get('new_category');
            $category->save();
            $product->product_category =$category->id;
        }
        $product->save();

        return redirect(url('list_product'))->with('message', 'Update Recorde succesfully');
    }
}
