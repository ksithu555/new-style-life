<?php

use App\Models\PDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Product;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/verifyemail', function () {return view('auth.verify-email');})->name('auth.verify-email');
//route::get('/verifyemail',[UserController::class,'verify-email'])->name('auth.verify-email');


Route::get('/', [Admincontroller::class,'welcome']);


Route::get('/user-registration', [UserController::class,'index'])->name('user_register');

Route::post('/products/reviews', [ReviewController::class, 'store'])->name('reviews');
route::post('/user-registration/add-user',[UserController::class,'store'])->name('adduser');

Route::get('/user', [UserController::class, 'indexuser'])->name('user_dashboard');
Route::get('/user-orders', [UserController::class, 'showOrders'])->name('user_order');
Route::get('/user-order-details', [UserController::class, 'showOrderDetails'])->name('user_order_details');
Route::get('/user-order-tracking', function () {return view('front-end.user-order-tracking');})->name('front-end.user-order-tracking');

Route::get('/user/delivery', [UserController::class, 'showDelistatus'])->name('user_deivery_status');

Route::get('/user/addresses', [UserController::class, 'showAddresses'])->name('user_addresses');
Route::post('/user/addresses', [UserController::class, 'createNewaddress'])->name('add_newaddress');
Route::post('/user/addresses/edit-address', [UserController::class, 'editAddress'])->name('edit_address');
Route::delete('/user/remove-address/{id}', [UserController::class, 'removeAddress'])->name('remove_address');

Route::get('/user/paymentmethod', [UserController::class, 'showCard'])->name('user_cards');
Route::post('/user/paymentmethod', [UserController::class, 'createNewcard'])->name('add_newcard');
Route::post('/user-payment/edit-card', [UserController::class, 'editCard'])->name('edit_card');
Route::delete('/remove-cards/{id}', [UserController::class, 'removeCard'])->name('remove_card');

Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user_profile');
Route::post('/user/profile/edit-profile', [UserController::class, 'editProfile'])->name('edit_profile');
Route::post('user/profile/edit-password', [UserController::class, 'editPassword'])->name('edit_password');

Route::get('/register', function () {return view('front-end.register');});

Route::get('/products', [ShowProductController::class, 'ShowProductList'])->name('show-product');
Route::get('/wishlist', [ShowProductController::class, 'ShowWishList'])->name('show-wishlist');
Route::post('/delete-wishlist/{id}', [ShowProductController::class, 'DeleteWishList'])->name('delete-wishlist');
Route::get('/discount-products', [ShowProductController::class, 'ShowDiscountProductList'])->name('show-discount-product');
Route::get('/product-left-thumbnail/{id}', [ShowProductController::class, 'ShowProductleftThumbnail'])->name('show-product-left-thumbnail');
Route::get('/show-carts', [UserController::class, 'showCarts'])->name('show_carts');
Route::post('/cart/{id}', [UserController::class, 'updateCartQty'])->name('update_cart_qty');
Route::post('user/remove-cart/{id}', [UserController::class, 'removeCart'])->name('remove_cart');
Route::get('/user/checkout', [UserController::class, 'showCheckout'])->name('checkout');
Route::post('/cupon', [UserController::class, 'addCouponCode'])->name('add_coupon_code');

Route::get('/compare', function () {return view('front-end.compare');});

Route::get('/product-circle', function () {return view('front-end.product-circle');});

Route::get('/shoplist', [AdminController::class, 'indexshoplist'])->name('shoplist');


Route::get('categorysidebar/{categoryid}', [AdminController::class, 'indexcategoryproduct']);
Route::get('subcategorysidebar/{subcategoryid}', [AdminController::class, 'indexsubcategoryproduct']);
Route::get('shopleftsidebar/{shopid}', [AdminController::class, 'indexshopproduct']);


Route::get('/news', [AdminController::class, 'news']);
Route::get('blogdetail/{blogid}', [AdminController::class, 'bloglistdetail']);

