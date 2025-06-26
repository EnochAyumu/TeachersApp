<?php
session_start();
if(!isset($_SESSION['adminSession']))
{
	header("Location: index.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname = $MySQLi_CON->real_escape_string(trim($_POST['user_name']));
	$staff_id = $MySQLi_CON->real_escape_string(trim($_POST['staff_id']));
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
	
	$new_password = password_hash($upass, PASSWORD_DEFAULT);
	
	$check_staff_id = $MySQLi_CON->query("SELECT staff_id FROM admin WHERE staff_id='$staff_id'");
	$count=$check_staff_id->num_rows;
	
	if($count==0){
		
		
		$query = "INSERT INTO admin(user_name,staff_id,user_pass) VALUES('$uname','$staff_id','$new_password')";

		
		if($MySQLi_CON->query($query))
		{
			$msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully created admin !
					</div>";
		}
		else
		{
			$msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while creating admin !
					</div>";
		}
	}
	else{
		
		
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry Staff ID already taken !
				</div>";
			
	}
	
}
?>
<?php


$query = $MySQLi_CON->query("SELECT * FROM admin WHERE user_id=".$_SESSION['adminSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
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
            <li ><a href="submision.php">Submissions</a></li>
            <li ><a href="teacher_list.php">Teachers</a></li>
            <li class="active"><a href="#">New Admin</a></li>
            <li><a href="reg_department.php">New Department</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['user_name']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Add New Admin</h2><hr />
        
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
        <input type="text" class="form-control" placeholder="Username" name="user_name" required  />
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Staff ID" name="staff_id" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required  />
        </div>
        
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
			</button>
            
        </div> 
      
      </form>

    </div>
    
</div>

</body>
</html>