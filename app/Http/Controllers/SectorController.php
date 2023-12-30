<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Sector;

class SectorController extends Controller
{
    
     /**
     * Show the Sector dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $sector  = Sector::get();


        return view('inventory.sector.index',compact('sector'));
    }


    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getSectorList(Request $request): mixed
    {
        $data = Sector::orderBy('id', 'desc');
        $searchKeyword = filter_var($request->get('search')['value'], FILTER_SANITIZE_STRING);
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('name', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageProductAttributes = Auth::user()->can('manage_sector');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageProductAttributes)  {
                $output = '';

                if ($hasManageProductAttributes) {
                    $output = '<div class="table-actions">
                        <a href="#sectorView" data-toggle="modal" data-target="#sectorView"
                        data-name="' . $data->name . '"
                        data-image="' . $data->image . '"
                        data-id="' . $data->id . '"
                        ><i class="ik ik-edit-2"></i></a>
                        <a href="javascript:void(0);" onclick="showConfirmationModal(\'' . url("admin/sector/delete/" . $data->id) . '\')">
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {

            $sectorImage = $request->file('image');
            if (!empty($sectorImage)) {
                $sectorImageName = time() . '.' . $sectorImage->getClientOriginalExtension();  
                $sectorImage->move('uploads/sector/', $sectorImageName);
                $sectorImagepath = 'uploads/sector/'.$sectorImageName;
            }
      
            // store sector information
            $sector = Sector::create([
                'name' => $request->name,
                'image' => $sectorImagepath ?? '',
            ]);


            if ($sector) {
                return redirect('admin/sector')->with('success', 'Sector created!');
            }

            return redirect('admin/sector')->with('error', 'Failed to create new Sector! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    // update sector
    public function update(Request $request)
    {
        
        //Validate
        $validator = Validator::make($request->all(), [
            'id' => 'required| string ',
            'name' => ' string ',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            
            $sector = Sector::find($request->id);
            if (!empty($request->name)) {
                $sector->name = $request->name;
            }

            $sectorImage = $request->file('image');
            if (!empty($sectorImage)) {
                $sectorImageName = time() . '.' . $sectorImage->getClientOriginalExtension();  
                $sectorImage->move('uploads/sector/', $sectorImageName);
                $sectorImagepath = 'uploads/sector/'.$sectorImageName;
                $sector->image = $sectorImagepath;
            }

            $sector->save();

            if ($sector) {
                return redirect('admin/sector')->with('success', ' Sector updated!');
            }

            return redirect('admin/sector')->with('error', 'Failed to update Sector! Try again.');

        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete(Request $request)
    {
        $sector = Sector::find($request->id);
  
        $sector->delete();
        return redirect('admin/sector')->with('success', ' Sector deleted!');
    }

}
