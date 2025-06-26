<?php
session_start();
if(!isset($_SESSION['userSession']))
{
	header("Location: login.php");
}
include_once 'dbconnect.php';

if(isset($_POST['submit']))
{
	$tr_id = $MySQLi_CON->real_escape_string(trim($_POST['tr_id']));
	$type = $MySQLi_CON->real_escape_string(trim($_POST['type']));
	$description = $MySQLi_CON->real_escape_string(trim($_POST['description']));

	$query = "INSERT INTO complaints(tr_id,type,description,comp_date) VALUES('$tr_id','$type','$description',now())";	 
		if($MySQLi_CON->query($query))
		{
			$msg = "<div> Complaint sent
					</div> <br />";
		}
		else
		{
			$msg = "<div > Error! Complaint not sent please resubmit
					</div> <br />";
		}
	$MySQLi_CON->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>T-DataApp</title>
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
 <!-- HOME -->
 <div data-role="page" id="main">
      <header data-role="header" data-theme="b">
        <h1>T-Data App: Complaints </h1>
           </button><nav data-role="navbar">  
            <ul>
              <li><a data-theme="b" data-icon="home" href="home.php">HOME</a></li>
              <li><a data-theme="b" data-icon="grid" href="#" >COMPLAINTS</a></li>
             </ul>
          </nav>      
      </header>
<div data-role="content" >
       <form method="post" data-ajax="false">
          	<h3 style="text-align:center"> COMPLAINT FORM </h3>
	    		<h4 style="text-align:center"> <?php
                    if(isset($msg)){
                      echo $msg;
                    }
                    else{
                      ?></h4>
                            <h4 style="text-align:center">
                        All the fields are mandatory !
                      </h4> 
                            <?php
                    }
                    ?> 
		 
		 <label for="tr_id">Staff ID:</label>
         <input type="text" name="tr_id" placeholder="Staff ID" required="required"><br>
		      
         <fieldset class="field-contain">
         <label for="type">Complaient Type:</label>
            <select id="select" name="type" >
				<option>--Select Option-</option>
				<option value="Upgrading">Upgrading</option>
                <option value="Salary">Salary</option>
                <option value="Transfer">Transfer</option>
                <option value="Promotion">Promotion</option>
                <option value="Confirmation">Comfirmation</option>
			</select>
         </fieldset><br />
		 <label for="current_school">Description:</label>
         <textarea class="form-control" rows="15" cols="30"type="text"  name="description" required="required" > </textarea>
                  
        <button type="submit" name="submit" data-inline="true">Submit</button>
      </form> 
     </div>
      <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer>
  </div>	  
</body>
</html>
