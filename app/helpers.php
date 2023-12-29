<?php
use App\Models\Comparision;
use App\Models\Productmeta;

// getProductMetaValue 
if (!function_exists('getProductMetaValue')) {
    function getProductMetaValue($product_id, $product_attribute_id)
    {
        $product_meta = Productmeta::where('product_id', $product_id)->where('product_attribute_id', $product_attribute_id)->first();
        if ($product_meta) {
            return $product_meta->value;
        } else {
            return '-';
        }
    }
}

// checkIfInCompare 
if (!function_exists('checkIfInCompare')) {
    function checkIfInCompare($product_id)
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $session_id = null;
        } else {
            $user_id = null;
            $session_id = session()->getId();
        }

        if ($user_id) {
            $comparision = Comparision::where('user_id', $user_id)->where('product_id', $product_id)->first();
        } else {
            $comparision = Comparision::where('session_id', $session_id)->where('product_id', $product_id)->first();
        }

        
        if ($comparision) {
            return true;
        } else {
            return false;
        }
    }
}

// getProductMetaValueFromName 
if (!function_exists('getProductMetaValueFromName')) {
    function getProductMetaValueFromName($product_id, $product_attribute_name)
    {
        $product_meta = Productmeta::where('product_id', $product_id)->whereHas('product_attribute', function ($query) use ($product_attribute_name) {
            $query->where('name', $product_attribute_name);
        })->first();
        if ($product_meta) {
            return $product_meta->value;
        } else {
            return '-';
        }
    }
}