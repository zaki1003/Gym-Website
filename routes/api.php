<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\PackagesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AllUsersController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoachController;
use App\Models\User;
use App\Models\TrainingSession;
use App\Models\TrainingPackage;


use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('signin', 'signin');
    Route::post('signup', 'signup');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('update_profile', [AuthController::class, 'updateProfile']);
    Route::get('TrainingSessions/', [TrainingController::class, 'index']);
    Route::get('get_reservations', [TrainingController::class, 'getReservationsForUser']);
});
Auth::routes(['verify'=>true]);
Route::post('email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware('auth:sanctum');
Route::get('email/verify/{id}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
//Traning Sessions Routes

Route::get('subscription_dates',[TrainingController::class,'get_subscription_dates'])->middleware('auth:sanctum');
Route::post('reserveSession/{session}',[TrainingController::class,'reserve_training_session'])->middleware('auth:sanctum');




#=======================================================================================#
#			                    Coach Controller Routes                              	#
#=======================================================================================#


Route::controller(CoachController::class)->group(function () {
    Route::post('/coach/store', 'store')->middleware('auth:sanctum') ;
    Route::put('/coach/update/{coach}', 'update')->middleware('auth:sanctum') ;
    Route::delete('/coach/{id}', 'deleteCoach')->middleware('auth:sanctum') ;
    Route::get('/coach/list', 'list')->middleware('auth:sanctum') ;
    Route::get('/coach/show/{coach}', 'show')->middleware('auth:sanctum') ;
});



#=======================================================================================#
#			                            All users Route                          	    #
#=======================================================================================#
Route::controller(AllUsersController::class)->group(function () {
    Route::get('/allUsers/list', 'list')-> middleware('auth:sanctum') ;
    Route::get('/allUsers/show/{id}', 'show')-> middleware('auth:sanctum') ;
    Route::delete('/allUsers/{id}', 'deleteUser')-> middleware('auth:sanctum') ;
});


#=======================================================================================#
#			                            User Routes                                   	#
#=======================================================================================#
Route::get('/user/{id}', [UserController::class, 'show_profile'])->middleware('auth:sanctum')  ;
Route::put('/user/{user}', [UserController::class, 'update'])->middleware('auth:sanctum')  ;
Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum')  ;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user/show-profile', [UserController::class, 'show_my_profile']);
      Route::put('/user/update-profile', [UserController::class, 'update_my_profile']);
   
});



#=======================================================================================#
#			                            Ban User                              	        #
#=======================================================================================#
Route::get('/banUser/{userID}', [UserController::class, 'banUser'])->middleware('auth:sanctum')  ;
Route::get('/listBanned', [UserController::class, 'listBanned'])->middleware('auth:sanctum')  ;
Route::PATCH('/unBan/{userID}', [UserController::class, 'unBan'])->middleware('auth:sanctum')  ;






#=======================================================================================#
#			                         Training Routes                                  	#
#=======================================================================================#
Route::post('/createSession/sessionsAdmin', [TrainingController::class, 'storeAdmin']) ->middleware('auth:sanctum');
Route::post('/createSession/sessionsCoach', [TrainingController::class, 'storeCoach'])->middleware('auth:sanctum') ;
Route::get('/TrainingSessions/{session}',[TrainingController::class,'showSession'])->middleware('auth:sanctum');
Route::put('/TrainingSessions/{session}',[TrainingController::class,'update'])->middleware('auth:sanctum');
Route::delete('/TrainingSessions/{session}',[TrainingController::class,'deleteSession'])->middleware('auth:sanctum');





//Api Sanctum Token
Route::post('/sanctum/token', function (Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});