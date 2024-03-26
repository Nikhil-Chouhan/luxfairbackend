<?php

namespace App\Http\Controllers;

use App\Models\Comparision;
use App\Models\Manufacturer;
use App\Models\Sector;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productattribute;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class FrontendController extends Controller
{
    
    public function index()
    {
        $all_sector= Sector::orderBy('id', 'asc')->get();
        $all_categories= Category::orderBy('id', 'asc')->get();
        $product_of_week= Product::where('is_featured', 1)->get();

        return view('frontend.index',compact('all_sector','all_categories','product_of_week'));
    }
    
    public function register()
    {
        if (auth()->check()) {
            return redirect()->route('frontend.home');
        }
        return view('frontend.register');
    }

    // registerSubmit
    public function registerSubmit(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('frontend.home');
        }
        // validate 
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create user
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->save();
        $user->syncRoles(7);

        // login user
        auth()->login($user);

        return redirect()->route('frontend.home');
    }
    


    
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('frontend.home');
        }
        return view('frontend.login');
    }
    
    // loginSubmit
    public function loginSubmit(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('frontend.home');
        }
        // validate 
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // check if user exists
        $credentials = $request->only('email', 'password');

        auth()->attempt($credentials);

        if (auth()->attempt($credentials)) {
            return redirect()->route('frontend.home');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }


    public function products(Request $request)
    {
        $all_products = Product::orderBy('id', 'desc'); 


        if ($request->has('manufacturer')) {
            $manufacturer =  explode(',', $request->manufacturer); 
            // check if all values are integrer 
            if (array_filter($manufacturer, 'is_numeric')) {
                $all_products = $all_products->whereIn('manufacturer_id', $manufacturer);
            } 
        }

        if ($request->has('sector')) {
            $sectorIds = explode(',', $request->sector);
        
            // Check if all values are integers
            if (count($sectorIds) > 0 && count(array_filter($sectorIds, 'is_numeric')) === count($sectorIds)) {
                foreach ($sectorIds as $sectorId) {
                    $all_products = $all_products->orWhere('sector_id', 'LIKE', '%,' . $sectorId . ',%');
                }
            } 
        }

        if ($request->has('category')) {
            $categoryIds = explode(',', $request->category);
        
            // Check if all values are integers
            if (count($categoryIds) > 0 && count(array_filter($categoryIds, 'is_numeric')) === count($categoryIds)) {
                foreach ($categoryIds as $categoryId) {
                    $all_products = $all_products->orWhere('category_id', 'LIKE', '%,' . $categoryId . ',%');
                }
            } 
        }

        // indoor_outdoor_filter
        if ($request->has('indoor_outdoor_filter')) {
            $indoor_outdoor =  $request->indoor_outdoor_filter;
            $check_indoor_outdoor = array('indoor', 'outdoor');
            if (in_array($indoor_outdoor, $check_indoor_outdoor)) { 
                $all_products =  $all_products->where('indoor_outdoor', $indoor_outdoor);
            } 
        }
        // other_filter
        if ($request->has('other_filter')) {
            $other_filter =  $request->other_filter;
            $check_other_filter = array('popularity', 'manu_a_z', 'manu_z_a');
            if (in_array($other_filter, $check_other_filter)) { 
                if ($other_filter == 'popularity') {
                    $all_products =  $all_products->orderBy('view_count', 'desc');
                }
                elseif ($other_filter == 'manu_a_z') {
                    // manufacturer names a to z 
                    $all_products =  $all_products->manufacturer->orderBy('name', 'asc');
                }
                elseif ($other_filter == 'manu_z_a') {
                    $all_products =  $all_products->manufacturer->orderBy('name', 'desc');
                }
            } 
        }
        
        

        // showproducts
        if ($request->has('showproducts')) {
            $showproducts =  $request->showproducts;
            
            $check_array= array('30', '60', 'all');

            if (in_array($showproducts, $check_array)) {
                if($showproducts == '30')
                {
                    $all_products = $all_products->paginate(30);
                }
                elseif($showproducts == '60')
                {
                    $all_products = $all_products->paginate(60);
                }else{
                    $all_products = $all_products->get();
                }
                
            }
        }else{
            $all_products = $all_products->get();
        }

        
        $indoor_products_count= Product::where('indoor_outdoor', 'indoor')->count();
        $outdoor_products_count= Product::where('indoor_outdoor', 'outdoor')->count();
        $all_manufacturers= Manufacturer::orderBy('id', 'desc')->get();
        return view('frontend.products', compact('all_products', 'indoor_products_count', 'outdoor_products_count', 'all_manufacturers'));
    }
    
    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if($product) {
            $product->view_count = $product->view_count + 1;
            $product->save();
            $product_attribues = Productattribute::get()->toArray();
            $product_arr = array();
    
            foreach($product_attribues as $key => $item)
            {
                if(array_key_exists('group', $item))
                    $product_arr[$item['group']][$key] = $item;
            }
    
            ksort($product_arr, SORT_NUMERIC);
    
            $similar_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
     
            return view('frontend.product_details', compact('product', 'product_arr', 'similar_products'));
        }
        else {
            return redirect()->back()->with('error', 'Product doesnt Exist!');

        }
    }


    public function supersearchresult(Request $request)
    {  
    $query = $request->input('query');
    $all_products = Product::where('name', 'LIKE', "%$query%")->get();
    return view('frontend.searchresults', compact('all_products'));
    }

    public function supersearch(Request $request)
    {  

        $all_products = Product::orderBy('id', 'desc'); 
        $hasresult = false;

        if ($request->has('searchresult')) {
            $hasresult = true;
        }

        if ($request->has('manufacturer')) {
            $manufacturer =  explode(',', $request->manufacturer); 
            // check if all values are integrer 
            if (array_filter($manufacturer, 'is_numeric')) {
                $all_products = $all_products->whereIn('manufacturer_id', $manufacturer);
            } 
        }

        if ($request->has('sector')) {
            $sectorIds = explode(',', $request->sector);
        
            // Check if all values are integers
            if (count($sectorIds) > 0 && count(array_filter($sectorIds, 'is_numeric')) === count($sectorIds)) {
                foreach ($sectorIds as $sectorId) {
                    $all_products = $all_products->orWhere('sector_id', 'LIKE', '%,' . $sectorId . ',%');
                }
            } 
        }

        if ($request->has('category')) {
            $categoryIds = explode(',', $request->category);
        
            // Check if all values are integers
            if (count($categoryIds) > 0 && count(array_filter($categoryIds, 'is_numeric')) === count($categoryIds)) {
                foreach ($categoryIds as $categoryId) {
                    $all_products = $all_products->orWhere('category_id', 'LIKE', '%,' . $categoryId . ',%');
                }
            } 
        }

        // indoor_outdoor_filter
        if ($request->has('indoor_outdoor_filter')) {
            $indoor_outdoor =  $request->indoor_outdoor_filter;
            $check_indoor_outdoor = array('indoor', 'outdoor');
            if (in_array($indoor_outdoor, $check_indoor_outdoor)) { 
                $all_products =  $all_products->where('indoor_outdoor', $indoor_outdoor);
            } 
        }
        // other_filter
        if ($request->has('other_filter')) {
            $other_filter =  $request->other_filter;
            $check_other_filter = array('popularity', 'manu_a_z', 'manu_z_a');
            if (in_array($other_filter, $check_other_filter)) { 
                if ($other_filter == 'popularity') {
                    $all_products =  $all_products->orderBy('view_count', 'desc');
                }
                elseif ($other_filter == 'manu_a_z') {
                    // manufacturer names a to z 
                    $all_products =  $all_products->manufacturer->orderBy('name', 'asc');
                }
                elseif ($other_filter == 'manu_z_a') {
                    $all_products =  $all_products->manufacturer->orderBy('name', 'desc');
                }
            } 
        }
        
        

        // showproducts
        if ($request->has('showproducts')) {
            $showproducts =  $request->showproducts;
            
            $check_array= array('30', '60', 'all');

            if (in_array($showproducts, $check_array)) {
                if($showproducts == '30')
                {
                    $all_products = $all_products->paginate(30);
                }
                elseif($showproducts == '60')
                {
                    $all_products = $all_products->paginate(60);
                }else{
                    $all_products = $all_products->get();
                }
                
            }
        }else{
            $all_products = $all_products->get();
        }

        $indoor_products_count= Product::where('indoor_outdoor', 'indoor')->count();
        $outdoor_products_count= Product::where('indoor_outdoor', 'outdoor')->count();
        $all_manufacturers= Manufacturer::orderBy('id', 'desc')->get();
        return view('frontend.supersearch', compact('hasresult', 'all_products', 'indoor_products_count', 'outdoor_products_count', 'all_manufacturers'));

    }

    public function aftersupersearch(Request $request)
    {  
    return view('frontend.aftersupersearch');
    }

    public function sectors()
    {
        $all_sector= Sector::orderBy('id', 'asc')->get();
        return view('frontend.sectors', compact('all_sector'));
    }

    public function manufacturers()
    {
        $all_manufacturers= Manufacturer::orderBy('name', 'desc')->get();
        return view('frontend.manufacturers', compact('all_manufacturers'));
    }
    public function comparisions()
    { 
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $session_id = null;
        } else {
            $user_id = null;
            $session_id = session()->getId();
        }

        if ($user_id) {
            $all_comparisions = Comparision::where('user_id', $user_id)->get();
        } else {
            $all_comparisions = Comparision::where('session_id', $session_id)->get();
        }
        return view('frontend.comparisions ', compact('all_comparisions'));
    }

    // addToCompare
    public function addToCompare(Request $request)
    {

        // validate 
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Product not found']);
        }
        $product_id = $request->product_id;

        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $session_id = null;
        } else {
            $user_id = null;
            $session_id = session()->getId();
        }

        if ($user_id) {
            $check_comparision = Comparision::where('product_id', $product_id)->where('user_id', $user_id)->first();
        } else {
            $check_comparision = Comparision::where('product_id', $product_id)->where('session_id', $session_id)->first();
            $count_comparision = Comparision::where('session_id', $session_id)->count();
        }
        

        if($check_comparision)
        {
            return response()->json(['status' => 'error', 'message' => 'Product already added to compare']);
        }else{
            if (!$user_id && $count_comparision > 1) { 
                return response()->json(['status' => 'error', 'message' => 'You can add only 4 products to compare']);
            }else{ 
                $comparision = new Comparision();
                $comparision->product_id = $product_id;
                $comparision->user_id = $user_id;
                $comparision->session_id = $session_id;
                $comparision->save();
                return response()->json(['status' => 'success', 'message' => 'Product added to compare']);
            }
        }
    }

    // clearallComparisions
    public function clearallComparisions()
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $session_id = null;
        } else {
            $user_id = null;
            $session_id = session()->getId();
        }

        if ($user_id) {
            $all_comparisions = Comparision::where('user_id', $user_id)->get();
        } else {
            $all_comparisions = Comparision::where('session_id', $session_id)->get();
        }

        foreach ($all_comparisions as $comparision) {
            $comparision->delete();
        }
        return redirect()->back()->with('success', 'All comparisions cleared');
    }


    // clearComparisions
    public function clearComparisions($id)
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $session_id = null;
        } else {
            $user_id = null;
            $session_id = session()->getId();
        }

        if ($user_id) {
            $comparision = Comparision::where('user_id', $user_id)->where('id', $id)->first();
        } else {
            $comparision = Comparision::where('session_id', $session_id)->where('id', $id)->first();
        }

        if ($comparision) {
            $comparision->delete();
            return redirect()->back()->with('success', 'Comparision cleared');
        } else {
            return redirect()->back()->with('error', 'Comparision not found');
        }
    }
}
