<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
   function SubCategoryView(){
       $scategories = SubCategory::orderBy('created_at', 'desc')->paginate();
       return view('backend.subcategory.subcategory-view',[
           'scategories' => $scategories
       ]);
   }
   function SubCategoryAdd(){
       return view('backend.subcategory.subcategory-add',[
           'categories' => Category::orderBy('category_name', 'asc')->get()
       ]);
   }
   function SubCategoryPost(Request $request){
       //return $request->all();
    //    SubCategory::insert([
    //        'subcategory_name' => $request->subcategory_name,
    //        'slug' => Str::slug($request->subcategory_name),
    //        'category_id' => $request->category_id,
    //        'created_at' => Carbon::now(),
    //    ]);


        $data = new SubCategory;
        $data->subcategory_name = $request->subcategory_name;
        $data->slug = Str::slug($request->subcategory_name);
        $data->category_id   = $request->category_id;
        $data->save();
        return redirect('subcategory-view')->with('SubCategoryAdd', 'Sub Category Added Successfully!');

    }
    function SubCategoryEdit($scat_id){
        $scat = SubCategory::where('slug', $scat_id)->first();
    	return view('backend.subcategory.subcategory-edit' , [
            'scat' => $scat,
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'scategories'   => $scat,
        ]);
    }
    function SubCategoryUpdate(Request $req){
        $update = SubCategory::findOrFail($req->id);
        $update->subcategory_name = $req->subcategory_name;
        $update->category_id = $req->category_id;
        $update->slug = Str::slug($req->subcategory_name);
        $update->save();
        return redirect('subcategory-view')->with('SubCategoryUpdate', ' Sub Category Updated Successfully!');
    }
    function SubCategoryDelete($scat_id){
        SubCategory::findOrFail($scat_id)->delete();
        return redirect('subcategory-view')->with('SubCategoryDelete', 'Sub Category Deleted Successfully!');
    }
}
