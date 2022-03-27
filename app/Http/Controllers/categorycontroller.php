<?php

namespace App\Http\Controllers;
use App\Models\Design;
use App\Models\Order;
use App\Models\DesignCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Website;
use App\Models\WebsiteCategory;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{
    public function add_category()
    {
        return view('categories.add_categorie');
    }
    public function store(Request $request)
    {
        if ($request->get('category')==1)
        {
            $request->validate([
                'name'=>'required|unique:product_categories',
                'category'=>'required',
            ]);

            $product_category=new ProductCategory();
            $product_category->name=$request->get('name');
            $product_category->save();

        }
        if ($request->get('category')==2)
        {
            $request->validate([
                'name'=>'required|unique:design_categories',
                'category'=>'required',
            ]);
            $design_category=new DesignCategory();
            $design_category->name=$request->get('name');
            $design_category->save();
        }
        if ($request->get('category')==3)
        {
            $request->validate([
                'name'=>'required|unique:website_categories',
                'category'=>'required',
            ]);
            $website_category=new WebsiteCategory();
            $website_category->name=$request->get('name');
            $website_category->save();
        }


        return redirect()->back()->with('alert', 'Insert Recorde successfully');
    }
    public function list_category()
    {
        $products = ProductCategory::all();
        $i = 0;
        foreach ($products as $product) {
            if (!Product::where('product_category', $product->id)->exists()) {
                $products[$i]->setAttribute('delete', true);
            } else {
                $products[$i]->setAttribute('delete', false);

            }

            $i++;

        }


        $designs = DesignCategory::all();
        $j = 0;
        foreach ($designs as $design) {
            if (!Design::where('product_category', $design->id)->exists()) {
                $designs[$j]->setAttribute('delete', true);
            } else {
                $designs[$j]->setAttribute('delete', false);

            }
            $j++;

        }
        $websites = WebsiteCategory::all();
        $k = 0;
        foreach ($websites as $website) {
            if (!Website::where('product_category', $website->id)->exists()) {
                $websites[$k]->setAttribute('delete', true);
            } else {
                $websites[$k]->setAttribute('delete', false);

            }
            $k++;

        }

        return view('categories.list_categorie', compact('products', 'designs', 'websites'));
    }
    public function destroy($id,$flag)
    {
        if ($flag==1)
        {
           ProductCategory::where('id',$id)->delete();

        }
        if ($flag==2)
        {
           DesignCategory::where('id',$id)->delete();
        }
        if ($flag==3)
        {
            WebsiteCategory::where('id',$id)->delete();
        }

        return redirect()->back();
    }
    public function edit($id,$flag)
    {
        if ($flag==1)
        {
            $data=ProductCategory::find($id);
        }
        if ($flag==2)
        {
            $data=DesignCategory::find($id);
        }
        if ($flag==3)
        {
            $data=WebsiteCategory::find($id);
        }

      return view('categories.edit_categorie',compact('data','flag'));
    }
    public function update(request $request,$id,$flag)
    {
        $request->validate([
            'name'=>'required'
        ]);
        if ($flag==1)
        {
            $data=ProductCategory::find($id);
            $data->name=$request->get('name');
        }
        if ($flag==2)
        {
            $data=DesignCategory::find($id);
            $data->name=$request->get('name');
        }
        if ($flag==3)
        {
            $data=WebsiteCategory::find($id);
            $data->name=$request->get('name');
        }

        $data->save();

        return redirect(url('list_category'))->with('message', 'Update Recorde succesfully');

    }
}
