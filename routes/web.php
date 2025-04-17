<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationAPIMiddleware;
use App\Http\Middleware\TokenverificationMiddleware;
use Illuminate\Support\Facades\Route;

// user routing

Route::post('/user_registration', [UserController::class, 'UserRegistration']);

Route::post('/user_login',[UserController::class,'UserLogin']);

Route::get('/user_logout',[UserController::class,'UserLogout']);

Route::post('/user_sendotp',[UserController::class,'SendOtpCode']);

Route::post('/user_verify',[UserController::class,'VerifyOtp']);

// Token verification
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post('/user_ResetPassword',[UserController::class,'ResetPassword'])
->middleware([TokenVerificationAPIMiddleware::class]);

// Category
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware([TokenVerificationAPIMiddleware::class]);

// / Customer API
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware([TokenVerificationAPIMiddleware::class]);


// Product API

Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/delete-product",[ProductController::class,'DeleteProduct'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware([TokenVerificationAPIMiddleware::class]);
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware([TokenVerificationAPIMiddleware::class]);

// Invoice
Route::post("/invoice-create",[InvoiceController::class,'invoiceCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/invoice-select",[InvoiceController::class,'invoiceSelect'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/invoice-details",[InvoiceController::class,'InvoiceDetails'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/invoice-delete",[InvoiceController::class,'invoiceDelete'])->middleware([TokenVerificationMiddleware::class]);

// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage',[InvoiceController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);
// Route::get('/reportPage',[ReportController::class,'ReportPage'])->middleware([TokenVerificationMiddleware::class]);
// SUMMARY & Report
Route::get("/summary",[DashboardController::class,'Summary'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/sales-report/{FormDate}/{ToDate}",[ReportController::class,'SalesReport'])->middleware([TokenVerificationMiddleware::class]);

//
