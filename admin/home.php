<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['adminSession']))
{
	header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM admin WHERE user_id=".$_SESSION['adminSession']);
$userRow=$query->fetch_array();

?>
<!DOCTYPE html>

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
          <a class="navbar-brand" href="">T-Data Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Admin Home</a></li>
            <li><a href="submision.php">Submissions</a></li>
            <li><a href="teacher_list.php">Teachers</a></li>
            <li><a href="register.php">New Admin</a></li>
            <li><a href="reg_department.php">New Department</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container" style="margin-top:90px;" >
  <h1 style="color:#aaabd3;text-align:center" >Complaints and Response</h1>
    <div class="row"> 
      <div class = "col-md-12 success" >
        
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
 
      </div>
    </div>

</body>
</html>