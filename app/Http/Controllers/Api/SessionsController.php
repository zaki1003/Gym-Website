<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class SessionsController extends Controller
{
    public function index()
    {
        $sessions = TrainingSession::all();
        return $sessions;
    }
    public function showSession($sessionId)
    {
        $sessions = TrainingSession::find($sessionId);
        return [
            'name' => $sessions->name,
            'day' => $sessions->day,
            'starts_at' => $sessions->starts_at,
            'finishes_at' => $sessions->finishes_at
        ];
    }

    public function get_subscription_dates()
    {
        return [
            'subscription_start' => Auth()->user()->subscription_start,
            'subscription_end' => Auth()->user()->subscription_end
        ];
    }

    public function reserve_training_session($sessionId, Request $request)
    {
        $user_id = Auth()->user()->id;
        $session = TrainingSession::find($sessionId);
        $user = user::find($user_id);
        
      //  $reserveTime = Carbon::parse($request->reservation_at)->format('Y-m-d');


        $todayDay = Carbon::now();
   
        $reserveTime = Carbon::now();

    $dateTimestamp1 = strtotime($todayDay->toDateString());
    $dateTimestamp2 = strtotime($request->subscription_end);


        if ($reserveTime >= $session->day) {
            $response = ['Sorry, you can reserve a session that it’s date is before today'];
            return response($response, 200);
        }

      //  if ($dateTimestamp1 <= $dateTimestamp2) {
      

            $reserve = new Reservation([
                'reservation_at' => $reserveTime,
                'user_id' => $user_id,
                'training_session_id' => $sessionId
            ]);
            $reserve->save();
    
            $response = [
                'user' => $user,
                'session' => $session,
            ];
            return response($response, 200);
     //   } else {
    //        $response = ['Please renew your subscription'];
     //       return response($response, 200);
     //   }
    }


    public function getReservationsForUser()
    {
        $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,Date(reservations.reservation_at
        ) as reservation_date,Time(reservations.reservation_at) as reservation_time , users.name as name , users.email as email'))
        ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
 
        ->where('reservations.user_id',Auth::user()->id)

        ->get();
       
       
        return response()->json(
            $history_reservations
        );
    
    }
   /* public function getSessionsForUser(Request $request)
    {
        $user = Auth()->user();
        $history_attendances = Attendance::select(DB::raw('training_sessions.name as training_session_name,gyms.name as gym_name,Date(attendances.attendance_at
        ) as attendance_date,Time(attendances.attendance_at) as attendance_time'))
            ->join('users', 'users.id', '=', 'attendances.user_id')->join('training_sessions', 'training_sessions.id', '=', 'attendances.training_session_id')
            ->join('gyms', "gyms.id", '=', 'users.gym_id')
            ->where('attendances.user_id', '=', $user->id)
            ->where('users.id', '=', $user->id)

            ->get();
        return response()->json(
            $history_attendances
        );
    }*/
}
