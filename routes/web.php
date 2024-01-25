<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WQController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wasim', [\App\Http\Controllers\ProfileController::class,'wasim'])->name('wasim');

// Route::get('/studentshow',[WQController::class,'studentshow'] )->name('studentshow');
// Route::get('/studentedit/{id}',[WQController::class,'studentedit'] )->name('studentedit');

Route::prefix('students')->controller(\App\Http\Controllers\WQController::class)->name('students.')->group(function () {

    Route::get('/showall', 'showall')->name('showall')->middleware(['permission:product.view']);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:product.edit']);   
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:product.edit']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:product.delete']);
    Route::post('store', 'store')->name('store')->middleware(['permission:product.add']);
    Route::get('/addstudent', 'addstudent')->name('addstudent')->middleware(['permission:product.add']);
});
 
Route::prefix('brands')->controller(\App\Http\Controllers\Product\BrandController::class)->name('brand.')->group(function () {

    Route::get('/list', 'list')->name('list')->middleware(['permission:brand.view']);
    Route::post('store', 'store')->name('store')->middleware(['permission:brand.add']);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:brand.edit']);
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:brand.edit']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:brand.delete']);
});

Route::prefix('vendors')->controller(\App\Http\Controllers\Invoice\VendorController::class)->name('vendor.')->group(function () {

    Route::get('/list', 'list')->name('list')->middleware(['permission:vendor.view']);
    Route::post('store', 'store')->name('store')->middleware(['permission:vendor.add']);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:vendor.edit']);
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:vendor.edit']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:vendor.delete']);
}); 

