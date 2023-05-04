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

class TrainingController extends Controller
{
    public function index()
    {
  

        $userRole = Auth::user()->getRoleNames();
      
        if ($userRole['0'] == 'coach') {


            $trainingSessions = DB::table('training_sessions')
            ->join('training_session_user', 'training_session_user.training_session_id', '=', 'training_sessions.id')
            ->join('users', 'users.id', '=', 'training_session_user.user_id')
            ->where('users.id',Auth::user()->id)
           ->select('users.name as coach_name', 'training_sessions.*')
            ->get();
    

            return $trainingSessions;       
        
        }else{   
                
                      
        $trainingSessions = DB::table('training_sessions')
        ->join('training_session_user', 'training_session_user.training_session_id', '=', 'training_sessions.id')
        ->join('users', 'users.id', '=', 'training_session_user.user_id')
     
       ->select('users.name as coach_name', 'training_sessions.*')
        ->get();
            
            
        //    $sessions = TrainingSession::all();
              
              
              
              
                return $trainingSessions;}

  

    }





    
    public function showSession($sessionId)
    {
        $sessions = TrainingSession::find($sessionId);
       /* return [
            'name' => $sessions->name,
            'day' => $sessions->day,
            'starts_at' => $sessions->starts_at,
            'finishes_at' => $sessions->finishes_at
        ];*/
        return $sessions;
    }

    public function get_subscription_dates()
    {
        return [
            'subscription_start' => Auth()->user()->subscription_start,
            'subscription_end' => Auth()->user()->subscription_end
        ];
    }



    #=======================================================================================#
    #			                             store                                         	#
    #=======================================================================================#
    public function storeAdmin(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'day' => ['required', 'date', 'after_or_equal:today'],
            'user_id'=> ['required'],
            'starts_at' => ['required'],
            'finishes_at' => ['required'],

        ]);



        $validate_old_seesions = TrainingSession::where('day', '=', $request->day)->where("starts_at", "!=", null)->where("finishes_at", "!=", null)->where(function ($q) use ($request) {
            $q->whereRaw("starts_at = '$request->starts_at' and finishes_at ='$request->finishes_at'")
                ->orwhereRaw("starts_at < '$request->starts_at' and finishes_at > '$request->finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and starts_at < '$request->finishes_at'")
                ->orwhereRaw("finishes_at > '$request->starts_at' and finishes_at < '$request->finishes_at'")
                ->orwhereRaw("'$request->starts_at' > '$request->finishes_at'")
                ->orwhereRaw("'starts_at' > 'finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and finishes_at < '$request->finishes_at'");
        })->get()->toArray();


        if (count($validate_old_seesions) > 0)
         
            return response()->json(['message' => 'please check your time']);
        $requestData = request()->all();
        $session = TrainingSession::create($requestData);
        $user_id = $request->input('user_id');
        $id = $session->id;
        $data = array('user_id' => $user_id, "training_session_id" => $id);
        DB::table('training_session_user')->insert($data);

        return response()->json(['success' => 'Record Stored successfully!']);
    }



    public function storeCoach(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'day' => ['required', 'date', 'after_or_equal:today'],
            'starts_at' => ['required'],
            'finishes_at' => ['required'],
            'user_id'=> ['required'],

        ]);



        $validate_old_seesions = TrainingSession::where('day', '=', $request->day)->where("starts_at", "!=", null)->where("finishes_at", "!=", null)->where(function ($q) use ($request) {
            $q->whereRaw("starts_at = '$request->starts_at' and finishes_at ='$request->finishes_at'")
                ->orwhereRaw("starts_at < '$request->starts_at' and finishes_at > '$request->finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and starts_at < '$request->finishes_at'")
                ->orwhereRaw("finishes_at > '$request->starts_at' and finishes_at < '$request->finishes_at'")
                ->orwhereRaw("'$request->starts_at' > '$request->finishes_at'")
                ->orwhereRaw("'starts_at' > 'finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and finishes_at < '$request->finishes_at'");
        })->get()->toArray();


        if (count($validate_old_seesions) > 0)
        return response()->json(['message' => 'please check your time']);
        $requestData = request()->all();
        $session = TrainingSession::create($requestData);
        $user_id = $request->input('user_id');
        $id = $session->id;
        $data = array('user_id' => $user_id, "training_session_id" => $id);
        DB::table('training_session_user')->insert($data);

        return response()->json(['success' => 'Record Created successfully!']);
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
    #=======================================================================================#
    #			                             update                                         #
    #=======================================================================================#
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'day' => ['required', 'string'],
            'starts_at' => [
                'required'
            ],
            'finishes_at' => [
                'required'
            ],

        ]);

        $validate_old_seesions = TrainingSession::where('day', '=', $request->day)->where("starts_at", "!=", null)->where("finishes_at", "!=", null)->where(function ($q) use ($request) {
            $q->whereRaw("starts_at = '$request->starts_at' and finishes_at ='$request->finishes_at'")
                ->orwhereRaw("starts_at < '$request->starts_at' and finishes_at > '$request->finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and starts_at < '$request->finishes_at'")
                ->orwhereRaw("finishes_at > '$request->starts_at' and finishes_at < '$request->finishes_at'")
                ->orwhereRaw("starts_at > '$request->starts_at' and finishes_at < '$request->finishes_at'");
        })->where('id', '!=', $id)->get()->toArray();

        if (count($validate_old_seesions) > 0)
 
            return response()->json(['message' => 'Time invalid']);

        if (count(DB::select("select * from training_session_user where training_session_id = $id")) != 0) {
           return response()->json(['message' => "You can't edit this session because there are users in it!"]);

        }



        TrainingSession::where('id', $id)->update([

            'name' => $request->all()['name'],
            'day' => $request->day,
            'starts_at' => $request->starts_at,
            'finishes_at' => $request->finishes_at,



        ]);
        return response()->json(['success' => 'Record Udated successfully!']);
    }
    #=======================================================================================#
    #			                             destroy                                       	#
    #=======================================================================================#
    public function deleteSession($id)
    {


        if (count(DB::select("select * from training_session_user where training_session_id = $id")) == 0) {
            $trainingSession = TrainingSession::findorfail($id);
            $trainingSession->delete();
            return response()->json([
                'success' => '1'
            ]);
        } else {
            return response()->json(['failed' => '0']);
        }
    }
}
