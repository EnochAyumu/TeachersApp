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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">T-Data Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Admin Home</a></li>
            <li class="active"><a href="#">Submissions</a></li>
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

<div class="container" style="margin-top:90px;" ><!--For Page-->
  <div class="row"><!--For Page Content Grid--> 
    <h1 style="color:#aaabd3;text-align:center">Submitions and Requests</h1>
  <div class = "col-md-12 success" > <!--Submisions Column-->
      
      <div class = "row"><!--For Promotions -->
         <div class = "col-md-12" >
          <h2 style="color:navy;">Promotions</h2> 
           <table class="table" border="1" >
           <thead >
             <tr class="success">
               <th>Staff ID</th>
               <th>First Appoint Letter</th>
               <th>Application Letter</th>
               <th>Last Promotion/Upgrading/Confirmation</th>
               <th>Date Submitted</th>              
             </tr>
           </thead>
            <?php
              $sql = "SELECT * FROM promotion ORDER BY `promotion`.`last_log_date` DESC";
              $result = $MySQLi_CON->query($sql);
               if ($result) {
              // output data of each row
                   while($row = $result->fetch_assoc()) {
            ?>
           <tbody>
             <tr>
               <td><?php echo $row["tr_id"];?></td>
               <td><a href="../user/promotion/appointletter/<?php echo $row['firstAppoint'] ?>" target="_blank">view file</a></td>
               <td><a href="../user/promotion/applictletter/<?php echo $row['applicLetter'] ?>" target="_blank">view file</a></td>
               <td><a href="../user/promotion/promoletter/<?php echo $row['last_promo'] ?>" target="_blank">view file</a></td>
               <td><?php echo $row["last_log_date"];?></td>
             </tr>
           </tbody>
            <?php   
              }
                } else {
                        echo "There are no Submitions For Promotion";
                        }
            ?>
            </table>
        </div>
      </div><!--End of Promotions --> 
      <hr /> 

<div class = "row"><!--For transfers -->
  <div class = "col-md-12" >
  <h2 style="color:navy;">Transfers</h2>
    <table class="table" border="1" >
      <thead >
          <tr class="success">
            <th>Staff ID</th>
            <th>Appointment Letter</th>
            <th>Application Letter</th>
            <th>Date Submitted</th>
          </tr>
    </thead>
        <?php
         $sql = "SELECT * FROM transfer ORDER BY `transfer`.`upload_date` DESC";
         $result = $MySQLi_CON->query($sql);
             if ($result) {
              // output data of each row
                 while($row = $result->fetch_assoc()) {
        ?>
        <tbody>
          <tr>
            <td><?php echo $row["tr_id"];?></td>
            <td><a href="../user/transfer/appointletter/<?php echo $row['firstAppoint'] ?>" target="_blank">view file</a></td>
            <td><a href="../user/transfer/applictletter/<?php echo $row['transferApp'] ?>" target="_blank">view file</a></td>
            <td><?php echo $row["upload_date"];?></td>
          </tr>
        </tbody>
        <?php   
            }
          } else {
               echo "There are no Submitions For Transfer";
                }
        ?>
        </table> 
      </div>    
    </div><!--End of Transter -->
      <hr />
  <div class = "row"><!--For Validation -->
    <div class = "col-md-12" >
        <h2 style="color:navy;">Validation</h2>
      <table class="table" border="1" >
        <thead >
            <tr class="success">
                <th>Staff ID</th>
                <th>Appoint Letter</th>
                <th>Cert 1</th>
                <th>Cert 2</th>
                <th>Cert 3</th>
                <th>Date Submitted</th>
          </tr>
        </thead>
           <?php
             $sql = "SELECT * FROM validation ORDER BY `validation`.`upload_date` DESC";
             $result = $MySQLi_CON->query($sql);
                if ($result) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
             ?>
          <tbody>
            <tr>
                <td><?php echo $row["tr_id"];?></td>
                <td><a href="../user/validate/letters/<?php echo $row['appletter'] ?>" target="_blank">view file</a></td>
                <td><a href="../user/validate/certs/<?php echo $row['cert1'] ?>" target="_blank">view file</a></td>
                <td><a href="../user/validate/certs/<?php echo $row['cert2'] ?>" target="_blank">view file</a></td>
                <td><a href="../user/validate/certs/<?php echo $row['cert3'] ?>" target="_blank">view file</a></td>
                <td><?php echo $row["upload_date"];?></td>
            </tr>
          </tbody>
            <?php   
                }
              } else {
                      echo "there are no Submitions for validations";
                      }
            
            ?>
                                  </table>
    </div>  <!--End of Validation-->  
    </div>

    <div class= "row"><!--For Upgrading -->
         <div class = "col-md-12" >
          <h2 style="color:navy;">Upgrading</h2> 
           <table class="table" border="1" >
           <thead >
             <tr class="success">
               <th>Staff ID</th>
               <th>Application Letter</th>
               <th>Certificate</th>
               <th>Pay Slip</th>
               <th>Date Submitted</th>              
             </tr>
           </thead>
            <?php
              $sql = "SELECT * FROM upgrading_tb ORDER BY `upgrading_tb`.`last_log_date` DESC";
              $result = $MySQLi_CON->query($sql);
               if ($result) {
              // output data of each row
                   while($row = $result->fetch_assoc()) {
            ?>
           <tbody>
             <tr>
               <td><?php echo $row["tr_id"];?></td>
               <td><a href="../user/upgrade/application/<?php echo $row['app_letter'] ?>" target="_blank">view file</a></td>
               <td><a href="../user/upgrade/certs/<?php echo $row['certificate'] ?>" target="_blank">view file</a></td>
               <td><a href="../user/upgrade/slip/<?php echo $row['pay_slip'] ?>" target="_blank">view file</a></td>
               <td><?php echo $row["last_log_date"];?></td>
             </tr>
           </tbody>
                    <?php   
                      }
                        } else {
                                echo "There are no Submitions For Promotion";
                        }
                        $MySQLi_CON->close();
            ?>
            </table>
        </div>
      </div><!--End of Upgrading -->     
  </div><!--End of Submisions Culumn-->
    
  </div><!--End of Page Content Grid-->
 </div><!--End of Page-->
</body>
</html>