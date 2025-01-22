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

// Language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back()->withInput();
});

Route::get('/', [AdminController::class, 'welcome']);


Route::get('/user-registration', [UserController::class, 'index'])->name('user_register');

Route::post('/products/reviews', [ReviewController::class, 'store'])->name('reviews');
route::post('/user-registration/add-user', [UserController::class, 'store'])->name('adduser');

Route::get('/user', [UserController::class, 'indexuser'])->middleware(['auth', 'verified', 'role:buyer'])->name('user_dashboard');
Route::post('/user-profile-upload', [UserController::class, 'userProfileUpload']);
Route::get('/user/orders', [UserController::class, 'showOrders'])->name('user_order');
Route::get('/user/orderdetails', [UserController::class, 'showOrderDetails'])->name('user_order_details');
Route::get('/user/orderdetailtracking', [UserController::class, 'showOrderDetailTracking'])->name('order_detail_tracking');
Route::get('/user/delivery', [UserController::class, 'showDelistatus'])->name('user_deivery_status');
Route::get('/user/ordertracking', [UserController::class, 'orderTracking'])->name('user_order_tracking');


Route::get('/user/addresses', [UserController::class, 'showAddresses'])->name('user_addresses');
Route::post('/user/addresses', [UserController::class, 'createNewaddress'])->name('add_newaddress');
Route::post('/user/addresses/edit-address', [UserController::class, 'editAddress'])->name('edit_address');
Route::get('/set-default-address/{id}', [UserController::class, 'setDefaultAddress'])->name('set_default_address');
Route::delete('/user/remove-address/{id}', [UserController::class, 'removeAddress'])->name('remove_address');

Route::get('/user/paymentmethod', [UserController::class, 'showCard'])->name('user_cards');
Route::post('/user/paymentmethod', [UserController::class, 'createNewcard'])->name('add_newcard');
Route::post('/user-payment/edit-card', [UserController::class, 'editCard'])->name('edit_card');
Route::delete('/remove-cards/{id}', [UserController::class, 'removeCard'])->name('remove_card');

Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user_profile');
Route::post('/user/profile/edit-profile', [UserController::class, 'editProfile'])->name('edit_profile');
Route::post('user/profile/edit-password', [UserController::class, 'editPassword'])->name('edit_password');

Route::get('/user/message', [UserController::class, 'showMessage'])->name('user_message');
Route::post('/user/message/{id}', [UserController::class, 'removeMessage'])->name('remove_message');
Route::post('/user/message-all/{id}', [UserController::class, 'removeMessageAll'])->name('remove_message_all');

Route::get('search', [ShowProductController::class, 'footerSearch'])->name('footer_search');
Route::get('ordertracking', [UserController::class, 'footertracking'])->name('footer_tracking');

Route::get('/register', function () {
    return view('front-end.register');
});

Route::get('/products', [ShowProductController::class, 'ShowProductList'])->name('show-product');
Route::get('/wishlist', [ShowProductController::class, 'ShowWishList'])->middleware(['auth', 'role:buyer'])->name('show-wishlist');
Route::get('/comparelist', [ShowProductController::class, 'ShowCompareList'])->middleware(['auth', 'role:buyer'])->name('show-comparelist');
Route::get('/delete-wishlist/{id}', [ShowProductController::class, 'DeleteWishList'])->name('delete-wishlist');
Route::get('/delete-comparelist/{id}', [ShowProductController::class, 'DeleteCompareList'])->name('delete-comparelist');
Route::get('/discount-products', [ShowProductController::class, 'ShowDiscountProductList'])->name('show-discount-product');
Route::get('/coupon-products', [ShowProductController::class, 'ShowCouponProductList'])->name('show-coupon-product');
Route::get('/product-left-thumbnail/{id}', [ShowProductController::class, 'ShowProductleftThumbnail'])->name('show-product-left-thumbnail');
Route::get('/carts', [UserController::class, 'showCarts'])->middleware(['auth', 'role:buyer'])->name('show_carts');
Route::post('/cart/{id}', [UserController::class, 'updateCartQty'])->name('update_cart_qty');
Route::post('user/remove-cart/{id}', [UserController::class, 'removeCart'])->name('remove_cart');
Route::get('/remove-cart-product/{id}', [UserController::class, 'removeCartProduct'])->name('remove_cart_product');
Route::post('/user/checkout', [UserController::class, 'showCheckout'])->name('checkout');
Route::get('/cupon', [UserController::class, 'applyCouponCode'])->name('apply_coupon_code');
Route::post('/payment', [UserController::class, 'paymentCompleted'])->name('payment_completed');
Route::post('/cash-payment', [UserController::class, 'cashPayment'])->name('cash_payment');
Route::get('/order-success/{orderId}', [UserController::class, 'orderSuccess'])->name('order_success');

