 <?php
    session_start();
	$sShowWelcome = "";
	$sShowWelcomeUser= "";
	$sShowLogin = "";

	if( isset( $_SESSION['AdminEmail'] ) )
	{
		// show the welcome page
		// echo "YES";
		$sShowWelcome  = "show";
		$_SESSION['isadminlogin']='true';
		$_SESSION['isuserlogin']='false';
	}
	elseif ( isset($_SESSION['sCorrectUserEmail'] ) )
	 {
		$sShowWelcomeUser  = "show";	
		$_SESSION['isadminlogin']='false';
		$_SESSION['isuserlogin']='true';
	}
	
	else
	{
		// show the login page
		// echo "NO";
		$sShowLogin = "show";
	    $_SESSION['isadminlogin']='false';
		$_SESSION['isuserlogin']='false';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Event-Management</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css/merge-style.css">
 <link rel="stylesheet" href="css/interaction.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>

</head>
<body onload="LoadAllEvents(false);">
<ul class="myNav">
 <div id="logo-title">
  <img class="logo" src="banner/TB.svg">
  <p id="SiteTitle">TechBiz</p>
 </div>


<div id="magicBtn">
			<button type="Button" onclick="loginlogout();" id='loginlogout'>
				<?php  
					if(
						(ISSET($_SESSION['isuserlogin']) && $_SESSION['isuserlogin']=='true')
						||
						(ISSET($_SESSION['isadminlogin']) && $_SESSION['isadminlogin']=='true')
					   ) 
					  { 
					  					echo 'Logout';
					}else{
		echo 'Login';
					}
				?>

			</button>
	</div>

 <!--  <li class="right"><a href="#about">About</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a>News</a></li> -->
  <li><a onclick="LoadAllEvents();">Home</a></li>
</ul>

<!-- .......................................Login and SignUp............... -->
	<div id="iPageLogin" class="cPage loginPage   <?php echo $sShowLogin; ?>">
		     <ul>
				  <div class="dropdown"> 
				       <h2 class="dropbtn">LOGIN</h2>
					   <div class="dropdown-content">
						  <h3 class="ShowPage" data-showThisPage="Form-LogIn-User">Participant</h3>
						  <h3 class="ShowPage" data-showThisPage="Form-LogIn-Stakeholder">Stakeholder</h3>
					      <h3 class="ShowPage" data-showThisPage="Form-LogIn-Admin">Admin</h3>
					   </div> 
				   </div>
			    <li class="ShowPage" data-showThisPage="Form-SignUp"> <h2>SIGNUP</h2> </li>
			</ul>

		

			<div id="Form-LogIn-User" class="page">   
	            <h1>Welcome to Login</h1>
	            <form id="UserfrmLogin" >
					<input class="LogIn  iPutProp" type="email" name="UserEmail" placeholder="Email Address"><br>
					<input class="LogIn  iPutProp" type="password" name="txtUserPassword" placeholder="password"> <br>
	               <button class="LogIn  btnfrm" id="btnLoginUser" type="button">LOGIN</button>
	          </form>
	       </div>
	       <!-- ..................stakeholder login to publish event.............. -->

		    <div id="Form-LogIn-Stakeholder" class="page">   
	            <h1>Welcome to Publish event</h1>
	            <form id="StakeholderfrmLogin" >
					<input class="LogIn  iPutProp" type="email" name="StakeholderEmail" placeholder="Email Address"><br>
					<input class="LogIn  iPutProp" type="password" name="txtStakeholderPassword" placeholder="password"> <br>
	               <button class="LogIn  btnfrm" id="btnLoginStakeholder" type="button">LOGIN</button>
	          </form>
	       </div>
	       <!-- ..................stakeholder login end.............. -->



           <div id="Form-LogIn-Admin" class="page">   
	            <h1>Login-Admin</h1>
	            <form id="frmLogin">
				  <input class="LogIn  iPutProp" type="email" name="AdminEmail" placeholder="Email Address"><br>
				  <input class="LogIn  iPutProp" type="password" name="txtAdminPassword" placeholder="password"> <br>
	               <button class="LogIn btnfrm" id="btnLoginAdmin" type="button">LOGIN</button>
	          </form>
	       </div>

		 <div id="Form-SignUp" class="page">   
		      <h1>Sign Up for Event</h1>
		      <form id="frmUser">
		           <input class="SignUp  iPutProp" type="text" name="txtUserName" placeholder="Name"><br>
		           <input class="SignUp  iPutProp" type="text" name="txtUserLastName" placeholder="Last Name"><br>
		           <input class="SignUp  iPutProp" type="password" name="txtUserPassword" placeholder="password"><br>
		           <input class="SignUp iPutProp" type="email" name="txtUserEmail" placeholder="Email Address"><br>
		           <input class="SignUp iPutProp" type="text" name="txtUserMobile" placeholder="Mobile"><br>
		           <input class="SignUp iPutProp" type="file" name="UserImgfile"><br>
		           <button class="SignUp btnfrm" id="btnSignUp" type="button">Sign Up</button>
		      </form>
		 </div>

         <div class="errorlabel" id="lblLoginError" >ERROR - PLEASE TRY AGAIN</div>
   </div>
	 	
	<!-- .......................................Login and SignUp End............... -->

		<!-- ......................Admin welcome div................ -->

 <div id="iPageWelcome" class=" cPage <?php echo $sShowWelcome; ?>">
	<div id="userManagement">
	  <button id="btnCreateUser" class="userButton" type="button">CREATE USER</button>
	  <button id="btnViewAllUsers" class="userButton" type="button">VIEW USER</button>
	</div>
	<div id="view-stat">
	  <button id="btnShowAttendance" class="evntButton"  type="button">SHOW ATTENDANCE</button>
	  <button id="btnShowRegistration" class="evntButton" type="button">VIEW REGISTRATION</button>
	  <button id="btnShowViewRates" class="evntButton" type="button">VIEW RATES</button>
	</div>
	<div>
	  <button id="btnCreateEvnt" class="evntButton" type="button">CREATE EVENT</button>
	  <button id="btnViewAllEvnt" class="evntButton" type="button">VIEW EVENT</button>
	  <button id="btnViewPartnerList" class="evntButton" type="button">VIEW PARTNER LIST</button>
	</div>
	<h1>WELCOME <span id="iLblWelcomeUserName"></span>-Admin</h1>
</div>

		<!-- ......................User welcome div................ -->
<div id="iPageWelcomeUser" class=" cPage <?php echo $sShowWelcomeUser; ?>">
	<button id="btnLogoutUser" class="btnLogout" type="button">LOGOUT</button>
	<button id="BtnLoadToJoinEvnt" type="button">Join to Event</button>
	<h1>WELCOME <span id="iLblWelcomeUserName"></span>--Participant</h1>
</div>


<!-- ......................User Event div................ -->
<div id="iPageShowEvnt">
<!-- Show all Events-->

   <div class="show-all-Evnts">
     	<!--......image section start with class Con.........-->
	  <div class ="con">
	   	  <img src="banner/banner1.jpg" class= "banner">
	   	  <img src="banner/banner2.jpg" class= "banner">
	      <img src="banner/banner3.jpg" class= "banner">
	      <img src="banner/banner4.jpg" class= "banner">
	  </div>

      <div id="divider">
<!-- 		<div id="magicBtn">
			<button type="Button" onclick="loginlogout();" id='loginlogout'>
				<?php  
					if(
						(ISSET($_SESSION['isuserlogin']) && $_SESSION['isuserlogin']=='true')
						||
						(ISSET($_SESSION['isadminlogin']) && $_SESSION['isadminlogin']=='true')
					   ) 
					  { 
					  					echo 'Logout';
					}else{
		echo 'Login';
					}
				?>

			</button>
		</div> -->

		<div id="articleByDate">
            <h3>Search Event By Date</h3> 
            <form id="Period">
              <label>From</label>    
              <input type="date" id="startDate" class="iputDivider"> 
              <label>To</label>     
              <input type="date" id="endDate" class="iputDivider">           
              <input type="button" id="DateSearch" value="Search" class="iputDivider">
            </form>          
       </div>
      <div>
       <input type="text" id="Searchingkeyword" onkeyup="Search_Function()" placeholder="Search for Event &#128270;" title="Type an Event" class="iputDivider">
      </div>       
   </div>
       <div class="EvntsView  flex-container" id="LoadEvntsHere"></div>
    </div>
</div>



<!-- .....................Show-all-User-div................ -->
<div id="iPageParticipant" class="DisplayUsers"  > 
      <!-- Show all users -->
       <div class="show-all-users">
          <div class="users" id="insertUsersHere"></div>
      </div>
    
    <!-- Show detailed view about single user -->
    <div class="show-single-user" >
        <h1>User details</h1>    
    <div class="user-details" id="insertUserDetailsHere"> </div>
    <div id="updateInfo">
        <form id=frmUpdateInfo>
           <input  type="text" name= "old" placeholder="What to Replace?" class="iPutProp"><br>
           <input  type="text" name= "new" placeholder="Rplace with" class="iPutProp">
           <button  type="button" id="updateField">SAVE</button>
        </form>
      </div>
      <button class="BtnBack" type="button">BACK</button>
    </div>
</div>


<!-- .....................Show-partner-list................ -->

<div id="ipagePartnerlist" class="DisplayPartnerList">   
	       	<div class="backtoPanel">
	       	    <button class="BtnBack" type="button">BACK</button>
	       	</div>
        <table class="PartnerList"  border="2" >
        	<tr>
                <th>Event Name</th>
                <th>Partners</th>
            </tr >
            <tbody id="insertPartnerListHere"></tbody>
        </table> 
      
</div>


<!-- .....................Create user by admin................ -->
<div id="iPageAddEditUser" class="DisplayUsers"  >
      <div class="create-user">
          <h1>Create User</h1>
              <form id="AddingUser">
		           <input  type="text" name="txtUserName" placeholder="Name" class="iPutProp"><br>
		           <input  type="password" name="txtUserPassword" placeholder="password" class="iPutProp"><br>
		           <input  type="email" name="txtUserEmail" placeholder="Email Address" class="iPutProp"><br>
		           <input  type="text" name="txtUserMobile" placeholder="Mobile" class="iPutProp"><br>
		           <input  type="file" name="UserImgfile" class="iPutProp"><br>
		           <button  id="btnAddUser" class="BtnAddinguser" type="button">ADD USER</button>
		           <button id="btnShowAllUsers" class="GoToShowUsers" type="button">VIEW USER</button>
		           <button  class="BtnBack" type="button">BACK</button>
		      </form>
      </div>  
</div>
<!-- **************************************Event****************************************** -->
<!-- .....................Create Event by admin................ -->

<div id="iPageAddEvnt" class="DisplayAddEvnt">
      <div class="create-Evnt">
          <h1>Publish Event</h1>
           <form id="AddingEvnt">
		           <input  type="text" name="txtEventName" placeholder="Name" class="iPutProp"><br>
		           <input  type="text" name="txtEventPartners" placeholder="Event Partners" class="iPutProp"><br>
		           <input  type="text" name="txtEventLocation" placeholder="Location" class="iPutProp"><br>
		           <input  type="text" name="txtEventTopic" placeholder="Topic" class="iPutProp"><br>
		           <input  type="text" name="txtEventDate" placeholder="Date" class="iPutProp"><br>
		           <input  type="text" name="txtEventTime" placeholder="Time" class="iPutProp"><br>
		           <input  type="number" name="txtquantity" placeholder="No of Participant" class="iPutProp"><br>
		           <input  type="file" name="EventImgfile" class="iPutProp"><br>
		           <button id="btnAddEvent" class="EventAddBtn" type="button">ADD EVENT</button>
		           <button id="btnViewEvents" class="EventViewBtn" type="button">VIEW EVENTS</button>
		           <button  class="BtnBack" type="button">BACK</button>
		      </form>
	   </div>
</div>

<!-- .....................Display Admin Events............-->

<div id="iPageEvent" class="DisplayEvnts">
      <!-- Show all Events-->
       <div class="show-all-Evnts"> 
	       	<div class="backtoPanel">
	       		<h1>Welcome Admin</h1>
	       		<h2>Update the information if required</h2>
	       	    <button  id="BtnbacktoAdminPanel"  class="BtnBack" type="button">BACK</button>
	       	</div>
        <div class="EvntsView flex-container" id="insertEvntsHere"></div> 
      </div>
</div>

<!-- ......................Update Event Info.............. -->

<div id="updateEventInfo">
        <form id=frmEventInfo>
           <input  type="text" name= "oldInfo" placeholder="What to Replace?" class="iPutProp"><br>
           <input  type="text" name= "newInfo" placeholder="Replace with" class="iPutProp">
           <button type="button" id="btnEditEventInfo">SAVE</button>
        </form>
  </div>




<!-- .............................Create event By stakeholder..................... -->

<div id="iPageAddStakeholderEvnt" class="DisplayAddEvnt">
      <div class="create-Evnt">
          <h1>Publish Event</h1>
           <form id="AddingStakeholderEvnt">
		           <input  type="text" name="txtEventName" placeholder="Name" class="iPutProp"><br>
		           <input  type="text" name="txtEventPartners" placeholder="Event Partners" class="iPutProp"><br>
		           <input  type="text" name="txtEventLocation" placeholder="Location" class="iPutProp"><br>
		           <input  type="text" name="txtEventTopic" placeholder="Topic" class="iPutProp"><br>
		           <input  type="text" name="txtEventDate" placeholder="Date" class="iPutProp"><br>
		           <input  type="text" name="txtEventTime" placeholder="Time" class="iPutProp"><br>
		           <input  type="number" name="txtquantity" placeholder="No of Participant" class="iPutProp"><br>
		           <input  type="file" name="EventImgfile" class="iPutProp"><br>
		           <button id="btnAddStakeholderEvent" class="EventAddBtn" type="button">ADD EVENT</button>
		           
		      </form>
	   </div>
</div>

<!-- .................stakeholder end............................................. -->


<!-- ......................show Graph............. -->
<div id="iPageShowGraph">
	
<h1>STATISTICS OF THE RECENT EVENTS</h1>
<button class="BtnBack" type="button">BACK</button>
	<div id="container">
		<canvas id="lineChart"></canvas>

	</div>
</div>


<!---............The Modal ...........-->
<div id="pop-up" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  	<div class="modal-header">

    	<span  id="hidden" class="close">&times;</span>
    	<h1> Event Details</h1>
    </div>
        <div class="modal-body">
     	    <div id="modalEventHere"></div>
        </div>
    
    <div class="modal-footer">
    </div>

  </div>
</div>

<!-- ............The Modal end...........- -->

<div class="footer">
    <p>@Copyright Notice here@<wbr>Site maintain by <i>TechBiz</i></p>
</div>




<script>
// .............. Form.Tab ...open the tab for fill up the form................... 
    var aShowPages = document.getElementsByClassName("ShowPage");
    // this is an array
    for(var i = 0; i < aShowPages.length; i++)
    {
        // console.log("x");
        aShowPages[i].addEventListener("click",function(){
             // console.log("x");
            // Hide the pages
          var aPages = document.getElementsByClassName( "page" );
            for(var j = 0; j < aPages.length; j++)
            {
                //console.log("x");
                aPages[j].style.display = "none";
            }

            var sDataAttibute = this.getAttribute("data-showThisPage");
            // pageOne or pageTwo
           console.log(sDataAttibute);
           document.getElementById(sDataAttibute).style.display = "inline";
        });
    }

// ............................ Ajax and send data to API....................

    btnSignUp.addEventListener( "click" , function(){
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);
			     	// box.innerHTML=sDataFromServer;
	     		}

		    }		

			  ajax.open( "POST", "api-save-data-SignUp.php", true );
			  // What am I posting ?????
			  var jFrmUser = new FormData( frmUser );
			  // console.log(sFrmUser);
			  ajax.send( jFrmUser );	
			});
  
 

 
  	function loginlogout(){
  		if(document.getElementById('loginlogout').innerText==='Login')
  		{
  			Login();
  		}else{
			Logout();
  		}

  	 }

