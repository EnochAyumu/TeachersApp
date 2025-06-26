<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['deptSession'])!="")
{
	header("Location: home.php");
	exit;
}

if(isset($_POST['btn-login']))
{
	$staff_id = $MySQLi_CON->real_escape_string(trim($_POST['staff_id']));
	$upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
	$user_department = $MySQLi_CON->real_escape_string(trim($_POST['user_department']));
	$query = $MySQLi_CON->query("SELECT user_id, staff_id, user_pass,user_department FROM department WHERE 
		staff_id='$staff_id' AND user_department='$user_department'");
	
	$row=$query->fetch_array();
	
	if(password_verify($upass, $row['user_pass']))
	{
		$_SESSION['deptSession'] = $row['user_id'];
		header("Location: home.php");
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Stff ID, password or department does not exists !
				</div>";
	}
	
	$MySQLi_CON->close();
	
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>T-Data App department Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
		<div class="signin-form">
			<div class="container">
		       <form class="form-signin" method="post" id="login-form">
				  <h2 class="form-signin-heading">Department Login.
				  </h2><hr /> 
				    <?php
					if(isset($msg)){
						echo $msg;
						}
						?>             
					   <div class="form-group">
							<input type="text" class="form-control" placeholder="Staff ID" name="staff_id" required />
							<span id="check-e"></span>
					    </div>
					    <div class="form-group">
					     <input type="password" class="form-control" placeholder="Password" name="password" required />
					    </div>
					    <div class="form-group">
					     <fieldset class="form-group">
					          <select id="select" name="user_department"   type="text" class="form-control"     >
					                <option placeholder="Select Department">---SELECT DEPARTMENT---</option>
					                <option value="HR">HR</option>
					                <option value="SUPERVISION">Supervision</option>
					                <option value="ACCOUNTS">Accounts</option>
					                <option value="IPPD">IPPD</option>       
					          </select>
					     </fieldset>
					    </div>
					    <hr />
					 <div class="form-group">
					     <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
					    	<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
						
						</button> 
						
					</div>  
				</form>
			</div>		    
		</div>
	</body>
</html>