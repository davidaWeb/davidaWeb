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
    <link rel="stylesheet" href="themes/<?php echo $theme ?>.css" id="theme_style">
    <link rel="stylesheet" href="design-sett.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        <?php echo $lang['title']?>
    </title>
</head>

<body>

 <!-- NAVIGATION -->

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

<!-- THEME -->

    <main>
            <table class="table-sett">
                <tr>
                    <th><?php echo $lang['theme']?></th>
                    <th></th>
                    <th></th>
                </tr>
            <form method="POST">
                <tr>
                    <td>
                        <select name="theme">
                            <option value="golden" ><?php echo $lang['golden']?></option>
                            <option value="main"><?php echo $lang['navy blue']?></option>
                            <option value="purple"><?php echo $lang['purple']?></option>
                            <option value="rosy"><?php echo $lang['rosy']?></option>
                            <option value="gray"><?php echo $lang['gray']?></option>
                        </select> 
                    </td>
                    <td>
                        <input type="submit" name="theme-change" value="<?php echo $lang['apply']?>">
                    </td>
                </tr>
            </form>
        </table>

<!-- SET THEME VALUE INTO DATABASE-->

            <?php
                if(isset($_POST['theme-change'])){
                    $id = $_SESSION['admin_id'];
                    $query="UPDATE admins SET admin_theme='$_POST[theme]' WHERE admin_id = '$id'";
                    $result = mysqli_query($conn, $query);
                    header("Location:settings.php");
                }
            ?>
    </main>

<!-- LANGUAGE -->

    <div id="sidebar">
            
                <table class="table-lang">
                    <tr>
                        <th><?php echo $lang['language']?></th>
                    </tr>
                    <form method="POST">
                        <tr>
                            <td>
                                <select name="lang">
                                    <option value="en"><?php echo $lang['english']?></option>
                                    <option value="hr"><?php echo $lang['croatian']?></option>
                                    <option value="it"><?php echo $lang['italian']?></option>
                                    <option value="de"><?php echo $lang['german']?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="lang-change" value="<?php echo $lang['apply']?>">
                            <td>
                        </tr>
                    </form>
                </table>

<!-- SET LANGUAGE VALUE INTO DATABASE -->

                <?php
                if(isset($_POST['lang-change'])) {
                    $id = $_SESSION['admin_id'];
                    $query="UPDATE admins SET admin_lang='$_POST[lang]' WHERE admin_id = '$id'";
                    $query_run = mysqli_query($conn, $query);
                    header("Location:settings.php");
                }
                ?>
        </div>
    </div>
    
</body>
</html>