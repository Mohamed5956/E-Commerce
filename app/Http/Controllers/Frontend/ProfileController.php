<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfoRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ProfileController extends Controller
{
    public function profile($id)
    {
        if(User::where('id',Auth::id())->find($id)){
            $user = User::where('id',Auth::id())->find($id);
            return view('frontend.users.index',['user'=>$user]);
        }else{
            return redirect ('/')->with('status','The link you followed is broken');
        }


    }

    public function edit($id , UserInfoRequest $request)
    {
        // dd($request->all());
        if(Profile::where('id',Auth::id())->find($id)){
            $user = Profile::where('id',Auth::id())->find($id);
            $user->update($request->all());
            return redirect ('profile/'.$id)->with('status','The Information Updated successfully');
        }else{
            return redirect ('/')->with('status','The link you followed is broken');
        }

    }
}
