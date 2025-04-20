<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::prefix('person')->group(function () {
        Route::get('/', [PeopleController::class, 'getAllPerson']);      // GET /person
        Route::get('/{id}', [PeopleController::class, 'getPerson']);     // GET /person/{id}
        Route::post('/', [PeopleController::class, 'createPerson']);     // POST /person
        Route::put('/{id}', [PeopleController::class, 'updatePerson']);  // PUT /person/{id}
        Route::delete('/{id}', [PeopleController::class, 'deletePerson']); // DELETE /person/{id}
        Route::get('/{id}/pets', [PeopleController::class, 'getPersonWithPets']); // GET /person/{id}/pets
    });
    
    Route::prefix('pet')->group(function () {
        Route::get('/', [PetController::class, 'getAllPets']);
        Route::get('/{id}', [PetController::class, 'getPet']);
        Route::post('/', [PetController::class, 'createPet']); 
        Route::put('/{id}', [PetController::class, 'updatePet']); 
        Route::delete('/{id}', [PetController::class, 'deletePet']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'getAllUsers']);      // GET /user
        Route::get('/auth', [UserController::class, 'getUser']);     // GET /user/{id}
        Route::post('/', [UserController::class, 'createUser']);     // POST /user
        Route::put('/{id}', [UserController::class, 'updateUser']);  // PUT /user/{id}
        Route::delete('/{id}', [UserController::class, 'deleteUser']); // DELETE /user/{id}
    });
});





