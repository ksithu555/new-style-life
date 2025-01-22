<?php

namespace App\Http\Controllers;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Comparelist;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'mainSearch' => 'string|nullable',
            'sHistory' => 'string|nullable',
            'sRemove' => 'string|nullable',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $mainSearch = $validated['mainSearch'] ?? null;
        $sHistory = $validated['sHistory'] ?? null;
        $sRemove = $validated['sRemove'] ?? null;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $limit = 12; // set the number of products per page

        $searchHistory = Session::get('searchHistory', []);
        if ($mainSearch != null && !in_array($mainSearch, $searchHistory)) {
            array_unshift($searchHistory, $mainSearch);
            $searchHistory = array_slice($searchHistory, 0, 10);
            Session::put('searchHistory', $searchHistory);
        }
        if ($sRemove != null && $sHistory == null) {
            $index = array_search($sRemove, $searchHistory);
            if ($index !== false) {
                unset($searchHistory[$index]);
                Session::put('searchHistory', $searchHistory);
            }
        }
        // Session::forget('searchHistory');

        $query = Product::query();

        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('product_name', 'like', '%' . $mainSearch . '%')
                      ->orWhere('product_tags', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('Category', function ($query) use ($mainSearch) {
                $query->where('category_name', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('SubCategoryTitle', function ($query) use ($mainSearch) {
                $query->where('sub_category_titlename', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('SubCategory', function ($query) use ($mainSearch) {
                $query->where('sub_category_name', 'like', '%' . $mainSearch . '%');
            });
        }
        else {
            if (!empty($sHistory)) {
                $query->where(function ($query) use ($sHistory) {
                    $query->where('product_name', 'like', '%' . $sHistory . '%')
                          ->orWhere('product_tags', 'like', '%' . $sHistory . '%');
                })
                ->orWhereHas('Category', function ($query) use ($sHistory) {
                    $query->where('category_name', 'like', '%' . $sHistory . '%');
                })
                ->orWhereHas('SubCategoryTitle', function ($query) use ($sHistory) {
                    $query->where('sub_category_titlename', 'like', '%' . $sHistory . '%');
                })
                ->orWhereHas('SubCategory', function ($query) use ($sHistory) {
                    $query->where('sub_category_name', 'like', '%' . $sHistory . '%');
                });
            }

            if (!empty($search)) {
                $query->where('product_name', 'like', '%' . $search . '%');
            }

            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }

            if (!empty($price)) {
                $priceRange = explode(';', $price);

                if (count($priceRange) == 2) {
                    $minPrice = (float)$priceRange[0];
                    $maxPrice = (float)$priceRange[1];

                    $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                }
            }

            if (!empty($rating)) {
                $averageRated = Review::select('product_id',
                    DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
                )
                ->groupBy('product_id')
                ->get();
                $matchedProductIds = [];
                foreach ($averageRated as $rated) {
                    if (in_array($rated->average_rating, $rating)) {
                        $matchedProductIds[] = $rated->product_id;
                    }
                }
                $query->whereIn('products.id', $matchedProductIds);
            }

            if (!empty($discount)) {
                if (in_array("1", $discount)) {
                    $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
                }
                if (in_array("2", $discount)) {
                    $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
                }
                if (in_array("3", $discount)) {
                    $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
                }
                if (in_array("4", $discount)) {
                    $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
                }
                if (in_array("5", $discount)) {
                    $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
                }
            }

            // Apply sorting
            switch ($sort) {
                case 1:
                    $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                    break;
                case 2:
                    $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                    break;
                case 3:
                    $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                        ->select('products.*', DB::raw('FLOOR(AVG(reviews.stars_rated)) as review_count'))
                        ->groupBy('products.id')
                        ->orderBy('review_count', 'desc');
                    break;
                case 4:
                    $query->orderBy('product_name', 'ASC');
                    break;
                case 5:
                    $query->orderBy('product_name', 'DESC');
                    break;
                case 6:
                    $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                    break;
                default:
                    // No sorting applied
                    break;
            }
        }

        // Fetch paginated results
        $products = $query->with('Category')->where('products.status', '=', '1')->paginate($limit, ['*'], 'page', $page);
        $ttl = $products->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                            ->where('products.status', '=', '1')
                                            ->groupBy('categories.id')
                                            ->get();

        $ratingWithProductCount = Review::select(
                                                DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                                            )
                                            ->join('products', 'products.id', '=', 'reviews.product_id')
                                            ->where('products.status', '=', '1')
                                            ->groupBy('product_id')
                                            ->get()
                                            ->groupBy('average_rating')
                                            ->map(function ($grouped) {
                                                return $grouped->count();
                                            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                            ->where('status', '=', '1')
                                            ->first();

        $mostDiscountPercentages = Product::select('discount_percent')
                                            ->where('status', '=', '1')
                                            ->distinct()
                                            ->orderBy('discount_percent', 'desc')
                                            ->take(3)
                                            ->pluck('discount_percent');

        return view('front-end.products', compact('products', 'reviews', 'ttl', 'ttlpage', 'page', 'categoryWithProductCount', 'ratingWithProductCount', 'discountWithProductCount'
        , 'search', 'categories', 'price', 'rating', 'discount', 'sort', 'searchHistory', 'sHistory', 'sRemove'));
    }
    public function ShowProductleftThumbnail($id)
    {
        $product = Product::with('user')->with('user.seller')->where('status', 1)->find($id);
        if($product)
        {
            $multiImages = DB::table('multi_imgs')->where('product_id', $id)->get();
            $reviews = Review::where('product_id', $id)->where('status', 1)->get();
            $reviewAll = Review::where('status', 1)->get();
            $productOrdered = OrderDetail::where('product_id', $id)->get();
            $topProducts = OrderDetail::select('product_id', DB::raw('COUNT(*) as frequency'))
                                    ->groupBy('product_id')
                                    ->orderByDesc('frequency')
                                    ->limit(3)
                                    ->get();
            $relatedProducts = Product::where('id', '!=', $id)->where('category_id', $product->category_id)->get();
            $ratingWithProductCount = [];
            $ratingWith = 0;
            $productCount = 0;
            $productStarReview = 0;
            $ratingProject = Product::with('reviews')->where('seller_id', $product->seller_id)->get();
            if ($ratingProject->count() > 0) {
                foreach ($ratingProject as $key => $rating) {
                    if($rating->reviews->isNotEmpty()) {
                        foreach ($rating->reviews as $review) {
                            $ratingWith += $review->stars_rated;
                            $productCount++;
                        }
                        $productStarReview += $ratingWith / $rating->reviews->count();
                        $ratingWith = 0;
                    }
                }
                $ratingWithProductCount[0] = floor($productStarReview / $ratingProject->count());
                $ratingWithProductCount[1] = $productCount;
            }
            return view('front-end.product-left-thumbnail',compact('product','reviews', 'productOrdered', 'topProducts', 'id', 
            'ratingWithProductCount', 'multiImages', 'relatedProducts', 'reviewAll'));
        }
        else{
            return view('front-end.product-left-thumbnail',compact('product'));
        }
        
    }

    public function ShowDiscountProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'ids' => 'array',
            'ids.*' => 'integer|distinct|min:1',
            'topic' => 'string|nullable',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $ids = $validated['ids'] ?? [];
        $topic = $validated['topic'] ?? null;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $limit = 12; // set the number of products per page
        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select('product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
            ->groupBy('product_id')
            ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            $query->whereIn('products.id', $matchedProductIds);
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        // Apply sorting
        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('FLOOR(AVG(reviews.stars_rated)) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        if($ids)
        {
            $products = $query->with('Category')->whereIn('products.id', $ids)->where('products.status', '=', '1')
            ->paginate($limit, ['*'], 'page', $page);

            $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                            ->where('products.status', '=', '1')
                                            ->whereIn('products.id', $ids)
                                            ->groupBy('categories.id')
                                            ->get();

            $ratingWithProductCount = Review::select(
                                                DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                                            )
                                            ->leftjoin('products', 'reviews.product_id', '=', 'products.id')
                                            ->whereIn('products.id', $ids)
                                            ->where('products.status', '=', '1')
                                            ->groupBy('product_id')
                                            ->get()
                                            ->groupBy('average_rating')
                                            ->map(function ($grouped) {
                                                return $grouped->count();
                                            });

            $discountWithProductCount = new Collection([
                                                'group_1_count' => 0,
                                                'group_2_count' => 0,
                                                'group_3_count' => 0,
                                                'group_4_count' => 0,
                                                'group_5_count' => 0,
                                            ]);
            
        }
        else
        {
            if($topic == 'value-of-the-day')
            {
                $products = $query->with('Category')
                                    ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
                                    ->whereDate('order_details.created_at', Carbon::today())
                                    ->where('products.status', '=', '1')
                                    ->select('products.*')
                                    ->distinct('order_details.product_id')
                                    ->paginate($limit, ['*'], 'page', $page);

                $filterForProduct = Product::with('Category')
                                    ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
                                    ->whereDate('order_details.created_at', Carbon::today())
                                    ->where('products.status', '=', '1')
                                    ->select('products.*') // Select only the columns from the 'products' table
                                    ->distinct('order_details.product_id')
                                    ->get();
            }

            if($topic == 'top-50-offers')
            {
                if ($page == 6) $limit = 5;
                $products = $query->with('Category')->where('products.status', '=', '1')->orderBy('discount_percent', 'desc')
                ->paginate($limit, ['*'], 'page', $page);

                $filterForProduct = Product::with('Category')->where('products.status', '=', '1')->orderBy('discount_percent', 'desc')->take(50)->get();
            }

            if($topic == 'new-arrivals')
            {
                $products = $query->with('Category')->whereDate('created_at', Carbon::today())->where('products.status', '=', '1')
                ->paginate($limit, ['*'], 'page', $page);

                $filterForProduct = Product::with('Category')->whereDate('created_at', Carbon::today())->where('products.status', '=', '1')->get();
            }

                $categoryIds = $filterForProduct->pluck('Category.id')->unique()->toArray();
                $productIds = $filterForProduct->pluck('id')->unique()->toArray();

                $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                            ->where('products.status', '=', '1')
                            ->whereIn('categories.id', $categoryIds)
                            ->whereIn('products.id', $productIds)
                            ->groupBy('categories.id')
                            ->get();

                $ratingWithProductCount = Review::select(
                                DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                            )
                            ->leftjoin('products', 'reviews.product_id', '=', 'products.id')
                            ->whereIn('products.category_id', $categoryIds)
                            ->whereIn('products.id', $productIds)
                            ->where('products.status', '=', '1')
                            ->groupBy('product_id')
                            ->get()
                            ->groupBy('average_rating')
                            ->map(function ($grouped) {
                                return $grouped->count();
                            });

                $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                            ->where('status', '=', '1')
                            ->whereIn('products.category_id', $categoryIds)
                            ->whereIn('products.id', $productIds)
                            ->first();
        }
        $ttl = $products->total();
        if ($topic == 'top-50-offers' && $ttl > 50) {
            $ttl = 50;
            $ttlpage = 6; // Assigning specific value when $ttl is limited to 50
        } else {
            $ttlpage = ceil($ttl / $limit);
        }
        
        $reviews = Review::all();

        return view('front-end.discount-products',compact('products', 'reviews', 'ttl', 'ttlpage', 'page', 'categoryWithProductCount', 'ratingWithProductCount', 'discountWithProductCount'
        , 'search', 'categories', 'price', 'rating', 'discount', 'sort', 'ids', 'topic'));
    }

    public function ShowCouponProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];
        $id = request()->id;

        $limit = 12; // set the number of products per page
        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select('product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
            ->groupBy('product_id')
            ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            $query->whereIn('products.id', $matchedProductIds);
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        // Apply sorting
        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('FLOOR(AVG(reviews.stars_rated)) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $products = $query->with('Category')
                    ->leftJoin('sellers', 'products.seller_id', '=', 'sellers.user_id')
                    ->where(function($query) use ($id) {
                        $query->where('sellers.coupon_id', '=', $id)
                            ->orWhere('products.coupon_id', '=', $id);
                    })
                    ->where('products.status', '=', '1')
                    ->where(function($query) {
                        $query->where('sellers.coupon_status', '=', '1')
                            ->orWhere('products.coupon_status', '=', '1');
                    })
                    ->select('products.*')
                    ->paginate($limit, ['*'], 'page', $page);

        $filterForProduct = Product::with('Category')
                    ->leftJoin('sellers', 'products.seller_id', '=', 'sellers.user_id')
                    ->where(function($query) use ($id) {
                        $query->where('sellers.coupon_id', '=', $id)
                            ->orWhere('products.coupon_id', '=', $id);
                    })
                    ->where('products.status', '=', '1')
                    ->where(function($query) {
                        $query->where('sellers.coupon_status', '=', '1')
                            ->orWhere('products.coupon_status', '=', '1');
                    })
                    ->select('products.*')
                    ->get();

        $categoryIds = $filterForProduct->pluck('Category.id')->unique()->toArray();
        $productIds = $filterForProduct->pluck('id')->unique()->toArray();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                    ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                    ->where('products.status', '=', '1')
                    ->whereIn('categories.id', $categoryIds)
                    ->whereIn('products.id', $productIds)
                    ->groupBy('categories.id')
                    ->get();

        $ratingWithProductCount = Review::select(
                        DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
                    )
                    ->leftjoin('products', 'reviews.product_id', '=', 'products.id')
                    ->whereIn('products.category_id', $categoryIds)
                    ->whereIn('products.id', $productIds)
                    ->where('products.status', '=', '1')
                    ->groupBy('product_id')
                    ->get()
                    ->groupBy('average_rating')
                    ->map(function ($grouped) {
                        return $grouped->count();
                    });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
                    ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                    ->where('status', '=', '1')
                    ->whereIn('products.category_id', $categoryIds)
                    ->whereIn('products.id', $productIds)
                    ->first();

        $ttl = $products->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        return view('front-end.coupon-products',compact('products', 'reviews', 'ttl', 'ttlpage', 'page', 'categoryWithProductCount', 'ratingWithProductCount', 'discountWithProductCount'
        , 'search', 'categories', 'price', 'rating', 'discount', 'sort', 'id'));
    }

    public function ShowWishList()
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        if(request()->id != null)
        {
            Wishlist::firstOrCreate([
                'buyer_id' => $buyer->id,
                'product_id' => request()->id,
            ]);
        }
        $wishlist = Wishlist::where('buyer_id', $buyer->id)->get();
        $wishlistProducts = Product::whereIn('id', $wishlist->pluck('product_id'))->get();

        return view('front-end.wishlist',compact('wishlistProducts'));
    }

    public function ShowCompareList()
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        if(request()->id != null)
        {
            Comparelist::firstOrCreate([
                'buyer_id' => $buyer->id,
                'product_id' => request()->id,
            ]);
        }
        $comparelist = Comparelist::where('buyer_id', $buyer->id)->get();
        $ratingWithProductCount = [];
        $comparelistProducts = Product::with('reviews')->whereIn('id', $comparelist->pluck('product_id'))->get();
        if ($comparelistProducts->count() > 0) {
            foreach ($comparelistProducts as $key => $product) {
                $ratingWith = 0;
                $reviewCount = 0;
                if($product->reviews->isNotEmpty()) {
                    foreach ($product->reviews as $review) {
                        $ratingWith += $review->stars_rated;
                        $reviewCount++;
                    }
                    $ratingWithProductCount[$key][0] = floor($ratingWith / $reviewCount);
                    $ratingWithProductCount[$key][1] = $reviewCount;
                }
                else {
                    $ratingWithProductCount[$key][0] = 0;
                    $ratingWithProductCount[$key][1] = 0;
                }
            }
        }
        return view('front-end.compare',compact('comparelistProducts', 'ratingWithProductCount'));
    }

    public function DeleteWishList($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $wishlistItem = Wishlist::where('buyer_id', $buyer->id)->where('product_id', $id)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['message' => 'Wishlist item deleted successfully']);
        } else {
            return response()->json(['message' => 'Wishlist item not found'], 404);
        }
    }

    public function DeleteCompareList($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $comparelistItem = Comparelist::where('buyer_id', $buyer->id)->where('product_id', $id)->first();
        if ($comparelistItem) {
            $comparelistItem->delete();
            return response()->json(['message' => 'Compare item deleted successfully']);
        } else {
            return response()->json(['message' => 'Compare item not found'], 404);
        }
    }

    //Show footer search
    public function footerSearch()
    {
        $validated = request()->validate([
            'footerSearch' => 'string|nullable',
        ]);
        $footerSearch = $validated['footerSearch'] ?? null;

        // $limit = 10; // set the number of products per page
        $query = Product::query();

        if ($footerSearch != null) {
            $query->where(function ($query) use ($footerSearch) {
                $query->where('product_name', 'like', '%' . $footerSearch . '%')
                    ->orWhere('product_tags', 'like', '%' . $footerSearch . '%');
            })
            ->orWhereHas('Category', function ($query) use ($footerSearch) {
                $query->where('category_name', 'like', '%' . $footerSearch . '%');
            })
            ->orWhereHas('SubCategoryTitle', function ($query) use ($footerSearch) {
                $query->where('sub_category_titlename', 'like', '%' . $footerSearch . '%');
            })
            ->orWhereHas('SubCategory', function ($query) use ($footerSearch) {
                $query->where('sub_category_name', 'like', '%' . $footerSearch . '%');
            });
        }

        $products = $query->with('Category')
            ->where('products.status', '=', '1')->get();
        $reviews = Review::all();
        return view('front-end.search',compact('products', 'reviews'));
       
    }
}