Route::get('/product-circle', function () {
    return view('front-end.product-circle');
});

Route::get('/shoplist', [AdminController::class, 'indexshoplist'])->name('shoplist');


Route::get('categorysidebar/{categoryid}', [AdminController::class, 'indexcategoryproduct'])->name('show-category-left-side-bar');
Route::get('subcategorysidebar/{subcategoryid}', [AdminController::class, 'indexsubcategoryproduct']);
Route::get('specialsubcategorysidebar/{subcategoryid}', [AdminController::class, 'indexspecialsubcategoryproduct']);
Route::get('shopleftsidebar/{shopid}', [AdminController::class, 'indexshopproduct'])->name('show-shop-left-side-bar');


Route::get('/news', [AdminController::class, 'news']);
Route::get('blogdetail/{blogid}', [AdminController::class, 'bloglistdetail']);

Route::get('/contact', function () {
    return view('front-end.contact-us');
});
Route::post('contact', [AdminController::class, 'contact'])->name('contact');
Route::get('/faq', [AdminController::class, 'indexfaq']);
Route::get('faq/{faqid}', [AdminController::class, 'faqdetail']);
Route::get('/privacy-policy', function () {
    return view('front-end.privacy-policy');
});
Route::get('/term-and-condition', function () {
    return view('front-end.term-and-condition');
});
Route::get('/term-and-condition', function () {
    return view('front-end.term-and-condition');
});
Route::get('/buyer-term-and-condition', function () {
    return view('front-end.buyer-term-and-condition');
});
Route::get('/seller-term-and-condition', function () {
    return view('front-end.seller-term-and-condition');
});

Route::get('/cart', function () {
    return view('front-end.cart');
});

Route::get('/checkout', function () {
    return view('front-end.checkout');
});

