

<h2>Student Profile</h2>

@if($studentrequests[0]->flag==1)
<form id="loginform"  method="post" enctype="multipart/form-data">
  @csrf
  @foreach ($studentrequests as $studentrequests2)
  <div class="container">
    <div class="row">
        <label for="name"><b>name</b></label>
        <input class="form-control" type="text" placeholder="Enter Username" id="name" name="name" value="{{$studentrequests2->name}}" required>
    </div>
  
    <div class="row">
        <label for="password"><b>Password</b></label>
        <input class="form-control" type="password" placeholder="Enter Password" name="password" id="password" value="{{$studentrequests2->password}}" required>
    </div>
    <div class="row">
        <label for="email"><b>email</b></label>
        <input class="form-control" type="email" placeholder="Enter email" name="email" id="email" value="{{$studentrequests2->email}}" required>
    </div>
   
    <div class="row">
        <label for="address">address:</label>
        <textarea class="form-control" id="address" name="address" rows="4" cols="50">{{$studentrequests2->address}}</textarea>
    </div>
   
<div class="row">
    <label for="dp"><b>profile picture</b></label>
    <input class="form-control" type="file"  name="dp" id="dp" required>
    <input class="form-control" type="text"  name="dp2" id="dp2" value="{{$studentrequests2->dp}}">
    <img src=" {{url('/'.'images'.'/'.$studentrequests2->dp)}}" alt="Girl in a jacket" width="200" height="200">
</div>
  
    <div class="row">
        <label for="currentschool"><b>currentschool</b></label>
        <input class="form-control" type="text" placeholder="Enter current school" name="currentschool" id="currentschool" value="{{$studentrequests2->currentschool}}" required>
    </div>
   
    <div class="row">
        <label for="previousschool"><b>previousschool</b></label>
        <input class="form-control" type="text" placeholder="Enter previous school" name="previousschool" id="previousschool" value="{{$studentrequests2->previousschool}}" required>
    </div>
    <div class="row">
        <label for="parentsdetails"><b>parentsdetails</b></label>
    <textarea class="form-control" id="parentsdetails" name="parentsdetails" rows="4" cols="50">{{$studentrequests2->parentsdetails}}</textarea>
    </div>
  
   <div class="row">
     
    <label for="assignedteacher"><b>assignedteacher</b></label>
    <input type="text" class="form-control" name="assignedteacher" id="assignedteacher" value="{{$studentrequests2->assignedteacher}}" readonly>
   
   </div>
   
   @endforeach
    <button type="submit" class="btn btn-success mt-2">Update</button>
   
  </div>

  
</form>

@else
<div class="row">
    <div class="col-lg-4">
    <h3>Admin Approval Pending.....</h3>
    </div>
</div>

@endif

<script>
    	


    $("#loginform").submit(function (event) {
        var id={{$id}};
        
        var formData = new FormData(document.getElementById("loginform"));
$.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

  type: "POST",
  url: "<?php echo url('/studedit')?>/"+id,
  data: formData,
  
  
  
                contentType: false,
                processData: false,
     success: function(result){
    
            //console.log(result);
          if(result==1){
              
            alert("Update Successfull");
            $("#loginform")[0].reset();
            window.location.reload(true);
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