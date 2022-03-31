<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\userscontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\Designcontroller;
use App\Http\Controllers\websitescontroller;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;

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

// Main Page Route
Route::get('/dashboard', [DashboardController::class,'admindashboard'])->middleware('verified');
Route::get('/customer_dashboard', [DashboardController::class,'customerdashboard'])->middleware('verified');
Route::get('/employ_dashboard', [DashboardController::class,'customerdashboard'])->middleware('verified');


// Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');

Auth::routes(['verify' => true]);
Route::get('/', function (){
    return redirect('login');
});
/* Route Dashboards */
Route::group(['middleware' => ['auth']], function() {
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
});

/* Route users */
Route::get('adduser', [userscontroller::class, 'index'])->name('add_user');
Route::post('store', [userscontroller::class, 'store'])->name('store');
Route::get('listuser', [userscontroller::class, 'create'])->name('list_user');
Route::post('search', [userscontroller::class, 'search'])->name('search');
Route::get('delete/{id}', [userscontroller::class, 'delete'])->name('delete');
Route::get('edituser/{id}', [userscontroller::class, 'edit'])->name('edit');
Route::get('show/{id}', [userscontroller::class, 'show'])->name('show');
Route::post('update/{id}', [userscontroller::class, 'update'])->name('update');
// Route::resource('users', userscontroller::class);
/* Route Product */
Route::get('add_product', [productcontroller::class, 'add_product'])->name('add_product');
Route::get('list_product', [productcontroller::class, 'list_product'])->name('list_product');
Route::get('destroyproduct/{id}', [productcontroller::class, 'destroy'])->name('destroy');
Route::get('editproduct/{id}', [productcontroller::class, 'edit'])->name('edit');
Route::post('updateproduct/{id}', [productcontroller::class, 'update'])->name('update');
Route::post('searchproduct', [productcontroller::class, 'search'])->name('search');
Route::resource('products', productcontroller::class);
/* Route Design*/
Route::get('add_desing', [Designcontroller::class, 'add_desing'])->name('add_desing');
Route::get('list_design', [Designcontroller::class, 'list_design'])->name('list_design');
Route::post('searchdesign', [Designcontroller::class, 'search'])->name('search');
Route::post('searchdesignCategory', [Designcontroller::class, 'searchCategory'])->name('searchCategory');
Route::get('editdesign/{id}', [Designcontroller::class, 'edit'])->name('edit');
Route::post('updatedesign/{id}', [Designcontroller::class, 'update'])->name('update');
Route::get('destroydesign/{id}', [Designcontroller::class, 'destroy'])->name('destroy');
Route::resource('Design', Designcontroller::class);
/* Route website*/
Route::get('add_website', [websitescontroller::class, 'add_website'])->name('add_website');
Route::get('list_website', [websitescontroller::class, 'list_website'])->name('list_website');
Route::post('searchwebsite', [websitescontroller::class, 'search'])->name('search');
Route::post('searchwebCategory', [websitescontroller::class, 'searchCategory'])->name('searchCategory');
Route::get('destroywebsit/{id}', [websitescontroller::class, 'destroy'])->name('destroy');
Route::get('editwebsite/{id}', [websitescontroller::class, 'edit'])->name('edit');
Route::post('updatewebsite/{id}', [websitescontroller::class, 'update'])->name('update');
Route::resource('website', websitescontroller::class);
/* Route categeory*/
Route::get('add_category', [categorycontroller::class, 'add_category'])->name('add_category');
Route::get('list_category', [categorycontroller::class, 'list_category'])->name('list_category');
Route::get('destroy/{id}/{flag}', [categorycontroller::class, 'destroy'])->name('destroy');
Route::get('editcategory/{id}/{flag}', [categorycontroller::class, 'edit'])->name('edit');
Route::post('categoryupdate/{id}/{flag}', [categorycontroller::class, 'update'])->name('update');
Route::resource('category', categorycontroller::class);
/* Route Orders*/
Route::get('add_order', [OrderController::class, 'add_order'])->name('add_order');
Route::get('create/{id}', [OrderController::class, 'create'])->name('create');
Route::post('store1', [OrderController::class, 'store1'])->name('store1');
// Route::post('store', [OrderController::class, 'store'])->name('store');
Route::get('current/{order}', [OrderController::class, 'current'])->name('current');
Route::resource('orders', OrderController::class);
/* Route Adminorder*/
Route::get('list_order', [AdminOrderController::class, 'list_order'])->name('list_order');
Route::post('searchorder', [AdminOrderController::class, 'search'])->name('search');
Route::get('ordersdetail', [AdminOrderController::class, 'ordersdetail'])->name('ordersdetail');
Route::get('dropupdate/{id}/{order}', [AdminOrderController::class, 'dropupdate'])->name('dropupdate');
Route::get('unassingemploy/{id}/{order}', [AdminOrderController::class, 'unassingemploy'])->name('unassingemploy');
Route::get('todo/{order}', [AdminOrderController::class, 'todo'])->name('todo');
Route::get('running/{order}', [AdminOrderController::class, 'running'])->name('running');
Route::get('check/{order}', [AdminOrderController::class, 'check'])->name('check');
Route::get('finished/{order}', [AdminOrderController::class, 'finished'])->name('finished');
Route::get('activated/{order}', [AdminOrderController::class, 'activated'])->name('activated');
Route::get('cancelled/{order}', [AdminOrderController::class, 'cancelled'])->name('cancelled');
Route::get('deleteorder/{id}', [AdminOrderController::class, 'deleteorder'])->name('deleteorder');
Route::get('editorder/{id}', [AdminOrderController::class, 'editorder'])->name('editorder');
Route::get('invoicepdf/{id}', [AdminOrderController::class, 'invoicepdf'])->name('invoicepdf');
Route::post('deleteall', [AdminOrderController::class, 'deleteall'])->name('deleteall');
Route::post('paid', [AdminOrderController::class, 'paid'])->name('paid');
Route::post('restore', [AdminOrderController::class, 'restore'])->name('restore');
Route::post('allinvoice', [AdminOrderController::class, 'allinvoice'])->name('allinvoice');
Route::post('updateorder/{id}', [AdminOrderController::class, 'updateorder'])->name('updateorder');
Route::post('addEmployee/{order}', [AdminOrderController::class, 'addEmployee'])->name('addEmployee');
Route::get('trialdocuments/{order}', [AdminOrderController::class, 'trialDocuments'])->name('trialDocuments');






