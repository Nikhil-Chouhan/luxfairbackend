<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productmeta;
use App\Models\Productgallery;
use App\Models\Productattribute;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Manufacturer;

use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use File;


class ProductController extends Controller
{
    
     /**
     * Show the categories dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $products  = Product::get();
        // foreach ($products  as $key => $value) {
        //     if (!empty($value->category_img)) {
        //         $value->category_img = asset('uploads/category/' . $value->category_img);
        //     }else{
        //         $value->category_img = asset('uploads/category/' . 'default.jpg');
        //     }
        // }
        return view('inventory.product.index',compact('products'));
    }


    /**
     * Show Product List
     *
     * @param Request $request
     * @return mixed
     */
    public function getProductList(Request $request): mixed
    {
        $data = Product::orderBy('id', 'desc');
        $searchKeyword = $request->get('search')['value'];
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('name', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageSubcategories = Auth::user()->can('manage_category');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageSubcategories)  {
                $output = '';
                if ($hasManageSubcategories) { 
                    if (!empty($data->image)) {
                        $data->image = asset('uploads/product/'.$data->id.'/' . $data->image);
                    }else{
                        $data->image = asset('uploads/img/' . 'default.jpg');
                    }
                    $output = '<div class="table-actions">
                    
                                <a href="' . url('admin/products/edit/' .  $data->id).'"><i class="ik ik-edit-2"></i></a>
                                <a href="' . url('admin/products/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                                            
                }
                return $output;
            })
            ->rawColumns([ 'action'])
            ->make(true);
    }

    
    // Create Products
    public function create(): View
    {
        $categories = Category::get();
        $product_attribues = Productattribute::get()->toArray();
        $product_arr = array();

        foreach($product_attribues as $key => $item)
        {
            if(array_key_exists('group', $item))
                $product_arr[$item['group']][$key] = $item;
        }

        ksort($product_arr, SORT_NUMERIC);
 
        $manufacturers = Manufacturer::get();
        return view('inventory.product.create',compact('categories','product_arr','manufacturers'));
    }
    /**
     * Store Product
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

      

        //Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'manufacturer_id' => 'required',
            // 'image' => 'required',
        ]);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
           
            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->manufacturer_id = $request->manufacturer_id;
            $product->price = $request->price;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->is_active = $request->is_active;
            $product->indoor_outdoor = $request->indoor_outdoor;
            $product->sector = $request->sector;
            $product->design = $request->design;
            $product->connection = $request->connection;
            $product->installation = $request->installation;


            $slug = str_slug($request->name, '-');
            $slugCount = Product::where('slug', $slug)->count();
            if ($slugCount > 1) {
                $slug = $slug . '-' . $slugCount;
            }
            $product->slug = $slug;
            $product->save();

            // Product img 
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/product/'.$product->id);
                $image->move($destinationPath, $name);
                $path = 'uploads/product/'.$product->id.'/'.$name;
                $product->update(['image' => $path]);
            }


            // Product Gallery Images
            $gallery_images = $request->gallery_images;
            $gallery_img_c =0;
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $key => $value) {
                    $gallery_img_c++;
                    $temp_filename = $value;
                    $destinationPath = public_path('uploads/product/'.$product->id.'/gallery');
                    // Make dire 
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }
                    // get file extension from string 
                    $ext = pathinfo($temp_filename, PATHINFO_EXTENSION);
                    $name = time().'_'.$gallery_img_c. '.' . $ext;
                    File::move(public_path('uploads/products/temp/'.$temp_filename), $destinationPath.'/'.$name);
                    $gpath = 'uploads/product/'.$product->id.'/gallery/'.$name;
                    $product_gallery = new Productgallery();
                    $product_gallery->product_id = $product->id;
                    $product_gallery->image = $gpath;
                    $product_gallery->save();
                } 
            }


            if ($request->attribute) {
                // Product Meta
                foreach ($request->attribute as $key => $value) {
                    if ($value) {
                        $product_meta = new Productmeta();
                        $attr_id=substr($key, 0,  strpos($key, "_"));
                        $product_meta->product_id = $product->id;
                        $product_meta->product_attribute_id = $attr_id;
                        $product_meta->value = $value;
                        $product_meta->save();
                    }
                } 
            }
            // Response 
            return redirect()->route('products.index')->with('success', 'Product created successfully.');


            // if ($category) {
            //     return redirect('admin/categories')->with('success', 'New Category created!');
            // }

            return redirect('admin/products.index')->with('error', 'Failed to create new Product! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->withErrors( $bug);
        }
    }

    /**
     * Edit Product
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $id ): View
    {
        $categories = Category::get();
        $product_attribues = Productattribute::get()->toArray();
        $product_arr = array();
        $product= Product::find($id);

        foreach($product_attribues as $key => $item)
        {
            if(array_key_exists('group', $item))
                $product_arr[$item['group']][$key] = $item;
        }

        ksort($product_arr, SORT_NUMERIC);
        $manufacturers = Manufacturer::get(); 

        // get gallery imgs 
        $product_gallery = Productgallery::where('product_id',$product->id)->get()->toArray();

        // get product metas 
        $product_metas = Productmeta::where('product_id',$product->id)->get()->toArray();
        // echo "<pre>";
        // print_r($product_metas);
        // die;
        return view('inventory.product.edit', compact('product','categories','product_arr','manufacturers','product_gallery','product_metas'));
    }

   

    // update category
    public function update(Request $request)
    {
        
   
        //Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            'manufacturer_id' => 'required',
            // 'image' => 'required',
        ]);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
           
             
            $productid= $request->product_id;
            $product = Product::find($productid);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->manufacturer_id = $request->manufacturer_id;
            $product->price = $request->price;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->is_active = $request->is_active;
            $product->indoor_outdoor = $request->indoor_outdoor;
            $product->sector = $request->sector;
            $product->design = $request->design;
            $product->connection = $request->connection;
            $product->installation = $request->installation;


            $slug = $request->slug;
            // check if slug is same as saved slug 
            if ($slug == $product->slug) {
                $slug = $slug;
            } else {
                $slugCount = Product::where('slug', $slug)->count();
                if ($slugCount > 1) {
                    $slug = $slug . '-' . $slugCount;
                }
            } 
            $product->slug = $slug;
            $product->save();

            // Product img 
            if ($request->hasFile('image')) {
                // remove old file 
                $old_file = public_path('uploads/product/'.$product->id.'/'.$product->image);
                if (File::exists($old_file)) {
                    File::delete($old_file);
                }
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/product/'.$product->id);  
                $path = 'uploads/product/'.$product->id.'/'.$name;
                $image->move($destinationPath, $name);
                $product->update(['image' => $path]);
            }


            // Product Gallery Images
            $gallery_images = $request->gallery_images;
            $gallery_img_c =0;
            if (!empty($gallery_images)) {
                # code...
                foreach ($gallery_images as $key => $value) {
                    // check if img already exists
                    $old_file = public_path('uploads/product/'.$product->id.'/gallery/'.$value);
                    if (!(File::exists($old_file))) {
                        $gallery_img_c++;
                        $temp_filename = $value;
                        $destinationPath = public_path('uploads/product/'.$product->id.'/gallery');
                        // Make dire 
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        // get file extension from string 
                        $ext = pathinfo($temp_filename, PATHINFO_EXTENSION);
                        $name = time().'_'.$gallery_img_c. '.' . $ext;
                        File::move(public_path('uploads/products/temp/'.$temp_filename), $destinationPath.'/'.$name);

                        $gpath = 'uploads/product/'.$product->id.'/gallery/'.$name;
                        $product_gallery = new Productgallery();
                        $product_gallery->product_id = $product->id;
                        $product_gallery->image = $gpath;
                        $product_gallery->save();
                    } 
                } 
            }


            if ($request->attribute) {
                // delete all product meta
                Productmeta::where('product_id',$product->id)->delete();
                // Product Meta
                foreach ($request->attribute as $key => $value) {
                    if ($value) {
                        $product_meta = new Productmeta();
                        $attr_id=substr($key, 0,  strpos($key, "_"));
                        $product_meta->product_id = $product->id;
                        $product_meta->product_attribute_id = $attr_id;
                        $product_meta->value = $value;
                        $product_meta->save();
                    }
                } 
            }
            // Response 
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');


            // if ($category) {
            //     return redirect('admin/categories')->with('success', 'New Category updated!');
            // }

            return redirect('admin/products.index')->with('error', 'Failed to update Product! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->withErrors( $bug);
        }
    }

    // Delete Categpry 
    public function delete(Request $request)
    {
 
        $product = Product::find($request->id);
        // delete all files from folder
        $path = public_path('uploads/product/'.$product->id);
        File::deleteDirectory($path); 
        $gallery_imgs = Productgallery::where('product_id', $product->id)->delete();
        $product_meta = Productmeta::where('product_id', $product->id)->delete();
        $product->delete();
        return redirect('admin/products')->with('success', ' Product deleted!');
    }



    // upload temp img 
    public function storegalleryTempImg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required | max:2048 | mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()->first()]);
        }
        try {
            $image = $request->file('file');
            $imageName =   time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products/temp'), $imageName);
            return response()->json(['success' => true, 'filename' => $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    //Delete Temp img
    public function deletegalleryTempImg(Request $request)
    {

        $is_old = $request->is_old;
        if ($is_old) { 
            $product_id = $request->product_id;


            $image_path = public_path('uploads/product/'.$product_id.'/gallery/' . $request->filename);
            // delete if exists
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $product_gallery = Productgallery::where('product_id', $product_id)->where('image', $request->filename)->delete();

        }
        
        $image_path = public_path('uploads/products/temp/' . $request->filename);
        
        // delete if exists 
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        return response()->json(['success' => true]);

    }
}
