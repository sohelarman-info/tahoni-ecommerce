<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('verified');

    }
    function CategoryList(){
        //$categories = Category::simplepaginate(3);
        $categories = Category::paginate();
        $trash_category = Category::onlyTrashed()->get();
    	return view('backend.category.category-list' , [
            'categories' => $categories,
            'trash_category' => $trash_category
        ]);
    }
    function CategoryPost(Request $req){
        $req->validate([
            'category_name' => ['required', 'min:3', 'unique:categories']
        ],[
            'category_name.required'    => 'আপনি কিছুই দেন নি!',
            'category_name.min'         => 'কমপক্ষে ৩ টি অক্ষর দিতে হবে।',
            'category_name.unique'      => 'আপনি যেটা দিয়েছেন সেটি অন্য ডাটার সাথে মিলে গেছে'
        ]);
        //return $req -> all();

        //Data Insert Method 01
        $data = new Category;
        $data->slug = Str::slug($req->category_name);
        $data->category_name = $req->category_name;
        $data->save();

        //Data Insert method 02
    	// Category::insert([
    	// 	//db column field => Form Request Value
		// 	'category_name' => $req->category_name,
		// 	'created_at' 	=> Carbon::now()
        // ]);
        return redirect('category-add')->with('CategoryAdd', 'Category Added Successfully!');
        //return redirect('/link');
    }
    function CategoryDelete($id){
        $cat_product = Product::where('category_id', $id)->count();
        if($cat_product > 0){
            return back()->with('CategoryAddAlart', "You can't Delete this Category. alrady have product");
        }else{
            Category::findOrFail($id)->delete();
            return back()->with('CategoryDelete', 'Category Deleted Successfully!');
        }
    }
    function CategoryRestore($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return back()->with('CategoryRestore', 'Category Undo Successfully!');
    }
    function CategoryPermanentDelete($id){
        Category::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('CategoryDelete', 'Category Permanent Deleted Successfully!');
    }
    function CategoryEdit($id){
        $categories     = Category::paginate();
        $trash_category = Category::onlyTrashed()->get();
        $edit_category  = Category::findOrFail($id);

    	return view('backend.category.category-edit' , [
            'categories'        => $categories,
            'trash_category'    => $trash_category,
            'edit_category'     => $edit_category,
        ]);
    }
    function CategoryUpdate(Request $req){
        //Method 01
        $update = Category::findOrFail($req->id);
        $update->category_name = $req->category_name;
        $update->slug = Str::slug($req->category_name);
        $update->save();

        //Method 02
        // Category::findOrFail($req->id)->update([
        //     'category_name' => $req->category_name,
        //     'slug'          => Str::slug($req->category_name),
        //     'updated_at'    => Carbon::now()
        // ]);
        return redirect('category-list')->with('CategoryRestore', 'Category Updated Successfully!');
    }
    function CategoryAdd(){
        $categories = Category::paginate();
        $trash_category = Category::onlyTrashed()->get();
    	return view('backend.category.category-add' , [
            'categories' => $categories,
            'trash_category' => $trash_category
        ]);
    }
    function SelectCategoryDelete(Request $request){
        if ($request->cat_id != '') {
            foreach ($request->cat_id as $cat) {
                Category::findOrFail($cat)->delete();
             }
        }
        return back()->with('CategoryDelete', 'Category Deleted Successfully');
    }
}
