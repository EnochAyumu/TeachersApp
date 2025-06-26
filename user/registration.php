<?php
session_start();
if(isset($_SESSION['userSession'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$fname = $MySQLi_CON->real_escape_string(trim($_POST['fname']));
	$lname = $MySQLi_CON->real_escape_string(trim($_POST['lname']));
	$staf_id = $MySQLi_CON->real_escape_string(trim($_POST['staf_id']));
	$password = $MySQLi_CON->real_escape_string(trim($_POST['password']));
	$reg_number = $MySQLi_CON->real_escape_string(trim($_POST['reg_number']));
	$ssf_number= $MySQLi_CON->real_escape_string(trim($_POST['ssf_number']));
	$current_rank = $MySQLi_CON->real_escape_string(trim($_POST['current_rank']));
	$current_school = $MySQLi_CON->real_escape_string(trim($_POST['current_school']));
	
	$new_password = password_hash($password, PASSWORD_DEFAULT);
	
	$checkStaffID = $MySQLi_CON->query("SELECT staf_id FROM teach_tb WHERE staf_id='$staf_id'");
	$count=$checkStaffID->num_rows;
	
	if($count==0){
		
		
		$query = "INSERT INTO teach_tb(fname,lname,staf_id,password,reg_number,ssf_number,current_rank,current_school) VALUES('$fname','$lname','$staf_id','$new_password','$reg_number','$ssf_number','$current_rank','$current_school')";
		 
		if($MySQLi_CON->query($query))
		{
			$msg = "<div> Congratulations! You Can Now LOGIN To Use The System 
					</div> <br />";
		}
		else
		{
			$msg = "<div> error while registering !
					</div> <br />";
		}
	}
	else{
		$msg = "<div > &nbsp; sorry StafID already taken !
				</div> <br />";
			
	}
	$MySQLi_CON->close();
}
?>
<!DOCTYPE html>
<html>
<!--
  * Please see the included README.md file for license terms and conditions.
  -->
<head>
    <title>T-Data-App</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">

    <!-- see http://webdesign.tutsplus.com/tutorials/htmlcss-tutorials/quick-tip-dont-forget the-viewport-meta-tag -->
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=no">
    <style>
        /* following two viewport lines are equivalent to meta viewport statement above, needed for Windows */
        /* see http://www.quirksmode.org/blog/archives/2014/05/html5_dev_conf.html and http://dev.w3.org/csswg/css-device-adapt/ */
        @-ms-viewport { width: 100vw ; min-zoom: 100% ; zoom: 100% ; }  @viewport { width: 100vw ; min-zoom: 100% zoom: 100% ; }
        @-ms-viewport { user-zoom: fixed ; min-zoom: 100% ; }           @viewport { user-zoom: fixed ; min-zoom: 100% ; }
    </style>

    <!-- Uncomment the following scripts if you convert your "Standard HTML5" project into a "Cordova" project. -->
    <!-- <script src="cordova.js"></script> -->          <!-- phantom library, needed for Cordova api calls, added during build -->
    <!-- <script src="js/app.js"></script> -->           <!-- recommended location of your JavaScript code relative to other JS files -->
    <!-- <script src="xdk/init-dev.js"></script> -->     <!-- normalizes device and document ready events, see README for details -->

    <link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet">
    
    <script src="jquery-mobile/jquery-1.8.2.js" type="text/javascript"></script>
    
    <script src="jquery-mobile/jquery-1.2.0.js" type="text/javascript"></script>   
</head>
<body>
	   <div data-role="page" data-content-theme="d">
		  <header data-role="header" data-theme="b">
		       <h1>T-Data App: Registration </h1>              
          </header>
	<div data-role="content" >
       <form method="post" id="register-form" data-ajax="false">
         <img src="myimages/login5.png" width="70" height="70" style="float:right;"/> <h3 style="text-align:center">Enter Your Credentials</h3>
    	 <h3 style="text-align:center"> DATA ENTRY FORM </h3>
					<?php
					if(isset($msg)){
						echo $msg;
					}
					else{
						?>
			            <div> All the fields are mandatory !
						</div>
			            <?php
					}
					?>
		 <label for="fname">First Name:</label>
         <input type="text" name="fname" placeholder="eg. Henry" required="required"><br>
	  
         <label for="lname"  >Last Name(s):</label>
         <input type="text" name="lname" placeholder="e.g Safori-Kobena" required="required">*hyphenate if name is more than 1<br>
		 <br>
		 <label for="staf_id"  >Staff ID:</label>
         <input type="text" name="staf_id" placeholder="Staff ID" required="required"><br>
		 
		  <label for="password">Password:</label>
         <input type="password" name="password" placeholder="Password" required="required"><br>
		
		 <label for="reg_number">TR's. Registered Number:</label>
         <input type="text" name="reg_number" placeholder="1234/16" required="required"><br>
		
		<label for="ssf_number"  >Social Security Number:</label>
         <input type="text" name="ssf_number" placeholder="SSN" required="required"><br>
		 <fieldset class="field-contain">
            <label for="current_rank">Current Rank</label>
            <select id="select" name="current_rank" >
				<option value="Select">--Select Rank--</option>
				<option value="TR Level 1">TR Level 1</option>
                <option value="Sup II">Sup II</option>
                <option value="Sup I">Sup I</option>
                <option value="SS II">SS II</option>
                <option value="SS I">SS I</option>
			    <option value="PS">PS</option>
				<option value="AD II">AD II</option>
				<option value="AD I">AD I</option>
				<option value="Director">Director</option>
		 		    </select>
         </fieldset>
		 <label for="current_school">Current School</label>
         <input type="text" name="current_school" id="current_school" placeholder="Dodowa Presby JHS" required="required">
                  
        <button type="submit" name="btn-signup" data-inline="true">Submit</button>
		 <a href="login.php" style="float:right;" data-role="button" data-inline="true" data-theme="b">LOGIN</a>
     </form> 
 </div>
      <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer>
      </div>	  
</body>
</html>
