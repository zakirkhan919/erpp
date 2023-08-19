<?php

// Admin Route
Route::group(['middleware' => 'auth'], function () {

    // route for seller means product seles man
    Route::get('/seller', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'seller'])->name('seller');
    Route::get('/seller-add', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'sellerAdd'])->name('seller-add');
    Route::get('/seller-edit/{id}', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'sellerEdit'])->name('seller-edit');
    Route::post('/submit-seller', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'submitSeller'])->name('submit-seller');
    Route::post('/update-seller', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'updateSeller'])->name('update-seller');
    Route::post('/get-seller', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'getSeller']); // ajax request
    Route::post('/delete-seller', [App\Modules\Inventory\Http\Controllers\sales\SellerController::class, 'deleteSeller']); // ajax request

    // route for product
    Route::get('/product', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'product'])->name('product');
    Route::get('/product-add', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'productAdd'])->name('product-add');
    Route::get('/product-edit/{id}', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'productEdit'])->name('product-edit');
    Route::post('/submit-product', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'submitProduct'])->name('submit-product');
    Route::post('/update-product', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'updateProduct'])->name('update-product');
    Route::post('/get-product', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'getProduct']); // ajax request
    Route::post('/delete-product', [App\Modules\Inventory\Http\Controllers\product\ProductController::class, 'deleteProduct']); // ajax request

    // routes for purchase
    Route::get('/purchase', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'purchase'])->name('purchase');
    Route::get('/purchase-add', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'purchaseAdd'])->name('purchase-add');
    Route::get('/purchase-edit/{id}', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'purchaseEdit'])->name('purchase-edit');
    Route::post('/submit-purchase', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'submitPurchase'])->name('submit-purchase');
    Route::post('/update-purchase', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'updatePurchase'])->name('update-purchase');
    Route::post('/get-purchase', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'getPurchase']); // ajax request
    Route::post('/delete-purchase', [App\Modules\Inventory\Http\Controllers\purchase\PurchaseController::class, 'deletePurchase']); // ajax request

    // route for coustomer
    Route::get('/customer', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'customer'])->name('customer');
    Route::get('/customer-add', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'customerAdd'])->name('customer-add');
    Route::get('/customer-edit/{id}', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'customerEdit'])->name('customer-edit');
    Route::post('/submit-customer', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'submitcustomer'])->name('submit-customer');
    Route::post('/update-customer', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'updateCustomer'])->name('update-customer');
    Route::post('/get-customer', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'getCustomer']); // ajax request
    Route::post('/delete-customer', [App\Modules\Inventory\Http\Controllers\customer\CustomerController::class, 'deleteCustomer']); // ajax request


    // route for product selling history
    Route::get('/sell', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'sell'])->name('sell');
    Route::get('/sell-add', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'sellAdd'])->name('sell-add');
    Route::get('/sell-edit/{id}', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'sellEdit'])->name('sell-edit');
    Route::post('/submit-sell', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'submitsell'])->name('submit-sell');
    Route::post('/update-sell', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'updateSell'])->name('update-sell');
    Route::post('/get-sell', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'getSell']); // ajax request
    Route::post('/delete-sell', [App\Modules\Inventory\Http\Controllers\sell\SellController::class, 'deleteSell']); // ajax request

});
