<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Productmeta;
use App\Models\Productgallery;
use App\Models\Productattribute;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Manufacturer;
use App\Models\Sector;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeImport;

class ProductsImport implements ToModel,WithHeadingRow
{
    private $failedImports = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if (empty($row['name']) || empty($row['code'])) {
            Log::error('Invalid data: ' . json_encode($row));
            // $this->failedImports[] = 'Name :' . $row['name'] . ' Code :' . $row['code'] . ' Name, Code are required';
            return null;
        }

        $category = Category::where('category_title', $row['category'])->first();
        if (!isset($category)) {
            Log::error('Invalid category: ' . json_encode($row));
            return null;
        }

        $subcategory = Subcategory::where('subcategory_title', $row['subcategory'])->first();
        if (!isset($subcategory)) {
            Log::error('Invalid subcategory: ' . json_encode($row));
            return null;
        }

        $manufacturer = Manufacturer::where('name', $row['manufacturer'])->first();
        if (!isset($manufacturer)) {
            Log::error('Invalid manufacturer: ' . json_encode($row));
            return null;
        }

        $sector = Sector::where('name', $row['sector'])->first();
        if (!isset($sector)) {
            Log::error('Invalid sector: ' . json_encode($row));
            return null;
        }

        $product = new Product();
        $product->name = $row['name'];
        $product->category_id =  $category->id;
        $product->subcategory_id = $subcategory->id;
        $product->manufacturer_id = $manufacturer->id;
        $product->sector_id = $sector->id;
        $product->price = $row['price'];
        $product->short_description = $row['short_description'];
        $product->long_description = $row['long_description'];
        $product->indoor_outdoor = strtolower($row['indoor_outdoor']);
        $product->design = $row['design'];
        $product->connection = $row['connection'];
        $product->installation = $row['installation'];


        $slug = str_slug($row['name'], '-');
        $slugCount = Product::where('slug', $slug)->count();
        if ($slugCount > 1) {
            $slug = $slug . '-' . $slugCount;
        }
        $product->slug = $slug;
        $product->save();
        $product_id = $product->id;

        if ($row['image']) {
            $image =$row['image'];
            $image_path = 'uploads/product/'.$product_id.'/'.$image;
            $product->image = $image_path;
        }

        if ($row['gallery']) {
            $gallery=$row['gallery'];
            $imageArray = explode(',', $gallery);
            foreach($imageArray as $image) {
                $image_path = 'uploads/product/'.$product_id.'/'.$image;
                $product_gallery = new Productgallery();
                $product_gallery->product_id = $product_id;
                $product_gallery->image = $image_path;
                $product_gallery->save();
            }
        }

       return $product;

    }
    
    public function getFailedImports()
    {
        return $this->failedImports;
    }

}
