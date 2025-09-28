<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\ScoringController;
use App\Http\Controllers\DecissionController;

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

Route::get('/', fn () => view('login'));
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/user', [UserController::class, 'getDataUser']);
    Route::get('/detail-user/{id}', [UserController::class, 'getDetailDataUser']);
    Route::post('/create-user', [UserController::class, 'createUser']);
    Route::get('/create-user', fn () => view('form/create-user'));
    Route::put('/update-user/{id}', [UserController::class, 'updateUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
});

Route::middleware(['auth', 'role:super_admin,admin'])->group(function () {
    Route::get('/sales', [SalesController::class, 'getDataSales']);
    Route::get('/detail-sales/{id}', [SalesController::class, 'getDetailDataSales']);
    Route::post('/create-sales', [SalesController::class, 'createSales']);
    Route::get('/create-sales', fn () => view('form/create-sales'));
    Route::put('/update-sales/{id}', [SalesController::class, 'updateSales']);
    Route::delete('/delete-sales/{id}', [SalesController::class, 'deleteSales']);

    Route::get('/categories', [CategoryController::class, 'getDataCategory']);
    Route::get('/detail-category/{id}', [CategoryController::class, 'getDetailDataCategory']);
    Route::post('/create-category', [CategoryController::class, 'createCategory']);
    Route::get('/create-category', fn () => view('form/create-category'));
    Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

    Route::get('/packages', [PackageController::class, 'getDataPackage']);
    Route::get('/detail-package/{id}', [PackageController::class, 'getDetailDataPackage']);
    Route::get('/create-package', [PackageController::class, 'showFormCreatePackage']);
    Route::post('/create-package', [PackageController::class, 'createPackage']);
    Route::put('/update-package/{id}', [PackageController::class, 'updatePackage']);
    Route::delete('/delete-package/{id}', [PackageController::class, 'deletePackage']);

    Route::get('/bookings', [BookingController::class, 'getDataBooking']);
    Route::get('/detail-booking/{id}', [BookingController::class, 'getDetailDataBooking']);
    Route::get('/create-booking', [BookingController::class, 'showFormCreateBooking']);
    Route::post('/create-booking', [BookingController::class, 'createBooking']);
    Route::delete('/delete-booking/{id}', [BookingController::class, 'deleteBooking']);
    Route::put('/update-booking/{id}', [BookingController::class, 'updateBooking']);
    Route::get('/invoice-booking/{id}', [BookingController::class, 'getInvoiceBooking']);

    Route::get('/criterias', [CriteriaController::class, 'getDataCriteria']);
    Route::get('/detail-criteria/{id}', [CriteriaController::class, 'getDetailDataCriteria']);
    Route::get('/create-criteria', fn () => view('form/create-criteria'));
    Route::post('/create-criteria', [CriteriaController::class, 'createCriteria']);
    Route::put('/update-criteria/{id}', [CriteriaController::class, 'updateCriteria']);
    Route::delete('/delete-criteria/{id}', [CriteriaController::class, 'deleteCriteria']);

    Route::get('/sub-criterias', [SubCriteriaController::class, 'getDataSubCriteria']);
    Route::get('/detail-sub-criteria/{id}', [SubCriteriaController::class, 'getDetailSubCriteria']);
    Route::get('/create-sub-criteria', [SubCriteriaController::class, 'showFormCreateSubCriteria']);
    Route::post('/create-sub-criteria', [SubCriteriaController::class, 'createSubCriteria']);
    Route::put('/update-sub-criteria/{id}', [SubCriteriaController::class, 'updateSubCriteria']);
    Route::delete('/delete-sub-criteria/{id}', [SubCriteriaController::class, 'deleteSubCriteria']);

    Route::get('/scorings', [ScoringController::class, 'getDataScoring']);
    Route::get('/detail-scoring/{id}', [ScoringController::class, 'getDetailDataScoring']);
    Route::get('/create-scoring', [ScoringController::class, 'showFormCreateScoring']);
    Route::post('/create-scoring', [ScoringController::class, 'createScoring']);
    Route::put('/update-scoring/{id}', [ScoringController::class, 'updateScoring']);
    Route::delete('/delete-scoring/{id}', [ScoringController::class, 'deleteScoring']);

    Route::get('/report', fn () => view('form/create-report'));
    Route::get('/create-report', [ReportController::class, 'createReport']);
});

Route::middleware(['auth', 'role:customer,super_admin'])->group(function () {
    Route::get('/decision-support', [DecissionController::class, 'calculateSMART']);
});
