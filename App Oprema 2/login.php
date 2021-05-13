<?php
    include "db_connect.php";
    include "check_login.php";
    session_start();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$admin_user = $_POST['admin_user'];
		$admin_pass = $_POST['admin_pass'];
		
		if(!empty($admin_user) && !empty($admin_pass) && !is_numeric($admin_user))
		{
			$query = "SELECT * FROM admins WHERE admin_user = '$admin_user' limit 1";
			$result = mysqli_query($conn, $query);
			
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$check_pass = mysqli_fetch_assoc($result);
						
						if($check_pass['admin_pass'] == $admin_pass)
						{
							$_SESSION['admin_id'] = $check_pass['admin_id'];
							header("Location: index.php");
							die;
						}
				}
			}
			echo "Please enter valid username and password!";
		}else
		{
			echo "Ispunite polja!";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Opema</title>
</head>
<body>
    <!--LOGO-->
    <div class="log-bar">
        <img src="img/oprema-logo.png" class="logo-img">
    </div>
    <!--LOGIN FORM-->
    <form method="POST">
        <div class="login-form">
            <p>Username:</p>
            <input type="text" name="admin_user" placeholder="Enter Username...">
            <p>Password:</p>
            <input type="password" name="admin_pass" placeholder="Enter Password..."><br>
            <input class="login-btn" type="submit" name="" value="Login">
        </div>
    </form>

<footer>
    <p class="tip">*OPREMA is device monitoring desktop app, made by davidaWEBdesign.</p>
</footer>

    
</body>
</html>