// Route::resource('Adminorder', AdminOrderController::class);


/* Route Apps */
Route::group(['prefix' => 'app'], function () {
    Route::get('chat', [AppsController::class, 'chatApp'])->name('app-chat');
    Route::get('todo', [AppsController::class, 'todoApp'])->name('app-todo');
    Route::get('calendar', [AppsController::class, 'calendarApp'])->name('app-calendar');
    Route::get('kanban', [AppsController::class, 'kanbanApp'])->name('app-kanban');
    Route::get('invoice/list', [AppsController::class, 'invoice_list'])->name('app-invoice-list');
    Route::get('invoice/preview', [AppsController::class, 'invoice_preview'])->name('app-invoice-preview');
    Route::get('invoice/edit', [AppsController::class, 'invoice_edit'])->name('app-invoice-edit');
    Route::get('invoice/add', [AppsController::class, 'invoice_add'])->name('app-invoice-add');
    Route::get('invoice/print', [AppsController::class, 'invoice_print'])->name('app-invoice-print');
    Route::get('ecommerce/shop', [AppsController::class, 'ecommerce_shop'])->name('app-ecommerce-shop');
    Route::get('ecommerce/details', [AppsController::class, 'ecommerce_details'])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [AppsController::class, 'ecommerce_wishlist'])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [AppsController::class, 'ecommerce_checkout'])->name('app-ecommerce-checkout');
    Route::get('file-manager', [AppsController::class, 'file_manager'])->name('app-file-manager');
    Route::get('user/list', [AppsController::class, 'user_list'])->name('app-user-list');
    Route::get('user/view', [AppsController::class, 'user_view'])->name('app-user-view');
    Route::get('user/edit', [AppsController::class, 'user_edit'])->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
    Route::get('typography', [UserInterfaceController::class, 'typography'])->name('ui-typography');
    Route::get('colors', [UserInterfaceController::class, 'colors'])->name('ui-colors');
});
/* Route UI */