// ............................Admin-login with api....................

		/**************************************************/
		btnLoginAdmin.addEventListener( "click" , function(){
			console.log("X");
			
		  var ajax = new XMLHttpRequest();
		  ajax.onreadystatechange = function() 
		  {
		    if (this.readyState == 4 && this.status == 200) 
		    {
		     	var jDataFromServer = JSON.parse( this.responseText );
	   			if( jDataFromServer.login == "ok" )		   			
	   			{
   					console.log("WELCOME:" , jDataFromServer.lastName );
   					
   					iPageWelcome.style.display = "grid";
   					iPageLogin.style.display = "none";
					document.getElementById('loginlogout').innerText='Logout';	

	   			}		   		
				else
					{
					console.log("LOGIN FAIL - TRY AGAIN");
   					iPageWelcome.style.display = "none";
   					lblLoginError.style.display = "grid";						
					}
	   		}
	    }			
		  ajax.open( "POST", "api-login.php" , true );
		  var jFrmLogin = new FormData( frmLogin );
		  ajax.send( jFrmLogin );		
			
		});

  
 
 // .....................user logout button ..................  
		btnLogoutUser.addEventListener( "click" , function(){
		  Logout();
		});
		
// ..........Logout Function to use to logout buttons ...........  

	      function Logout(){
		  var ajax = new XMLHttpRequest();
		  ajax.onreadystatechange = function() 
		  {
		  	iPageWelcomeUser.style.display = "none";
		  	iPageLogin.style.display = "grid";
		  	LoadAllEvents(false);
	    }			
		  ajax.open( "GET", "api-logout.php" , true );
		  ajax.send();	

		}

