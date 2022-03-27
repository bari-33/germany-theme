<?php

namespace App\Http\Controllers;
use App\Models\Design;
use App\Models\Order;
use App\Models\DesignCategory;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Designcontroller extends Controller
{
    public function add_desing()
    {
        $design_categories=DesignCategory::all();
        return view('Design.add_design',compact('design_categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'design_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'service'=>'required',
            'primary_image'=>'required',
            'secondary_image'=>'required',
        ]);
        $design=new Design();
        $design->design_title=$request->get('design_title');
        $design->regular_price=$request->get('regular_price');
        $design->promotional_price=$request->get('promotional_price');
        $design->status=$request->get('status');
        $design->tax_class=$request->get('tax_class');
        $design->service=$request->get('service');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/designs/primary',$filename);
            $primary_image = $filename;
        }
            $design->primary_image= $primary_image;


        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/designs/secondary/',$filename);
            $secondary_image = $filename;

        }

        $design->secondary_image= $secondary_image;

        if ($request->get('new_category')==null) {
            $design->product_category = $request->get('category');

        }
        else
        {
            $design_category=new DesignCategory();
            $design_category->name=$request->get('new_category');
            $design_category->save();
            $design->product_category =$design_category->id;
        }
        $design->save();
        return redirect()->back()->with('alert', 'Insert Recorde successfully');
    }
    public function list_design()
    {

        $trash=false;
        $designs=Design::orderBy('created_at','ASC')->get();
        $count=$designs->count();
        $published=Design::where('status','1')->count();
        $draft=Design::where('status','0')->count();
        $deleted=Design::onlyTrashed()->count();
        $product_categories=DesignCategory::all();

        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('deleted',$deleted);
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }

        return view('Design.list_design',compact('designs','product_categories','trash'));
    }
    public function search(Request $request)
    {
        $trash=false;
        $product_categories=DesignCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        switch ($request->input('action'))
        {

            case 'all':
                $designs=Design::orderBy('created_at','ASC')->get();
                break;
            case 'published':
                $designs=Design::where('status','1')->orderBy('created_at','ASC')->get();

                break;
            case 'draft':
                $designs=Design::where('status','0')->orderBy('created_at','ASC')->get();
                break;
            case 'deleted':
                $designs=Design::onlyTrashed()->get();
                $trash=true;
                break;


        }
        return view('Design.list_design',compact('designs','product_categories','trash'));


    }


    public function searchCategory(Request $request)
    {
        $trash=false;
        $product_categories=DesignCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $designs=Design::where('product_category',$category)->orderBy('created_at','Desc')->get();
        return view('Design.list_design',compact('designs','product_categories','trash'));
    }
    public function destroy($id)
    {
        Design::where('id',$id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
      $design =  Design::where('id',$id)->first();
        $design_categories=DesignCategory::all();
        return view('Design.edit_design',compact('design','design_categories'));
    }
    public function update(request $request,$id)
    {
        $request->validate([
            'design_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'service'=>'required',
        ]);
        $design = design::where('id', $id)->first();
        $design->design_title=$request->get('design_title');
        $design->regular_price=$request->get('regular_price');
        $design->promotional_price=$request->get('promotional_price');
        $design->status=$request->get('status');
        $design->tax_class=$request->get('tax_class');
        $design->service=$request->get('service');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $path = public_path()."/images/designs/primary/".$design->primary_image;
            unlink($path);
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/designs/primary/',$filename);
            $primary_image = $filename;
          }else {
            $primary_image = $design->primary_image ;
          }
          $design->primary_image = $primary_image ;


        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $path = public_path()."/images/designs/secondary/".$design->secondary_image;
            unlink($path);
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/designs/secondary/',$filename);
            $secondary_image = $filename;
          }else {
            $secondary_image = $design->secondary_image ;
          }
          $design->secondary_image = $secondary_image ;



        if ($request->get('new_category')==null) {
            $design->product_category = $request->get('category');

        }
        else
        {
            $design_category=new DesignCategory();
            $design_category->name=$request->get('new_category');
            $design_category->save();
            $design->product_category =$design_category->id;
        }
        $design->save();
        return redirect(url('list_design'))->with('message', 'Update Recorde succesfully');

    }

}
