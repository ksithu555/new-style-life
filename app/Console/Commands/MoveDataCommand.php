<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MoveDataCommand extends Command
{
    protected $signature = 'data:move';
    protected $description = 'Move data from NewStyleLife to MadeInJapan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            Log::info('MoveDataCommand started.');

            // Calculate yesterday's date
            $yesterday = \Carbon\Carbon::yesterday();

            // Retrieve data from NewStyleLife
            $users = DB::connection('mysql')->table('users')->where('role', 'seller')->whereDate('created_at', $yesterday)->get();
            $userMapping = [];

            foreach ($users as $user) {
                $existingUser = DB::connection('made_in_japan')->table('users')->where('email', $user->email)->first();

                if (!$existingUser) {
                    $created_by = NULL;
                    if ($user->created_by) {
                        $createdByNewStyle = DB::connection('mysql')->table('users')->where('id', $user->created_by)->first();
                        $createdByMadeIn = DB::connection('made_in_japan')->table('users')->where('email', $createdByNewStyle->email)->first();
                        $created_by = $createdByMadeIn->id;
                    }
                    $newUserId = DB::connection('made_in_japan')->table('users')->insertGetId([
                        'role' => $user->role,
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $user->password,
                        'user_photo' => $user->user_photo,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'status' => $user->status,
                        'email_verified_at' => $user->email_verified_at,
                        'noalert' => $user->noalert,
                        'created_by' => $created_by,
                        'remember_token' => $user->remember_token,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at
                    ]);

                    $userMapping[$user->id] = $newUserId;
                    // Move user photo
                    if ($user->user_photo) {
                        $sourcePath = public_path('upload/profile/' . $user->user_photo);
                        $destinationPath = ('/var/apps/madein-japan.com/public/upload/profile/' . $user->user_photo);

                        if (file_exists($sourcePath)) {
                            if (!file_exists(dirname($destinationPath))) {
                                mkdir(dirname($destinationPath), 0777, true);
                            }
                            Log::info('Source: ' . $sourcePath);
                            Log::info('Destination: ' . $destinationPath);
                            copy($sourcePath, $destinationPath);
                            Log::info('Photo moved for user: ' . $user->email);
                        } else {
                            Log::warning('Photo not found for user: ' . $user->email);
                        }
                    }
                } else {
                    $userMapping[$user->id] = $existingUser->id;
                }
            }
            Log::info('User Moved.');

            $sellers = DB::connection('mysql')->table('sellers')->whereIn('user_id', array_keys($userMapping))->get();
            $sellerMapping = [];

            foreach ($sellers as $seller) {
                $existingSeller = DB::connection('made_in_japan')->table('sellers')->where('user_id', $userMapping[$seller->user_id])->where('shop_name', $seller->shop_name)->first();

                if (!$existingSeller) {
                    $newSellerId = DB::connection('made_in_japan')->table('sellers')->insertGetId([
                        'user_id' => $userMapping[$seller->user_id],
                        'country_id' => $seller->country_id,
                        'bank_name' => $seller->bank_name,
                        'bank_acc_type' => $seller->bank_acc_type,
                        'bank_branch' => $seller->bank_branch,
                        'bank_acc_name' => $seller->bank_acc_name,
                        'bank_acc_no' => $seller->bank_acc_no,
                        'shop_name' => $seller->shop_name,
                        'shop_logo' => $seller->shop_logo,
                        'shop_establish' => $seller->shop_establish,
                        'phone' => $seller->phone,
                        'zip_code' => $seller->zip_code,
                        'prefecture' => $seller->prefecture,
                        'city' => $seller->city,
                        'chome' => $seller->chome,
                        'building' => $seller->building,
                        'room' => $seller->room,
                        'url' => $seller->url,
                        'commission' => $seller->commission,
                        'status' => $seller->status,
                        'coupon_status' => 0,
                        'coupon_id' => NULL,
                        'created_at' => $seller->created_at,
                        'updated_at' => $seller->updated_at
                    ]);

                    $sellerMapping[$seller->id] = $newSellerId;
                    // Move shop logo
                    $sourcePath = public_path('images/' . $seller->shop_logo);
                    $destinationPath = ('/var/apps/madein-japan.com/public/images/' . $seller->shop_logo);

                    if (file_exists($sourcePath)) {
                        if (!file_exists(dirname($destinationPath))) {
                            mkdir(dirname($destinationPath), 0777, true);
                        }
                        copy($sourcePath, $destinationPath);
                        Log::info('Photo moved for seller: ' . $seller->shop_logo);
                    } else {
                        Log::warning('Photo not found for seller: ' . $seller->shop_logo);
                    }
                } else {
                    $sellerMapping[$seller->id] = $existingSeller->id;
                }
            }
            Log::info('Seller Moved.');

            $subsellers = DB::connection('mysql')->table('subsellers')->whereIn('user_id', array_keys($userMapping))->get();

            foreach ($subsellers as $subseller) {
                $existingSubseller = DB::connection('made_in_japan')->table('subsellers')->where('email', $subseller->email)->first();

                if (!$existingSubseller) {
                    $sellerIdNewStyle = DB::connection('mysql')->table('users')->where('id', $subseller->seller_id)->first();
                    $sellerIdMadeIn = DB::connection('made_in_japan')->table('users')->where('email', $sellerIdNewStyle->email)->first();
                    DB::connection('made_in_japan')->table('subsellers')->insert([
                        'user_id' => $userMapping[$subseller->user_id],
                        'seller_id' => $sellerIdMadeIn->id,
                        'name' => $subseller->name,
                        'email' => $subseller->email,
                        'password' => $subseller->password,
                        'photo' => $subseller->photo,
                        'phone' => $subseller->phone,
                        'created_at' => $subseller->created_at,
                        'updated_at' => $subseller->updated_at
                    ]);
                }
            }
            Log::info('Sub Seller Moved.');

            // Move products data here
            $products = DB::connection('mysql')->table('products')->where('country_id', 111)->whereDate('created_at', $yesterday)->get();
            $brandMapping = [];
            $categoryMapping = [];
            $subCategoryTitleMapping = [];
            $subCategoryMapping = [];

            foreach ($products as $product) {
                $existingProduct = DB::connection('made_in_japan')
                    ->table('products')
                    ->where('product_code', $product->product_code . 'S')
                    ->first();

                if (!$existingProduct) {
                    // Handle brands
                    $brand = DB::connection('mysql')->table('brands')->where('id', $product->brand_id)->first();
                    if ($brand) {
                        $existingBrand = DB::connection('made_in_japan')->table('brands')->where('brand_name', $brand->brand_name)->first();
                        if (!$existingBrand) {
                            $newBrandId = DB::connection('made_in_japan')->table('brands')->insertGetId([
                                'brand_name' => $brand->brand_name,
                                'brand_icon' => $brand->brand_icon,
                                'created_at' => $brand->created_at,
                                'updated_at' => $brand->updated_at
                            ]);
                            $brandMapping[$brand->id] = $newBrandId;
                            // Move brand icon
                            $sourcePath = public_path('images/' . $brand->brand_icon);
                            $destinationPath = ('/var/apps/madein-japan.com/public/images/' . $brand->brand_icon);

                            if (file_exists($sourcePath)) {
                                if (!file_exists(dirname($destinationPath))) {
                                    mkdir(dirname($destinationPath), 0777, true);
                                }
                                copy($sourcePath, $destinationPath);
                                Log::info('Photo moved for brand: ' . $brand->brand_icon);
                            } else {
                                Log::warning('Photo not found for brand: ' . $brand->brand_icon);
                            }
                        } else {
                            $brandMapping[$brand->id] = $existingBrand->id;
                        }
                    }

                    // Handle categories
                    $category = DB::connection('mysql')->table('categories')->where('id', $product->category_id)->first();
                    if ($category) {
                        $existingCategory = DB::connection('made_in_japan')->table('categories')->where('category_name', $category->category_name)->first();
                        if (!$existingCategory) {
                            $newCategoryId = DB::connection('made_in_japan')->table('categories')->insertGetId([
                                'category_name' => $category->category_name,
                                'category_icon' => $category->category_icon,
                                'created_at' => $category->created_at,
                                'updated_at' => $category->updated_at
                            ]);
                            $categoryMapping[$category->id] = $newCategoryId;
                            // Move category icon
                            $sourcePath = public_path('images/' . $category->category_icon);
                            $destinationPath = ('/var/apps/madein-japan.com/public/images/' . $category->category_icon);

                            if (file_exists($sourcePath)) {
                                if (!file_exists(dirname($destinationPath))) {
                                    mkdir(dirname($destinationPath), 0777, true);
                                }
                                copy($sourcePath, $destinationPath);
                                Log::info('Photo moved for category: ' . $category->category_icon);
                            } else {
                                Log::warning('Photo not found for category: ' . $category->category_icon);
                            }
                        } else {
                            $categoryMapping[$category->id] = $existingCategory->id;
                        }
                    }

                    // Handle sub_category_titles
                    $subCategoryTitle = DB::connection('mysql')->table('sub_category_titles')->where('id', $product->sub_category_title_id)->first();
                    if ($subCategoryTitle) {
                        $existingSubCategoryTitle = DB::connection('made_in_japan')->table('sub_category_titles')->where('sub_category_titlename', $subCategoryTitle->sub_category_titlename)->first();
                        if (!$existingSubCategoryTitle) {
                            $newSubCategoryTitleId = DB::connection('made_in_japan')->table('sub_category_titles')->insertGetId([
                                'category_id' => $categoryMapping[$subCategoryTitle->category_id] ?? null,
                                'sub_category_id' => $subCategoryMapping[$subCategoryTitle->sub_category_id] ?? null,
                                'sub_category_titlename' => $subCategoryTitle->sub_category_titlename,
                                'created_at' => $subCategoryTitle->created_at,
                                'updated_at' => $subCategoryTitle->updated_at
                            ]);
                            $subCategoryTitleMapping[$subCategoryTitle->id] = $newSubCategoryTitleId;
                        } else {
                            $subCategoryTitleMapping[$subCategoryTitle->id] = $existingSubCategoryTitle->id;
                        }
                    }

                    // Handle sub_categories
                    $subCategory = DB::connection('mysql')->table('sub_categories')->where('id', $product->sub_category_id)->first();
                    if ($subCategory) {
                        $existingSubCategory = DB::connection('made_in_japan')->table('sub_categories')->where('sub_category_name', $subCategory->sub_category_name)->first();
                        if (!$existingSubCategory) {
                            $newSubCategoryId = DB::connection('made_in_japan')->table('sub_categories')->insertGetId([
                                'category_id' => $categoryMapping[$subCategory->category_id] ?? null,
                                'sub_category_name' => $subCategory->sub_category_name,
                                'sub_category_title_id' => $subCategoryTitleMapping[$subCategory->sub_category_title_id] ?? null,
                                'created_at' => $subCategory->created_at,
                                'updated_at' => $subCategory->updated_at
                            ]);
                            $subCategoryMapping[$subCategory->id] = $newSubCategoryId;
                        } else {
                            $subCategoryMapping[$subCategory->id] = $existingSubCategory->id;
                        }
                    }

                    $sellerNewStyle = DB::connection('mysql')->table('users')->where('id', $product->seller_id)->first();
                    $sellerMadeIn = DB::connection('made_in_japan')->table('users')->where('email', $sellerNewStyle->email)->first();
                    // Insert product data into MadeInJapan with the new IDs
                    $newProductId = DB::connection('made_in_japan')->table('products')->insertGetId([
                        'product_code' => $product->product_code . 'S',
                        'brand_id' => $brandMapping[$product->brand_id],
                        'country_id' => $product->country_id,
                        'category_id' => $categoryMapping[$product->category_id],
                        'sub_category_title_id' => $subCategoryTitleMapping[$product->sub_category_title_id],
                        'sub_category_id' => $subCategoryMapping[$product->sub_category_id],
                        'special_sub_category_id' => NULL,
                        'seller_id' => $sellerMadeIn->id,
                        'subseller_id' => NULL,
                        'product_name' => $product->product_name,
                        'product_qty' => $product->product_qty,
                        'in_stock' => $product->in_stock,
                        'product_tags' => $product->product_tags,
                        'product_size' => $product->product_size,
                        'product_color' => $product->product_color,
                        'original_price' => $product->original_price,
                        'selling_price' => $product->selling_price,
                        'seller_amount' => $product->seller_amount,
                        'discount_percent' => $product->discount_percent,
                        'short_desc' => $product->short_desc,
                        'long_desc' => $product->long_desc,
                        'care_instructions' => $product->care_instructions,
                        'product_thambnail' => $product->product_thambnail,
                        'commission' => $product->commission,
                        'commission_status' => $product->commission_status,
                        'com_price' => $product->com_price,
                        'status' => $product->status,
                        'coupon_status' => 0,
                        'coupon_id' => NULL,
                        'estimate_date' => $product->estimate_date,
                        'delivery_price' => $product->delivery_price,
                        'shipping_country' => $product->shipping_country,
                        'updated_by' => NULL,
                        'created_at' => $product->created_at,
                        'updated_at' => $product->updated_at
                    ]);

                    $productMapping[$product->id] = $newProductId;
                    // Move product image
                    $sourcePath = public_path('images/' . $product->product_thambnail);
                    $destinationPath = ('/var/apps/madein-japan.com/public/images/' . $product->product_thambnail);

                    if (file_exists($sourcePath)) {
                        if (!file_exists(dirname($destinationPath))) {
                            mkdir(dirname($destinationPath), 0777, true);
                        }
                        copy($sourcePath, $destinationPath);
                        Log::info('Photo moved for product: ' . $product->product_thambnail);
                    } else {
                        Log::warning('Photo not found for product: ' . $product->product_thambnail);
                    }

                    // Move multi_imgs data
                    $multiImgs = DB::connection('mysql')->table('multi_imgs')->where('product_id', $product->id)->get();

                    foreach ($multiImgs as $img) {
                        DB::connection('made_in_japan')->table('multi_imgs')->insert([
                            'product_id' => $newProductId,
                            'photo_name' => $img->photo_name,
                            'created_at' => $img->created_at,
                            'updated_at' => $img->updated_at
                        ]);

                        // Move product image
                        $sourcePath = public_path('upload/multiImg/' . $img->photo_name);
                        $destinationPath = ('/var/apps/madein-japan.com/public/upload/multiImg/' . $img->photo_name);

                        if (file_exists($sourcePath)) {
                            if (!file_exists(dirname($destinationPath))) {
                                mkdir(dirname($destinationPath), 0777, true);
                            }
                            copy($sourcePath, $destinationPath);
                            Log::info('Photo moved for multi images: ' . $img->photo_name);
                        } else {
                            Log::warning('Photo not found for multi images: ' . $img->photo_name);
                        }
                    }
                }
            }
            Log::info('Product Moved.');

            Log::info('MoveDataCommand completed successfully.');
        } catch (\Exception $e) {
            Log::error('Error in MoveDataCommand: ' . $e->getMessage());
        }
    }
}
