<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\attribute;
use App\brands;
use App\Category;
use App\Color;
use App\Product;
use App\Size;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
   function products(){
       return view('backend.product.product-list',[
           'products' => Product::paginate(),
           'product_count' => Product::count(),
       ]);
   }

   //Product Add
   function ProductAdd(){
       $categories  = Category::orderBy('category_name', 'asc')->get();
       $scat        = SubCategory::orderBy('subcategory_name', 'asc')->get();
       $colors      = Color::orderBy('color_name', 'asc')->get();
       $sizes       = Size::orderBy('size_name', 'asc')->get();
       $brands      = brands::orderBy('brand_name', 'asc')->get();

       return view('backend.product.product-add',[
           'categories' => $categories,
           'scat'       => $scat,
           'colors'     => $colors,
           'sizes'      => $sizes,
           'brands'     => $brands,
       ]);
   }
    function ProductStore(Request $request){
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext   = Str::random(16).'.'. $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('images/'. $ext));

            $product_id           =  Product::insertGetId([
                'category_id'       => $request->category_id,
                'brand_id'          => $request->brand_id,
                'subcategory_id'    => $request->subcategory_id,
                'title'             => $request->title,
                'slug'              => Str::slug($request->title),
                'price'             => $request->price,
                'summary'           => $request->summary,
                'description'       => $request->description,
                'thumbnail'         => $ext,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);

            // Single Data Insert
            // attribute::insert([
            //     'color_id'   => $request->color_id,
            //     'product_id' => $product_id,
            //     'size_id'    => $request->size_id,
            //     'quantity'   => $request->quantity,
            //     'created_at' => Carbon::now()
            // ]);

            // Multiple DaTa Insert
            foreach ($request->color_id as $key => $value) {
                attribute::insert([
                    'color_id'   => $value,
                    'product_id' => $product_id,
                    'size_id'    => $request->size_id[$key],
                    'quantity'   => $request->quantity[$key],
                    'created_at' => Carbon::now()
                ]);
            }
            if($request->hasFile('images')){
                $images = $request->file('images');
                $new_location = public_path('gallery/')
                . Carbon::now()->format('Y/m/')
                . $product_id . '/';
                File::makeDirectory($new_location , $mode = 0777, true, true);
                foreach ($images as $img) {
                    $img_ext   = Str::random(16).'.'. $img->getClientOriginalExtension();
                    Image::make($img)->save($new_location . $img_ext);
                    Gallery::insert([
                        'product_id'    => $product_id,
                        'images'        => $img_ext,
                        'created_at' => Carbon::now()
                    ]);
                }
            }
        }
        return redirect()->route('products')->with('ProductAdd','Product Add SuccessFully');
    }

    //Product Update
    function ProductEdit($slug){
        return view('backend.product.product-edit',[
            'brands'        => brands::all(),
            'categories'    => Category::all(),
            'product'       => Product::where('slug', $slug)->first(),
        ]);
    }
    function ProductUpdate(Request $request){
        $request->validate([
            'thumbnail' => ['required', 'image']

        ]);
        $product = Product::findOrFail($request->product_id);
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext   = Str::random(16).'.'. $image->getClientOriginalExtension();
            $old_img_location           = public_path('images/'.$product->thumbnail);
            if(file_exists($old_img_location)){
                unlink($old_img_location);
            }
            Image::make($image)->save(public_path('images/'. $ext));
            $product->thumbnail     = $ext;
        }
        $product->title             = $request->title;
        $product->slug              = Str::slug($request->title);
        $product->brand_id          = $request->brand_id;
        $product->category_id       = $request->category_id;
        $product->subcategory_id    = $request->subcategory_id;
        $product->price             = $request->price;
        $product->summary           = $request->summary;
        $product->description       = $request->description;
        $product->save();
        return redirect('products')->with('ProductUpdate', 'Product Updated Successfully!');
    }
    function CategoryAjax($id){
        $scat = SubCategory::where('category_id', $id)->get();
        return response()->json($scat);
    }

    //Gallery Images Update
    function ProductImageEdit($slug){
        $product_id = Product::where('slug', $slug)->first();
        $gallery    = Gallery::where('product_id', $product_id->id)->get();
        return view('backend.product.gallery-edit',[
            'brands'        => brands::all(),
            'categories'    => Category::all(),
            'product'       => Product::where('slug', $slug)->first(),
            'gallery'       => $gallery,
        ]);
    }
    //Gallery Image Delete
    function GalleryImageDelete($id){
        $gallery = Gallery::findOrFail($id);
        $old_img = public_path('gallery/'.$gallery->created_at->format('Y/m/'.$gallery->product_id).'/'.$gallery->images);
        if(file_exists($old_img)){
           unlink($old_img);
           $gallery->delete();
        }
        return back()->with('ImageDelete', 'Image Deleted Successfully');
    }
    function MultiImgUpadate(Request $request){
        // $request->validate([
        //     'MultiImage' => ['required', 'image']
        // ],[
        //     'MultiImage.required' => 'মালটি ইমেজ আপনার দিতেই হবে',
        // ]);
        if($request->hasFile('images')){
           $product_id = $request->product_id;
            $images = $request->file('images');
            $new_location = public_path('gallery/')
            . Carbon::now()->format('Y/m/')
            . $product_id . '/';
            File::makeDirectory($new_location , $mode = 0777, true, true);
            foreach ($images as $img) {
                $img_ext   = Str::random(16).'.'. $img->getClientOriginalExtension();
                Image::make($img)->resize(500, 500)->save($new_location . $img_ext);
                Gallery::insert([
                    'product_id'    => $product_id,
                    'images'        => $img_ext,
                    'created_at' => Carbon::now()
                ]);
            }
            return back()->with('ImageAdd', 'Image Added Successfully');
        }
    }
    function ProductDelete($id){
        $product = Product::findOrFail($id);
        $old_img = public_path('images/'.$product->thumbnail);
        if(file_exists($old_img)){
           unlink($old_img);
        }
        $gallery = Gallery::where('product_id', $product->id)->get();
        foreach ($gallery as $item) {
            $oldimg = public_path('gallery/'.$item->created_at->format('Y/m/'.$item->product_id).'/'.$item->images);
            if(file_exists($oldimg)){
                unlink($oldimg);
                $item->delete();
            }
        }
        $product->delete();
        return back()->with('ProductDelete', 'Product Deleted Successfully');
    }
}