Route::get('/contact', function () {return view('front-end.contact-us');});
Route::post('contact', [AdminController::class, 'contact'])->middleware(['auth', 'role:buyer'])->name('contact');
Route::get('/faq', [AdminController::class, 'indexfaq']);

Route::get('/cart', function () {return view('front-end.cart');});

Route::get('/checkout', function () {return view('front-end.checkout');});

//Admin
Route::get('/admin', [AdminController::class, 'admindashboard'])->middleware(['auth','role:admin'])->name('admin.dashboard');
Route::get('/admin/transferdetail', function () {return view('admin.transferdetail');})->name('admin.transferdetail');
Route::get('/admin/category', [AdminController::class, 'indexcategory'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/addcategory', function () {return view('back-end.addcategory');});

Route::post('admin/registercategory', [AdminController::class, 'storecategory'])->name('registercategory');
Route::post('admin/registersubtitle', [AdminController::class, 'storesubtitle'])->name('registersubtitle');
Route::post('admin/registersubcategory', [AdminController::class, 'storesubcategory'])->name('registersubcategory');

Route::get('/admin/users', function () {return view('back-end.users');});

Route::get('admin/subadmin', [AdminController::class, 'indexsubadmin'])->middleware(['auth','role:admin']);
Route::get('/admin/registersubadmin', function () {return view('admin.edituser');});
Route::post('admin/registersubadmin', [AdminController::class, 'registersubadmin'])->name('registersubadmin');
Route::get('/subcategory', function () {return view('back-end.subcategory');});
Route::post('/user/status', [AdminController::class, 'indexuserstatus'])->name('ss');
Route::post('/user/review', [AdminController::class, 'indexreviewstatus'])->name('statusreview');
Route::get('/admin/profile', function () {return view('admin.profile');})->name('admin.profile');
Route::get('/admin/review/product', [AdminController::class,'indexreview'])->name('admin.product.review');
Route::get('/admin/faq', [AdminController::class, 'indexfaq']);
Route::get('/admin/addcoupon', function () {return view('admin.addcoupon');})->name('admin.addcoupon');
Route::get('/admin/coupon', [AdminController::class, 'indexcoupon']);
Route::get('/editcoupon/{couponid}', [AdminController::class, 'editcoupon']);
Route::post('admin/registercoupon', [AdminController::class, 'storecoupon'])->name('registercoupon');
Route::get('/editcoupon/{couponid}', [AdminController::class, 'editcoupon']);
Route::get('/admin/registerfaq', function () {return view('admin.registerfaq');})->name('admin.registerfaq');
Route::post('admin/registerfaq', [AdminController::class, 'storefaq'])->name('registerfaq');
Route::get('/editfaq/{faqid}', [AdminController::class, 'editfaq']);
route::post('/deletefaq',[AdminController::class,'deletefaq'])->name('deletefaq');
//AdminProduct
Route::get('/admin/product', [AdminController::class, 'indexproduct'])->name('admin.all.product');
Route::get('/editproduct/{productid}', [AdminController::class, 'editproduct']);
Route::post('admin/storeproduct', [AdminController::class, 'storeproduct'])->name('storeproduct');
Route::get('product/{productid}', [AdminController::class, 'productdetail']);

route::post('/admin/deleteproduct',[AdminController::class,'deleteproduct'])->name('deleteproduct');

Route::post('/product/status', [AdminController::class, 'indexstatus'])->name('tt');
Route::post('admin/couponstatus', [AdminController::class, 'indexcouponstatus'])->name('coupon');
route::post('/admin/deletecoupon',[AdminController::class,'deletecoupon'])->name('deletecoupon');
Route::post('/admin/subadminstatus', [AdminController::class, 'indexsubadminstatus'])->name('subadminstataus');

//startuser

Route::get('/admin/all/users', [Admincontroller::class, 'indexuser'])->name('admin.all.users');
Route::get('/takeremote/{id}', [AdminController::class, 'takeremote'])->middleware(['auth','role:admin']);
Route::get('userdetail/{userid}', [AdminController::class, 'userdetail']);
Route::get('subadmindetail/{userid}', [AdminController::class, 'subadmindetail']);
Route::get('/edit/{role}/{id}', [AdminController::class, 'editdata'])->middleware(['auth']);
Route::post('edituser', [AdminController::class, 'updateuser'])->name('edituser');
Route::post('edithost', [AdminController::class, 'updatehost'])->name('edithost');
Route::get('/admin/all/subuserdetail', function () {return view('admin.subuserdetail');})->name('admin.subuserdetail');
Route::get('/admin/all/addsubadmin', function () {return view('admin.addsubadmin');})->name('admin.addsubadmin');
Route::get('/admin/all/edituser', function () {return view('admin.edituser');})->name('admin.edituser');
Route::get('/admin/all/editsubuser', function () {return view('admin.editsubuser');})->name('admin.editsubuser');
route::post('/admin/deleteuser',[AdminController::class,'deleteuser'])->name('deleteuser');
route::post('/admin/deletesubadmin',[AdminController::class,'deletesubadmin'])->name('deletesubadmin');
//enduser

//startblog
Route::get('/admin/all/blog', [AdminController::class,'indexblog'])->name('admin.all.blog');
Route::get('/admin/add/blog', function () {return view('admin.blog.addblog');})->name('admin.addblog');
route::post('/admin/all/deleteblog',[AdminController::class,'deleteblog'])->name('deleteblog');
Route::post('admin/registerblog', [AdminController::class, 'storeblog'])->name('registerblog');
Route::get('blog/{blogid}', [AdminController::class, 'blogdetail']);
Route::get('/editblog/{blogid}', [AdminController::class, 'editblog']);


//endblog


//starthelp
Route::get('/admin/help', [AdminController::class, 'indexhelp'])->middleware(['auth','role:admin'])->name('admin.indexhelp');
Route::get('/admin/addhelp', [AdminController::class, 'addHelp'])->middleware(['auth','role:admin'])->name('addhelp');
Route::post('/admin/sendhelp', [AdminController::class, 'storehelp'])->middleware(['auth', 'role:admin'])->name('storehelp');

//endhelp

//startcategory
route::get('/admin/all/category',[AdminController::class,'indexcategory'])->name('admin.all.category');
route::post('/admin/all/deletecategory',[AdminController::class,'deletecategory'])->name('deletecategory');
Route::get('/admin/all/subtitle', [AdminController::class,'indexsubtitle'])->name('admin.all.subtitle');
Route::get('/editcategory/{categoryid}', [AdminController::class, 'editcategory']);
Route::get('/editsubtitle/{categoryid}', [AdminController::class, 'editsubtitle']);
Route::get('/editsubcategory/{categoryid}', [AdminController::class, 'editsubcategory']);

Route::get('/admin/all/subcategory', [AdminController::class,'indexsubcategory'])->name('admin.all.subcategory');

Route::get('/admin/all/addsubtitle',[AdminController::class,'addsubtitle'])->name('admin.all.addsubtitle');
Route::get('/admin/all/addcategory', function () {return view('admin.addcategory');})->name('admin.all.addcategory');
Route::get('/admin/all/addsubcategory', [AdminController::class,'addsubcategory'])->name('admin.all.addsubcategory');
Route::post('get-subcategories', [AdminController::class,'getSubcategories'])->name('getSubcategories');

Route::get('/admin/edit/editsubtitle', function () {return view('admin.editsubtitle');})->name('admin.edit.editsubtitle');
Route::get('/admin/edit/category', function () {return view('admin.editcategory');})->name('admin.edit.category');

Route::get('/admin/edit/subcategory', function () {return view('admin.editsubcategory');})->name('admin.edit.subcategory');
//endcategory


Route::get('/admin/detail/product', function () {return view('admin.product.product_detail');})->name('admin.detail.product');
Route::get('/admin/edit/product', function () {return view('admin.product.product_edit');})->name('admin.edit.product');

//AdminOrder
Route::get('/admin/orderlist', [AdminController::class, 'indexorderlist'])->name('orderlist');
Route::get('/admin/orderdetail/{id}', [AdminController::class, 'orderdetail'])->name('orderdetail');
Route::get('/admin/ordertracking/{id}', [AdminController::class, 'ordertracking'])->name('ordertracking');
route::post('/admin/deleteorderlist',[AdminController::class,'deleteorderlist'])->name('deleteorderlist');

Route::get('/admin/detail/order', function () {return view('admin.order.order_detail');})->name('admin.detail.order');
Route::get('/admin/tracking/order', function () {return view('admin.order.order_tracking');})->name('admin.order-tracking');


//Seller
Route::get('/seller/register', [RegisterController::class, 'sellerRegister'])->name('seller.register');
Route::post('/seller/registered', [RegisterController::class, 'sellerRegistered'])->name('seller.registered');
Route::get('/seller', [SellerController::class, 'dashboard'])->middleware(['auth','verified','role:seller'])->name('seller.dashboard');
Route::get('/seller/profile', [SellerController::class, 'profile'])->middleware(['auth','role:seller'])->name('seller.profile');
Route::post('/seller/profilestore', [SellerController::class, 'storeProfile'])->middleware(['auth','role:seller'])->name('store.profile');
Route::post('/seller/shopupdate', [SellerController::class, 'updateShop'])->middleware(['auth','role:seller'])->name('update.shop');
Route::get('/seller/help', [SellerController::class, 'help'])->middleware(['auth','role:seller'])->name('seller.help');
Route::get('/seller/helpadd', [SellerController::class, 'addHelp'])->middleware(['auth','role:seller'])->name('help.add');
Route::post('/seller/helpstore', [SellerController::class, 'storeHelp'])->middleware(['auth','role:seller'])->name('help.store');
Route::get('/seller/helpdetail/{id}', [SellerController::class, 'detailHelp'])->middleware(['auth','role:seller'])->name('help.detail');
Route::get('/seller/help/{id}', [SellerController::class, 'deleteHelp'])->middleware(['auth','role:seller'])->name('help.delete');


//Brand
Route::get('/seller/brandadd', [BrandController::class, 'addBrand'])->middleware(['auth','role:seller'])->name('add.brand');
Route::post('/seller/brandstore', [BrandController::class, 'storeBrand'])->middleware(['auth','role:seller'])->name('store.brand');

//SellerProduct
Route::get('/seller/productlist', [ProductController::class, 'allProduct'])->middleware(['auth','role:seller'])->name('all.product');
Route::get('/seller/productdetail/{id}', [ProductController::class, 'detailProduct'])->middleware(['auth','role:seller'])->name('detail.product');
Route::get('/seller/productadd', [ProductController::class, 'addProduct'])->middleware(['auth','role:seller'])->name('add.product');
Route::post('/seller/productstore', [ProductController::class, 'storeProduct'])->middleware(['auth','role:seller'])->name('store.product');
Route::get('/seller/productedit/{id}', [ProductController::class, 'editProduct'])->middleware(['auth','role:seller'])->name('edit.product');
Route::post('/seller/productupdate', [ProductController::class, 'updateProduct'])->middleware(['auth','role:seller'])->name('update.product');
Route::post('/seller/productdelete', [ProductController::class, 'deleteProduct'])->middleware(['auth','role:seller'])->name('delete.product');
Route::post('/seller/productstatus', [ProductController::class, 'changeStatus'])->middleware(['auth','role:seller'])->name('change.status');
Route::post('/seller/product/multiImg', [ProductController::class, 'updateMultiImg'])->middleware(['auth','role:seller'])->name('update.multiImg');
Route::get('/seller/product/multiImg/delete/{id}', [ProductController::class, 'deleteMultiImg'])->middleware(['auth','role:seller'])->name('delete.multiImg');
Route::get('/seller/review', [ProductController::class, 'review'])->middleware(['auth','role:seller'])->name('seller.review');
Route::post('/seller/reviewstatus', [ProductController::class, 'changeRtStatus'])->middleware(['auth','role:seller'])->name('rating.status');
Route::post('/seller/reviewupdate', [ProductController::class, 'updateReview'])->middleware(['auth','role:seller'])->name('review.update');
Route::post('/seller/reviewdelete', [ProductController::class, 'deleteReview'])->middleware(['auth','role:seller'])->name('review.delete');
Route::get('/get-subtitle/{categoryId}', [ProductController::class, 'getSubTitle']);
Route::get('/get-subcategories-by-title/{subcategoryTitleId}', [ProductController::class, 'getSubcategory']);

//SellerOrder
Route::get('/seller/orderlist', [OrderController::class, 'sellerAllOrder'])->middleware(['auth','role:seller'])->name('all.order');
Route::get('/seller/orderdetail/{id}', [OrderController::class, 'sellerDetailOrder'])->middleware(['auth','role:seller'])->name('detail.order');
Route::post('/seller/orderstatus', [OrderController::class, 'updateOrderStatus'])->middleware(['auth','role:seller'])->name('order.status');
Route::get('/seller/ordertracking/{id}', [OrderController::class, 'orderTracking'])->middleware(['auth','role:seller'])->name('order.tracking');
Route::get('/seller/ordercancel', [OrderController::class, 'cancelOrder'])->middleware(['auth','role:seller'])->name('order.cancel');
Route::post('/seller/cancelreason', [OrderController::class, 'cancelOrderReason'])->middleware(['auth','role:seller'])->name('order.cancel.reason');
Route::get('/invoice/{id}', [OrderController::class, 'generatePDF'])->middleware(['auth','role:seller'])->name('invoice');

// Route::get('', [OrderController::class, ''])->middleware(['auth','role:seller'])->name('');

//SellerSubSeller
Route::get('/seller/all/subseller', function () {return view('seller.subseller.subseller_all');})->name('all.subseller');
// Route::get('/seller/add/subseller', function () {return view('seller.subseller.subseller_add');})->name('add.subseller');
// Route::get('/seller/edit/subseller', function () {return view('seller.subseller.subseller_edit');})->name('edit.subseller');

//Subseller
Route::get('/subseller', function () {return view('sub_seller.index');})->name('sub_seller.dashboard');
Route::get('/subseller/profile', function () {return view('sub_seller.profile');})->name('sub_seller.profile');
Route::get('/subseller/help', function () {return view('sub_seller.help.help');})->name('sub_seller.help');
Route::get('/subseller/add/help', function () {return view('sub_seller.help.help_add');})->name('sub_seller.help.add');

//SubsellerProduct
Route::get('/subseller/all/product', function () {return view('sub_seller.product.product_all');})->name('sub_seller.all.product');
Route::get('/subseller/add/product', function () {return view('sub_seller.product.product_add');})->name('sub_seller.add.product');
Route::get('/subseller/detail/product', function () {return view('sub_seller.product.product_detail');})->name('sub_seller.detail.product');
Route::get('/subseller/edit/product', function () {return view('sub_seller.product.product_edit');})->name('sub_seller.edit.product');

//SubsellerOrder
Route::get('/subseller/all/order', function () {return view('sub_seller.order.order_all');})->name('sub_seller.all.order');
Route::get('/subseller/detail/order', function () {return view('sub_seller.order.order_detail');})->name('sub_seller.detail.order');
Route::get('/subseller/tracking/order', function () {return view('sub_seller.order.order_tracking');})->name('sub_seller.order-tracking');
//Route::get('/subseller/review/product', function () {return view('sub_seller.product.product_review');})->name('sub_seller.product.review');

require __DIR__.'/auth.php';