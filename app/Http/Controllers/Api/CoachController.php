<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CoachController extends Controller
{
    #=======================================================================================#
    #			                        list Function                                       #
    #=======================================================================================#
    public function list()
    {
        $coachesFromDB = User::role('coach')->withoutBanned()->get();
        if (count($coachesFromDB) <= 0) {
            return view('empty');
        }
        return $coachesFromDB;
    }
    #=======================================================================================#
    #			                        show Function                                       #
    #=======================================================================================#
    public function show($id)
    {
        $singleCoach = User::find($id);
        return  $singleCoach;
    }

  
    #=======================================================================================#
    #			                        store Function                                      #
    #=======================================================================================#
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required'],
            'profile_image' => ['nullable', 'mimes:jpg,jpeg'],
        ]);
        $todayDay = Carbon::now();
        if ($request->hasFile('profile_image') == null) {
            $imageName = 'imgs/defaultImg.jpg';
        } else {
            $image = $request->file('profile_image');
            $name = time() . \Str::random(30) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imgs');
            $image->move($destinationPath, $name);
            $imageName = 'imgs/' . $name;
        }

        $user = new User();
        $user->name = $request->name;
    

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile_image = $imageName;
        $user->assignRole('coach');
        $user->save();
       
        
      
        return response($user, 200);
    }


    #=======================================================================================#
    #			                        Update Function                                     #
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
        $user->email = $request->email;
 


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
        return response($user, 200);
    }

    #=======================================================================================#
    #			                        Delete Function                                     #
    #=======================================================================================#
    public function deleteCoach($id)
    {
        $singleCoach = User::find($id);
        $singleCoach->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
