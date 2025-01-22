<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\User;


class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
            'product_id' => 'required|integer',
        ]);
        $product = Product::find($request->product_id);
        $id = $request->product_id;
    
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->seller_id = $product->seller_id;
        $review->stars_rated = $request->rating;
        $review->comment = $request->comment;
        $review->status = 1;
        $saved = $review->save();
    
        if ($saved) {
            return redirect()->route('show-product-left-thumbnail',compact ('id') )->with('success', 'Review submitted successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to submit review.');
        }
    }
}