//Admin
Route::get('/admin', [AdminController::class, 'admindashboard'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::get('/admin/transferdetail', function () {
    return view('admin.transferdetail');
})->middleware(['auth', 'role:admin'])->name('admin.transferdetail');
Route::get('admin/transfer-order-details/{transferId}', [AdminController::class, 'indextransferorderdetail'])->name('transfer_order_detail');
Route::get('/trans_orderdetail/{id}/{startdate}/{enddate}', [AdminController::class, 'trans_orderdetail'])->middleware(['auth', 'role:admin'])->name('trans_orderdetail');
Route::get('/admin/category', [AdminController::class, 'indexcategory'])->middleware(['auth', 'verified', 'role:admin']);
Route::get('/admin/addcategory', function () {
    return view('back-end.addcategory');
});

Route::post('admin/registercategory', [AdminController::class, 'storecategory'])->middleware(['auth', 'role:admin'])->name('registercategory');
Route::post('admin/registersubtitle', [AdminController::class, 'storesubtitle'])->middleware(['auth', 'role:admin'])->name('registersubtitle');
Route::post('admin/registersubcategory', [AdminController::class, 'storesubcategory'])->middleware(['auth', 'role:admin'])->name('registersubcategory');
Route::get('/admin/users', function () {
    return view('back-end.users');
});

Route::get('admin/subadmin', [AdminController::class, 'indexsubadmin'])->middleware(['auth', 'role:admin'])->name('admin.subadmin');
Route::get('/admin/registersubadmin', function () {
    return view('admin.edituser');
});
Route::post('admin/registersubadmin', [AdminController::class, 'registersubadmin'])->name('registersubadmin');
Route::get('admin/bank-account', [AdminController::class, 'indexbankaccount'])->middleware(['auth', 'role:admin'])->name('admin.bank_account');
Route::get('/admin/add-bank-account', function () {
    return view('admin.add_bank_account');
});
Route::post('/admin/add-bank-account', [AdminController::class, 'addBankAccount'])->name('admin.add_bank_account');
Route::get('/admin/edit-bank-account/{id}', [AdminController::class, 'forEditBankAccount']);
Route::post('/admin/edit-bank-account', [AdminController::class, 'editBankAccount'])->name('admin.edit_bank_account');
Route::post('/admin/delete-bank-account', [AdminController::class, 'deleteBankAccount'])->name('admin.delete_bank_account');

Route::get('/subcategory', function () {
    return view('back-end.subcategory');
});
Route::post('/user/status', [AdminController::class, 'indexuserstatus'])->middleware(['auth', 'role:admin'])->name('ss');
Route::post('/user/review', [AdminController::class, 'indexreviewstatus'])->middleware(['auth', 'role:admin'])->name('statusreview');
Route::get('/admin/profile', function () {
    return view('admin.profile');
})->middleware(['auth', 'role:admin'])->name('admin.profile');
Route::get('/admin/review/product', [AdminController::class, 'indexreview'])->middleware(['auth', 'role:admin'])->name('admin.product.review');
Route::get('/admin/faq', [AdminController::class, 'indexfaq'])->middleware(['auth', 'role:admin'])->name('admin.faq');
Route::get('/admin/addcoupon', function () {
    return view('admin.addcoupon');
})->middleware(['auth', 'role:admin'])->name('admin.addcoupon');
Route::get('/admin/coupon', [AdminController::class, 'indexcoupon'])->middleware(['auth', 'role:admin'])->name('admin.coupon');
Route::get('/admin/indexcustomer', [AdminController::class, 'indexcustomer'])->middleware(['auth', 'role:admin'])->name('admin.indexcustomer');
Route::get('/editcustomer/{topid}', [AdminController::class, 'editcustomer'])->middleware(['auth', 'role:admin']);
Route::post('admin/registercustomer', [AdminController::class, 'storecustomer'])->middleware(['auth', 'role:admin'])->name('registercustomer');
Route::get('/admin/top', [AdminController::class, 'indextop'])->middleware(['auth', 'role:admin'])->name('admin.top');
Route::get('/admin/newsletter', [AdminController::class, 'indexnewsletter'])->middleware(['auth', 'role:admin'])->name('admin.newsletter');
Route::get('/edittop/{topid}', [AdminController::class, 'edittop'])->middleware(['auth', 'role:admin']);
Route::post('admin/registertop', [AdminController::class, 'storetop'])->middleware(['auth', 'role:admin'])->name('registertop');
Route::get('/editcoupon/{couponid}', [AdminController::class, 'editcoupon'])->middleware(['auth', 'role:admin']);
Route::post('admin/registercoupon', [AdminController::class, 'storecoupon'])->middleware(['auth', 'role:admin'])->name('registercoupon');
Route::get('/editcoupon/{couponid}', [AdminController::class, 'editcoupon'])->middleware(['auth', 'role:admin']);
Route::get('/admin/registerfaq', function () {
    return view('admin.registerfaq');
})->middleware(['auth', 'role:admin'])->name('admin.registerfaq');
Route::post('admin/registerfaq', [AdminController::class, 'storefaq'])->middleware(['auth', 'role:admin'])->name('registerfaq');
Route::get('/editfaq/{faqid}', [AdminController::class, 'editfaq'])->middleware(['auth', 'role:admin']);
route::post('/deletefaq', [AdminController::class, 'deletefaq'])->middleware(['auth', 'role:admin'])->name('deletefaq');
//AdminProduct
Route::get('/admin/product', [AdminController::class, 'indexproduct'])->middleware(['auth', 'role:admin'])->name('admin.all.product');
Route::get('/admin/shoplist', [AdminController::class, 'shoplist'])->middleware(['auth', 'role:admin'])->name('admin.all.shop');
route::post('/admin/updatecoupon', [AdminController::class, 'updatecoupon'])->middleware(['auth', 'role:admin'])->name('updatecoupon');
route::post('/admin/updatecommission', [AdminController::class, 'updatecommission'])->middleware(['auth', 'role:admin'])->name('updatecommission');
route::post('/admin/updateadjust', [AdminController::class, 'updateadjust'])->middleware(['auth', 'role:admin'])->name('updateadjust');
route::post('/admin/updateproductcommission', [AdminController::class, 'updateproductcommission'])->middleware(['auth', 'role:admin'])->name('updateproductcommission');
route::post('/admin/deletecommission', [AdminController::class, 'deletecommission'])->middleware(['auth', 'role:admin'])->name('deletecommission');
route::post('/admin/updateproductcoupon', [AdminController::class, 'updateproductcoupon'])->middleware(['auth', 'role:admin'])->name('updateproductcoupon');
Route::get('/editproduct/{productid}', [AdminController::class, 'editproduct'])->middleware(['auth', 'role:admin']);
Route::post('/admin/product/multiImg', [AdminController::class, 'updateMultiImg'])->middleware(['auth', 'role:admin'])->name('updatemultiImg');
Route::get('/admin/product/multiImg/delete/{id}', [AdminController::class, 'deletemultiImg'])->middleware(['auth', 'role:admin'])->name('deletemultiImg');
Route::post('admin/storeproduct', [AdminController::class, 'storeproduct'])->middleware(['auth', 'role:admin'])->name('storeproduct');
Route::get('product/{productid}', [AdminController::class, 'productdetail'])->middleware(['auth', 'role:admin']);
Route::get('shop/{shopid}', [AdminController::class, 'shopdetail'])->middleware(['auth', 'role:admin']);
Route::get('shoptransfer/{shopid}', [AdminController::class, 'shopTransferDetail'])->middleware(['auth', 'role:admin']);
Route::get('coupon/{couponid}', [AdminController::class, 'coupondetail'])->middleware(['auth', 'role:admin']);
route::post('/admin/deleteproduct', [AdminController::class, 'deleteproduct'])->middleware(['auth', 'role:admin'])->name('deleteproduct');
Route::post('/admin/cash-payment-received/{id}', [AdminController::class, 'cashPaymentReceived'])->name('cash_payment_received');

Route::post('/product/status', [AdminController::class, 'indexstatus'])->middleware(['auth', 'role:admin'])->name('tt');
Route::post('/shop/status', [AdminController::class, 'indexshopstatus'])->middleware(['auth', 'role:admin'])->name('shopstatus');
Route::post('/transfer/status', [AdminController::class, 'indextransferstatus'])->middleware(['auth', 'role:admin'])->name('transferstatus');
Route::get('admin/transfer-order-details/{transferId}', [AdminController::class, 'indextransferorderdetail'])->name('transfer_order_detail');
Route::post('admin/couponstatus', [AdminController::class, 'indexcouponstatus'])->middleware(['auth', 'role:admin'])->name('coupon');
route::post('/admin/deletecoupon', [AdminController::class, 'deletecoupon'])->middleware(['auth', 'role:admin'])->name('deletecoupon');
Route::post('/admin/subadminstatus', [AdminController::class, 'indexsubadminstatus'])->middleware(['auth', 'role:admin'])->name('subadminstataus');

//startuser

Route::get('/admin/all/users', [Admincontroller::class, 'indexuser'])->name('admin.all.users');
Route::get('/takeremote/{id}', [AdminController::class, 'takeremote'])->middleware(['auth', 'role:admin']);
Route::get('/shoptakeremote/{shopid}', [AdminController::class, 'shoptakeremote'])->middleware(['auth', 'role:admin']);
Route::get('userdetail/{userid}', [AdminController::class, 'userdetail']);
Route::get('subadmindetail/{userid}', [AdminController::class, 'subadmindetail']);
Route::get('/edit/{role}/{id}', [AdminController::class, 'editdata'])->middleware(['auth']);
Route::post('edituser', [AdminController::class, 'updateuser'])->name('edituser');
Route::post('edithost', [AdminController::class, 'updatehost'])->name('edithost');
Route::get('/admin/all/subuserdetail', function () {
    return view('admin.subuserdetail');
})->name('admin.subuserdetail');
Route::get('/admin/all/addsubadmin', function () {
    return view('admin.addsubadmin');
})->name('admin.addsubadmin');
Route::get('/admin/all/edituser', function () {
    return view('admin.edituser');
})->name('admin.edituser');
Route::get('/admin/all/editsubuser', function () {
    return view('admin.editsubuser');
})->name('admin.editsubuser');
route::post('/admin/deleteuser', [AdminController::class, 'deleteuser'])->name('deleteuser');
route::post('/admin/deletesubadmin', [AdminController::class, 'deletesubadmin'])->name('deletesubadmin');
//enduser

//startblog
Route::get('/admin/all/blog', [AdminController::class, 'indexblog'])->name('admin.all.blog');
Route::get('/admin/add/blog', function () {
    return view('admin.blog.addblog');
})->name('admin.addblog');
route::post('/admin/all/deleteblog', [AdminController::class, 'deleteblog'])->name('deleteblog');
route::post('/admin/deletenewsletter', [AdminController::class, 'deletenewsletter'])->name('deletenewsletter');
Route::post('admin/registerblog', [AdminController::class, 'storeblog'])->name('registerblog');
Route::post('admin/registernewsletter', [AdminController::class, 'storenewsletter'])->name('registernewsletter');
Route::get('blog/{blogid}', [AdminController::class, 'blogdetail']);
Route::get('/editblog/{blogid}', [AdminController::class, 'editblog']);


//endblog


//starthelp

Route::get('/admin/indexhelp', [AdminController::class, 'indexhelp'])->name('admin.indexhelp');
Route::get('helpdetails/{helpid}', [AdminController::class, 'helpDetail']);
Route::get('/admin/addhelp', [AdminController::class, 'addhelp'])->name('admin.addhelp');
Route::get('/admin/addnotice', [AdminController::class, 'addnotice'])->name('admin.addnotice');
Route::post('/admin/sendhelp', [AdminController::class, 'notice'])->name('notice');
Route::post('/admin/sendall', [AdminController::class, 'noticeall'])->name('noticeall');
Route::post('/admin/noticedelete', [AdminController::class, 'deleteNotice'])->name('noticedelete');
Route::post('/admin/reveivedelete', [AdminController::class, 'deleteReceive'])->name('receivedelete');
Route::post('/admin/replyemail', [AdminController::class, 'storeReply'])->name('emailreply');
Route::post('/adminreplyresent', [AdminController::class, 'storeReply'])->middleware(['auth', 'role:admin'])->name('admin.reply.sent');
//endhelp

//startcategory
route::get('/admin/all/category', [AdminController::class, 'indexcategory'])->name('admin.all.category');
Route::get('/admin/all/subtitle', [AdminController::class, 'indexsubtitle'])->name('admin.all.subtitle');
Route::get('/editcategory/{categoryid}', [AdminController::class, 'editcategory']);
Route::get('/editsubtitle/{categoryid}', [AdminController::class, 'editsubtitle']);
Route::get('/editsubcategory/{categorytype}/{categoryid}', [AdminController::class, 'editsubcategory']);
route::post('/admin/deletecategory', [AdminController::class, 'deletecategory'])->name('deletecategory');
route::post('/addtospecial', [AdminController::class, 'addToSpecial'])->name('add_to_special_corner');
route::delete('/removefromspecial/{id}', [AdminController::class, 'removeFromSpecial'])->name('remove_from_special_corner');
//route::delete('/removecoupon/{id}',[AdminController::class,'removeCoupon'])->name('removecoupon');
route::post('/removeCoupon', [AdminController::class, 'removeCoupon'])->name('removeCoupon');
route::post('/remove_shop_coupon', [AdminController::class, 'remove_shopCoupon'])->name('remove_shop_coupon');
Route::get('/admin/category', [AdminController::class, 'indexsubcategory'])->name('admin.category');
route::post('/admin/updatesubcatname', [AdminController::class, 'updatesubcatname'])->middleware(['auth', 'role:admin'])->name('updatesubcat_Name');
route::post('/admin/updatecategoryname', [AdminController::class, 'updatecategoryname'])->middleware(['auth', 'role:admin'])->name('updatecategory_Name');
Route::get('/admin/addsubtitle', [AdminController::class, 'addsubtitle'])->name('admin.all.addsubtitle');
Route::get('/admin/addcategory', function () {
    return view('admin.addcategory');
})->name('admin.all.addcategory');
Route::get('/admin/addsubcategory', [AdminController::class, 'addsubcategory'])->name('admin.all.addsubcategory');
Route::post('get-subcategories', [AdminController::class, 'getSubcategories'])->name('getSubcategories');

Route::get('/admin/edit/editsubtitle', function () {
    return view('admin.editsubtitle');
})->name('admin.edit.editsubtitle');
Route::get('/admin/edit/category', function () {
    return view('admin.editcategory');
})->name('admin.edit.category');

Route::get('/admin/edit/subcategory', function () {
    return view('admin.editsubcategory');
})->name('admin.edit.subcategory');
//endcategory


Route::get('/admin/detail/product', function () {
    return view('admin.product.product_detail');
})->name('admin.detail.product');
Route::get('/admin/edit/product', function () {
    return view('admin.product.product_edit');
})->name('admin.edit.product');

//AdminOrder
Route::get('/admin/orderlist', [AdminController::class, 'indexorderlist'])->name('orderlist');
Route::get('admin/productdetail/{id}', [AdminController::class, 'detailProduct'])->middleware(['auth', 'role:admin'])->name('admin.detailproduct');
Route::get('/admin/orderdetail/{id}', [AdminController::class, 'orderdetail'])->name('orderdetail');
Route::get('/admin/ordertracking/{id}', [AdminController::class, 'ordertracking'])->name('ordertracking');
route::post('/admin/deleteorderlist', [AdminController::class, 'deleteorderlist'])->name('deleteorderlist');

Route::get('/admin/detail/order', function () {
    return view('admin.order.order_detail');
})->name('admin.detail.order');
Route::get('/admin/tracking/order', function () {
    return view('admin.order.order_tracking');
})->name('admin.order-tracking');

// story
Route::get('/our-story', [AdminController::class, 'ourStory']);
Route::get('/admin/story', [AdminController::class, 'indexstory'])->middleware(['auth', 'role:admin'])->name('admin.story');
Route::get('/admin/addstory', function () {
    return view('admin.addstory');
})->name('admin.add.story');
Route::post('/admin/addstory', [AdminController::class, 'storeStory'])->name('admin.store.story');
Route::post('/admin/deletestory', [AdminController::class, 'deleteStory'])->middleware(['auth', 'role:admin'])->name('admin.delete.story');
Route::get('/editstory/{id}', [AdminController::class, 'editStory'])->middleware(['auth', 'role:admin']);

Route::post('/notifications/{id}/seen', [AdminController::class, 'markAsSeen']);
Route::get('/notifications/allseen', [AdminController::class, 'allSeen']);
Route::post('/seller-notifications/{id}/seen', [SellerController::class, 'markAsSeen']);
Route::get('/seller-notifications/allseen', [SellerController::class, 'allSeen']);

//Seller
Route::get('/seller', [SellerController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:seller'])->name('seller.dashboard');
Route::get('/seller/register', [RegisterController::class, 'sellerRegister'])->name('seller.register');
Route::post('/seller/registered', [RegisterController::class, 'sellerRegistered'])->name('seller.registered');

Route::get('/profile', [SellerController::class, 'profile'])->middleware(['auth', 'role:seller'])->name('seller.profile');
Route::post('/profilestore', [SellerController::class, 'storeProfile'])->middleware(['auth', 'role:seller'])->name('store.profile');
Route::post('/shopupdate', [SellerController::class, 'updateShop'])->middleware(['auth', 'role:seller'])->name('update.shop');
route::delete('/removeshopcoupon/{id}', [AdminController::class, 'removeFromShop'])->name('remove_from_shop');
Route::get('/help', [SellerController::class, 'help'])->middleware(['auth', 'role:seller'])->name('seller.help');
Route::get('/helpadd', [SellerController::class, 'addHelp'])->middleware(['auth', 'role:seller'])->name('help.add');
Route::post('/helpstore', [SellerController::class, 'storeHelp'])->middleware(['auth', 'role:seller'])->name('help.store');
Route::get('/helpdetail/{id}', [SellerController::class, 'detailHelp'])->middleware(['auth', 'role:seller'])->name('help.detail');
Route::post('/helpdelete', [SellerController::class, 'deleteHelp'])->middleware(['auth', 'role:seller'])->name('help.delete');
Route::get('/reply/{id}', [SellerController::class, 'reply'])->middleware(['auth', 'role:seller'])->name('reply');
Route::post('/replyresent', [SellerController::class, 'storeReply'])->middleware(['auth', 'role:seller'])->name('reply.sent');



//Brand
Route::get('/brandadd', [BrandController::class, 'addBrand'])->middleware(['auth', 'role:seller'])->name('add.brand');
Route::post('/brandstore', [BrandController::class, 'storeBrand'])->middleware(['auth', 'role:seller'])->name('store.brand');

//SellerProduct
Route::get('/productlist', [ProductController::class, 'allProduct'])->middleware(['auth', 'role:seller'])->name('all.product');
Route::get('/productdetail/{id}', [ProductController::class, 'detailProduct'])->middleware(['auth', 'role:seller'])->name('detail.product');
Route::get('/productadd', [ProductController::class, 'addProduct'])->middleware(['auth', 'role:seller'])->name('add.product');
Route::post('/productstore', [ProductController::class, 'storeProduct'])->middleware(['auth', 'role:seller'])->name('store.product');
Route::get('/productedit/{id}', [ProductController::class, 'editProduct'])->middleware(['auth', 'role:seller'])->name('edit.product');
Route::post('/productupdate', [ProductController::class, 'updateProduct'])->middleware(['auth', 'role:seller'])->name('update.product');
Route::post('/productdelete', [ProductController::class, 'deleteProduct'])->middleware(['auth', 'role:seller'])->name('delete.product');
Route::post('/productstatus', [ProductController::class, 'changeStatus'])->middleware(['auth', 'role:seller'])->name('change.status');
Route::post('/product/multiImg', [ProductController::class, 'updateMultiImg'])->middleware(['auth', 'role:seller'])->name('update.multiImg');
Route::post('/product/multiImg/delete', [ProductController::class, 'deleteMultiImg'])->middleware(['auth', 'role:seller'])->name('delete.multiImg');
Route::get('/review', [ProductController::class, 'review'])->middleware(['auth', 'role:seller'])->name('seller.review');
Route::post('/reviewstatus', [ProductController::class, 'changeRtStatus'])->middleware(['auth', 'role:seller'])->name('rating.status');
Route::post('/reviewupdate', [ProductController::class, 'updateReview'])->middleware(['auth', 'role:seller'])->name('review.update');
Route::post('/reviewdelete', [ProductController::class, 'deleteReview'])->middleware(['auth', 'role:seller'])->name('review.delete');
Route::get('/get-subtitle/{categoryId}', [ProductController::class, 'getSubTitle']);
Route::get('/get-subcategories-by-title/{subcategorytitleId}', [ProductController::class, 'getSubcategory']);

//SellerOrder
Route::get('/orderlist', [OrderController::class, 'sellerAllOrder'])->middleware(['auth', 'role:seller'])->name('all.order');
Route::get('/orderdetail/{id}', [OrderController::class, 'sellerDetailOrder'])->middleware(['auth', 'role:seller'])->name('detail.order');
Route::post('/orderstatus', [OrderController::class, 'updateOrderStatus'])->middleware(['auth', 'role:seller'])->name('order.status');
Route::get('/ordertracking/{id}', [OrderController::class, 'orderTracking'])->middleware(['auth', 'role:seller'])->name('order.tracking');
Route::get('/ordercancel', [OrderController::class, 'cancelOrder'])->middleware(['auth', 'role:seller'])->name('order.cancel');
Route::post('/cancelreason', [OrderController::class, 'cancelOrderReason'])->middleware(['auth', 'role:seller'])->name('order.cancel.reason');
Route::get('/invoice/{id}', [OrderController::class, 'generatePDF'])->middleware(['auth', 'role:seller'])->name('invoice');

// Route::get('', [OrderController::class, ''])->middleware(['auth','role:seller'])->name('');

//SellerSubSeller
Route::get('/subsellerlist', [SellerController::class, 'allSubseller'])->middleware(['auth', 'role:seller'])->name('all.subseller');
Route::get('/subselleradd', [SellerController::class, 'addSubseller'])->middleware(['auth', 'role:seller'])->name('add.subseller');
Route::post('/subsellerstore', [SellerController::class, 'storeSubseller'])->middleware(['auth', 'role:seller'])->name('store.subseller');
Route::get('/subselleredit/{id}', [SellerController::class, 'editSubseller'])->middleware(['auth', 'role:seller'])->name('edit.subseller');
Route::post('/subsellerupdate', [SellerController::class, 'updateSubseller'])->middleware(['auth', 'role:seller'])->name('update.subseller');
Route::post('/subsellerdelete', [SellerController::class, 'deleteSubseller'])->middleware(['auth', 'role:seller'])->name('delete.subseller');


require __DIR__ . '/auth.php';