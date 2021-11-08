<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">DAY1 TASK</a>
          </div>
      <ul class="nav navbar-nav navbar-right">
        
       
        <li style="padding-right:3px;"> 
          <form method="POST" action="{{ route('registernewuser') }}">
                      @csrf
  
                      <input type="submit" class="btn btn-success mt-2" name="submit" id="submit" value="Register">
                  </form>
           
          </li>
          <li> 
            <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <input type="submit" class="btn btn-danger mt-2" name="submit" id="submit" value="logout">
                    </form>
             
            </li>
      </ul>
    </div>
  </nav>