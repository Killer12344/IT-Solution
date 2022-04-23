<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PageController extends Controller
{

    # index

    public function index(){
        $questions = Question::with('comment','like','saveQuestion','tag')->get();
        return Inertia::render("Home",compact('questions'));
    }

    # Profile Edit

    public function edit(){
        return Inertia::render("EditUser");
    }

    public function update(Request $request){

        $id = Auth::user()->id;
        $user = User::where('id',$id)->first();

        if ($request->file('photo')) {

            $photo = $request->file('photo');
            $path = 'public/images/profile';
            $photo_name = 'profile_'.uniqid().'_photo.'.$photo->getClientOriginalExtension();
            $photo->storeAs($path,$photo_name);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        if ($request->file('photo')) {
            $user->photo = $photo_name;
        }
        $user->update();

        return redirect()->route('user.edit')->with('message','User updated is success');

    }
}
