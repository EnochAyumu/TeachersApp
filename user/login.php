<?php
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['userSession'])!="")
{
  header("Location: home.php");
  exit;
}

if(isset($_POST['btn-login']))
{
  $staff_id = $MySQLi_CON->real_escape_string(trim($_POST['staf_id']));
  $upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
  
  $query = $MySQLi_CON->query("SELECT id, staf_id, password FROM teach_tb WHERE staf_id='$staff_id'");
  $row=$query->fetch_array();
  
  if(password_verify($upass, $row['password']))
  {
    $_SESSION['userSession'] = $row['id'];
    header("Location: home.php");
  }
  else
  {
    $msg = "<div >
           Staff id or password does not exists !
        </div><br />";
  }
  
  $MySQLi_CON->close();
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>  
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>T-DataApp</title>
  

    <!-- see http://webdesign.tutsplus.com/tutorials/htmlcss-tutorials/quick-tip-dont-forget the-viewport-meta-tag -->
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=no">
    <style>
        /* following two viewport lines are equivalent to meta viewport statement above, needed for Windows */
        /* see http://www.quirksmode.org/blog/archives/2014/05/html5_dev_conf.html and http://dev.w3.org/csswg/css-device-adapt/ */
        @-ms-viewport { width: 100vw ; min-zoom: 100% ; zoom: 100% ; }  @viewport { width: 100vw ; min-zoom: 100% zoom: 100% ; }
        @-ms-viewport { user-zoom: fixed ; min-zoom: 100% ; }           @viewport { user-zoom: fixed ; min-zoom: 100% ; }
    </style>

    <link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet">
    
    <script src="jquery-mobile/jquery-1.8.2.js" type="text/javascript"></script>
    
    <script src="jquery-mobile/jquery-1.2.0.js" type="text/javascript"></script>
    
</head>
<body>
    <div data-role="page" >
        <header data-role="header" data-theme="b">
        <h1>T-Data App </h1>
      </header>
    <div data-role="content" >
      <form  method="post" id="login-form" data-ajax="false">

          <h2 style="text-align:center"> USER LOGIN</h2><hr /> 

            <?php
          if(isset($msg)){
            echo $msg;
            }
            ?>  
        <h3 style="text-align:center"> Enter Your Credentials <img src="myimages/login5.png" width="70" height="70" style="float:right;"/></h3><br /> <hr />
         <label >Staff ID:</label>
         <input type="text" name="staf_id" placeholder="Staff ID" required="required"><br>
     
          <label >Password:</label>
          <input type="password" name="password" placeholder="Password" required="required"> <br />
 
           <div>
            <button type="submit" data-inline="true"class="btn btn-default" name="btn-login" id="btn-login">
                 Sign In
            </button> 
            <a href="index.html" style="float:right;" data-role="button" data-inline="true" data-theme="b" data-icon="delete" data-transition="flip">Cancel</a> 
          </div> 
        </form>
      </div>
        <footer data-role="footer" data-theme="b">
            <h1>@henrysafori</h1>
        </footer>
     </div>
  </body>
</html>