/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
    Route::get('feather', [UserInterfaceController::class, 'icons_feather'])->name('icons-feather');
});
/* Route Icons */

/* Route Cards */
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardsController::class, 'card_basic'])->name('card-basic');
    Route::get('advance', [CardsController::class, 'card_advance'])->name('card-advance');
    Route::get('statistics', [CardsController::class, 'card_statistics'])->name('card-statistics');
    Route::get('analytics', [CardsController::class, 'card_analytics'])->name('card-analytics');
    Route::get('actions', [CardsController::class, 'card_actions'])->name('card-actions');
});
/* Route Cards */

/* Route Components */
Route::group(['prefix' => 'component'], function () {
    Route::get('alert', [ComponentsController::class, 'alert'])->name('component-alert');
    Route::get('avatar', [ComponentsController::class, 'avatar'])->name('component-avatar');
    Route::get('badges', [ComponentsController::class, 'badges'])->name('component-badges');
    Route::get('breadcrumbs', [ComponentsController::class, 'breadcrumbs'])->name('component-breadcrumbs');
    Route::get('buttons', [ComponentsController::class, 'buttons'])->name('component-buttons');
    Route::get('carousel', [ComponentsController::class, 'carousel'])->name('component-carousel');
    Route::get('collapse', [ComponentsController::class, 'collapse'])->name('component-collapse');
    Route::get('divider', [ComponentsController::class, 'divider'])->name('component-divider');
    Route::get('dropdowns', [ComponentsController::class, 'dropdowns'])->name('component-dropdowns');
    Route::get('list-group', [ComponentsController::class, 'list_group'])->name('component-list-group');
    Route::get('modals', [ComponentsController::class, 'modals'])->name('component-modals');
    Route::get('pagination', [ComponentsController::class, 'pagination'])->name('component-pagination');
    Route::get('navs', [ComponentsController::class, 'navs'])->name('component-navs');
    Route::get('tabs', [ComponentsController::class, 'tabs'])->name('component-tabs');
    Route::get('timeline', [ComponentsController::class, 'timeline'])->name('component-timeline');
    Route::get('pills', [ComponentsController::class, 'pills'])->name('component-pills');
    Route::get('tooltips', [ComponentsController::class, 'tooltips'])->name('component-tooltips');
    Route::get('popovers', [ComponentsController::class, 'popovers'])->name('component-popovers');
    Route::get('pill-badges', [ComponentsController::class, 'pill_badges'])->name('component-pill-badges');
    Route::get('progress', [ComponentsController::class, 'progress'])->name('component-progress');
    Route::get('media-objects', [ComponentsController::class, 'media_objects'])->name('component-media-objects');
    Route::get('spinner', [ComponentsController::class, 'spinner'])->name('component-spinner');
    Route::get('toast', [ComponentsController::class, 'toast'])->name('component-toast');
});
/* Route Components */

/* Route Extensions */
Route::group(['prefix' => 'ext-component'], function () {
    Route::get('sweet-alerts', [ExtensionController::class, 'sweet_alert'])->name('ext-component-sweet-alerts');
    Route::get('block-ui', [ExtensionController::class, 'block_ui'])->name('ext-component-block-ui');
    Route::get('toastr', [ExtensionController::class, 'toastr'])->name('ext-component-toastr');
    Route::get('slider', [ExtensionController::class, 'slider'])->name('ext-component-slider');
    Route::get('drag-drop', [ExtensionController::class, 'drag_drop'])->name('ext-component-drag-drop');
    Route::get('tour', [ExtensionController::class, 'tour'])->name('ext-component-tour');
    Route::get('clipboard', [ExtensionController::class, 'clipboard'])->name('ext-component-clipboard');
    Route::get('plyr', [ExtensionController::class, 'plyr'])->name('ext-component-plyr');
    Route::get('context-menu', [ExtensionController::class, 'context_menu'])->name('ext-component-context-menu');
    Route::get('swiper', [ExtensionController::class, 'swiper'])->name('ext-component-swiper');
    Route::get('tree', [ExtensionController::class, 'tree'])->name('ext-component-tree');
    Route::get('ratings', [ExtensionController::class, 'ratings'])->name('ext-component-ratings');
    Route::get('locale', [ExtensionController::class, 'locale'])->name('ext-component-locale');
});
/* Route Extensions */

