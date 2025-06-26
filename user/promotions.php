<?php
session_start(); 
include 'dbconnect.php';
if(!isset($_SESSION['userSession']))
{
  header("Location: login.php");
}
if(isset($_POST['upload'])){ 
  $fileExistsFlag = 0; 
   $firstAppoint = $_FILES['firstAppoint']['name'];
   $applicLetter = $_FILES['applicLetter']['name'];
   $last_promo = $_FILES['last_promo']['name'];
 
 /* 
 *  Checking whether the file already exists in the destination folder 
 */
      $query = "SELECT * FROM promotion"; 
     $result = $MySQLi_CON->query($query);
     while($row = mysqli_fetch_array($result)) {
    if($row['firstAppoint'] == $firstAppoint || $row['applicLetter'] == $applicLetter || $row['last_promo'] == $last_promo) {
     $fileExistsFlag = 1;
     } 
    }
 /*
 *  If file is not present in the destination folder
 */
 if($fileExistsFlag == 0) {
 $tr_id = $_POST['tr_id']; 
 $location = "promotion/appointletter/";
 $filelocation = $location.$firstAppoint; 
 $tempfirstAppoint = $_FILES["firstAppoint"]["tmp_name"];

  $location2 = "promotion/applicletter/";
 $filelocation2 = $location2.$applicLetter; 
 $tempapplicLetter = $_FILES["applicLetter"]["tmp_name"];
 
  $location3 = "promotion/promoletter/";
 $filelocation3 = $location3.$last_promo; 
 $templast_promo = $_FILES["last_promo"]["tmp_name"];
  

 $result = move_uploaded_file($tempfirstAppoint,$filelocation);
 $result2 = move_uploaded_file($tempapplicLetter,$filelocation2);
 $result3 = move_uploaded_file($templast_promo,$filelocation3);

 /*
 *  If file was successfully uploaded in the destination folder
 */
 if($result && $result2 && $result3) { 

 $query = "INSERT INTO promotion(tr_id,firstAppoint,applicLetter,last_promo,last_log_date) VALUES ('$tr_id','$firstAppoint','$applicLetter','$last_promo',now())"; 
  $MySQLi_CON->query($query); 
  
  $msg= "Your file <b><i>" .$firstAppoint. ", ".$applicLetter." and ".$last_promo."</i></b> have been successfully uploaded <br />"; 

 }
 else { 
 $msg = "Sorry !!! There was an error in uploading your file"; 
 }
 
 }
 /*
 *  If file is already present in the destination folder
 */
 else {
 $msg= "File <b><i>".$appletter."</i></b>already exists in your folder. Please rename the file and try again.";
 
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
 <form method="post" action="promotions.php" data-ajax="false" enctype="multipart/form-data" >   
       <h3 > PROMOTION FORM</h3>           
                      <h4 > <?php
                    if(isset($msg)){
                      echo $msg;
                    }
                    else{
                      ?></h4>
                            <h4 >
                        All the fields are mandatory !
                      </h4> 
                            <?php
                    }
                    ?>      
            
          <label for="tr_id"  >Staff ID:</label>
          <input type="text" name="tr_id" placeholder="Staff ID" required="required"><br>
                 
          <label for="firstAppoint">FIRST APPOINTMENT LETTER:</label> <br />
          <input type="file" name="firstAppoint" required="required"><br><br />
          
          <label for="applicLetter">Application Letter:</label> <br />
          <input type="file" name="applicLetter" required="required" ><br> <br />              
          
          <label for="last_promo">Last Promotion Letter: </label> <br />
          <input type="file" name="last_promo" ><br /> <br />
          <input TYPE="submit" name="upload" value="Submit" data-inline="true"/><br /> <br />
        </form>  
       </div>
     <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer> 
  </div>
</body>
</html>