// .....................user login with api..................... 

		btnLoginUser.addEventListener( "click" , function(){
			console.log("X");
			
		  var ajax = new XMLHttpRequest();
		  ajax.onreadystatechange = function() 
		  {
		    if (this.readyState == 4 && this.status == 200) 
		    {
		     	var jDataFromServer = JSON.parse( this.responseText );
	   			if( jDataFromServer.login == "ok" )		   			
	   			{
   					console.log("WELCOME:" , jDataFromServer.MatchUserEmail );
   					LoadAllEvents(true);
	   			}		   		
				else
					{
					console.log("LOGIN FAIL - TRY AGAIN");
   					lblLoginError.style.display = "grid";
   					// LoadAllEvents(false);					
					}
	   		}
	    }			
		  ajax.open( "POST", "api-user-login.php" , true );
		  var jUserFrmLogin = new FormData( UserfrmLogin );
		  ajax.send( jUserFrmLogin );		
			
		});


// .....................Stakeholder login with api..................... 

		btnLoginStakeholder.addEventListener( "click" , function(){
			console.log("X");
			
		  var ajax = new XMLHttpRequest();
		  ajax.onreadystatechange = function() 
		  {
		    if (this.readyState == 4 && this.status == 200) 
		    {
		     	var jDataFromServer = JSON.parse( this.responseText );
	   			if( jDataFromServer.login == "ok" )		   			
	   			{
   					console.log("WELCOME:" , jDataFromServer.MatchUserEmail );
   					
   					iPageAddStakeholderEvnt.style.display = "grid";
   					iPageLogin.style.display = "none";
   					document.getElementById('loginlogout').innerText='Logout';	
	   			}		   		
				else
					{
					console.log("LOGIN FAIL - TRY AGAIN");
   					iPageWelcome.style.display = "none";
   					lblLoginError.style.display = "grid";
   					// LoadAllEvents(false);					
					}
	   		}
	    }			
		  ajax.open( "POST", "api-stakeholder-login.php" , true );
		  var jStakeholderFrmLogin = new FormData( StakeholderfrmLogin );
		  ajax.send( jStakeholderFrmLogin );		
			
		});

