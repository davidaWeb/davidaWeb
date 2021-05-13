<?php
session_start();
    include "db_connect.php";
    include "check_login.php";
    include "check_theme.php";
    include "language.php";
	$admin_status = check_login($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="themes/<?php echo $theme ?>.css">
    <link rel="stylesheet" href="design.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Oprema-<?php echo $lang['monitor']?></title>
</head>
<body>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="img/oprema-logo.png" class="logo-img">
            </div>
            <div class="tabs">
                <a href="index.php"><?php echo $lang['monitor']?></a>
                <a href="employees.php"><?php echo $lang['employees']?></a>
                <a href="devices.php"><?php echo $lang['devices']?></a>
                <a href="settings.php"><?php echo $lang['settings']?></a>
                <a href="logout.php"><?php echo $lang['logout']?></a>
            </div>
        </nav>
        <main>
            <table class="table-content">
                <tr>
                    <th><?php echo $lang['model']?></th>
				    <th><?php echo $lang['type']?></th>
				    <th><?php echo $lang['year']?></th>
				    <th><?php echo $lang['serial-number']?></th>
				    <th><?php echo $lang['user']?></th>
                    <th><?php echo $lang['status']?></th>
                </tr>
               
            </table>

        </main>
        <div id="sidebar">
            <table class="table-updates">
                <tr>
                    <th><?php echo $lang['last-change']?></th>
                    <th></th>
                </tr>
                     
            </table>
        </div>
    </div>
    
</body>
</html>