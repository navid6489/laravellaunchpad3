<style>
    
    /*tab styling*/
    body {font-family: Arial;}
    
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
      color:black;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      
      border-top: none;
    }

    .notification {
background-color: #555;
color: white;
text-decoration: none;
padding: 15px 26px;
position: relative;
display: inline-block;
border-radius: 2px;
}

.notification:hover {
background: red;
}

.notification .badge {
position: absolute;
top: -10px;
right: -10px;
padding: 5px 10px;
border-radius: 50%;
background-color: red;
color: white;
margin-top: 10px;
margin-right: 13px;
}
    </style>    


<div class="tab">
    <button class="tablinks  notification" onclick="openRequests(event, 'Student')">Student <span id="studnotification" class="badge">{{$countstud[0]->cnt_data}}</span></button>
    <button class="tablinks  notification" onclick="openRequests(event, 'Teachers')">Teachers <span id="teachernotification" class="badge">{{$countteacher[0]->cnt_data}}</span></button>
   
  </div>
  
  <div id="Student" class="tabcontent">
    <h3>Student</h3>
    <table class="table table-bordered table-responsive-lg">
      <tr>
          <th>No</th>
          <th>Name</th>
          <th>email</th>
          <th>address</th>
          <th>profilepicture</th>
          <th>currentschool</th>
    <th>previousschool</th>
    <th>parentsdetails</th>
    <th>assignedteacher</th>
    <th>Approved</th>
    <th style="column-span:2; ">Actions</th>
      </tr>
      
      @foreach ($studentrequests as $studentrequests2)
          <tr>
              <td>{{$studentrequests2->id}}</td>
              <td>{{$studentrequests2->name}}</td>
              <td>{{$studentrequests2->email}}</td>
              <td>{{$studentrequests2->address}}</td>
              <td>{{$studentrequests2->dp}}</td>
       <td>{{$studentrequests2->currentschool}}</td>
              <td>{{$studentrequests2->previousschool}}</td>
              <td>{{$studentrequests2->parentsdetails}}</td>
             
              <td><a type="button" class='btn btn-success'  onclick="studentapprovedata('{{$studentrequests2->id}}','teacher{{$studentrequests2->id}}')">Approve</a></td>
              <td><a  class='btn btn-primary' href="<?php echo url('/adminstudedit')?>/{{$studentrequests2->id}}" >Edit</a></td>
      <td><a type="button" class='btn btn-danger'  onclick="studentdeletedata('{{$studentrequests2->id}}')" >delete</a></td>
      
              
          </tr>
      @endforeach
  </table>
  
  </div>
  
  <div id="Teachers" class="tabcontent">
    <h3>Teachers</h3>
    <table class="table table-bordered table-responsive">
      <tr>
          <th>No</th>
          <th>Name</th>
          <th>email</th>
          <th>address</th>
          <th>profilepicture</th>
          <th>currentschool</th>
    <th>previousschool</th>
    <th>experienceinyears</th>
    <th>expertiseinsubjects</th>
    <th>Approved</th>
    <th>Actions</th>
      </tr>
     
      
      @foreach ($teacherrequests as $teacherrequests2)
          <tr>
              <td>{{$teacherrequests2->id}}</td>
              <td>{{$teacherrequests2->name}}</td>
              <td>{{$teacherrequests2->email}}</td>
              <td>{{$teacherrequests2->address}}</td>
              <td>{{$teacherrequests2->dp}}</td>
       <td>{{$teacherrequests2->currentschool}}</td>
              <td>{{$teacherrequests2->previousschool}}</td>
              <td>{{$teacherrequests2->experienceinyears}}</td>
        <td>{{$teacherrequests2->expertiseinsubjects}}</td>
             
              <td><a type="button" class='btn btn-success' onclick="teacherapprovedata('{{$teacherrequests2->id}}')">approve</a></td>
              <td><a  class='btn btn-primary' href="<?php echo url('/adminteacheredit')?>/{{$teacherrequests2->id}}" >Edit</a></td>
              <td><a type="button" class='btn btn-danger'  onclick="teacherdeletedata('{{$teacherrequests2->id}}')" >delete</a></td>
     
              
          </tr>
      @endforeach
  </table> 
 
  </div>

  <script>
    $( document ).ready(function() {
      var teachercount='<?php echo $countteacher[0]->cnt_data?>';
      var studentcount='<?php echo $countstud[0]->cnt_data?>';
if(teachercount==0)
{
$('#teachernotification').hide();
}
else
{
$('#teachernotification').show();
}

if(studentcount==0)
{
$('#studnotification').hide();
}
else
{
$('#studnotification').show();
}
});
    </script>

<!--teacher related script-->
  <script>
    function teacherapprovedata(id) {
    
$.ajax({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

type: "POST",
url: "<?php echo url('/teacherapprove')?>/"+id,
data: {id: id},

   success: function(result){
  
          //console.log(result);
        if(result==1){
            
          alert("teacher approved Successfully");
          window.location.reload(true);
            }
            else
            {
             
              alert("teacher approval Failed");
            }
}

})
}

function teacherdeletedata(id) {
$.ajax({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

type: "POST",
url: "<?php echo url('/teacherdelete')?>/"+id,
data: id,
   success: function(result){
  
          //console.log(result);
        if(result==1){
            
          alert("teacher Deleted Successfully");
          window.location.reload(true);
            }
            else
            {
             
              alert("teacher Deletion Failed");
            }
}

})
}
    </script>
  <script>
    function openRequests(evt, recordtype) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(recordtype).style.display = "block";
      evt.currentTarget.className += " active";
    }
    </script>


 <!--student related script-->
  <script>
      function studentapprovedata(id,teacher) {
        var assignedteacher=  $('#'+teacher).val();
$.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

  type: "POST",
  url: "<?php echo url('/studapprove')?>/"+id,
  data: {id: id, assignedteacher: assignedteacher},

     success: function(result){
    
            //console.log(result);
          if(result==1){
              
            alert("student approved Successfully");
            window.location.reload(true);
              }
              else
              {
               
                alert("student approval Failed");
              }
 }
  
})
}

function studentdeletedata(id) {
$.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

  type: "POST",
  url: "<?php echo url('/studdelete')?>/"+id,
  data: id,
     success: function(result){
    
            //console.log(result);
          if(result==1){
              
            alert("student Deleted Successfully");
            window.location.reload(true);
              }
              else
              {
               
                alert("student Deletion Failed");
              }
 }
  
})
}
      </script>