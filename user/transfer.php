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
   $transferApp = $_FILES['transferApp']['name'];
 
 /* 
 *  Checking whether the file already exists in the destination folder 
 */
      $query = "SELECT * FROM transfer"; 
     $result = $MySQLi_CON->query($query);
     while($row = mysqli_fetch_array($result)) {
    if($row['firstAppoint'] == $firstAppoint || $row['transferApp'] == $transferApp) {
     $fileExistsFlag = 1;
     } 
    }
 /*
 *  If file is not present in the destination folder
 */
 if($fileExistsFlag == 0) {
 $tr_id = $_POST['tr_id']; 
 $location = "transfer/appointletter/";
 $filelocation = $location.$firstAppoint; 
 $tempfirstAppoint = $_FILES["firstAppoint"]["tmp_name"];

  $location2 = "transfer/applicletter/";
 $filelocation2 = $location2.$transferApp; 
 $temptransferApp = $_FILES["transferApp"]["tmp_name"];

  

 $result = move_uploaded_file($tempfirstAppoint,$filelocation);
 $result2 = move_uploaded_file($temptransferApp,$filelocation2);

 /*
 *  If file was successfully uploaded in the destination folder
 */
 if($result && $result2) { 

 $query = "INSERT INTO transfer(tr_id,firstAppoint,transferApp,upload_date) VALUES ('$tr_id','$firstAppoint','$transferApp',now())"; 
  $MySQLi_CON->query($query); 
  
  $msg= "Your file <b><i>" .$firstAppoint. " and ".$transferApp."</i></b> have been successfully uploaded <br />"; 

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
        <h1>T-Data App: Transfer</h1>
           </button><nav data-role="navbar">
            <ul>
              <li><a data-theme="b" data-icon="home" href="home.php">HOME</a></li>
              <li><a data-theme="b" data-icon="grid" href="#" >TRANSFER</a></li>
            </ul>
          </nav>      
      </header>
  <div data-role="content">
 <form method="post" action="transfer.php" data-ajax="false" enctype="multipart/form-data" >           
       <h3 style="text-align:center"> TRANSFER FORM</h3>    
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
          <label for="tr_id">STAFF ID:</label><br />
          <input type="text" name="tr_id" placeholder="STAFF ID" required="required"><br /> <br />
                 
          <label for="firstAppoint">FIRST APPOINTMENT LETTER:</label><br /> 
          <input type="file" name="firstAppoint" required="required"><br /><br />
          
          <label for="transferApp">APPLICATION LETTER:</label><br /> 
          <input type="file" name="transferApp" required="required" ><br />  <br />           
           
          <input TYPE="submit" name="upload" value="Submit" data-inline="true" /><br /> 
      </form>  
      </div><br />
      <br /><footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
      </footer> 
  </div>
</body>
</html>





