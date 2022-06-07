
<?php


use App\Http\Controllers\ApiController\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;

Route::middleware([
    // 'localeSessionRedirect',
    // 'localizationRedirect',
    // 'localeViewPath',
    'auth',
    'role:super_admin',
])
    ->group(function () {

        Route::resource('/product',ProductController::class );
        Route::resource('/category',\App\Http\Controllers\CategoryController::class );
        Route::resource('/emp',\App\Http\Controllers\EmployeeController::class );
        Route::resource('/sup',\App\Http\Controllers\SupllierController::class );

        

        Route::post('/emp_paid_store',[\App\Http\Controllers\NetprofitController::class,'EmpPaidstore'] );
        Route::put('/emp_paid_update/{id}',[\App\Http\Controllers\NetprofitController::class,'EmpPaidupdate'] );
        Route::delete('/emp_paid_delete/{id}',[\App\Http\Controllers\NetprofitController::class,'EmpPaiddestroy'] );

        

        Route::post('/sup_paid_store',[\App\Http\Controllers\SupllierController::class,'SupPaidstore'] );
        Route::put('/sup_paid_update/{id}',[\App\Http\Controllers\SupllierController::class,'SupPaidupdate'] );
        Route::delete('/sup_paid_delete/{id}',[\App\Http\Controllers\SupllierController::class,'SupPaiddestroy'] );

        

        Route::resource('/net',\App\Http\Controllers\NetprofitController::class );
        Route::get('/categories',[CategoryController::class, 'index']);
        Route::get('/orders',[\App\Http\Controllers\OrderController::class, 'show_orders']);
        Route::get('/cust_orders',[\App\Http\Controllers\CustomerController::class, 'index']);

        
        Route::get('/generate_pdf_profile',[\App\Http\Controllers\CustomerController::class, 'generate_pdf_file']);

        Route::get('/generate_pdf',[\App\Http\Controllers\OrderController::class, 'generate_pdf_file']);
        Route::get('/main',[\App\Http\Controllers\HomeController::class, 'main_page'])->name('main');
        Route::get('/getorderonly',[\App\Http\Controllers\OrderController::class, 'getOrderOnly']);
        Route::get('/getorderonly_prof',[\App\Http\Controllers\CustomerController::class, 'getOrderOnly']);

        
        Route::get('/report',[\App\Http\Controllers\ReportController::class, 'index']);

        Route::get('/purchase',[\App\Http\Controllers\PurchaseController::class, 'index']);
        Route::get('/stock_purchase_edit',[\App\Http\Controllers\PurchaseController::class, 'editStock']);

        Route::delete('/purchase/{id}',[\App\Http\Controllers\PurchaseController::class, 'destroy']);

    });

Route::get('/login',[LoginController::class, 'show_login_form'])->name('login');
Route::post('/login',[LoginController::class, 'process_login'])->name('login');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');


Route::get('/',[\App\Http\Controllers\SellingController::class, 'index'])->name('/');;

Route::get('/order',[\App\Http\Controllers\SellingController::class, 'create_order']);
Route::post('/',[\App\Http\Controllers\SellingController::class, 'create_order']);
Route::delete('/{product_id}',[\App\Http\Controllers\SellingController::class, 'delete_product']);

Route::get('/check_order',[\App\Http\Controllers\SellingController::class, 'check_order_open']);


Route::get('/cart_check',[\App\Http\Controllers\SellingController::class, 'check_order']);

Route::get('/product_options/{product_id}/{color}',[\App\Http\Controllers\SellingController::class, 'product_options']);

Route::post('/create_order',[\App\Http\Controllers\OrderController::class, 'CreateOrder']);



Route::post('/set_price',[\App\Http\Controllers\SellingController::class, 'setPriceProduct']);

Route::get('/get_order_today',[\App\Http\Controllers\SellingController::class, 'get_orders_today']);

Route::get('/get_customer/{phone}',[\App\Http\Controllers\CustomerController::class, 'get_customer_name']);
Route::get('/return_product/{id}',[\App\Http\Controllers\OrderController::class, 'return_order']);