// ............stakeholder login end........................
// .............stakeholder adding event.............


btnAddStakeholderEvent.addEventListener( "click" , function(){

console.log("btnAddStakeholderEvent");
				var ajax = new XMLHttpRequest();
			    ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    	
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);
			     	// box.innerHTML=sDataFromServer;
	     		}

		    }		

			  ajax.open( "POST", "api-save-Event.php", true );
			  // What am I posting ?????
			  var jFrmStakeholderEvnt = new FormData( AddingStakeholderEvnt);
			  ajax.send(jFrmStakeholderEvnt);	
			});

// ..........................stakeholder adding event End...............


 // ................view all users and user details ..........
  
   	btnViewAllUsers.addEventListener("click", getAllUsers);
   	console.log(" User view button has clicked");	
    var users = [];
    function getAllUsers() {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          users = JSON.parse(this.responseText);
          console.log(users);
          iPageParticipant.style.display = "grid";
   		  iPageWelcome.style.display = "none";
   		  iPageAddEditUser.style.display = "none";
          showUsers();
        }
      }
      request.open("GET", "api-get-users.php");
      request.send();
    }
// ..........................................................
    function showUsers() {
      var htmlUsers = "";
      for (var i = 0; i < users.length; i++) {
        var htmlUser = '<div class="user">\
                          <p class="name">'+users[i].Name+'</p>\
               <button id="btnGetUser" class="btnseeDetails" data-id="'+users[i].id+'">See details</button>\
               <button id="btnDeleteUser" class="BtnDelUser" data-id="'+users[i].id+'">Delete User</button>\
                  </div>'
        htmlUsers += htmlUser;
      }
      insertUsersHere.innerHTML = htmlUsers;
       UserDetailsButton();


// .......delete User from users list.....................................................
var UserListBtn = document.querySelectorAll(".BtnDelUser");
			for (var j = 0; j < UserListBtn.length; j++) {
					 UserListBtn[j].addEventListener("click", function(){
					 	console.log("clicked to delete user");
					  			this.parentNode.remove();
					  			});
					}
// .........................................
    }
    
    //..............Show details about specific user..................
    var btnsGetUser;
    var user;
    function getSingleUser(e) {
      var userId = e.target.getAttribute('data-id');
      // console.log("Show single user", e.target.getAttribute('data-id'));
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          user = JSON.parse(this.responseText);
          showSingleUser();

        }
      }
      request.open("GET", "api-get-user.php?id="+userId);
      request.send();
    }
    // ......................................
    function showSingleUser() {
      var userHtml = '<div>\
      				  <img src="'+user.image+'">\
                      <h3>'+user.Name+'</h3>\
                      <p>'+user.Email+'</p>\
                      <p>'+user.Mobile+'</p>\
                <button id="BtnUpdateUser" class="btnUpdate" >EDIT</button>\
                     </div>'
               insertUserDetailsHere.innerHTML = userHtml; 
               //updateSingleUser();              
    }
    // Helpers
    function UserDetailsButton() {
      btnsGetUser = document.querySelectorAll("#btnGetUser");
      for (var i = 0; i < btnsGetUser.length; i++) {
        btnsGetUser[i].addEventListener("click", getSingleUser);
      }
    }

