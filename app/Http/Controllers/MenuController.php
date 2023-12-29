<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;


class MenuController extends Controller
{
   
    public function header_index(){
        $menus = Menu::where('parent_id', '=', 0)->where('type', 'header')->get();
        $allMenus = Menu::where('type', 'header')->pluck('title','id')->all(); 
        return view('menu.header_index',compact('menus','allMenus'));
    }
    public function footer_index(){
        $menus = Menu::where('parent_id', '=', 0)->where('type', 'footer')->get();
        $allMenus = Menu::where('type', 'footer')->pluck('title','id')->all(); 
        return view('menu.footer_index',compact('menus','allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Menu::create($input);
        return back()->with('success', 'Menu added successfully.');
    }

    public function show()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));
    }

    public function destroy($id)
    { 
        // delete menu
        Menu::find($id)->delete(); 
        return response()->json(['success' => true ]);
    } 
}
