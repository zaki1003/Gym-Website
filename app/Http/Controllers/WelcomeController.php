<?php

namespace App\Http\Controllers;

use Carbon\Carbon;


use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    private $userID, $userRole,
        $coaches = 0, $users = 0, $trainingSessions = 0;
    #=======================================================================================#
    #			                               index                                       	#
    #=======================================================================================#
    public function index()
    {
        $this->userID = Auth::id();
        $this->userData = User::find($this->userID);
        $this->userRole = Auth::user()->getRoleNames();

        $todayDay = Carbon::now();
         

        switch ($this->userRole['0']) {
            case 'admin':



                $this->coaches = count(User::role('coach')->get());
                $this->users = count(User::role('user')->get());
                $this->trainingSessions =  count(TrainingSession::where('day', '=', $todayDay->toDateString())->get());


                break;
     
            case 'coach':
                $userOfGym = User::with(['trainingSessions'])->where('id', $this->userID)->first();
                if (count($userOfGym->trainingSessions) <= 0) { //for empty statement
                    return view('empty');
                }
                return view("welcome", [
                    'trainingSessions' => $userOfGym->trainingSessions,
                ]);
                break;
        }

        return view("welcome", [
      
            'coaches' => $this->coaches,
            'users' => $this->users,
            'trainingSessions' => $this->trainingSessions,
        ]);
    }
}