// ..............delete user from file..............
document.addEventListener( "click" , function( e ){
				if( e.target.className == "BtnDelUser" ){
					  console.log("BUTTON CLICKED");
					var sUserId = e.target.getAttribute("data-id");
					 // console.log(sUserId);
					DeleteUser( sUserId );
				}
			});
			function DeleteUser( sUserId ){
				// console.log("sUserId",sUserId);
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	  console.log(sDataFromServer);
			     	
	     		}
		    }				 
		ajax.open( "GET", "api-delete-user.php?id="+sUserId, true );
		ajax.send();				
	  }
   
// ....................add User..........................
  
    btnCreateUser.addEventListener( "click" , function(){
			iPageAddEditUser.style.display = "grid";
		    iPageWelcome.style.display = "none";
	btnAddUser.addEventListener( "click" , function(){

				var ajax = new XMLHttpRequest();
			    ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    	
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);
			     	// box.innerHTML=sDataFromServer;
	     		}

		    }		

			  ajax.open( "POST", "api-save-data-SignUp.php", true );
			  // What am I posting ?????
			  var jFrmUser = new FormData( AddingUser);
			  ajax.send( jFrmUser );	
			});
			  
	});

	// ........back to the view user page...........
	btnShowAllUsers.addEventListener("click", getAllUsers);
   
// ................Single User Edit button...........................

document.addEventListener( "click" , function( e ){
				if( e.target.className == "btnUpdate" ){
					  console.log("UPDATE BUTTON CLICKED");
					  updateInfo.style.display = "grid";
	 // ......For save Button info for single ........

updateField.addEventListener( "click" , function(){
		console.log("Save");
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);

			     	// box.innerHTML=sDataFromServer;
	     		}

		    }		
			  ajax.open( "POST", "api-edit-data.php", true );
			  // What am I posting ?????
			  var updtInfo = new FormData( frmUpdateInfo );
			  // console.log(sFrmUser);
			  ajax.send( updtInfo);	
			});

	   		
				}
			});
   

    btnCreateEvnt.addEventListener( "click" , function(){
			iPageAddEvnt.style.display = "grid";
		    iPageWelcome.style.display = "none";
	btnAddEvent.addEventListener( "click" , function(){

				var ajax = new XMLHttpRequest();
			    ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    	
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);
			     	// box.innerHTML=sDataFromServer;
	     		}

		    }		

			  ajax.open( "POST", "api-save-Event.php", true );
			  // What am I posting ?????
			  var jFrmEvnt = new FormData( AddingEvnt);
			  ajax.send( jFrmEvnt);	
			});
			  
	});

// ****************************view Partners ************************* 
	
btnViewPartnerList.addEventListener("click", getPartners);
   	console.log(" Partners view button has clicked");	
     var partners = [];
    function getPartners() {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         partners = JSON.parse(this.responseText);
          console.log("partner:",partners);
          ipagePartnerlist.style.display = "grid";
   		  iPageWelcome.style.display = "none";
   		  
          showPartners(partners);
        }
      }
      request.open("GET", "api-get-partners.php");
      request.send();
    }

    // ..........................................................
    function showPartners(partners) {
    	
      var htmlPartners = "";
      for (var i = 0; i < partners.length; i++) {
        var htmlPartner = '<tr class="Partner">\
        				  <td>'+partners[i].Name+'</td>\
        				  <td>'+partners[i].Partners+'</td></tr>'
         htmlPartners += htmlPartner;
      }
       insertPartnerListHere.innerHTML = htmlPartners;
  }

