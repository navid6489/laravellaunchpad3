
 @php
 if(Auth::user()->roletype=='student')
 {
    $id=Auth::user()->id;
    $studentrequests =  DB::select("SELECT * from adminrequests where roletype='student' and id='$id'");
 }
 else if(Auth::user()->roletype=='teacher')
 {
    $id=Auth::user()->id;
    $teacherrequests =  DB::select("SELECT * from adminrequests where roletype='teacher' and id='$id' ");
 }
 else if(Auth::user()->roletype=='admin')
 {
    $id=Auth::user()->id;
    $countstud= DB::select("SELECT COUNT(*) as cnt_data from adminrequests where flag=0 and roletype='student'");
    $studentrequests =  DB::select("SELECT * from adminrequests where flag=0 and roletype='student'");
    $countteacher= DB::select("SELECT COUNT(*) as cnt_data from adminrequests where flag=0 and roletype='teacher'");
    $teacherrequests =  DB::select("SELECT * from adminrequests where flag=0 and roletype='teacher'");
 }
 
   
        @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if($errors->any())
    <div class="alert" style="padding:20px; background-color:#f44336; color:white;">
    <span style="margin-left: 15px;color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;" class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      {{$errors->first()}}
    </div>
    @endif
    @if(Auth::user()->roletype=='admin')
    
    
    @include('admin.admindashboard')
  
    @elseif(Auth::user()->roletype=='student')
    
        
    @include('student.studentdashboard')



@elseif(Auth::user()->roletype=='teacher')

@include('teacher.teacherdashboard')
    @endif
   
</x-app-layout>


