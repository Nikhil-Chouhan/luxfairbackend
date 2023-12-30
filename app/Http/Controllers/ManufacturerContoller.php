<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Manufacturer;

class ManufacturerContoller extends Controller
{
    
     /**
     * Show the manufacturers dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $manufacturers  = Manufacturer::get();


        return view('inventory.manufacturers.index',compact('manufacturers'));
    }


    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getManufacturerList(Request $request): mixed
    {
        $data = Manufacturer::orderBy('id', 'desc');
        $searchKeyword = filter_var($request->get('search')['value'], FILTER_SANITIZE_STRING);
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('name', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageProductAttributes = Auth::user()->can('manage_manufacturers');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageProductAttributes)  {
                $output = '';

                if ($hasManageProductAttributes) {
                    $output = '<div class="table-actions">
                        <a href="#manufacturerView" data-toggle="modal" data-target="#manufacturerView"
                        data-name="' . $data->name . '"
                        data-description="' . $data->description . '"
                        data-image="' . $data->image . '"
                        data-id="' . $data->id . '"
                        ><i class="ik ik-edit-2"></i></a>
                        <a href="javascript:void(0);" onclick="showConfirmationModal(\'' . url("admin/manufacturers/delete/" . $data->id) . '\')">
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
            'description' => 'required| string ',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            $manufaImage = $request->file('image');
            if (!empty($manufaImage)) {
                $manufaImageName = time() . '.' . $manufaImage->getClientOriginalExtension();  
                $manufaImage->move('uploads/manufacturers/', $manufaImageName);
                $manufaImagepath = 'uploads/manufacturers/'.$manufaImageName;
            }
      
            // store manufacturers information
            $manufacturers = Manufacturer::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $manufaImagepath ?? '',
            ]);


            if ($manufacturers) {
                return redirect('admin/manufacturers')->with('success', 'Manufacturer created!');
            }

            return redirect('admin/manufacturers')->with('error', 'Failed to create new Manufacturer! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }


   

    // update manufacturers
    public function update(Request $request)
    {
        
   
        //Validate
        $validator = Validator::make($request->all(), [
            'id' => 'required| string ',
            'name' => ' string ',
            'description' => ' string '
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            
            $manufacturers = Manufacturer::find($request->id);
            if (!empty($request->description)) {
                $manufacturers->description = $request->description;
            }
            if (!empty($request->name)) {
                $manufacturers->name = $request->name;
            }

            $manufaImage = $request->file('image');
            if (!empty($manufaImage)) {
                $manufaImageName = time() . '.' . $manufaImage->getClientOriginalExtension();  
                $manufaImage->move('uploads/manufacturers/', $manufaImageName);
                $manufaImagepath = 'uploads/manufacturers/'.$manufaImageName;
                $manufacturers->image = $manufaImagepath;
            }

            $manufacturers->save();

            if ($manufacturers) {
                return redirect('admin/manufacturers')->with('success', ' Manufacturer updated!');
            }

            return redirect('admin/manufacturers')->with('error', 'Failed to update Manufacturer! Try again.');

        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    // Delete Categpry 
    public function delete(Request $request)
    {

        // check subcategory exists
        // $subCategoryCount = SubManufacturer::where('category_id', $request->id)->count();
        // if ($subCategoryCount > 0) {
        //     return redirect()->back()->with('error', 'Category has subcategory. Delete subcategory first.');
        // }
        $manufacturers = Manufacturer::find($request->id);
  
        $manufacturers->delete();
        return redirect('admin/manufacturers')->with('success', ' Manufacturer deleted!');
    }

}
