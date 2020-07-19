<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/','HomeController@index')->name('home');
Route::get('handshive-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('handshive-login', 'Auth\LoginController@login');
Route::post('handshive-logout', 'Auth\LoginController@logout')->name('logout');
Route::post('check-email', 'AdminController@checkAdminEmail')->name('check-email');
Route::post('check-user-verification', 'AdminController@checkAdminEmailCode')->name('check-user-verification');
Route::post('save-password-reset', 'AdminController@savePasswordReset')->name('save-password-reset');
Route::get(md5('admin-password-reset').'/', 'AdminController@passwordReset')->name('admin.password-reset');
Route::get(md5('admin-forget-password').'/','AdminController@forgetPassword')->name('admin.forget-password');
Route::get(md5('admin-user-verify').'/','AdminController@userVerify')->name('admin.user-verify');



Route::get('/terms-conditions', 'HomeController@termsConditions')->name('term-conditions');
Route::get('/return-and-refund-policy', 'HomeController@returnRefundPolicy')->name('return-policy');
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::get('/blog', 'HomeController@allBlog')->name('blog');
Route::get('/contact-us', 'HomeController@contactUs')->name('contact-us');
Route::post('/contact-message', 'HomeController@contactMessage')->name('contact-message');
Route::get('/about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('/blog-details/{slug}', 'HomeController@blogDetails')->name('blog-details');
Route::get('/blog-category/{slug}', 'HomeController@blogCategory')->name('blog-cagetory-view');
Route::get('/blog-tag/{tag}', 'HomeController@blogTag')->name('blog-tag-view');
Route::post('comment-save', 'HomeController@commentSave')->name('comment-save');




Route::get(md5('password-reset-view').'/','HomeController@passwordResetView')->name('password-reset-view');
Route::get(md5('customer-password-reset').'/','HomeController@passwordReset')->name('customer-password-reset');
Route::post('password-reset-confirm','HomeController@passwordResetConfirm')->name('password-reset-confirm');
Route::post('/autocomplete/fetch', 'HomeController@fetch')->name('autocomplete.fetch');
Route::post('/search-product-details', 'HomeController@searchProductDetails')->name('search-product-details');

Route::get('/products','HomeController@shop')->name('shop');
Route::get(md5('customer-verify').'/','HomeController@customerVerify')->name('customer-verify');
Route::get(md5('customer-resendcode').'/','HomeController@customerResendCode')->name('customer-resendcode');
Route::get(md5('customer-resendcode-password').'/','HomeController@customerResendCodePassword')->name('customer-resendcode-password');
Route::get(md5('email-verification').'/','HomeController@emailVerify')->name('email-verification');
Route::get('forget-password/','HomeController@forgetPassword')->name('forget-password');
Route::get(md5('account-found').'/{phone}','HomeController@accountFoundView')->name('account-found');
Route::post('apply-new-password','HomeController@newPasswordApply')->name('apply-new-password');
Route::post('customer-verify/','HomeController@customerVerifyCheck')->name('customer-verify-save');
Route::post('email-verify/','HomeController@emailVerifyCheck')->name('email-verify-save');
Route::post('customer-find/','HomeController@customerFind')->name('customer-find');

Route::post('/order-confirm','HomeController@orderConfirm');
Route::get('/order-confirm','HomeController@orderConfirmGet')->name('order-confirm');
Route::get('/cart','HomeController@viewCart')->name('cart');
Route::get('/delete-cart-item','HomeController@deleteItemCart')->name('delete-cart-item');
Route::get('add-to-cart','HomeController@addToCart')->name('add-to-cart');
Route::get('delete-to-cart','HomeController@deleteToCart')->name('delete-to-cart');
Route::get('delete-to-cart-mini','HomeController@deleteToCartMini')->name('delete-to-cart-mini');
Route::get('confirm-shipping-amount','HomeController@shippingConfirm')->name('confirm-shipping-amount');
Route::get('update-cart','HomeController@updateCart')->name('update-cart');
Route::get('update-cart-qty','HomeController@updateCartQty')->name('update-cart-qty');
Route::get('delete-cart-qty','HomeController@deleteCartQty')->name('delete-cart-qty');
Route::get('delete-cart','HomeController@deleteCart')->name('delete-cart');
Route::get('confirm-cupon-amount','HomeController@cupponConfirm')->name('confirm-cupon-amount');
Route::get('add-to-cart-full','HomeController@addToCartFull')->name('add-to-cart-full');
Route::get('add-to-cart-mini','HomeController@addToCartMini')->name('add-to-cart-mini');
Route::get('product/{slug}','HomeController@showProductDetails')->name('product-details');
Route::get('category-product/{slug}','HomeController@showCategoryProduct')->name('category_product');
Route::get('subcategory-product/{sub_cat_slug}','HomeController@showsubCategoryProduct')->name('subcategory_product');
Route::post('customer-login-email','CustomerLoginController@customerLoginEmail')->name('customer-login-email');
Route::get('customer-logout',[
    'uses'=>'CustomerLoginController@customerLogOut',
    'as'=>'customer.logout'
]);
Route::get('customer-login',[
    'uses'=>'CustomerLoginController@customerLogin',
    'as'=>'customer-login'
]);
Route::post('customer-login',[
    'uses'=>'CustomerLoginController@customerLoginCheck'
]);
//
Route::get('customer-registration',[
    'uses'=>'CustomerLoginController@customerRegistration',
    'as'=>'customer-register'
]);
Route::post('customer-registration',[
    'uses'=>'CustomerLoginController@customerRegistrationSave',
]);


Route::group(['middleware'=>['web','customer','revalidate']], function(){

    Route::get('my-dashboard',[
        'uses'=>'MyDashboardController@customerDashboard',
        'as'=>'my-dashboard'
    ]);
    Route::get(md5('customer-email-verification').'/','MyDashboardController@reemailVerify')->name('reemail-verification');
    Route::post('reemail-verify/','MyDashboardController@emailVerifyCheck')->name('reemail-verify-save');
    Route::get('my-order/{id}',[
        'uses'=>'MyDashboardController@showCustomerInvoice',
        'as'=>'my-order'
    ]);
    Route::get('my-order-cancel/{id}',[
        'uses'=>'MyDashboardController@cancelOrder',
        'as'=>'my-order-cancel'
    ]);

    Route::post('customer-profile-update',[
        'uses'=>'MyDashboardController@customerProfileUpdate',
        'as'=>'customer-profile-update'
    ]);
    //

    //

});



//Admin Routes
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'revalidate']], function () {

        //Dashboard
        Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
        //Department
        Route::get('department', 'CategoryController@department')->name('admin.department');
        Route::post('save-department', 'CategoryController@saveDepartment')->name('save.department');
        Route::get('edit-department', 'CategoryController@editDepartment')->name('admin.edit-department');
        Route::post('edit-department', 'CategoryController@updateDepartment');


        //Category
        Route::get('category', 'CategoryController@index')->name('admin.category');
        Route::get('edit-category', 'CategoryController@editCategory')->name('admin.edit-category');
        Route::post('edit-company-profile', 'ManageContentController@editCompany')->name('admin.edit-company');
        Route::get('get-subcategory', 'CategoryController@getSubCategory')->name('admin.get-sub-category');
        Route::post('edit-category', 'CategoryController@updateCategory');
        Route::post('save-category', 'CategoryController@saveCategory')->name('save.category');
        Route::get('get-category', 'CategoryController@getCategory')->name('admin.get-category');

        //Sub Category
        Route::get('sub-category', 'CategoryController@subCategory')->name('admin.sub-category');
        Route::post('save.sub-category', 'CategoryController@saveSubCategory')->name('save.sub-category');
        Route::get('edit-sub-category', 'CategoryController@editSubCategory')->name('admin.edit-sub-category');
        Route::post('edit-sub-category', 'CategoryController@updateSubCategory');

        //manage product
        Route::get('add-product', 'ProductController@addProduct')->name('admin.add-product');
        Route::post('add-product', 'ProductController@saveProduct');
        Route::get('view-all-product', 'ProductController@viewAllProduct')->name('admin.view-all-product');
        Route::get('edit-product/{id}', 'ProductController@editProduct')->name('product.edit');
        Route::post('edit-product/{id}', 'ProductController@updateProduct');

        //manage content
        Route::get('department-slider', 'ManageContentController@viewAllSlider')->name('admin.slider');
        Route::post('save-slider', 'ManageContentController@saveSlider')->name('save.slider');
        Route::post('update-slider', 'ManageContentController@updateSlider')->name('update.slider');
        Route::get('delete-slider/{id}', 'ManageContentController@deleteSlider')->name('admin.delete-slider');
        Route::get('edit-slider', 'ManageContentController@editSlider')->name('admin.edit-slider');
        //task we do content
        Route::get('department-task-we-do', 'ManageContentController@showTaskWeDo')->name('admin.courier');
        Route::post('save-courier', 'ManageContentController@saveTaskWeDo')->name('save.courier');
        Route::get('edit-task', 'ManageContentController@editTask')->name('admin.edit-task');
        Route::post('edit-task', 'ManageContentController@updateCourier');
//        Route::get('support', 'ManageContentController@viewAllSupport')->name('admin.support');
//        Route::get('edit-support', 'ManageContentController@editSupport')->name('admin.edit-support');
//        Route::post('update-support', 'ManageContentController@updateSupport')->name('update.support-content');
//        Route::get('shipping', 'ManageContentController@viewAllShipping')->name('admin.shipping');
//        Route::get('edit-shipping', 'ManageContentController@editShipping')->name('admin.edit-shipping');
//        Route::post('update-shipping', 'ManageContentController@updateShipping')->name('update.shipping-content');
//        Route::get('courier', 'ManageContentController@showCourier')->name('admin.courier');
//        Route::post('save-courier', 'ManageContentController@saveCourier')->name('save.courier');
//        Route::get('edit-courier', 'ManageContentController@editCourier')->name('admin.edit-courier');
//        Route::post('edit-courier', 'ManageContentController@updateCourier');
//
//        Route::get('cupon', 'ManageContentController@viewAllCupon')->name('admin.cupon');
//        Route::post('save-cupon', 'ManageContentController@saveCupon')->name('save.cupon');
//        Route::get('edit-cupon', 'ManageContentController@editCupon')->name('admin.edit-cupon');
//        Route::post('edit-cupon', 'ManageContentController@updateCupon');

        //blog
        Route::get('blog-category', 'ManageContentController@blogCategory')->name('admin.blog-category');
        Route::get('department-why-choose-us', 'ManageContentController@viewAllBlog')->name('admin.blog');
        Route::get('delete-blog-comment/{id}', 'ManageContentController@deleteComment')->name('admin.delete-blog-comment');
        Route::get('delete-support-service/{id}', 'ManageContentController@deleteSupportService')->name('admin.delete-support-service');
        Route::get('blog-comments', 'ManageContentController@viewAllBlogComments')->name('admin.blog-comments');
        Route::get('add-support-service', 'ManageContentController@addBlog')->name('admin.add-blog');
        Route::get('edit-support-service/{id}', 'ManageContentController@editSupportService')->name('admin.edit-support-service');
        Route::post('edit-support-service/{id}', 'ManageContentController@updateSupportService');
        Route::post('save-support-services', 'ManageContentController@saveSupportService')->name('admin.save-support-service');
        Route::post('save-blog-category', 'ManageContentController@saveBlogCategory')->name('save.blog-category');
        Route::get('edit-blog-category', 'ManageContentController@editBlogCategory')->name('admin.edit-blog-category');
        Route::post('edit-blog-category', 'ManageContentController@updateBlogCategory');
        //offer manage
        Route::get('offer', 'ManageContentController@viewAllOffer')->name('admin.offer');
        Route::get('contact-message', 'ManageContentController@allContactMessage')->name('admin.contact-message');
        Route::get('delete-contact-message/{id}', 'ManageContentController@deleteContactMessage')->name('admin.delete-contact-message');
        Route::get('view-contact-message', 'ManageContentController@viewContactMessage')->name('admin.view-contact-message');
        Route::get('mission-vision', 'ManageContentController@missionVision')->name('admin.mission-vision');
        Route::post('mission-vision-conent', 'ManageContentController@saveMissionVision')->name('save.mission-vision-conent');
        Route::get('edit-content', 'ManageContentController@editContent')->name('admin.edit-content');
        Route::post('update-mission-vision', 'ManageContentController@updateContent')->name('update.mission-vision');
        Route::get('delete-content/{id}', 'ManageContentController@deleteContent')->name('admin.delete-content');

        //
        Route::get('customer-share', 'ManageContentController@customerShare')->name('admin.customer-share');
        Route::post('save-customer-share', 'ManageContentController@saveCustomerShare')->name('save.customer-share');
        Route::get('edit-customer-share', 'ManageContentController@editCustomerShare')->name('admin.edit-customer-share');
        Route::post('update-customer-share', 'ManageContentController@updateCustomerShare')->name('update.customer-share');
        Route::get('delete-share/{id}', 'ManageContentController@deleteShare')->name('admin.delete-share');


        Route::get('department-work-flow', 'ManageContentController@addWorkFlow')->name('admin.add-work-flow');
        Route::post('save-work-flow', 'ManageContentController@saveWorkFlow')->name('save.work_flow');
        Route::get('edit-work-flow', 'ManageContentController@editWorkFlow')->name('admin.edit-work-flow');
        Route::post('update-work-flow', 'ManageContentController@updateWorkFlow')->name('update.work-flow');
        Route::get('delete-work-flow/{id}', 'ManageContentController@deleteWorkFlow')->name('admin.delete-work-flow');


        //

        Route::get('edit-offer', 'ManageContentController@editOffer')->name('admin.edit-offer');
        Route::post('update-offer', 'ManageContentController@updateOffer')->name('update.offer-content');

        //onetime order processing
        Route::get('onetime-order', 'OneTimeOrderController@allOneTimePendingOrder')->name('admin.view-onetime-order');
        Route::get('order-confirm/{id}', 'OneTimeOrderController@oneTimeOrderConfirm')->name('onetime-order-confirm');
        Route::get('order-view/{id}', 'OneTimeOrderController@oneTimeOrderView')->name('onetime-order-view');
        Route::post('update-onetime-order-payment', 'OneTimeOrderController@oneTimeOrderPayment')->name('update-onetime-order-payment');
        Route::post('update-courer-info/{order_id}', 'OneTimeOrderController@onetimeOrderCourer')->name('update-courer-info');
        Route::post('onetime-order-confirm-save/{order_id}', 'OneTimeOrderController@onetimeOrderConfirmSave')->name('onetime-order-confirm-save');
        Route::post('onetime-order-confirm-update/{order_id}/{detail_id}', 'OneTimeOrderController@onetimeOrderConfirmUpdate')->name('onetime-order-confirm-update');
        Route::post('update-confirm-order-product/{order_id}', 'OneTimeOrderController@onetimeOrderConfirmUpdateProduct')->name('update-confirm-order-product');
        Route::post('update-confirm-order-address/{order_id}', 'OneTimeOrderController@onetimeOrderConfirmUpdateAddress')->name('update-confirm-order-address');
        Route::post('update-onetime-order-shipping', 'OneTimeOrderController@onetimeOrderShipping')->name('update-onetime-order-shipping');
        Route::get('confirm-order', 'OneTimeOrderController@allOneTimeConfirmOrder')->name('admin.view-confirm-order');
        Route::get('onetime-invoice-print/{order_id}', 'OneTimeOrderController@onetimeOrderPrint')->name('onetime-invoice-print');
        Route::get('order-delivery/{id}', 'OneTimeOrderController@oneTimeOrderDelivery')->name('onetime-order-delivery');
        Route::post('onetime-order-delivery-save/{order_id}', 'OneTimeOrderController@onetimeOrderDeliverySave')->name('onetime-order-delivery-save');
        Route::get('delivery-order', 'OneTimeOrderController@allOneTimeDeliveryOrder')->name('admin.view-delivery-order');
        Route::get('cancel-order', 'OneTimeOrderController@allOneTimeCancelOrder')->name('admin.view-cancel-order');
        Route::get('onetime-order-cancel', 'OneTimeOrderController@confirmCancelOrder')->name('onetime-order-cancel');
        //registered order processing
        //

        Route::get('registered-pending-order', 'RegisteredOrderController@allPendingOrder')->name('admin.registered-pending-order');
        Route::get('registered-confirm-order', 'RegisteredOrderController@allConfirmOrder')->name('admin.registered-confirm-order');
        Route::get('registered-delivery-order', 'RegisteredOrderController@allDeliveryOrder')->name('admin.registered-delivery-order');
        Route::get('registered-cancel-order', 'RegisteredOrderController@allCancelOrder')->name('admin.registered-cancel-order');
        //company profile
        Route::get('company-profile', 'ManageContentController@comopanyProfile')->name('admin.profile');
        Route::get('edit-user', 'ManageContentController@editUser')->name('admin.edit-user');
        Route::post('edit-user', 'ManageContentController@updateUser');
        Route::get('users', 'ManageContentController@adminUser')->name('admin.view-user');
        Route::post('save-user', 'ManageContentController@saveUser')->name('save.user');
        //Report
        //admin.sales-report
        //ReportController
        Route::get('customer-contact-report', 'ReportController@contactReport')->name('admin.contact-report');
        Route::get('daily-sale-report', 'ReportController@dailySaleReport')->name('admin.sales-report');
        Route::get('cupon-report', 'ReportController@cuponReport')->name('admin.cupon-report');
        Route::post('daily-sale-report-search', 'ReportController@dailySaleReportSearch')->name('search.sale-report');
        Route::post('cupon-report-view', 'ReportController@cuponReportView')->name('search.cupon-report-view');
        Route::post('product-sale-report-search', 'ReportController@productSaleReportSearch')->name('search.product-sale-report');
        Route::get('product-sale-report', 'ReportController@productSaleReport')->name('admin.product-sale-report');


    });