// ****************************view Events *************************
 
  btnViewAllEvnt.addEventListener("click", getAllEvnts);
   	console.log("Event View button has clicked");	
    var aEvents = [];
    function getAllEvnts() {
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          aEvents = JSON.parse(this.responseText);
          console.log(users);
          iPageEvent.style.display = "grid";
   		  iPageWelcome.style.display = "none";
          ShowEvents();
        }
      }
      request.open("GET", "api-get-Events.php");
      request.send();
    }

    // ..........................................................
    function ShowEvents() {
      var htmlEvents = "";
      for (var i = 0; i < aEvents.length; i++) {
        var htmlEvent = '<div class="sEvnt">\
                          <h3 class="name">'+aEvents[i].Name+'</h3>\
                          <img src="'+aEvents[i].Image+'">\
                          <p><b>Partners:</b> '+aEvents[i].Partners+'</p>\
                          <p><b>Location:</b> '+aEvents[i].Location+'</p>\
                          <h4><b>Topic:</b> '+aEvents[i].Topic+'</h4>\
                          <h4 class="date"><b>Date:</b> '+aEvents[i].Date+'</h4>\
                          <h4 class="time"><b>Time:</b> '+aEvents[i].Time+'</h4>\
                          <p><b>No of Participant:</b> '+aEvents[i].Quantity+'</p>\
             <button  class="BtnEditEvnt" data-id="'+aEvents[i].id+'">EDIT EVENT</button>\
             <button  class="BtnDelevent" data-id="'+aEvents[i].id+'">DELETE EVENT</button>\
                  </div>'
        htmlEvents += htmlEvent;
      }
      insertEvntsHere.innerHTML = htmlEvents;

      // ****************************Delete Events *********************************
// ...............................Delete Event from DOM...................................
var EvntListBtn = document.querySelectorAll(".BtnDelevent");
			for (var j = 0; j< EvntListBtn.length; j++) {
					 EvntListBtn[j].addEventListener("click", function(){
					 	console.log("clicked to delete Event");
					  			this.parentNode.remove();
					  		   
					  			});
					}
    }
    // ...............................Delete Event from file............................


// ..............Delete Event from file..............
             document.addEventListener( "click" , function( e ){
				if( e.target.className == "BtnDelevent" ){
					  console.log("BUTTON CLICKED");
					var sEventId = e.target.getAttribute("data-id");
					 // console.log(sUserId);
					DeleteEvent( sEventId );
				}
			});
			function DeleteEvent( sEventId){
				// console.log("sUserId",sUserId);
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	  console.log(sDataFromServer);
			     	
	     		}
		    }				 
		ajax.open( "GET", "api-delete-Event.php?id="+sEventId, true );
		ajax.send();				
	  }
  	
  
// ****************************....Edit Event Info....************************* -->
 
  // ................Event Edit button...........................

document.addEventListener( "click" , function( e ){
				if( e.target.className == "BtnEditEvnt" ){
					  console.log("UPDATE BUTTON CLICKED");
					  updateEventInfo.style.display = "grid";
	 
	 // ......For save Button info for Event ........

btnEditEventInfo.addEventListener( "click" , function(){
		    console.log("Save");
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	console.log("THE SERVER SEND ME THIS:" , sDataFromServer);

	     		}

		    }		
			  ajax.open( "POST", "api-edit-EventInfo.php", true );
			  // What am I posting ?????
			  var updtInfo = new FormData( frmEventInfo );
			  // console.log(sFrmUser);
			  ajax.send( updtInfo);	
			});

	 // .......................................................  
					
				}
			});
// ....................All the Button for go back to admin well come page.........

// create a function and call the function from all the back button to go to admin wellcome page.
document.addEventListener( "click" , function( e ){
				if( e.target.className == "BtnBack" ){
					  console.log("BACK BUTTON CLICKED");
					    iPageWelcome.style.display = "grid";
						updateInfo.style.display = "none";
						iPageParticipant.style.display = "none";
						iPageAddEditUser.style.display = "none";
					    iPageEvent.style.display = "none";
						iPageAddEvnt.style.display = "none";
						updateEventInfo.style.display = "none";
						ipagePartnerlist.style.display = "none";
						iPageShowGraph.style.display = "none";

					  
					}
			}); 

// **********.....Go to Event Page from create/adding Event page.....*********** 
 
 btnViewEvents.addEventListener("click", function(){ 
	 	console.log("clicked");
	    getAllEvnts();
	 	iPageAddEvnt.style.display = "none";

	 });
  
