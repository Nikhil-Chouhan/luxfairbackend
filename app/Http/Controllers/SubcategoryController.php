<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class SubcategoryController extends Controller
{
     /**
     * Show the subcategories dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $subcategories  = Subcategory::get();
        $parentcategories = Category::get();
        foreach ($subcategories  as $key => $value) {
            if (!empty($value->subcategory_img)) {
                $value->subcategory_img = asset('uploads/subcategory/' . $value->subcategory_img);
            }else{
                $value->subcategory_img = asset('uploads/subcategory/' . 'default.jpg');
            }
        }
        return view('inventory.subcategory.index',compact('subcategories','parentcategories'));
    }


    
    /**
     * Store SubCategory
     *
     * @param SubCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        //Validate
        $validator = Validator::make($request->all(), [
            'subcategory_title' => 'required| string ',
            // 'subcategory_slug' => 'required | string ',
            'subcategory_img' => 'max:2048 | mimes:jpg,jpeg,png',
            'category_id' => 'required |exists:categories,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            // Store subcategory IMage
            $subcategoryImage = $request->file('subcategory_img');
            if ($subcategoryImage) {
               
                $subcategoryImageName = time() . '.' . $subcategoryImage->getClientOriginalExtension();
                $subcategoryImage->move(public_path('uploads/subcategory'), $subcategoryImageName);
            } else {
                $subcategoryImageName = 'default.jpg';
            }



            // Check slug with existing slug
            $slug = $request->get('subcategory_slug');
            if (empty($slug)) {
                $slug = str_slug($request->get('subcategory_title'), '-');
            }
            $slugCount = Subcategory::where('subcategory_slug', $slug)->count();
            if ($slugCount > 1) {
                $slug = $slug . '-' . $slugCount;
            //     return redirect()->back()->with('error', 'SubCategory slug already exists.');
            }
            // Generate new slug

            // store subcategory information
            $subcategory = Subcategory::create([
                'subcategory_title' => $request->subcategory_title,
                'subcategory_slug' => $slug,
                'subcategory_img' => $subcategoryImageName,
                'subcategory_description' => $request->subcategory_description,
                'is_active' => $request->is_active,
                'category_id' => $request->category_id,
            ]);


            if ($subcategory) {
                return redirect('admin/subcategories')->with('success', 'New SubCategory created!');
            }

            return redirect('admin/subcategories')->with('error', 'Failed to create new subcategory! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }


    /**
     * Show SubCategory List
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubCategoryList(Request $request): mixed
    {
        $data = Subcategory::orderBy('id', 'desc');
        $searchKeyword = $request->get('search')['value'];
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('subcategory_title', 'LIKE', '%' . $searchKeyword . '%')
                ->orWhere('subcategory_slug', 'LIKE', '%' . $searchKeyword . '%')
                ->orWhere('subcategory_description', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageSubcategories = Auth::user()->can('manage_subcategory');
        return Datatables::of($data)
            ->addColumn('parent_category', function ($row) {
                $getcategoryname = Category::where('id', $row->category_id)->first();
                
                return $getcategoryname->category_title;
            })
            ->addColumn('action', function ($data) use ($hasManageSubcategories)  {
                $output = '';
                // if ($data->name == 'Super Admin') {
                //     return '';
                // }
                // }
                // <a href="' . url('admin/user/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                if ($hasManageSubcategories) {
                    if (!empty($data->category_img)) {
                        $data->category_img = asset('uploads/subcategory/' . $data->category_img);
                    }else{
                        $data->category_img = asset('uploads/subcategory/' . 'default.jpg');
                    }
                    $output = '<div class="table-actions">

                                            <a href="#subcategoryView" data-toggle="modal" data-target="#subcategoryView"
                                            data-title = '. $data->subcategory_title .'
                                            data-slug = '. $data->subcategory_slug .'
                                            data-img = '. $data->subcategory_img .'
                                            data-is_active = '. $data->is_active .'
                                            data-id = '. $data->id .'
                                            data-description = '. $data->subcategory_description .'
                                            data-category_id = '. $data->category_id .'
                                            
                                            ><i class="ik ik-edit-2"></i></a>
                                <a href="' . url('admin/subcategory/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';

                }
                return $output;
            })
            ->rawColumns(['roles', 'permissions', 'action'])
            ->make(true);
    }

    // update subcategory
    public function update(Request $request)
    {
        
   
        //Validate
        $validator = Validator::make($request->all(), [
            'subcategory_title' => 'required| string ',
            'subcategory_slug' => 'required | string ',
            'subcategory_img' => 'nullable|max:2048 | mimes:jpg,jpeg,png',
            'category_id' => 'required |exists:categories,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            // Store subcategory IMage
            $subcategoryImage = $request->file('subcategory_img');
            if (!empty($subcategoryImage)) {

                // delete existing
                $subcategory = Subcategory::find($request->id);
                if (!empty($subcategory->subcategory_img)) {
                    $image_path = public_path('uploads/subcategory/' . $subcategory->subcategory_img);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $subcategoryImageName = time() . '.' . $subcategoryImage->getClientOriginalExtension();
          
                $subcategoryImage->move(public_path('uploads/subcategory'), $subcategoryImageName);
            }



            // Check slug with existing slug
            $slug = $request->get('subcategory_slug');
            $slugCount = Subcategory::where('subcategory_slug', $slug)->count();
            if ($slugCount > 1) {
                $slug = $slug . '-' . $slugCount;
                // return redirect()->back()->with('error', 'SubCategory slug already exists.');
            }
            // Generate new slug

            // store subcategory information
            $subcategory = Subcategory::find($request->id);
            $subcategory->subcategory_title = $request->subcategory_title;
            $subcategory->subcategory_slug = $slug;
            $subcategory->is_active = $request->is_active;
            $subcategory->subcategory_description = $request->subcategory_description;
            if (!empty($subcategoryImage)) {
                $subcategory->subcategory_img = $subcategoryImageName;
            }
            $subcategory->save();

            if ($subcategory) {
                return redirect('admin/subcategories')->with('success', ' SubCategory updated!');
            }

            return redirect('admin/subcategories')->with('error', 'Failed to update subcategory! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    // Delete Categpry 
    public function delete(Request $request)
    {

        // check products exists
        $productCount = Product::where('subcategory_id', $request->id)->count();
        if ($productCount > 0) {
            return redirect()->back()->with('error', 'SubCategory has products. Delete products first.');
        }
       

        $subcategory = Subcategory::find($request->id);
        if (!empty($subcategory->subcategory_img)) {
            $image_path = public_path('uploads/subcategory/' . $subcategory->subcategory_img);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $subcategory->delete();
        return redirect('admin/subcategories')->with('success', ' SubCategory deleted!');
    }

 

}

