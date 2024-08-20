<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Admin\OrderController;
use App\Http\Controllers\Api\v1\Admin\ReviewController;
use App\Http\Controllers\Api\v1\Admin\VendorController;
use App\Http\Controllers\Api\v1\Admin\PaymentController;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\CustomerController;
use App\Http\Controllers\Api\v1\Admin\QuestionController;
use App\Http\Controllers\Api\v1\Website\WebsiteController;
use App\Http\Controllers\Api\v1\Auth\VendorAuthController;
use App\Http\Controllers\Api\v1\Admin\OrderDetailsController;
use App\Http\Controllers\Api\v1\Admin\StoreController;
use App\Http\Controllers\Api\v1\Auth\CustomerAuthController;
use App\Http\Controllers\Api\v1\Vendor\VendorOrderController;
use App\Http\Controllers\Api\v1\Vendor\VendorStoreController;
use App\Http\Controllers\Api\v1\Vendor\VendorReviewController;
use App\Http\Controllers\Api\v1\Vendor\VendorPaymentController;
use App\Http\Controllers\Api\v1\Vendor\VendorProductController;
use App\Http\Controllers\Api\v1\Vendor\VendorCustomerController;
use App\Http\Controllers\Api\v1\Vendor\VendorQuestionController;
use App\Http\Controllers\Api\v1\Customer\CustomerOrderController;
use App\Http\Controllers\Api\v1\Customer\CustomerReviewController;
use App\Http\Controllers\Api\v1\Customer\CustomerProfileController;
use App\Http\Controllers\Api\v1\Customer\CustomerQuestionController;
use App\Http\Controllers\Api\v1\Vendor\VendorOrderDetailsController;
use App\Http\Controllers\Api\v1\Customer\CustomerOrderDetailsController;
use App\Http\Controllers\Api\v1\CategoryController as CommonCategoryController;
use App\Http\Controllers\Api\v1\Vendor\VendorCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    /** ============== ADMIN - VENDOR - CUSTOMER AUTENTICATION ============== */

    // ----- Admin Authentication  -----  //

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum', 'type.admin']);


    // ----- Vendor Authentication  -----  //

    Route::prefix('vendor')->group(function () {
        Route::post('login', [VendorAuthController::class, 'login']);
        Route::post('logout', [VendorAuthController::class, 'logout'])->middleware('auth:sanctum', 'type.vendor');
        Route::post('register', [VendorAuthController::class, 'register']);
    });


    // ----- Customer Authentication  -----  //

    Route::prefix('customer')->group(function () {
        Route::post('login', [CustomerAuthController::class, 'login']);
        Route::post('logout', [CustomerAuthController::class, 'logout'])->middleware('auth:sanctum', 'type.customer');
        Route::post('register', [CustomerAuthController::class, 'register']);
    });

    /** ==============  End ADMIN - VENDOR - CUSTOMER AUTENTICATION ============== */

    // ============== ALL AUTHENTICATED ROUTES ================= //

    Route::middleware('auth:sanctum')->group(function () {

        // ----- Auth User Route ----- //

        Route::get('user', function (Request $request) {
            return $request->user();
        });

        // ========== ADMIN ROUTES ============ //

        Route::middleware(['type.admin'])->prefix('admin')->group(function () {

            Route::apiResource('vendors', VendorController::class);
            Route::apiResource('stores', StoreController::class);
            Route::apiResource('customers', CustomerController::class);
            Route::apiResource('products', ProductController::class);
            Route::apiResource('orders', OrderController::class);
            Route::apiResource('order-details', OrderDetailsController::class);
            Route::apiResource('reviews', ReviewController::class);
            Route::apiResource('payments', PaymentController::class);
            Route::apiResource('questions', QuestionController::class);
            Route::apiResource('categories', CategoryController::class);

            // ------ exta category routes --- //
            Route::get('get-categories/{type}', [CategoryController::class, 'getCategories']);
            Route::get('get-category-types', [CategoryController::class, 'getCategoryTypes']);
        });


        // ========= VENDOR ROUTES ============  //

        Route::middleware(['type.vendor'])->prefix('vendor')->group(function () {

            // ------- store routes -------
            Route::apiResource('my-stores', VendorStoreController::class)->middleware('vendor.owns:my_store');
            Route::get('store-list', [VendorStoreController::class, 'storeList']);
            // ------- /store routes -------

            // ------- category routes -------
            Route::apiResource('my-categories', VendorCategoryController::class);
            Route::get('category-list', [VendorCategoryController::class, 'categoryList']);
            // ------- /category routes -------

            Route::apiResource('my-products', VendorProductController::class)->middleware('vendor.owns:my_product');
            Route::apiResource('my-customers', VendorCustomerController::class)->middleware('vendor.owns:my_customer');
            Route::apiResource('my-orders', VendorOrderController::class)->middleware('vendor.owns:my_order,order_id');
            Route::apiResource('my-order-details', VendorOrderDetailsController::class)->middleware('vendor.owns:my_order_detail');
            Route::apiResource('my-reviews', VendorReviewController::class)->middleware('vendor.owns:my_review');
            Route::apiResource('my-payments', VendorPaymentController::class)->middleware('vendor.owns:my_payment');
            Route::apiResource('my-questions', VendorQuestionController::class)->middleware('vendor.owns:my_question');
        });


        // ======== CUSTOMER ROUTES ===========  //

        Route::middleware(['type.customer'])->prefix('customer')->group(function () {

            // -----  customer profile routes ------
            Route::get('profile', [CustomerProfileController::class, 'index']);
            Route::put('profile', [CustomerProfileController::class, 'update']);
            Route::put('profile/password', [CustomerProfileController::class, 'updatePassword']);
            // ----- end customer profile routes ------

            // ----- Customer order routes ------
            Route::prefix('orders')->middleware('customer.owns:order')->group(function () {

                Route::get('{order}', [CustomerOrderController::class, 'show']);
                Route::put('{order}', [CustomerOrderController::class, 'update']);
            });
            Route::get('/orders', [CustomerOrderController::class, 'index']);
            Route::post('orders', [CustomerOrderController::class, 'store']);

            // ----- End customer order routes ------

            // ----- Customer order details routes ------
            Route::prefix('order-details')->middleware('customer.owns:order_detail')->group(function () {
                Route::get('/', [CustomerOrderDetailsController::class, 'index']);
                Route::get('{order_detail}', [CustomerOrderDetailsController::class, 'show']);
            });
            // ----- End customer order details routes ------

            // ----- Customer Question routes ------
            Route::prefix('questions')->middleware('customer.owns:question')->group(function () {
                Route::get('/', [CustomerQuestionController::class, 'index']);
                Route::post('/', [CustomerQuestionController::class, 'store']);
                Route::get('{question}', [CustomerQuestionController::class, 'show']);
                Route::put('{question}', [CustomerQuestionController::class, 'update']);
                Route::delete('{question}', [CustomerQuestionController::class, 'destroy']);
            });
            // ----- End customer Question routes ------

            // ----- Customer Review routes ------
            Route::prefix('reviews')->middleware('customer.owns:review')->group(function () {
                Route::get('/', [CustomerReviewController::class, 'index']);
                Route::post('/', [CustomerReviewController::class, 'store']);
                Route::get('{review}', [CustomerReviewController::class, 'show']);
                Route::put('{review}', [CustomerReviewController::class, 'update']);
                Route::delete('{review}', [CustomerReviewController::class, 'destroy']);
            });
            // ----- End customer Review routes ------

        });
    });

    // =============== END ALL AUTHENTICATED ROUTES ===========



    // ============= WEBSITE ROUTES ===============

    /** --- home page ----- */

    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('products/{product}', [WebsiteController::class, 'show']);
    Route::get('shops', [WebsiteController::class, 'shops']);


    /** --- categories ----- */

    Route::prefix('categories')->group(function () {
        Route::get('/', [CommonCategoryController::class, 'index']);
        Route::get('{category}', [CommonCategoryController::class, 'show']);
        Route::get('by/{type}', [CommonCategoryController::class, 'category']);
    });
    Route::get('category-types', [CommonCategoryController::class, 'categoryTypes']);

    Route::get('/categoryProduct/{categoryId}', [WebsiteController::class, 'getCategoryProducts']);
    Route::get('/shopProduct/{shopId}', [WebsiteController::class, 'getShopProducts']);
    Route::post('/cart-items', [WebsiteController::class, 'getCartItems']);

    /** --- product attributes ----- */

    Route::get('product-attributes', [WebsiteController::class, 'productAttributes']);


    // ============= END WEBSITE ROUTES ============
});
