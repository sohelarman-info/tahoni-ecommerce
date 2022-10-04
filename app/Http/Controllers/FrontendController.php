<?php

namespace App\Http\Controllers;

use App\attribute;
use App\Blog;
use App\Category;
use App\Comment;
use App\Gallery;
use App\Product;
use App\Review;
use Cookie;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function front(){
        return view('frontend.main', [
            'products' => Product::latest()->limit(8)->get(),
        ]);
    }
    function SingleProduct($slug){
        $cookie = Cookie::get('cookie_id');
        if ($cookie) {
            # code...
        }else{
            $generate = Str::random(7).rand(1,1000);
            Cookie::queue('cookie_id', $generate, 43200);
        }

        $product = Product::where('slug', $slug)->first();
        //$gallery = Gallery::where('product_id', $product->id)-get();
        $attribute = attribute::where('product_id', $product->id)->get();
        $collection = collect($attribute);
        $groupBy    = $collection->groupBy('color_id');
        return view('frontend.single_product',[
            'product' => $product,
            'groupBy' => $groupBy,
            //'gallery' => $gallery,
            'reviews' => Review::where('product_id', $product->id)->get()
        ]);
    }
    function GetSize($color, $product){
        $output = '';
        $sizes  = attribute::where('color_id', $color)->where('product_id', $product)->get();
        foreach($sizes as $size){
            $output = $output.' <input type="radio" class="size_id" name="size_id" value=" '. $size->size_id .'"> '. $size->Size->size_name. '';
        }
        echo $output;
    }
    function Blogs(){
        return view('frontend.blogs',[
            'blogs' => Blog::latest()->paginate()
        ]);
    }
    function SingleBlog($slug){
        $category = Category::orderBy('category_name', 'asc')->get();
        $blog = Blog::whereSlug($slug)->first();
        return view('frontend.blog-details',[
            'blog' => $blog,
            'catagories' => $category,
            'related' => Blog::where('category_id', $blog->category_id)->get()->except(['id', $blog->id]),
            'comments' => Comment::where('status', 1)->where('blog_id', $blog->id)->latest()->get(),
        ]);
    }
    function Search(Request $request){
        // return Product::where('title', 'LIKE' , "%$request->q%")->get();

        $product = Product::query();

        if ($request->q)
        {
            // simple where here or another scope, whatever you like
            $product->where('title','like',"%$request->q%");
        }

        if ($request->q)
        {
            $product->orwhere('price','like',"%$request->q%");
        }

        if ($request->q)
        {
            $product->orwhere('slug','like',"%$request->q%");
        }

        return $all_product = $product->get();
        return view('frontend.search', [
            'products' => $product,
        ]);
    }
}
