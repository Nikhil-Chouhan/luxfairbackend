<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Subcategory;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
     /**
     * Show the categories dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $categories  = Category::get();
        foreach ($categories  as $key => $value) {
            if (!empty($value->category_img)) {
                $value->category_img = asset('uploads/category/' . $value->category_img);
            }else{
                $value->category_img = asset('uploads/category/' . 'default.jpg');
            }
        }
        return view('inventory.category.index',compact('categories'));
    }


    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getCategoryList(Request $request): mixed
    {
        $data = Category::orderBy('id', 'desc');
        $searchKeyword = $request->get('search')['value'];
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('category_title', 'LIKE', '%' . $searchKeyword . '%')
                ->orWhere('category_slug', 'LIKE', '%' . $searchKeyword . '%')
                ->orWhere('category_description', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageSubcategories = Auth::user()->can('manage_category');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageSubcategories)  {
                $output = '';
                // if ($data->name == 'Super Admin') {
                //     return '';
                // }
                if ($hasManageSubcategories) {
                    // <a href="' . url('admin/user/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                    if (!empty($data->category_img)) {
                        $data->category_img = asset('uploads/category/' . $data->category_img);
                    }else{
                        $data->category_img = asset('uploads/category/' . 'default.jpg');
                    }
                    $output = '<div class="table-actions">
                                <a href="#categoryView" data-toggle="modal" data-target="#categoryView"
                                data-title = '. $data->category_title .'
                                data-slug = '. $data->category_slug .'
                                            data-img = '. $data->category_img .'
                                            data-is_active = '. $data->is_active .'
                                            data-id = '. $data->id .'
                                            data-description = '. $data->category_description .'
                                            ><i class="ik ik-edit-2"></i></a>
                                            <a href="' . url('admin/category/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </div>';
                                            
                }
                return $output;
            })
            ->rawColumns(['roles', 'permissions', 'action'])
            ->make(true);
    }

    
    /**
     * Store Category
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        //Validate
        $validator = Validator::make($request->all(), [
            'category_title' => 'required| string ',
            // 'category_slug' => 'required | string ',
            'category_img' => 'max:2048 | mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            // Store category IMage
            $categoryImage = $request->file('category_img');
            if (!empty($categoryImage)) {
                $categoryImageName = time() . '.' . $categoryImage->getClientOriginalExtension();
                $categoryImage->move(public_path('uploads/category'), $categoryImageName);
            }



            // Check slug with existing slug
            $slug = $request->get('category_slug');
            if (empty($slug)) {
                $slug = str_slug($request->get('category_title'), '-');
            }
            $slugCount = Category::where('category_slug', $slug)->count();
            if ($slugCount > 1) {
                $slug = $slug . '-' . $slugCount;
            //     return redirect()->back()->with('error', 'Category slug already exists.');
            }
            // Generate new slug


            // store category information
            $category = Category::create([
                'category_title' => $request->category_title,
                'category_slug' => $slug,
                'category_img' => $categoryImageName ?? null,
                'category_description' => $request->category_description,
                'is_active' => $request->is_active,
            ]);


            if ($category) {
                return redirect('admin/categories')->with('success', 'New Category created!');
            }

            return redirect('admin/categories')->with('error', 'Failed to create new category! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }


   

    // update category
    public function update(Request $request)
    {
        
   
        //Validate
        $validator = Validator::make($request->all(), [
            'category_title' => 'required| string ',
            'category_slug' => 'required | string ',
            'category_img' => 'nullable|max:2048 | mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            // Store category IMage
            $categoryImage = $request->file('category_img');
            if (!empty($categoryImage)) {

                // delete existing
                $category = Category::find($request->id);
                if (!empty($category->category_img)) {
                    $image_path = public_path('uploads/category/' . $category->category_img);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $categoryImageName = time() . '.' . $categoryImage->getClientOriginalExtension();
          
                $categoryImage->move(public_path('uploads/category'), $categoryImageName);
            }



            // Check slug with existing slug
            $slug = $request->get('category_slug');
            $slugCount = Category::where('category_slug', $slug)->count();
            if ($slugCount > 1) {
                $slug = $slug . '-' . $slugCount;
            //     return redirect()->back()->with('error', 'Category slug already exists.');
            }
            // Generate new slug

            // store category information
            $category = Category::find($request->id);
            $category->category_title = $request->category_title;
            $category->category_slug = $slug;
            $category->is_active = $request->is_active;
            $category->category_description = $request->category_description;
            if (!empty($categoryImage)) {
                $category->category_img = $categoryImageName;
            }
            $category->save();

            if ($category) {
                return redirect('admin/categories')->with('success', ' Category updated!');
            }

            return redirect('admin/categories')->with('error', 'Failed to update category! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    // Delete Categpry 
    public function delete(Request $request)
    {

        // check subcategory exists
        $subCategoryCount = Subcategory::where('category_id', $request->id)->count();
        if ($subCategoryCount > 0) {
            return redirect()->back()->with('error', 'Category has subcategory. Delete subcategory first.');
        }
        $category = Category::find($request->id);
        if (!empty($category->category_img)) {
            $image_path = public_path('uploads/category/' . $category->category_img);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $category->delete();
        return redirect('admin/categories')->with('success', ' Category deleted!');
    }

    //  get sub categories
    public function getSubCategories(Request $request)
    {
        $subCategories = Category::find($request->id)->subcategory??'';
        return response()->json($subCategories);
    }

}
