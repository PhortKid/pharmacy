<?php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpiryReportController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\DisposalProductController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StockAlertController;
use App\Http\Controllers\SupplierPaymentController;
use App\Http\Controllers\PurchaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Category;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Models\Permission;
use App\Http\Controllers\QrCodeController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__.'/auth.php';

Route::get('/register-pharmacy', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register-pharmacy', [RegisterController::class, 'register'])->name('register.pharmacy');
Route::middleware('auth')->group(function () {

Route::resource('/users_management',UserManagementController::class);
//Route::get('/home',function(){ $title="Dashboard"; return view('dashboard.index')->with('title',$title);});
Route::resource('/product_management',ProductsController::class);
Route::resource('/categories', CategoryController::class);
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
Route::get('/reports_stock', [StockReportController::class, 'index'])->name('stock.report');
Route::get('/reports_expiry', [ExpiryReportController::class, 'index'])->name('expiry.report');
Route::get('/disposal', [DisposalProductController::class, 'index'])->name('waste.index');
Route::post('/disposal', [DisposalProductController::class, 'store'])->name('waste.store');
Route::get('/product-report', [ProductReportController::class, 'index'])->name('product.report');


Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
Route::get('/low-stock-report', [StockAlertController::class, 'index'])->name('low_stock_report');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/audit-logs', [DashboardController::class, 'auditLogs'])->name('audit.logs');
Route::resource('suppliers', SupplierController::class);
Route::resource('payments', SupplierPaymentController::class);
Route::resource('purchases', PurchaseController::class);


//roles 
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');


Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'destroy']);
Route::get('/roles/{id}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');
Route::put('/roles/{id}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

});//end of auth 







Route::get('receipt/{id}',function(Request $request, $id){
    $customer=Sale::where('receipt_no',$id)->first();

    if(!$customer){
        return 'Not Found';
    }

    $receiptUrl = url("/receipt/{$customer->receipt_no}");
    $qrCode = QrCode::size(200)
        ->backgroundColor(255, 255, 255)
        ->margin(1)
        ->generate($receiptUrl);

    return view('dashboard.reports.thermal_receipt',compact('customer','qrCode'));
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfilesController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfilesController::class, 'changePassword'])->name('profile.changePassword');
});


Route::get('/trouble',function (){

    return Sale::truncate();
});

Route::get('/add_manual_permission',function (){

    return dd(Permission::all());
});


Route::get('/aadd_demo_user',function(){
 $role=  Role::create([
        'name'=>'admin',
       ]);

   User::create([
    'firstname'=>'phort',
    'lastname'=>'chrispin',
    'email'=>'middlephort@gmail.com',
    'phone'=>'+255787753939',
    'password'=> Hash::make('11111111'),
    'role_id'=>$role->id,
   ]);

    return 'useer added';
});
