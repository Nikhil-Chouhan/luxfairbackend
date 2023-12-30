<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Productattribute;

class ProductattributeController extends Controller
{
     /**
     * Show the productattributes dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $productattributes  = Productattribute::get();

        return view('inventory.productattributes.index',compact('productattributes'));
    }


    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getProductAttributesList(Request $request): mixed
    {
        $data = Productattribute::orderBy('id', 'desc');
        $searchKeyword = filter_var($request->get('search')['value'], FILTER_SANITIZE_STRING);
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('name', 'LIKE', '%' . $searchKeyword . '%')
                ->orWhere('type', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageProductAttributes = Auth::user()->can('manage_product_attributes');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageProductAttributes)  {
                $output = '';

                if ($hasManageProductAttributes) {
                    $output = '<div class="table-actions">
                                            <a href="javascript:void(0);" onclick="showConfirmationModal(\'' . url("admin/product_attributes/delete/" . $data->id) . '\')">
                                            <i class="ik ik-trash-2 f-16 text-red"></i>
                                        </a>
                                            </div>';
                                            
                }
                return $output;
            })
            ->rawColumns([ 'action'])
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
            'name' => 'required| string ',
            'type' => 'required| string ',
            'group' => 'required| string ',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

      



            // store productattributes information
            $productattributes = Productattribute::create([
                'name' => $request->name,
                'type' => $request->type,
                'group' => (!empty($request->group))? $request->group : 'others',
            ]);


            if ($productattributes) {
                return redirect('admin/product_attributes')->with('success', 'Product Attribute created!');
            }

            return redirect('admin/product_attributes')->with('error', 'Failed to create new Product Attribute! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }


   

    // update productattributes
    public function update(Request $request)
    {
        
   
        //Validate
        $validator = Validator::make($request->all(), [
            'id' => 'required| string ',
            'name' => ' string ',
            'group' => ' string ',
            'type' => ' string ',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            
            $productattributes = Productattribute::find($request->id);
            if (!empty($request->type)) {
                $productattributes->type = $request->type;
            }
            if (!empty($request->group)) {
                $productattributes->group = $request->group;
            }
            if (!empty($request->name)) {
                $productattributes->name = $request->name;
            }

            $productattributes->save();

            return $productattributes;
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    // Delete Categpry 
    public function delete(Request $request)
    {

        // check subcategory exists
        // $subCategoryCount = SubProductattribute::where('category_id', $request->id)->count();
        // if ($subCategoryCount > 0) {
        //     return redirect()->back()->with('error', 'Category has subcategory. Delete subcategory first.');
        // }
        $productattributes = Productattribute::find($request->id);
  
        $productattributes->delete();
        return redirect('admin/product_attributes')->with('success', ' Product Attribute deleted!');
    }

}
