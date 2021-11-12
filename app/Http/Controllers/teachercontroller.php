<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Providers\AccountApproved;
use DB;
class teachercontroller extends Controller
{
    public function teachereditentry(Request $request, $id)
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
    public function teacherapprove(Request $request, $id)
    {
        try {

  
                 // dd($id);
      
        //$assignedteacher=$request->assignedteacher;
       
        $num=1;

        //$result= DB::insert("insert into adminrequests ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects,flag) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects',0)");
        $result=DB::update("update users set flag='$num' where id=$id");
        //dd(DB::getQueryLog());
        if($result!=0)
        {
          event(new AccountApproved($id));
         
        }
          
        return response($result);
        } catch (\Exception $e) {
        
             
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
        
          
        
       
    }
    public function teacherdelete(Request $request, $id)
    {
        try {

             // dd($id);
      
        

        //$result= DB::insert("insert into adminrequests ( name, email, password, roletype, dp, address, currentschool, previousschool, parentsdetails, experienceinyears, expertiseinsubjects,flag) values ('$name','$email','$password','$roleflag', '$filename', '$address', '$currentschool', '$previousschool', '$parentsdetails', '$experienceinyears','$expertiseinsubjects',0)");
        $result=DB::delete("delete from adminrequests where id=$id");
        //dd(DB::getQueryLog());
          
        return response($result);

        } catch (\Exception $e) {
        
             
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
        
          
        
       
    }
}
