<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\EmptyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TrainingPackagesController;
use App\Http\Controllers\ReservationController;

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
#=======================================================================================#
#			                           Home Route                               	    #
#=======================================================================================#
Route::get('/PaymentPackage/stripe/{session}', [StripeController::class, 'stripe'])->name('PaymentPackage.stripe')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:user');
Route::post('/PaymentPackage/stripe', [StripeController::class, 'stripePost'])->name('stripe.post')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:user');
Route::get('/PaymentPackage/purchase_history', [StripeController::class, 'index'])->name('PaymentPackage.purchase_history')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:user');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach|user');
#=======================================================================================#
#			                        Gym Controller Routes                              	#
#=======================================================================================#

Route::get('/gym/training', function () {
    return view('gym.training_session')->name('gym.session');
})->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');

#=======================================================================================#
#			                    Coach Controller Routes                              	#
#=======================================================================================#
Route::controller(CoachController::class)->group(function () {
    Route::get('/coach/create', 'create')->name('coach.create')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::post('/coach/store', 'store')->name('coach.store')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/coach/edit/{coach}', 'edit')->name('coach.edit')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::put('/coach/update/{coach}', 'update')->name('coach.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::delete('/coach/{id}', 'deleteCoach')->name('coach.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/coach/list', 'list')->name('coach.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/coach/show/{coach}', 'show')->name('coach.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
});

#=======================================================================================#
#			                          Admin Routes                                  	#
#=======================================================================================#
Route::group(['middleware' => ['auth', 'logs-out-banned-user']], function () {
    Route::get('/user/show-profile', [UserController::class, 'show_my_profile'])->name('user.show_my_profile')->middleware('logs-out-banned-user')->middleware('role:admin|coach|user');
    Route::get('/user/edit-profile', [UserController::class, 'edit_my_profile'])->name('user.edit_my_profile')->middleware('logs-out-banned-user')->middleware('role:admin|coach|user');
    Route::put('/user/update-profile', [UserController::class, 'update_my_profile'])->name('user.update_my_profile')->middleware('logs-out-banned-user')->middleware('role:admin|coach|user');
    Route::get('/gym/training_session', [TrainingController::class, 'create'])->name('gym.training_session')->middleware('logs-out-banned-user')->middleware('role:admin');
});



#=======================================================================================#
#			                         Training Routes                                  	#
#=======================================================================================#
Route::get('/TrainingSessions/indexAdmin', [TrainingController::class, 'indexAdmin'])->name('TrainingSessions.listSessionsAdmin')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|user');
Route::get('/TrainingSessions/indexCoach', [TrainingController::class, 'indexCoach'])->name('TrainingSessions.listSessionsCoach')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:coach');
Route::get('/TrainingSessions/create_session', [TrainingController::class, 'create'])->name('TrainingSessions.training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');
Route::post('/TrainingSessions/sessionsAdmin', [TrainingController::class, 'storeAdmin'])->name('TrainingSessions.storeAdmin')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');
Route::post('/TrainingSessions/sessionsCoach', [TrainingController::class, 'storeCoach'])->name('TrainingSessions.storeCoach')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');

Route::get('/TrainingSessions/sessions/{session}', [TrainingController::class, 'show'])->name('TrainingSessions.show_training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach|user');
Route::get('/TrainingSessions/{session}/edit', [TrainingController::class, 'edit'])->name('TrainingSessions.edit_training_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');
Route::delete('/TrainingSessions/{session}  ', [TrainingController::class, 'deleteSession'])->name('TrainingSessions.delete_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');
Route::put('/TrainingSessions/{session}', [TrainingController::class, 'update'])->name('TrainingSessions.update_session')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');


#=======================================================================================#
#			                            User Routes                                   	#
#=======================================================================================#
Route::get('/user/{id}', [UserController::class, 'show_profile'])->name('user.admin_profile')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/user/{user}/edit-profile', [UserController::class, 'edit_profile'])->name('user.edit_user')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/user', [UserController::class, 'index'])->name('layouts.user-layout')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
#=======================================================================================#
#			                            Auth Routes                                  	#
#=======================================================================================#
Auth::routes();


#=======================================================================================#
#			                            Ban User                              	        #
#=======================================================================================#
Route::get('/banUser/{userID}', [UserController::class, 'banUser'])->name('user.banUser')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/listBanned', [UserController::class, 'listBanned'])->name('user.listBanned')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::PATCH('/unBan/{userID}', [UserController::class, 'unBan'])->name('user.unBan')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
// Route::get('/unBan/{userID}', [UserController::class, 'unBan'])->name('user.unBan')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
#=======================================================================================#
#			                           Training Packages                              	#
#=======================================================================================#
// Route::get('/trainingPackeges/list', [UserController::class, ''])->name('')->middleware('auth')->middleware('');


#=======================================================================================#
#			                            All users Route                          	    #
#=======================================================================================#
Route::controller(AllUsersController::class)->group(function () {
    Route::get('/allUsers/list', 'list')->name('allUsers.list')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::get('/allUsers/show/{id}', 'show')->name('allUsers.show')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
    Route::delete('/allUsers/{id}', 'deleteUser')->name('allUsers.delete')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
});


#=======================================================================================#
#			                           Attendance route                                  #
#=======================================================================================#
Route::get('/listReservationsAdmin', [ReservationController::class, 'listReservationsAdmin'])->name('reservation')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin');
Route::get('/listReservationsCoach', [ReservationController::class, 'listReservationsCoach'])->name('reservation')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:coach');
Route::get('/listReservationsUser', [ReservationController::class, 'listReservationsUser'])->name('reservation')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:user');

#=======================================================================================#
#			                            empty statement                                 #
#=======================================================================================#
Route::get('/empty', [EmptyController::class, 'empty'])->name('empty.statement')->middleware('logs-out-banned-user')->middleware('role:admin|coach');
#=======================================================================================#
#			                           not Found route                                  #
#=======================================================================================#
Route::get('/unAuth', [EmptyController::class, 'unAuth'])->name('500')->middleware('auth')->middleware('logs-out-banned-user')->middleware('role:admin|coach');

