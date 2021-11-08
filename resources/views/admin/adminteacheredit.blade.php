
<x-app-layout>

    @if($errors->any())
    <div class="alert" style="padding:20px; background-color:#f44336; color:white;">
    <span style="margin-left: 15px;color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;" class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      {{$errors->first()}}
    </div>
    @endif
<h2>Edit Teacher Profile</h2>

<form id="loginform"  method="post" enctype="multipart/form-data">
    @csrf
    @foreach ($teacherrequests as $teacherrequests2)
    <div class="container">
      <div class="row">
          <label for="name"><b>name</b></label>
          <input type="text"  class="form-control" placeholder="Enter Username" id="name" name="name" value="{{$teacherrequests2->name}}" required>
      </div>
    
      <div class="row">
          <label for="password"><b>Password</b></label>
          <input type="password"  class="form-control" placeholder="Enter Password" name="password" id="password" value="{{$teacherrequests2->password}}" required>
      </div>
      <div class="row">
          <label for="email"><b>email</b></label>
          <input type="email"  class="form-control" placeholder="Enter email" name="email" id="email" value="{{$teacherrequests2->email}}" required>
      </div>
     
      <div class="row">
          <label for="address">address:</label>
          <textarea id="address"  class="form-control" name="address" rows="4" cols="50">{{$teacherrequests2->address}}</textarea>
      </div>
     
  <div class="row">
      <label for="dp"><b>profile picture</b></label>
      <input type="file"  name="dp" id="dp" required>
      <input type="text"  class="form-control"  name="dp2" id="dp2" value="{{$teacherrequests2->dp}}">
      <img src=" {{url('/'.'images'.'/'.$teacherrequests2->dp)}}" alt="Girl in a jacket" width="200" height="200">
  </div>
    
      <div class="row">
          <label for="currentschool"><b>currentschool</b></label>
          <input type="text"  class="form-control" placeholder="Enter current school" name="currentschool" id="currentschool" value="{{$teacherrequests2->currentschool}}" required>
      </div>
     
      <div class="row">
          <label for="previousschool"><b>previousschool</b></label>
          <input type="text"  class="form-control" placeholder="Enter previous school" name="previousschool" id="previousschool" value="{{$teacherrequests2->previousschool}}" required>
      </div>
      
     <div class="row">
      <label for="experienceinyears"><b>experienceinyears</b></label>
      <input type="text"  class="form-control" placeholder="Enter experience in years" name="experienceinyears" id="experienceinyears" value="{{$teacherrequests2->experienceinyears}}" required>
     </div>
     
      <div class="row">
      <label for="expertiseinsubjects"><b>expertiseinsubjects</b></label>
      <input type="text" class="form-control" placeholder="Enter expertise in subjects" name="expertiseinsubjects" id="expertiseinsubjects" value="{{$teacherrequests2->expertiseinsubjects}}" required>
     </div>
     
     
     
     <button type="submit" class="btn btn-success mt-2">Update</button>
     
    </div>
  
    @endforeach
  </form>

  


  <script>
  $("#loginform").submit(function (event) {
    var id="<?php echo $teacherrequests[0]->id?>";
    
    var formData = new FormData(document.getElementById("loginform"));
$.ajax({
headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

type: "POST",
url: "<?php echo url('/adminteacheredit')?>/"+id,
data: formData,



            contentType: false,
            processData: false,
 success: function(result){

        //console.log(result);
      if(result==1){
          
        alert("Update Successfull");
        $("#loginform")[0].reset();
        window.location.href='<?php echo url('/dashboard')?>';
          }
          else
          {
           
            alert("Update Failed");
          }
}

})

event.preventDefault();
});
</script>


</x-app-layout>