// ********************...User-Join-Event....**************************
 
   BtnLoadToJoinEvnt.addEventListener("click", LoadToJoinEvent);
   	
    var aLoadEvents = [];
    function LoadToJoinEvent(islogin,JoiningEventId) {
		LoadAllEvents(islogin,JoiningEventId);      
    }

    function LoadAllEvents(islogin,JoiningEventId){
    var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          aLoadEvents = JSON.parse(this.responseText);
          console.log(" button has clicked");
          console.log(aLoadEvents);
          iPageShowEvnt.style.display = "block";
   		  iPageWelcomeUser.style.display = "none";
   		  iPageLogin.style.display="none";
   		  iPageWelcome.style.display = "none";
   		  ipagePartnerlist.style.display="none";
   		  iPageEvent.style.display="none";
   		  iPageAddEvnt.style.display="none";
   		  iPageParticipant.style.display="none";
   		  iPageAddEditUser.style.display="none";
   		  iPageAddStakeholderEvnt.style.display = "none";
   
          ShowToJoinEvent(islogin,JoiningEventId);
        }
      }
      request.open("GET", "api-get-Events.php");
      request.send();	
    }

    // ..........................................................
    function ShowToJoinEvent(islogin,JoiningEventId) {
      var PrintJoinEvents = "";

      if(islogin !=undefined && islogin==true){
      	document.getElementById('loginlogout').innerText='Logout';		
		  for (var i = 0; i < aLoadEvents.length; i++) {
			        var joinEvent = '<div class="sEvnt loadEvent">\
			        				  <h3>'+aLoadEvents[i].Name+'</h3>\
	<img class="evntImg" title="Click to see details"  data-id="'+aLoadEvents[i].id+'" src="'+aLoadEvents[i].Image+'"  onclick="showModal();">\
			        				  <p><b>Partners:</b> '+aLoadEvents[i].Partners+'</p>\
			        				  <p><b>Location:</b> '+aLoadEvents[i].Location+'</p>\
			                          <h4><b>Topic:</b> '+aLoadEvents[i].Topic+'</h4>\
			                          <h4><b>Date:</b> <span class="date">'+aLoadEvents[i].Date+'</span></h4>\
			                          <h4 class="time"><b>Time:</b> '+aLoadEvents[i].Time+'</h4>\
			                          <p><b>No of Participant:</b> '+aLoadEvents[i].Quantity+'</p>';
									  if(JoiningEventId !=undefined && JoiningEventId===aLoadEvents[i].id){
										joinEvent +='<button>Confirmed &#x2714;</button></div>';
									  }else{
										joinEvent +='<button class="BtnJoin" id="btnEvntJoin"  data-id="'+aLoadEvents[i].id+'">Going</button></div>';
									  }									 
			        PrintJoinEvents += joinEvent;
				}
	  }
      else{

      <?php 
      		if(ISSET($_SESSION['isuserlogin']) && $_SESSION['isuserlogin']=='true'){
      		?>
      		document.getElementById('loginlogout').innerText='Logout';
      		      for (var i = 0; i < aLoadEvents.length; i++) {
			        var joinEvent = '<div class="sEvnt loadEvent">\
			        				  <h3>'+aLoadEvents[i].Name+'</h3>\
	 <img class="evntImg" title="Click to see details" data-id="'+aLoadEvents[i].id+'" src="'+aLoadEvents[i].Image+'" onclick="showModal();">\
			        				  <p><b>Partners:</b> '+aLoadEvents[i].Partners+'</p>\
			        				  <p><b>Location:</b> '+aLoadEvents[i].Location+'</p>\
			                          <h4><b>Topic:</b> '+aLoadEvents[i].Topic+'</h4>\
			                          <h4><b>Date:</b> <span class="date">'+aLoadEvents[i].Date+'</span></h4>\
			                          <h4 class="time"><b>Time:</b> '+aLoadEvents[i].Time+'</h4>\
			                          <p><b>No of Participant:</b> '+aLoadEvents[i].Quantity+'</p>\
  <button class="BtnJoin" id="btnEvntJoin"  data-id="'+aLoadEvents[i].id+'">Going</button></div>';//........AKASH......


			        PrintJoinEvents += joinEvent;
			      }
			 <?php 
			 	}else
			 	{
			 ?>
			 document.getElementById('loginlogout').innerText='Login';
				for (var i = 0; i < aLoadEvents.length; i++) {
			        var joinEvent = '<div class="sEvnt loadEvent">\
			        				  <h3>'+aLoadEvents[i].Name+'</h3>\
			        				  <h4><b>Topic:</b> '+aLoadEvents[i].Topic+'</h4>\
<img class="evntImg" title="Click to see details" data-id="'+aLoadEvents[i].id+'" src="'+aLoadEvents[i].Image+'" onclick="showModal();">\
<h4 style="display:none;"><b>Date:</b> <span class="date">'+aLoadEvents[i].Date+'</span></h4>\
			       <button class="btnTojointEvent" onclick="Login();">Join to Event</button></div>';
			        PrintJoinEvents += joinEvent;
			      }

			  <?php } ?>
		}

      LoadEvntsHere.innerHTML = PrintJoinEvents;
  }

  function Login(){
			iPageShowEvnt.style.display = "none";
   		  iPageLogin.style.display='block';
   		  
  }
  	

 // ..............Modal Popup....................................... 

