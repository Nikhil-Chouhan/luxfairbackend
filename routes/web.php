<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductattributeController;
use App\Http\Controllers\ManufacturerContoller;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GoogleLoginController;

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

// home 
Route::get('/', [FrontendController::class,'index'])->name('frontend.home');
Route::get('/products', [FrontendController::class,'products'])->name('frontend.products');
Route::get('/sectors', [FrontendController::class,'sectors'])->name('frontend.sectors');
Route::get('/supersearch', [FrontendController::class,'supersearch'])->name('frontend.supersearch');
Route::get('/supersearchresult', [FrontendController::class,'supersearchresult'])->name('frontend.supersearchresult');
Route::get('/aftersupersearch', [FrontendController::class,'aftersupersearch'])->name('frontend.aftersupersearch');

Route::get('/manufacturers', [FrontendController::class,'manufacturers'])->name('frontend.manufacturers');
Route::get('/comparisions', [FrontendController::class,'comparisions'])->name('frontend.comparisions');
Route::get('/product_detail/{slug}', [FrontendController::class,'productDetail'])->name('frontend.product_detail');
Route::post('/add_to_compare', [FrontendController::class,'addToCompare'])->name('frontend.add_to_compare');
// frontend.comparisions.clearall
Route::get('/comparisions/clearall', [FrontendController::class,'clearallComparisions'])->name('frontend.comparisions.clearall');
// frontend.comparisions.clear
Route::get('/comparisions/clear/{id}', [FrontendController::class,'clearComparisions'])->name('frontend.comparisions.clear');
Route::get('/login', [FrontendController::class,'login'])->name('frontend.login');
Route::post('/login', [LoginController::class,'login'])->name('frontend.login.submit');
Route::get('/register', [FrontendController::class,'register'])->name('frontend.register');
Route::post('/register/submit', [FrontendController::class,'registerSubmit'])->name('frontend.register.submit');


// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
  