Route::prefix('products')->controller(\App\Http\Controllers\Product\ProductController::class)->name('product.')->group(function () {
    Route::get('/list', 'list')->name('list')->middleware(['permission:product.view']);
    Route::get('/add', 'addproduct')->name('add')->middleware(['permission:product.add']);
    Route::post('store', 'store')->name('store')->middleware(['permission:product.add']);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:product.edit']);
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:product.edit']);
    Route::get('delete-variation','deletevariation')->name('variation.delete')->middleware(['permission:product.delete']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:product.delete']);

      // group
    //   Route::prefix('productitems')->name('productitem.')->group(function () {    
    //     // Route::get('list/{id}', 'listitem')->name('list')->middleware(['permission:invoice.view']);
    //     // Route::get('edit/{id}', 'edititem')->name('edit')->middleware(['permission:department.edit']);      
    //     // Route::get('delete/{id}','deleteitem')->name('delete')->middleware(['permission:vendor.delete']);

    //     //   Route::prefix('history')->name('history.')->group(function () {    
    //     //       //Route::get('list/{id}', 'listhistory')->name('listhistory')->middleware(['permission:department.edit']);      
    //     //       //Route::get('edit/{id}', 'edithistory')->name('edithistory')->middleware(['permission:department.edit']);
    //     //       //Route::get('delete/{id}', 'deletehistory')->name('deletehistory')->middleware(['permission:department.edit']);
    //     //   });
    //   });
}); 

Route::prefix('productitems')->controller(\App\Http\Controllers\Product\ProductItemController::class)->name('productitem.')->group(function () {
     Route::get('list/{id}', 'list')->name('list')->middleware(['permission:invoice.view']);
     Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:department.edit']);
     Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:vendor.delete']);
     Route::get('get-employee','getemployee')->name('get.employee');
     Route::post('assign-employee','assignemployee')->name('assign.employee');


}); 

Route::prefix('producthistory')->controller(\App\Http\Controllers\Product\ProductHistoryController::class)->name('producthistory.')->group(function () {
     Route::get('list/{id}', 'list')->name('list')->middleware(['permission:department.edit']);   
     Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:department.edit']);
     Route::get('delete/{id}', 'delete')->name('delete')->middleware(['permission:department.edit']);
}); 


// .com/products/list
// .com/invoices/productitems/list/53
Route::prefix('invoices')->controller(\App\Http\Controllers\Invoice\InvoiceController::class)->name('invoice.')->group(function () {
    Route::get('/list', 'list')->name('list')->middleware(['permission:invoice.view']);
    Route::get('/add', 'addinvoicelist')->name('add')->middleware(['permission:invoice.add']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:vendor.delete']);
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:vendor.edit']);
    Route::post('store', 'store')->name('store')->middleware(['permission:invoice.add']);
    Route::get('edit/{id}','edit')->name('edit');



    Route::get('get-product-price', 'getproductprice')->name('get.product.price')->middleware(['permission:invoice.add']);

    //g-1    
    Route::get('edititem/{id}', 'edititem')->name('edititem')->middleware(['permission:department.edit']);
    Route::get('deleteitem/{id}','deleteitem')->name('deleteitem')->middleware(['permission:vendor.delete']);

    // group
    Route::prefix('productitems')->name('productitem.')->group(function () {    
    //   Route::get('list/{id}', 'listitem')->name('list')->middleware(['permission:invoice.view']);
    //   Route::get('edit/{id}', 'edititem')->name('edit')->middleware(['permission:department.edit']);      
    //   Route::get('delete/{id}','deleteitem')->name('delete')->middleware(['permission:vendor.delete']);
      //Route::get('history/{id}', 'history')->name('history')->middleware(['permission:department.edit']);
      Route::prefix('history')->name('history.')->group(function () {    
           Route::get('list/{id}', 'listhistory')->name('listhistory')->middleware(['permission:department.edit']);      
           Route::post('add', 'addhistory')->name('addhistory')->middleware(['permission:department.edit']);
           Route::get('delete/{id}', 'deletehistory')->name('deletehistory')->middleware(['permission:department.edit']);      
           Route::get('edit/{id}', 'edithistory')->name('edithistory')->middleware(['permission:department.edit']);
           Route::post('update/{id}', 'updatehistory')->name('update')->middleware(['permission:vendor.edit']);
        });

      
    });
    
    

});


Route::prefix('departments')->controller(\App\Http\Controllers\System\DepartmentController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.department.')->group(function () {

    Route::get('/list', 'list')->name('list')->middleware(['permission:department.view']);
    Route::post('store', 'store')->name('store')->middleware(['permission:department.add']);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware(['permission:department.edit']);
    Route::post('update/{id}', 'update')->name('update')->middleware(['permission:department.edit']);
    Route::get('delete/{id}','delete')->name('delete')->middleware(['permission:department.delete']);
});

Route::prefix('role')->controller(\App\Http\Controllers\System\RolesController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.role.')->group(function () {

    Route::get('list', 'list')->name('list');
    Route::post('create', 'create')->name('create');
    Route::post('update', 'update')->name('update');
    Route::get('delete/{id}', 'delete')->name('delete');
});

Route::prefix('permission')->controller(\App\Http\Controllers\System\PermissionsController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.permission.')->group(function () {

    Route::get('list', 'list')->name('list');
    Route::post('create', 'create')->name('create');
    Route::post('update', 'update')->name('update');
    Route::get('delete/{id}', 'delete')->name('delete');
    Route::post('add_module', 'add_module')->name('add_module');
});

Route::prefix('user')->controller(\App\Http\Controllers\System\UserController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.user.')->group(function () {

    Route::get('list', 'list')->name('list');
    Route::get('detail/{id}', 'detail')->name('detail');
    Route::post('add', 'add')->name('add');
    Route::post('update', 'update')->name('update');
    Route::get('delete/{id}', 'delete')->name('delete');

    Route::post('assign_role1', 'assign_role1')->name('assign_role1');
//
//    Route::get('getlist', 'getlist')->name('getlist');
//
//    Route::get('impersonate/{user_id}', 'impersonate')->name('impersonate');
//
//    Route::post('/update_target',arget 'update_t')->name('update_target');
//
    Route::get('disable/login/{id}', 'disable_enable_login')->name('disable_enable_login');
});

Route::prefix('profile')->controller(\App\Http\Controllers\System\ProfileController::class)->name('profile.')->group(function () {

    Route::get('/', 'list')->name('list');
    Route::post('edit-profile/{id}', 'editprofile')->name('edit.profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return abort(404);
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
