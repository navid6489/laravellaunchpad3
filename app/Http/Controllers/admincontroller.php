<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use Exception;

class admincontroller extends Controller
{


    public function adminstudeditindex(Request $request, $id)
    {
        try {

            $studentrequests =  DB::select("SELECT * from adminrequests where roletype='student' and id='$id'");
            $teacherselect =  DB::select("SELECT * from adminrequests where roletype='teacher' ");
            return view('admin.adminstudentedit')->with(compact('studentrequests','teacherselect'));

        } 
        catch (\Exception $e) {
        
             
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }
       
        
       
    }

    public function adminstudedit(Request $request, $id)
    {
        try {

                // dd($id);
        $filename=$request->file('dp')->getClientOriginalName();
        $name=$request->name;
        $password=Hash::make($request->password);
        $email=$request->email;
        $address=$request->address;
        $currentschool=$request->currentschool;
        $previousschool=$request->previousschool;
        $parentsdetails=$request->parentsdetails;
        $assignedteacher=$request->assignedteacher;
        //dd($assignedteacher);
        $roleflag = $request->role;
        $experienceinyears=$request->experienceinyears;
        $expertiseinsubjects=$request->expertiseinsubjects;
        $num=0;

        $destinationPath = public_path().'/images';
        $extension = $request->file('dp')->getClientOriginalExtension();
        $fileName2 = time() .'.' . $extension;
          $request->file('dp')->move($destinationPath, $fileName2); 
           // $fullpath=  $destinationPath./"."$fileName2";

        //$result= DB::insert("insert into adminrequests ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects,flag) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects',0)");
        $result=DB::update("update adminrequests set name='$name',password='$password',email='$email',address='$address',dp='$fileName2',currentschool='$currentschool',previousschool='$previousschool',parentsdetails='$parentsdetails',assignedteacher='$assignedteacher',flag='$num' where id=$id");
        //dd(DB::getQueryLog());
      


        return response($result);

        } catch (\Exception $e) {
        
             
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
        
       
        
       
    }




    public function adminteachereditindex(Request $request, $id)
    {
        try {

            $teacherrequests =  DB::select("SELECT * from adminrequests where roletype='teacher' and id='$id' ");
            return view('admin.adminteacheredit')->with(compact('teacherrequests'));

        } catch (\Exception $e) {
        
             
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
        
      
        
       
    }

    public function adminteacheredit(Request $request, $id)
    {
        try {

                // dd($id);
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
        $num=0;

        $destinationPath = public_path().'/images';
        $extension = $request->file('dp')->getClientOriginalExtension();
          $fileName2 = time() .'.' . $extension;
          $request->file('dp')->move($destinationPath, $fileName2); 
           // $fullpath=  $destinationPath.$fileName2;

        //$result= DB::insert("insert into adminrequests ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects,flag) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects',0)");
        $result=DB::update("update adminrequests set name='$name',password='$password',email='$email',address='$address',dp='$fileName2',currentschool='$currentschool',previousschool='$previousschool',parentsdetails='$parentsdetails',flag='$num' where id=$id");
        //dd(DB::getQueryLog());
        

        

        return response($result);

        } catch (\Exception $e) {
        
             
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
        
       
        
       
    }
}