Route::get('password/forget',  function () { 
	return view('pages.forgot-password'); 
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::get('admin/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('admin/login', [LoginController::class,'login'])->name('admin.login');


// logout route
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
	
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route  
	Route::get('/dashboard', function () { 
		return view('pages.dashboard'); 
	})->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
		Route::get('/users', [UserController::class,'index']);
		Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});
	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_category'], function(){
		Route::get('/categories', [CategoryController::class,'index']);
		Route::get('/category/get-list', [CategoryController::class,'getcategoryList']);
		// Route::get('/category/create', [CategoryController::class,'create']);
		Route::post('/category/store', [CategoryController::class,'store'])->name('store-category');
		// Route::get('/category/{id}', [CategoryController::class,'edit']);
		Route::post('/category/update', [CategoryController::class,'update'])->name('update-category');
		Route::get('/category/delete/{id}', [CategoryController::class,'delete']);
	});
	//only those have manage_subcategory permission will get access
	Route::group(['middleware' => 'can:manage_subcategory'], function(){
		Route::get('/subcategories', [SubcategoryController::class,'index']);
		Route::get('/subcategory/get-list', [SubcategoryController::class,'getsubcategoryList']);
		// Route::get('/subcategory/create', [SubcategoryController::class,'create']);
		Route::post('/subcategory/store', [SubcategoryController::class,'store'])->name('store-subcategory');
		// Route::get('/subcategory/{id}', [SubcategoryController::class,'edit']);
		Route::post('/subcategory/update', [SubcategoryController::class,'update'])->name('update-subcategory');
		Route::get('/subcategory/delete/{id}', [SubcategoryController::class,'delete']);
	});

	//only those have manage_product_attributes permission will get access
	Route::group(['middleware' => 'can:manage_product_attributes'], function(){
		Route::get('/product_attributes', [ProductattributeController::class,'index']);
		Route::get('/product_attributes/get-list', [ProductattributeController::class,'getProductAttributesList']);
		Route::post('/product_attributes/store', [ProductattributeController::class,'store'])->name('store-product_attributes');
		Route::post('/product_attributes/update', [ProductattributeController::class,'update'])->name('update-product_attributes');
		Route::get('/product_attributes/delete/{id}', [ProductattributeController::class,'delete']);
	});
	//only those have manage_manufacturers permission will get access
	Route::group(['middleware' => 'can:manage_manufacturers'], function(){
		Route::get('/manufacturers', [ManufacturerContoller::class,'index']);
		Route::get('/manufacturers/get-list', [ManufacturerContoller::class,'getManufacturerList']);
		Route::post('/manufacturers/store', [ManufacturerContoller::class,'store'])->name('store-manufacturers');
		Route::post('/manufacturers/update', [ManufacturerContoller::class,'update'])->name('update-manufacturers');
		Route::get('/manufacturers/delete/{id}', [ManufacturerContoller::class,'delete']);
	});

	Route::group(['middleware' => 'can:manage_sector'], function(){
		Route::get('/sector', [SectorController::class,'index']);
		Route::get('/sector/get-list', [SectorController::class,'getSectorList']);
		Route::post('/sector/store', [SectorController::class,'store'])->name('store-sector');
		Route::post('/sector/update', [SectorController::class,'update'])->name('update-sector');
		Route::get('/sector/delete/{id}', [SectorController::class,'delete']);
	});

	//only those have manage_products permission will get access
	Route::group(['middleware' => 'can:manage_products'], function(){
		Route::get('/products', [ProductController::class,'index'])->name('products.index');
		Route::get('/products/get-list', [ProductController::class,'getProductList']);
		Route::get('/products/create', [ProductController::class,'create'])->name('create-products');
		Route::post('/products/store', [ProductController::class,'store'])->name('store-products');
		Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('edit-products');
		Route::post('/products/update', [ProductController::class,'update'])->name('update-products');
		Route::get('/products/delete/{id}', [ProductController::class,'delete']);
		Route::post('/products/gallerytempimgstore', [ProductController::class,'storegalleryTempImg'])->name('gallerytempimgstore');
		Route::post('/products/gallerytempimgdelete', [ProductController::class,'deletegalleryTempImg'])->name('gallerytempimgdelete');
		Route::get('/products/duplicate/{id}', [ProductController::class,'duplicate'])->name('duplicate-products');

			// import_products
	Route::post('/import_products', [ProductController::class,'importProducts'])->name('import_products');
	Route::post('/import_product_imgs', [ProductController::class,'importProductImages'])->name('import_product_imgs');

	// Route::get('/products', function () { return view('inventory.product.list'); });
	// Route::get('/products/create', function () { return view('inventory.product.create'); }); 
	});

	
	Route::get('get_subcategories/{id}', [CategoryController::class,'getSubcategories']);


	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	
	//only those have manage_menu permission will get access
	Route::group(['middleware' => 'can:manage_menu'], function(){
		Route::get('header_menus',[MenuController::class,'header_index']);
		Route::get('footer_menus',[MenuController::class,'footer_index']);
		// Route::get('menus-show',[MenuController::class,'show']);
		Route::post('header_menus',[MenuController::class,'store'])->name('menus.store');
		Route::post('footer_menus',[MenuController::class,'store'])->name('menus.store');
		// delete 
		Route::post('menus-delete/{id}',[MenuController::class,'destroy']);
	});

	
	//only those have manage_menu permission will get access
	Route::group(['middleware' => 'can:manage_custompages'], function(){
		Route::get('/custompages', [PageController::class,'index'])->name('custompage.index');
		Route::get('/custompages/get-list', [PageController::class,'getPageList']);
		Route::get('/custompages/create', [PageController::class,'create'])->name('create-custompage');
		Route::post('/custompages/store', [PageController::class,'store'])->name('store-custompage');
		Route::get('/custompages/edit/{id}', [PageController::class,'edit']);
		Route::post('/custompages/update', [PageController::class,'update'])->name('update-custompage');
		Route::get('/custompages/delete/{id}', [PageController::class,'delete']);
		// slug generate
		Route::post('/custompages/generate-slug', [PageController::class,'generateSlug']);
	});




















	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example'); 
    });

	
    // API Documentation
    // Route::get('/rest-api', function () { return view('api'); });
    // // Editable Datatable
	// Route::get('/table-datatable-edit', function () { 
	// 	return view('pages.datatable-editable'); 
	// });

    // Themekit demo pages
	// Route::get('/calendar', function () { return view('pages.calendar'); });
	// Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
	// Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
	// Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
	// Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
	// Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
	// Route::get('/form-addon', function () { return view('pages.form-addon'); });
	// Route::get('/form-advance', function () { return view('pages.form-advance'); });
	// Route::get('/form-components', function () { return view('pages.form-components'); });
	// Route::get('/form-picker', function () { return view('pages.form-picker'); });
	// Route::get('/invoice', function () { return view('pages.invoice'); });
	// Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
	// Route::get('/layouts', function () { return view('pages.layouts'); });

	// Route::get('/navbar', function () { return view('pages.navbar'); });
	// Route::get('/profile', function () { return view('pages.profile'); });
	// Route::get('/project', function () { return view('pages.project'); });
	// Route::get('/view', function () { return view('pages.view'); });

	// Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
	// Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
	// Route::get('/taskboard', function () { return view('pages.taskboard'); });
	// Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
	// Route::get('/widget-data', function () { return view('pages.widget-data'); });
	// Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
	// Route::get('/widgets', function () { return view('pages.widgets'); });

	// // themekit ui pages
	// Route::get('/alerts', function () { return view('pages.ui.alerts'); });
	// Route::get('/badges', function () { return view('pages.ui.badges'); });
	// Route::get('/buttons', function () { return view('pages.ui.buttons'); });
	// Route::get('/cards', function () { return view('pages.ui.cards'); });
	// Route::get('/carousel', function () { return view('pages.ui.carousel'); });
	// Route::get('/icons', function () { return view('pages.ui.icons'); });
	// Route::get('/modals', function () { return view('pages.ui.modals'); });
	// Route::get('/navigation', function () { return view('pages.ui.navigation'); });
	// Route::get('/notifications', function () { return view('pages.ui.notifications'); });
	// Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
	// Route::get('/rating', function () { return view('pages.ui.rating'); });
	// Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
	// Route::get('/pricing', function () { return view('pages.pricing'); });


	// // new inventory routes
	Route::get('/inventory', function () { return view('inventory.dashboard'); });
	// Route::get('/pos', function () { return view('inventory.pos'); });
	// Route::get('/sales', function () { return view('inventory.sale.list'); });
	// Route::get('/sales/create', function () { return view('inventory.sale.create'); }); 
	// Route::get('/purchases', function () { return view('inventory.purchase.list'); });
	// Route::get('/purchases/create', function () { return view('inventory.purchase.create'); }); 
	// Route::get('/customers', function () { return view('inventory.people.customers'); }); 
	// Route::get('/suppliers', function () { return view('inventory.people.suppliers'); }); 
	
});


// Route::get('/register', function () { return view('pages.register'); });
// Route::get('/login-1', function () { return view('pages.login'); });