/* Route Page Layouts */
Route::group(['prefix' => 'page-layouts'], function () {
    Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('layout-collapsed-menu');
    Route::get('full', [PageLayoutController::class, 'layout_full'])->name('layout-full');
    Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('layout-without-menu');
    Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('layout-empty');
    Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('layout-blank');
});
/* Route Page Layouts */

/* Route Forms */
Route::group(['prefix' => 'form'], function () {
    Route::get('input', [FormsController::class, 'input'])->name('form-input');
    Route::get('input-groups', [FormsController::class, 'input_groups'])->name('form-input-groups');
    Route::get('input-mask', [FormsController::class, 'input_mask'])->name('form-input-mask');
    Route::get('textarea', [FormsController::class, 'textarea'])->name('form-textarea');
    Route::get('checkbox', [FormsController::class, 'checkbox'])->name('form-checkbox');
    Route::get('radio', [FormsController::class, 'radio'])->name('form-radio');
    Route::get('switch', [FormsController::class, 'switch'])->name('form-switch');
    Route::get('select', [FormsController::class, 'select'])->name('form-select');
    Route::get('number-input', [FormsController::class, 'number_input'])->name('form-number-input');
    Route::get('file-uploader', [FormsController::class, 'file_uploader'])->name('form-file-uploader');
    Route::get('quill-editor', [FormsController::class, 'quill_editor'])->name('form-quill-editor');
    Route::get('date-time-picker', [FormsController::class, 'date_time_picker'])->name('form-date-time-picker');
    Route::get('layout', [FormsController::class, 'layouts'])->name('form-layout');
    Route::get('wizard', [FormsController::class, 'wizard'])->name('form-wizard');
    Route::get('validation', [FormsController::class, 'validation'])->name('form-validation');
    Route::get('repeater', [FormsController::class, 'form_repeater'])->name('form-repeater');
});
/* Route Forms */

/* Route Tables */
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'table'])->name('table');
    Route::get('datatable/basic', [TableController::class, 'datatable_basic'])->name('datatable-basic');
    Route::get('datatable/advance', [TableController::class, 'datatable_advance'])->name('datatable-advance');
    Route::get('ag-grid', [TableController::class, 'ag_grid'])->name('ag-grid');
});
/* Route Tables */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings', [PagesController::class, 'account_settings'])->name('page-account-settings');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');
    Route::get('faq', [PagesController::class, 'faq'])->name('page-faq');
    Route::get('knowledge-base', [PagesController::class, 'knowledge_base'])->name('page-knowledge-base');
    Route::get('knowledge-base/category', [PagesController::class, 'kb_category'])->name('page-knowledge-base');
    Route::get('knowledge-base/category/question', [PagesController::class, 'kb_question'])->name('page-knowledge-base');
    Route::get('pricing', [PagesController::class, 'pricing'])->name('page-pricing');
    Route::get('blog/list', [PagesController::class, 'blog_list'])->name('page-blog-list');
    Route::get('blog/detail', [PagesController::class, 'blog_detail'])->name('page-blog-detail');
    Route::get('blog/edit', [PagesController::class, 'blog_edit'])->name('page-blog-edit');

    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('login-v1', [AuthenticationController::class, 'login_v1'])->name('auth-login-v1');
    Route::get('login-v2', [AuthenticationController::class, 'login_v2'])->name('auth-login-v2');
    Route::get('register-v1', [AuthenticationController::class, 'register_v1'])->name('auth-register-v1');
    Route::get('register-v2', [AuthenticationController::class, 'register_v2'])->name('auth-register-v2');
    Route::get('forgot-password-v1', [AuthenticationController::class, 'forgot_password_v1'])->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', [AuthenticationController::class, 'forgot_password_v2'])->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', [AuthenticationController::class, 'reset_password_v1'])->name('auth-reset-password-v1');
    Route::get('reset-password-v2', [AuthenticationController::class, 'reset_password_v2'])->name('auth-reset-password-v2');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
});
/* Route Authentication Pages */

/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartsController::class, 'apex'])->name('chart-apex');
    Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chart-chartjs');
    Route::get('echarts', [ChartsController::class, 'echarts'])->name('chart-echarts');
});
/* Route Charts */

// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
});
