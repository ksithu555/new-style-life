<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function storeBrand(Request $request)
    {
        $brands = new Brand();

        if ($request->hasFile('brand_icon')) {
            $imageName = time().'.'.$request->brand_icon->extension();
            $request->brand_icon->move(public_path('images'), $imageName);
            $brands->brand_icon = $imageName;
        }
        $brands->brand_name = $request->input('brand_name');
        $brands->save();
        return back();
    }
}