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
    
            foreach ($trainingSessions as $user) {

                $user->starts_at =            Carbon::parse($user->starts_at)->format('H:i');
                $user->finishes_at =            Carbon::parse($user->finishes_at)->format('H:i');
            }
            return $trainingSessions;       
        
        }else{   
                
                      
        $trainingSessions = DB::table('training_sessions')
        ->join('training_session_user', 'training_session_user.training_session_id', '=', 'training_sessions.id')
        ->join('users', 'users.id', '=', 'training_session_user.user_id')
        ->join('reservations', 'reservations.training_session_id', '=', 'training_sessions.id')
        ->where('reservations.user_id','!=' ,Auth::user()->id)
       ->select('users.name as coach_name', 'training_sessions.*','reservations.user_id' )
        ->get();
            
            
        //    $sessions = TrainingSession::all();
              
              
        foreach ($trainingSessions as $user) {

            $user->starts_at =            Carbon::parse($user->starts_at)->format('H:i');
            $user->finishes_at =            Carbon::parse($user->finishes_at)->format('H:i');
        }
              
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
        return response()->json([
            'message' => 'success'
        ]);
    }




    public function storeCoach(Request $request)
    {



        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'day' => ['required', 'date', 'after_or_equal:today'],
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
        $user_id = Auth::user()->id;
        $id = $session->id;
        $data = array('user_id' => $user_id, "training_session_id" => $id);
        DB::table('training_session_user')->insert($data);

        return response()->json([
            'message' => 'success'
        ]);
    }



    public function store(Request $request)
    {

    $userRole = Auth::user()->getRoleNames();
      
    if ($userRole['0'] == 'admin') {

        storeAdmin( $request);
    }
else storeCoach($request);
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
    $dateTimestamp2 = strtotime($user->subscription_end);


        if ($reserveTime >= $session->day) {
            $response = ['Sorry, you can reserve a session that it’s date is before today'];
    
            return response($response, 200);
  
        }

      //  if ($dateTimestamp1 <= $dateTimestamp2) {
      


        $todayDay = Carbon::now();
   
 

        $dateTimestamp1 = strtotime($todayDay->toDateString());
        $dateTimestamp2 = strtotime($user->subscription_end);
    
      
        if ( $dateTimestamp1 > $dateTimestamp2)
                    return response()->json([      'message' => 'Please renew your subscription'  ]);



            $reserve = new Reservation([
                'reservation_at' => $reserveTime,
                'user_id' => $user_id,
                'training_session_id' => $sessionId
            ]);
            $reserve->save();
    
            return response()->json([
                'message' => 'success'
            ]);


     //   } else {
    //        $response = ['Please renew your subscription'];
     //       return response($response, 200);
     //   }
    }


    public function getReservations()
    {

        $userRole = Auth::user()->getRoleNames();
      
        if ($userRole['0'] == 'admin') {


            $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,reservations.reservation_at
            as reservation_date,reservations.reservation_at as reservation_time , users.name as name , users.email as email'))
            ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
     
           
    
            ->get();
           
           
            return response()->json(
                $history_reservations
            );
            }

            if ($userRole['0'] == 'coach') {


             
             
                $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,reservations.reservation_at
                as reservation_date,reservations.reservation_at as reservation_time , users.name as name , users.email as email'))
                ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
                ->join('training_session_user', 'training_session_user.training_session_id ', '=', 'training_sessions.id')
         
            
                ->where('training_session_user.user_id',Auth::user()->id)
        
                ->get();
               
               
                return response()->json(
                    $history_reservations
                );
                }

        if ($userRole['0'] == 'user') {


        $history_reservations=Reservation::select(DB::raw('training_sessions.name as training_session_name,training_sessions.day as training_session_date,reservations.reservation_at
        as reservation_date,reservations.reservation_at as reservation_time , users.name as name , users.email as email'))
        ->join('users', 'users.id', '=', 'reservations.user_id')->join('training_sessions', 'training_sessions.id', '=', 'reservations.training_session_id')
 
        ->where('reservations.user_id',Auth::user()->id)

        ->get();
       
       
        return response()->json(
            $history_reservations
        );
        }
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

    
        if (count(DB::select("select * from reservations where training_session_id = $id")) != 0) {
           return response()->json(['message' => "You can't edit this session because there are users in it!"]);

        }



        TrainingSession::where('id', $id)->update([

            'name' => $request->all()['name'],
            'day' => $request->day,
            'starts_at' => $request->starts_at,
            'finishes_at' => $request->finishes_at,



        ]);
        return response()->json([
            'message' => 'success'
        ]);
    }
    #=======================================================================================#
    #			                             destroy                                       	#
    #=======================================================================================#
    public function deleteSession($id)
    {


        if (count(DB::select("select * from reservations where training_session_id = $id")) == 0) {
         $trainingSession = TrainingSession::findorfail($id);

           $trainingSession->delete();
           return response()->json([
                'message' => 'success'
            ]);


        } else {
            return response()->json(['message' => 'error']);
        }
    }
}
