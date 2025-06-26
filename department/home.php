<?php
session_start();
if(!isset($_SESSION['deptSession']))
{
  header("Location: index.php");
}
include 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
  $tr_id_comp = $MySQLi_CON->real_escape_string(trim($_POST['tr_id_comp']));
  $response = $MySQLi_CON->real_escape_string(trim($_POST['response']));
  
  $deadline = $MySQLi_CON->real_escape_string(trim($_POST['deadline']));
 
    $query = "INSERT INTO response(tr_id_comp,response,resp_time) VALUES('$tr_id_comp','$response',now())";

    if($MySQLi_CON->query($query))
    {
      $msg = "<div class='alert alert-success'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully  !
          </div>";
    }
    else
    {
      $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error  !
          </div>";
    }
  
  
  
  //$MySQLi_CON->close();
}
?>
<?php

$query = $MySQLi_CON->query("SELECT * FROM department WHERE user_id=".$_SESSION['deptSession']);
$userRow=$query->fetch_array();
//$MySQLi_CON->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['staff_id']; ?></title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
     <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="">T-Data Department</a>
     </div>
  <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav">
        <li class="active" ><a href="#">Complaints / Response</a></li>
        <li ><a href="submision.php">Submisions / Requests</a></li>
        <li ><a href="teacher_list.php">Teachers</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
      <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
     </ul>
  </div><!--/.nav-collapse -->
  </div>
</nav>
<div class="container" style="margin-top:90px;" >
    <div class="row"> 
      <div class = "col-md-8 success" >
        <h1 style="color:#aaabd3;" >Complaints and Response</h1>
        <div class = "row">
          <div class = "col-md-12" >
          <h2 style="color:navy;" >Complaints</h2> <!--For Promotions -->
        <table class="table" border="1" >
            <thead >
               <tr class="success">
                  <th>Staff ID</th>
                  <th>Complaint Type</th>
                  <th>Description</th>
                  <th>Date Submitted</th>
               </tr>
            </thead>
                <?php
                $sql = "SELECT * FROM complaints ORDER BY `complaints`.`comp_date` DESC";
                $result = $MySQLi_CON->query($sql);
                    if ($result) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                       ?>
          <tbody>
             <tr>
                <td><?php echo $row["tr_id"];?></td>
                <td><?php echo $row["type"];?></td>
                 <td><?php echo $row["description"];?></td>
                <td><?php echo $row["comp_date"];?></td>
                </tr>
          </tbody>
                  <?php   
                    }
                      } else {
                       echo "There are no Complaints";
                        }
                  ?>
        </table>
      </div>
  </div> <br/><hr />
  <div class = "row">
  <div class = "col-md-12" >
    <h2 style="color:navy;">Response</h2>
      <table class="table" border="1" >
        <thead >
          <tr class="success">
              <th>Staff ID</th>
              <th>Response</th>
              <th>Response Date</th>
          </tr>
        </thead>
              <?php
                  $sql = "SELECT * FROM response ORDER BY `response`.`resp_time` DESC";
                  $result = $MySQLi_CON->query($sql);
                    if ($result) {
                    // output data of each row
                      while($row = $result->fetch_assoc()) {
              ?>
        <tbody>
          <tr>
              <td><?php echo $row["tr_id_comp"];?></td>
              <td><?php echo $row["response"];?></td>
              <td><?php echo $row["resp_time"];?></td>
          </tr>
        </tbody>
               <?php   
                  }
                    } else {
                            echo "there are no Submitions for response";
                            }
                  $MySQLi_CON->close();
               ?>
        </table>
      </div>    
   </div>
  </div>
  <div class = "col-md-4">
  <form class="form-signin" method="post" id="register-form">
     <h2 class="form-signin-heading">Complaint Response Form</h2><hr />
               <?php
                 if(isset($msg)){ 
                  echo $msg;
                      }
                      else{
                ?>
        <div class='alert alert-info'>
            <span class='glyphicon glyphicon-asterisk'></span> &nbsp; all the fields are mandatory !
        </div>
               <?php
                    }
               ?>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Staff ID of complainant" name="tr_id_comp" required  />
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="10" cols="50"type="text" placeholder="Response" name="response" required > </textarea>
        </div><hr />
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">
              <span class="glyphicon glyphicon-log-in"></span> &nbsp; Submit
            </button> 
          </div> 
  </form>
        </div>
      </div>
    </div>
  </body>
</html>