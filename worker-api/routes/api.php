<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {

    // get all statuses
    Route::get("/statuses", [StatusController::class, "index"]);

    // add statuses
    Route::post("/statuses", [StatusController::class, "store"]);

    // get detail statuses
    Route::get("/statuses/{id}", [StatusController::class, "show"]);

    // update statuses
    Route::post("/statuses/{id}", [StatusController::class, "update"]);

    // delete statuses
    Route::delete("/statuses/{id}", [StatusController::class, "destroy"]);

    // get all employees
    Route::get("/employees", [EmployeeController::class, "index"]);

    // add employees
    Route::post("/employees", [EmployeeController::class, "store"]);

    // get detail employees
    Route::get("/employees/{id}", [EmployeeController::class, "show"]);

    // update employees
    Route::post("/employees/{id}", [EmployeeController::class, "update"]);

    // delete employees
    Route::delete("/employees/{id}", [EmployeeController::class, "destroy"]);

    // research by keyword
    Route::get("/employees/search/{name}", [EmployeeController::class, "search"]);

    // find active status in employees
    Route::get("/employees/status/active", [EmployeeController::class, "active"]);

    // find inactive status in employees
    Route::get("/employees/status/inactive", [EmployeeController::class, "inactive"]);

    // find terminated status in employees
    Route::get("/employees/status/terminated", [EmployeeController::class, "terminated"]);
    
    // logout & revoke token
    Route::post('/logout', [AuthController::class, 'logout']);
});

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



