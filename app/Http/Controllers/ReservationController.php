<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Reservation;
use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function listReservationsAdmin()
    {
        $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,Date(reservations.reservation_at
        ) as reservation_date,Time(reservations.reservation_at) as reservation_time , users.name as name , users.email as email'))
        ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
 

        ->get();
        return view('reservation', [
            'reservations' =>$history_reservations,
        ]);
    }

    public function listReservationsCoach()
    {
        $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,Date(reservations.reservation_at
        ) as reservation_date,Time(reservations.reservation_at) as reservation_time , users.name as name , users.email as email'))
        ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
        ->join('training_session_user', 'training_session_user.training_session_id', '=', 'training_sessions.id')
       ->where('training_session_user.user_id',Auth::user()->id)

        ->get();
        return view('reservation', [
            'reservations' =>$history_reservations,
        ]);
    }

}
