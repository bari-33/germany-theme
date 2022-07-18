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
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\exprationController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\passwordController;
use App\Http\Controllers\chatController;
use App\Http\Controllers\tasksController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\logoutController;
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
/* Route Orders*/
Route::get('add_order', [OrderController::class, 'add_order'])->name('add_order');
Route::get('create/{id}', [OrderController::class, 'create'])->name('create');
Route::post('store1', [OrderController::class, 'store1'])->name('store1');
// Main Page Route
Route::get('/dashboard', [DashboardController::class,'admindashboard'])->middleware('verified');
Route::get('/customer_dashboard', [DashboardController::class,'customerdashboard'])->middleware('verified');
Route::get('/employ_dashboard', [DashboardController::class,'employ_dashboard'])->middleware('verified');
/* Route Login */
Auth::routes(['verify' => true]);
Route::get('/', function (){
    return redirect('login');
});
/* Route Dashboards */
Route::group(['middleware' => ['auth']], function() {

/* Route users */
Route::get('adduser', [userscontroller::class, 'index'])->name('add_user');
Route::get('readall/{ids}', [userscontroller::class, 'readall'])->name('readall');
Route::post('store', [userscontroller::class, 'store'])->name('store');
Route::get('listuser', [userscontroller::class, 'create'])->name('list_user');
Route::post('search', [userscontroller::class, 'search'])->name('search');
Route::get('delete/{id}', [userscontroller::class, 'delete'])->name('delete');
Route::get('edituser/{id}', [userscontroller::class, 'edit'])->name('edit');
Route::get('show/{id}', [userscontroller::class, 'show'])->name('show');
Route::post('update/{id}', [userscontroller::class, 'update'])->name('update');
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
Route::get('current', [OrderController::class, 'current'])->name('current');
Route::get('express/{id}', [OrderController::class, 'express'])->name('express');
Route::post('documents/{id}', [OrderController::class, 'documents'])->name('documents');
Route::get('deledocuments/{id}', [OrderController::class, 'deledocuments'])->name('deledocuments');
Route::get('paypal/{id}', [paymentController::class, 'paypal'])->name('paypal');
Route::get('payment/{id}', [OrderController::class, 'payment'])->name('payment');


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
Route::post('trialdocuments/{order}', [AdminOrderController::class, 'trialDocuments'])->name('trialDocuments');
Route::get('deleteTrialDocument/{id}', [AdminOrderController::class, 'deleteTrialDocument'])->name('deleteTrialDocument');
Route::post('finisheddocuments/{id}', [AdminOrderController::class, 'finisheddocuments'])->name('finisheddocuments');
Route::get('deleteFinishedDocument/{id}', [AdminOrderController::class, 'deleteFinishedDocument'])->name('deleteFinishedDocument');
Route::post('saveNotes/{id}', [AdminOrderController::class, 'saveNotes'])->name('saveNotes');
     /* Route Bills*/
Route::get('list_invoice', [invoiceController::class, 'list_invoice'])->name('list_invoice');
Route::get('invoices/{id}', [invoiceController::class, 'invoices'])->name('invoices');
Route::post('searchinvoice', [invoiceController::class, 'search'])->name('search');
 /* Route Settings*/
 Route::get('EditAccount', [SettingController::class, 'EditAccount'])->name('EditAccount');
 Route::get('MyAccount', [SettingController::class, 'MyAccount'])->name('MyAccount');
 /* Route expration*/
 Route::get('Expration', [exprationController::class, 'Expration'])->name('Expration');
  /* Route FAQ*/
 Route::get('FAQ', [FAQController::class, 'FAQ'])->name('FAQ');
  /* Route tasks*/
 Route::get('tasks', [tasksController::class, 'tasks'])->name('tasks');
 Route::get('emloyeetask', [tasksController::class, 'emloyeetask'])->name('emloyeetask');
 Route::get('checkedtask/{id}/{order}/{loop}', [tasksController::class, 'checkedtask'])->name('checkedtask');
 Route::get('uncheck/{id}/{order}', [tasksController::class, 'uncheck'])->name('uncheck');
 Route::get('checkedemtask/{id}/{order}/{loop}', [tasksController::class, 'checkedemtask'])->name('checkedemtask');
 Route::get('uncheckemtask/{id}/{order}', [tasksController::class, 'uncheckemtask'])->name('uncheckemtask');
 Route::get('seen/{id}', [tasksController::class, 'seen'])->name('seen');
 Route::get('seenemp/{id}', [tasksController::class, 'seenemp'])->name('seenemp');


//  Route::get('allchecked/{order}', [tasksController::class, 'allchecked'])->name('allchecked');



   /* Route Chat*/
   Route::get('Message', [chatController::class, 'Message'])->name('Message');
 Route::post('read', [chatController::class, 'read'])->name('read');
 Route::get('getall/{id}', [chatController::class, 'getall'])->name('getall');
 Route::post('send', [chatController::class, 'send'])->name('send');
 Route::post('readreceipt', [chatController::class, 'readreceipt'])->name('readreceipt');
 /* Change Password*/
 Route::get('index', [passwordController::class, 'index'])->name('index');
 Route::post('chngpassword/{id}', [passwordController::class, 'chngpassword'])->name('chngpassword');
 /* customer Orders*/

 Route::get('customerOrders', [OrderController::class, 'customerOrders'])->name('customerOrders');
 Route::get('getTrialDocuments/{id}', [OrderController::class, 'getTrialDocuments'])->name('getTrialDocuments');
 Route::get('getFinishedDocuments/{id}', [OrderController::class, 'getFinishedDocuments'])->name('getFinishedDocuments');
 /* Route Employeee*/
 Route::get('emporders', [employeeController::class, 'emporders'])->name('emporders');
 Route::get('empbill', [employeeController::class, 'empbill'])->name('empbill');


  /* Route Logout*/
Route::get('logout', [logoutController::class, 'logout'])->name('logout');
// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

});
