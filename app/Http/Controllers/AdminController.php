<?php

namespace App\Http\Controllers;
use App\Http\Requests\PasswordRequest;
use App\Rules\HashCheckRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.home.index");
    }

    /**
     * display on user info to update his own password
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function editPassword(User $user){
        return view('admin.users.password',compact('user'));
   }

   public function updatePassword( PasswordRequest $request,User $user)
   {

       $user->update(['password' => Hash::make($request->password)]);
       Auth::logout();
       return redirect("/login");

   }

    /**
     * check if the new password == old password
     * @param $user
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
   protected function checkData($user,$request)
   {
       $user->password = Hash::make($request->password);
       if(!$user->isDirty())
           return redirect()->back()->with("message"," هذه الكلمة تطابق السابقة   ");
   }


   }

