<?php
session_start(); 
include 'dbconnect.php';
if(!isset($_SESSION['userSession']))
{
  header("Location: login.php");
}
if(isset($_POST['upload'])){ 
  $fileExistsFlag = 0; 
   $app_letter = $_FILES['app_letter']['name'];
   $certificate = $_FILES['certificate']['name'];
   $pay_slip = $_FILES['pay_slip']['name'];
 
 /* 
 *  Checking whether the file already exists in the destination folder 
 */
      $query = "SELECT * FROM upgrading_tb"; 
     $result = $MySQLi_CON->query($query);
     while($row = mysqli_fetch_array($result)) {
    if($row['app_letter'] == $app_letter || $row['certificate'] == $certificate || $row['pay_slip'] == $pay_slip) {
     $fileExistsFlag = 1;
     } 
    }
 /*
 *  If file is not present in the destination folder
 */
 if($fileExistsFlag == 0) {
 $tr_id = $_POST['tr_id']; 
 $location = "upgrade/application/";
 $filelocation = $location.$app_letter; 
 $tempapp_letter= $_FILES["app_letter"]["tmp_name"];

  $location2 = "upgrade/certs/";
 $filelocation2 = $location2.$certificate; 
 $tempcertificate = $_FILES["certificate"]["tmp_name"];
 
  $location3 = "upgrade/slip/";
 $filelocation3 = $location3.$pay_slip; 
 $temppay_slip = $_FILES["pay_slip"]["tmp_name"];
  

 $result = move_uploaded_file($tempapp_letter,$filelocation);
 $result2 = move_uploaded_file($tempcertificate,$filelocation2);
 $result3 = move_uploaded_file($temppay_slip,$filelocation3);

 /*
 *  If file was successfully uploaded in the destination folder
 */
 if($result && $result2 && $result3) { 

 $query = "INSERT INTO upgrading_tb(tr_id,app_letter,certificate,pay_slip,last_log_date) VALUES ('$tr_id','$app_letter','$certificate','$pay_slip',now())"; 
  $MySQLi_CON->query($query); 
  
  $msg= "Your file <b><i>" .$app_letter. ", ".$certificate." and ".$pay_slip."</i></b> have been successfully uploaded <br />"; 

 }
 else { 
 $msg = "Sorry !!! There was an error in uploading your file"; 
 }
 
 }
 /*
 *  If file is already present in the destination folder
 */
 else {
 $msg= "File <b><i>".$app_letter."</i></b>already exists in your folder. Please rename the file and try again.";
 
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
        <h1>T-Data App: Promotion</h1>
           </button><nav data-role="navbar">
            <ul>
              <li><a data-theme="b" data-icon="home" href="home.php">HOME</a></li>
              <li><a data-theme="b" data-icon="grid" href="#">PROMOTION</a></li>
             </ul>
          </nav>      
      </header>
  <div data-role="content">      
 <form method="post" action="upgrade.php" data-ajax="false" enctype="multipart/form-data" >   
       <h3 style="text-align:center"> PROMOTION FORM</h3>           
                      <h4 > <?php
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
            
          <label for="tr_id"  >STAFF ID:</label>
          <input type="text" name="tr_id" placeholder="Staff ID" required="required"><br>
                 
          <label for="app_letter">APPLICATION LETTER:</label> <br />
          <input type="file" name="app_letter" required="required"><br><br />
          
          <label for="applicLetter">CERTIFICATE:</label> <br />
          <input type="file" name="certificate" required="required" ><br> <br />              
          
          <label for="pay_slip">PAY SLIP: </label> <br />
          <input type="file" name="pay_slip" ><br /> <br />
          <input TYPE="submit" name="upload" value="Submit" data-inline="true"/><br /> <br />
        </form>  
       </div>
     <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer> 
  </div>
</body>
</html>