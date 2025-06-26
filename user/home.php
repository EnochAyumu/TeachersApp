<?php
session_start();
if(!isset($_SESSION['userSession']))
{
    header("Location: login.php");
}
include_once 'dbconnect.php';

$query = $MySQLi_CON->query("SELECT * FROM teach_tb WHERE id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
//$MySQLi_CON->close();
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
        <h1>T-Data App </h1>
           </button><nav data-role="navbar">
            
            <ul>
              <li><a data-theme="b" data-icon="home" href="home.php">HOME</a></li>
              <li><a data-theme="b" data-icon="grid" href="complaints.php" >COMPLAINTS</a></li>
             </ul>
          </nav>      
      </header>
            <div data-role="content"> 
              <h3 style="text-align:center"> Welcome</h3>
              <div data-role="collapsible" data-theme="c" data-content-theme="d"> 

                    <p data-content-theme="d">
                      <h3> Your Profile </h3>
                     <h4><?php  echo $userRow['fname'];?> &nbsp; <?php echo $userRow['lname'];?> </h4>
                     </div>
                </p>
               <div data-role="collapsible" data-theme="c" data-content-theme="d"> 
                <h1> Important Notice </h1>
                  <p>
                      Be Sure you begin your file name with your Staff ID<br/>
                      </p>
                       <h4> EXAMPLES:</h4>
                       <p>
                          3244applicationletter<br /> 
                          3244payslip<br />                 
                  </p> 
                 
                </div> 
                      <a data-theme="b" data-role="button" data-inline="true" data-icon="grid" href="validations.php" >VALIDATION</a>
                      <a data-theme="b" data-role="button" data-inline="true" data-icon="grid" href="promotions.php">PROMOTION</a>
                      <a data-theme="b" data-role="button" data-inline="true" data-icon="grid" href="transfer.php" >TRANSFER</a>
                      <a data-theme="b" data-role="button" data-inline="true" data-icon="grid" href="upgrade.php" >UPGRADING</a>
                   
                      <a data-theme="b" data-icon="info" href="logout.php?logout" data-role="button" data-inline="true" >Logout</a>
                    
              </div>
      <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer>   
    </div>       
    
   
</body>
</html>