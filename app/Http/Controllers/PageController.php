<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Auth;
use DataTables;

class PageController extends Controller
{
    
    public function index()
    {
        $pages = Page::all();
        return view('custompage.index', compact('pages'));


    }

    public function getPageList(Request $request): mixed
    {
        $data = Page::orderBy('id', 'desc');
        $searchKeyword = filter_var($request->get('search')['value'], FILTER_SANITIZE_STRING);
        if (!empty($searchKeyword) && $searchKeyword != null) {
            $data->where('title', 'LIKE', '%' . $searchKeyword . '%')
                ;
        }
        $data = $data->get();
        $hasManageProductAttributes = Auth::user()->can('manage_custompages');
        return Datatables::of($data)
            
            ->addColumn('action', function ($data)  use ($hasManageProductAttributes)  {
                $output = '';

                if ($hasManageProductAttributes) {
                    $output = '<div class="table-actions">
                    <a href="/custompages/edit/'. $data->id.'"><i class="ik ik-edit-2"></i></a>
                                            <a href="javascript:void(0);" onclick="showConfirmationModal(\'' . url("admin/custompages/delete/" . $data->id) . '\')">
                                            <i class="ik ik-trash-2 f-16 text-red"></i>
                                        </a>
                                            </div>';
                                            
                }
                return $output;
            })
            ->rawColumns([ 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('custompage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
            // 'keywords' => 'required',
            // 'description' => 'required',
            'body' => 'required',
            // 'image' => 'required'
        ]); 
        $page = new Page;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->is_active = $request->is_active;
        // sperate keywords by comma
        $keywords = explode(',', $request->keywords);
        $keywords = serialize($keywords);
        $page->keywords = $keywords;
        $page->description = $request->description;
        $page->body = $request->body;
        // save img 
        $image = $request->file('image');
        $new_name = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/custompages'), $new_name);
        $page->image = $new_name;

        
        $page->save();

        return redirect()->route('custompage.index')->with('success', 'Page created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('custompage.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
            // 'keywords' => 'required',
            // 'description' => 'required',
            'body' => 'required',
            // 'image' => 'required'
        ]);
        $id = $request->id;
        $page = Page::find($id);
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->is_active = $request->is_active;
        // sperate keywords by comma
        $keywords = explode(',', $request->keywords);
        $keywords = serialize($keywords);
        $page->keywords = $keywords;
        $page->description = $request->description;
        $page->body = $request->body; 
        if ($request->hasFile('image')) {
             // save img 
            $image = $request->file('image');
            $new_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/custompages'), $new_name);
            $page->image = $new_name;
        }
        $page->save();

        return redirect()->route('custompage.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('custompage.index')->with('success', 'Page deleted successfully.');
    }

    public function generateSlug(Request $request)
    {
        $title = $request->get('title');
        $slug = str_slug($title, '-'); 


        $slugCount = Page::where('slug', $slug)->count();
        if ($slugCount > 1) {
            $slug = $slug . '-' . $slugCount; 
        }

        return response()->json(['slug' => $slug]);
    }
}
