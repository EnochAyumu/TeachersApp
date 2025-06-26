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
<html lang="en">
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
            <li ><a href="submision.php">Submissions</a></li>
            <li class="active"><a href="#">Teachers</a></li>
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
<div class="container"style="margin-top:50px;" >
  <h1 style="text-align:center; color:navy;">Teachers List</h1><hr />
  <table class="table" border="1" style="margin-left:10px;">
	<thead >
		<tr class="success">
			<th>First Name</th>
			<th>Last Name</th>
			<th>Staff ID</th>
			<th>Registered Number</th>
			<th>SS Fund Number</th>
			<th>Current Rank</th>
			<th>Current School</th>
			<th>Action</th>
		</tr>
</thead>
<?php
$sql = "SELECT fname,lname,staf_id,reg_number,ssf_number,current_rank,current_school FROM teach_tb ORDER BY `teach_tb`.`fname` ASC";
$result = $MySQLi_CON->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		?>
		<tbody>
		<tr>
			<td><?php echo $row["fname"];?></td>
			<td><?php echo $row["lname"];?></td>
			<td><?php echo $row["staf_id"];?></td>
			<td><?php echo $row["reg_number"];?></td>
			<td><?php echo $row["ssf_number"];?></td>
			<td><?php echo $row["current_rank"];?></td>
			<td><?php echo $row["current_school"];?></td>
			<td><a href="#">Edit</a> | 
				<a href="#">Delete</a>
			</td>
		</tr>
	</tbody>
   <?php   
    }
} else {
    echo "0 results";
}
$MySQLi_CON->close();
?>
</div>
</table>
</body>
</html>