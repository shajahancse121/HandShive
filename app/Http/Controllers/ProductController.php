<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use App\SubCategory;
use App\Unit;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAdmin');
    }

    public function addProduct()
    {
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::where('status',1)->get();
        $units = Unit::all();
        $data = [];
        $data ['categories'] = $categories;
        $data ['subcategories'] = $subcategories;
        $data ['units'] = $units;
        return view('backend.admin.product.add-product',$data);
    }
    public function saveProduct(Request $request)
    {


        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->unit_id = $request->unit_id;
        $product->new_product = $request->new_product;
        $product->popular_product = $request->popular_product;
        $product->best_seller = $request->best_seller;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        $product->save();


         if($request->hasfile('field_name'))
         {
             foreach($request->file('field_name') as $file)
             {


                 $imageName = Str::uuid(). '.' .$file->getClientOriginalExtension();
                 $file->move(public_path('upload/product'), $imageName);
                 $product_upload_path = "upload/product/" . $imageName;


                 $productImage = new ProductImage();
                 $productImage->name = $product_upload_path;
                 $productImage->product_id = $product->id;
                 $productImage->save();
             }
         }

        $request->session()->flash('success','Product Save  Successfully');

        return redirect()->route('admin.view-all-product');

    }
    public function updateProduct($product_id,Request $request)
    {
        $product = Product::find($product_id);
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->unit_id = $request->unit_id;
        $product->weight = $request->weight;
        $product->new_product = $request->new_product;
        $product->popular_product = $request->popular_product;
        $product->best_seller = $request->best_seller;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        $product->save();


        if($request->hasfile('field_name'))
        {
            foreach($request->file('field_name') as $file)
            {


                $imageName = Str::uuid(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('upload/product'), $imageName);
                $product_upload_path = "upload/product/" . $imageName;


                $productImage = new ProductImage();
                $productImage->name = $product_upload_path;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }
        if(isset($request->previous_image) && count($request->previous_image)>0){
            foreach($request->previous_image as $image_id)
            {
                $productImage = ProductImage::find($image_id);
                $passport_previous_photo = public_path($productImage->name);
                unlink($passport_previous_photo);
                $productImage->delete();
            }

        }


        $request->session()->flash('success','Product Update  Successfully');

        return redirect()->route('admin.view-all-product');
    }
    public function viewAllProduct()
    {
        $products = Product::all();
        $data = [];
        $data ['products'] = $products;
        return view('backend.admin.product.view-all-product',$data);
    }
    public function editProduct($product_id = null)
    {
        $product = Product::find($product_id);
        $product_image = ProductImage::where('product_id',$product_id)->get();
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::where('status',1)->where('category_id',$product->category_id)->get();
        $units = Unit::all();
        $data = [];
        $data ['categories'] = $categories;
        $data ['subcategories'] = $subcategories;
        $data ['product'] = $product;
        $data ['product_image'] = $product_image;
        $data ['units'] = $units;
        return view('backend.admin.product.edit-product',$data);
    }
}
