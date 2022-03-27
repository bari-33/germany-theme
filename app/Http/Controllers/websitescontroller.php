<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Order;
use App\Models\WebsiteCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class websitescontroller extends Controller
{
    public function add_website()
    {
        $website_categories = WebsiteCategory::all();
        return view('websites.add_website', compact('website_categories'));
    }
    public function store(request $request)
    {
        $request->validate([
            'website_title' => 'required',
            'regular_price' => 'required',
            'status' => 'required',
            'tax_class' => 'required',
            'primary_image' => 'required',
            'secondary_image' => 'required',
        ]);
        $website = new Website();
        $website->website_title = $request->get('website_title');
        $website->regular_price = $request->get('regular_price');
        $website->promotional_price = $request->get('promotional_price');
        $website->status = $request->get('status');
        $website->tax_class = $request->get('tax_class');
        // FOR PRIMARY IMAGE
        if ($request->hasFile('primary_image')) {
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->move('images/websites/primary/', $filename);
            $primary_image = $filename;
        }
        $website->primary_image = $primary_image;
        // FOR SECONDARY IMAGE
        if ($request->hasFile('secondary_image')) {
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->move('images/websites/secondary/', $filename);
            $secondary_image = $filename;
        }
        $website->secondary_image = $secondary_image;



        if ($request->get('new_category') == null) {
            $website->product_category = $request->get('category');
        } else {
            $website_category = new WebsiteCategory();
            $website_category->name = $request->get('new_category');
            $website_category->save();
            $website->product_category = $website_category->id;
        }
        $website->save();
        return redirect()->back()->with('alert', 'Insert Recorde successfully');
    }
    public function list_website()
    {
        $trash=false;
        $websites=Website::orderBy('created_at','ASC')->get();

        $count=$websites->count();
        $published=Website::where('status','1')->count();
        $draft=Website::where('status','0')->count();
        $deleted=Website::onlyTrashed()->count();
        $product_categories=WebsiteCategory::all();

        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('draft',$draft);
        Session::put('deleted',$deleted);

        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }




        return view('websites.list_website',compact('websites','product_categories','trash'));
    }
    public function search(Request $request)
    {
        $trash=false;
        $product_categories=WebsiteCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        switch ($request->input('action'))
        {

            case 'all':
                $websites=Website::orderBy('created_at','ASC')->get();
                break;
            case 'published':
                $websites=Website::where('status','1')->orderBy('created_at','ASC')->get();

                break;
            case 'draft':
                $websites=Website::where('status','0')->orderBy('created_at','ASC')->get();
                break;
            case 'deleted':
                $websites=Website::onlyTrashed()->get();
                $trash=true;
                break;


        }
        return view('websites.list_website',compact('websites','product_categories','trash'));


    }


    public function searchCategory(Request $request)
    {

        $trash=false;
        $product_categories=WebsiteCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $websites=Website::where('product_category',$category)->orderBy('created_at','ASC')->get();
        return view('websites.list_website',compact('websites','product_categories','trash'));
    }
    public function destroy($id)
    {
        Website::where("id",$id)->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
       $website = Website::where("id",$id)->first();
        $website_categories=WebsiteCategory::all();
        return view('websites.edit_website',compact('website','website_categories'));
    }
    public function update(request $request,$id)
    {
        $request->validate([
            'website_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
        ]);
        $website = Website::where("id",$id)->first();
        $website->website_title=$request->get('website_title');
        $website->regular_price=$request->get('regular_price');
        $website->promotional_price=$request->get('promotional_price');
        $website->status=$request->get('status');
        $website->tax_class=$request->get('tax_class');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $path = public_path()."/images/websites/primary/".$website->primary_image;
            unlink($path);
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/websites/primary/',$filename);
            $primary_image = $filename;

        }else {
            $primary_image = $website->primary_image ;
        }
        $website->primary_image = $primary_image ;



        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $path = public_path()."/images/websites/secondary/".$website->secondary_image;
            unlink($path);
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('images/websites/secondary/',$filename);
            $secondary_image = $filename;

        }else {
            $secondary_image = $website->secondary_image ;
        }
        $website->secondary_image = $secondary_image ;


        if ($request->get('new_category')==null) {
            $website->product_category = $request->get('category');

        }
        else
        {
            $website_category=new WebsiteCategory();
            $website_category->name=$request->get('new_category');
            $website_category->save();
            $website->product_category =$website_category->id;
        }
        $website->save();

        return redirect(url('list_website'))->with('message', 'Update Recorde succesfully');

    }
}