function showModal(){
console.log("Modal");
$('#pop-up').show();


    var LoadEvents;
	document.addEventListener( "click" , function( e ){
				if( e.target.className == "evntImg" ){
					    var eventId = e.target.getAttribute('data-id');
       console.log("Show event ID:", e.target.getAttribute('data-id'));
   							  var request = new XMLHttpRequest();
     						  request.onreadystatechange = function() {
       							 if (this.readyState == 4 && this.status == 200) {
         									 LoadEvents = JSON.parse(this.responseText); 
         										 ShowEventInModal();
        										 }
      									}
      						request.open("GET", "api-get-modaal-event.php?id="+eventId);
     					    request.send();
    // ..........................................................
       function ShowEventInModal() {
            var modalEvent = '<div class="loadmodalEvent">\
        				  <img class="modalEventImg" src="'+LoadEvents.Image+'">\
                          <h3 class="modalEventname">'+LoadEvents.Name+'</h3>\
                          <p><b>Partners:</b> '+LoadEvents.Partners+'</p>\
                          <p><b>Location:</b> '+LoadEvents.Location+'</p>\
                          <h4><b>Topic:</b> '+LoadEvents.Topic+'</h4>\
                          <h4><b>Date:</b> <span class="date">'+LoadEvents.Date+'</span></h4>\
                          <h4 class="time"><b>Time:</b> '+LoadEvents.Time+'</h4>\</div>'
                         modalEventHere.innerHTML = modalEvent;
               }
  	
           }
	  });

   }

$('#hidden').click(function(){
             $('#pop-up').hide();
           });

// ..............Modal Popup end.................................
 

// ......Increase the quantity of the participant from file...........

document.addEventListener( "click" , function( e ){
				  if( e.target.className == "BtnJoin" ){
				    console.log("Thank you for Joining");	
var JoiningEventId = e.target.getAttribute("data-id");
				 joinEvent( JoiningEventId );
			/*this.disabled = true;*/

		}
}); 
function joinEvent( JoiningEventId){
	 // document.getElementsByClassName("BtnJoin").disabled = true;
			  var ajax = new XMLHttpRequest();
			  ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     	var sDataFromServer = this.responseText;
			     	  console.log(sDataFromServer);
			     	  LoadToJoinEvent(true,JoiningEventId);
	     		}
		    }				 
		ajax.open( "GET", "api-delete-quantity.php?id="+JoiningEventId, true );
		ajax.send();				
	  }


// .............change button text...................................
function changeBtnTxt(){
	document.getElementBy().innerHTML="confirmed &#x2714;"; 
}


  function Search_Function() {
    var UserInput, UserInputToUpperCase, LoadEventDiv, PList, PName, i;
    UserInput = document.getElementById("Searchingkeyword");
    UserInputToUpperCase = UserInput.value.toUpperCase();

    LoadEventDiv = document.getElementById("LoadEvntsHere");
    PList = LoadEventDiv.getElementsByClassName("loadEvent");

    for (i = 0; i < PList.length; i++) {
         PName = PList[i].getElementsByTagName("h4")[0];
        if (PName.innerHTML.toUpperCase().indexOf(UserInputToUpperCase) > -1) {
            PList[i].style.display = "";
        } else {
            PList[i].style.display = "none";

        }
    }
}

// .....search article by Period..... 
  
   $('#DateSearch').click(function() {
    var from = new Date($('#startDate').val()).getTime();
    console.log("from:"+from);
    var to = new Date($('#endDate').val()).getTime();

    $(".date").each(function(index, value) {
      var dates = $(this).text();
      console.log("Date:"+dates); 

      //if (!(from <= new Date(dates).getTime() && to >= new Date(dates).getTime())) {
      if (!(from <= new Date(dates).getTime() && to >= new Date(dates).getTime())) {   
        
        $(this).parent().parent().hide(); 
      }else{
      	
      	$(this).parent().parent().show();
      }

    });

  }); 


	btnShowAttendance.addEventListener( "click" , function(){
			iPageShowGraph.style.display = "grid";
		    iPageWelcome.style.display = "none";

	var chart = document.querySelector("#lineChart");

     var chartContent = new Chart(chart, {
      type: "line",
      data:{
        labels: ["January/February", "March/April", "May/June", "July/August", "September/october", "November/december"],
        datasets: [{
          label: ' Total # of Participant attend in 2017',
          data: [12, 19, 3, 10, 2, 3],
          fill: true,
          lineTension: 0,
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 4
        }]
      }
    });
});
	
	btnShowRegistration.addEventListener( "click" , function(){
			iPageShowGraph.style.display = "grid";
		    iPageWelcome.style.display = "none";

	var chart = document.querySelector("#lineChart");

    var chartContent = new Chart(chart, {
      type: "bar",
      data:{
        labels: ["January/February", "March/April", "May/June", "July/August", "September/october", "November/december"],
        datasets: [{
          label: ' Total # of registration in 2017',
          data: [9, 19, 6, 10, 12, 3],
          fill: true,
          lineTension: 0,
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 4
        }]
      }
    });
});


btnShowViewRates.addEventListener( "click" , function(){
			iPageShowGraph.style.display = "grid";
		    iPageWelcome.style.display = "none";

	var chart = document.querySelector("#lineChart");

	var chartContent = new Chart(chart, {
      type: "line",
      data:{
        labels: ["January/February", "March/April", "May/June", "July/August", "September/october", "November/december"],
        datasets: [{
          label: ' Total # of viewRates 2017',
          data: [4, 19, 3, 16, 20, 3],
          fill: true,
          lineTension: 0,
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 4
        }]
      }
    });
});

</script>





</body>
</html>