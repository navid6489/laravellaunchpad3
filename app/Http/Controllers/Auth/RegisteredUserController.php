<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $filename=$request->file('dp')->getClientOriginalName();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roletype' => $request->role,
            'dp'=>$filename,
            'address'=>$request->address,
            'currentschool'=>$request->currentschool,
            'previousschool'=>$request->previousschool,
            'parentsdetails'=>$request->parentsdetails,
            'experienceinyears'=>$request->experienceinyears,
            'expertiseinsubjects'=>$request->expertiseinsubjects,
        ]);

     /*   $filename=$request->file('dp')->getClientOriginalName();
        $name=$request->name;
        $password=Hash::make($request->password);
        $email=$request->email;
        $address=$request->address;
        $currentschool=$request->currentschool;
        $previousschool=$request->previousschool;
        $parentsdetails=$request->parentsdetails;
       // $assignedteacher=$request->assignedteacher;
        $roleflag = $request->role;
        $experienceinyears=$request->experienceinyears;
        $expertiseinsubjects=$request->expertiseinsubjects;

        $result= DB::insert("insert into users ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects')");
       */

      $filename=$request->file('dp')->getClientOriginalName();
      $name=$request->name;
      $password=Hash::make($request->password);
      $email=$request->email;
      $address=$request->address;
      $currentschool=$request->currentschool;
      $previousschool=$request->previousschool;
      $parentsdetails=$request->parentsdetails;
     // $assignedteacher=$request->assignedteacher;
      $roleflag = $request->role;
      $experienceinyears=$request->experienceinyears;
      $expertiseinsubjects=$request->expertiseinsubjects;
  

      $result= DB::insert("insert into adminrequests ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects')");
        
            event(new Registered($user));

            Auth::login($user);
    
            return redirect(RouteServiceProvider::HOME);
        
       
    }
}
