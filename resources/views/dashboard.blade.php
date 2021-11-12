
 @php
 if(Auth::user()->role=='student')
 {
    $id=Auth::user()->id;
    $studentrequests =  DB::select("SELECT * from users where role='student' and id='$id'");
 }
 else if(Auth::user()->role=='teacher')
 {
    $id=Auth::user()->id;
    $teacherrequests =  DB::select("SELECT * from users where role='teacher' and id='$id' ");
 }
 else if(Auth::user()->role=='admin')
 {
    $id=Auth::user()->id;
    $countstud= DB::select("SELECT COUNT(*) as cnt_data from users where flag=0 and role='student'");
    $studentrequests =  DB::select("SELECT * from users where flag=0 and role='student'");
    $countteacher= DB::select("SELECT COUNT(*) as cnt_data from users where flag=0 and role='teacher'");
    $teacherrequests =  DB::select("SELECT * from users where flag=0 and role='teacher'");
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
    @if(Auth::user()->role=='admin')
    
    
    @include('admin.admindashboard')
  
    @elseif(Auth::user()->role=='student')
    
        
    @include('student.studentdashboard')



@elseif(Auth::user()->role=='teacher')

@include('teacher.teacherdashboard')
    @endif
   
</x-app-layout>


