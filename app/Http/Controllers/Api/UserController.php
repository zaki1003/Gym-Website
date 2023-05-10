<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{

    #=======================================================================================#
    #			                             create                                         #
    #=======================================================================================#
    public function unAuth()
    {
        return view('500');
    }

    #=======================================================================================#
    #			                             index                                         	#
    #=======================================================================================#
    public function index()
    {
        $users = User::all();

        return $users;
    }
    #=======================================================================================#
    #			                        show_profile                                      	#
    #=======================================================================================#
 public function show_profile($user_id)
    {
        $user = User::find($user_id);

        return $user;
        
    }


    public function show_my_profile()
    {
        $user = User::find(Auth::user()->id);
        return  $user;
       
    }




    #=======================================================================================#
    #			                             update                                        	#
    #=======================================================================================#
  

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|string|unique:users,email,' . $user->id,
            'profile_image' => 'mimes:jpg,jpeg',
        ]);

        $user->name = $request->name;
        $user->subscription_start = $request->subscription_start;
        $user->subscription_end = $request->subscription_end;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . \Str::random(30) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imgs');
            $image->move($destinationPath, $name);
            $imageName = 'imgs/' . $name;
            if (isset($user->profile_image))
                File::delete(public_path('imgs/' . $user->profile_image));
            $user->profile_image = $imageName;
        }
        $user->save();
        return $user;
    }



    public function update_my_profile(StoreRequest $request)
    {
      $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . \Str::random(30) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imgs');
            $image->move($destinationPath, $name);
            $imageName = 'imgs/' . $name;
            if ($user->profile_image)
                File::delete(public_path('imgs/' . $user->profile_image));
            $user->profile_image = $imageName;
        }
        $user->save();
        return response($user, 200);
            }
  
  
  

    #=======================================================================================#
    #			                            Ban User                              	        #
    #=======================================================================================#
    public function banUser($userID)
    {
        User::find($userID)->ban([
            'comment' => 'banned user',
                        'expired_at' => '+3 month',
        ]);
        return response()->json([
            'message' => 'success'
        ]);
    }


    #=======================================================================================#
    #			                            listBanned                             	        #
    #=======================================================================================#
    public function listBanned()
    {
        $userRole = Auth::user()->getRoleNames();
        $allBannedUser = 0;
        if ($userRole['0'] == 'admin') {
                $allBannedUser = User::role([ 'coach', 'user'])->onlyBanned()->get();
       
     
        }
        if (count($allBannedUser) <= 0) { //for empty statement
            return [];
        }
        return  $allBannedUser;

    }
    #=======================================================================================#
    #			                                unBan                             	        #
    #=======================================================================================#
    public function unBan($userID)
    {
        $x = User::find($userID)->unban();
        return $this->listBanned();
    }
}
