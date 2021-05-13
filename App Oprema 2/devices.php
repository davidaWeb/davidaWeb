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
    <link rel="stylesheet" href="design-dev.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Oprema-<?php echo $lang['devices']?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

        <!-- ----------NAVIGATION------------- -->

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

        <!-- ----------DEVICES TABLE ------------- -->

        <main>
            <table class="table-dev">
                <tr>
                    <th><?php echo $lang['model']?></th>
				    <th><?php echo $lang['type']?></th>
				    <th><?php echo $lang['year']?></th>
				    <th><?php echo $lang['serial-number']?></th>
                </tr>
                <?php
				$query = "SELECT * FROM devices ";
				$result = mysqli_query($conn, $query);
			
				if($result && mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "<tr><td>".$row["dev_model"]."</td><td>".$row["dev_type"]."</td><td>".$row["dev_year"]."</td><td>".$row["dev_sn"]."</td></tr>";
					}
				echo "</table>";
				}
				else
				{
					echo "Table is empty!";
				}
				?>
            

        </main>

        <!-- ----------TABLE ACTION------------- --> 

        <div id="sidebar">
            <table id="table-dev-action" class="table-dev-action">
                <tr>
                    <th><?php echo $lang['action']?>:</th>
                </tr>
                <tr>
                    <td><img src="img/icons/devices.png" class="action-img"></td>
                </tr>
                <tr>
                    <td><button id="btn-add-dev" class="btn-action"><?php echo $lang['add-device']?></button></td>
                </tr>
                <tr>
                    <td><button id="btn-rem-dev" class="btn-action"><?php echo $lang['remove-device']?></button></td>
                </tr>
            </table>

        <!-- ----------TABLE ACTION ADD DEVICE------------- -->

        <table id="table-dev-add" class="table-dev-add">
                <tr>
                    <th><?php echo $lang['add-device']?></th>
                </tr>
                <tr>
                    <td>
                        <button id="btn-add-bck" class="button-back">
                            <img src="img/icons/back-icon.svg">
                        </button>
                    </td>
                </tr>
            <form method="POST">
                <tr>
                    <td><p class="form-text"><?php echo $lang['model']?></p><input type="text" name="dev_model"></td>
                </tr>
                <tr>
                    <td>
                        <p class="form-text"><?php echo $lang['type']?></p>
                        
                        <select class="dev-type-select" name="dev_type">
                            <option>Laptop</option>
                            <option>Tablet</option>
                            <option>Mobile phone</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p class="form-text"><?php echo $lang['year']?></p><input type="text" name="dev_year"></td>
                </tr>
                <tr>
                    <td><p class="form-text"><?php echo $lang['serial-number']?></p><input type="text" name="dev_sn"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="add_device" value="<?php echo $lang['add']?>"></td>
                </tr>
            </form>
            </table>

        <!--INSERT NEW DEVICE INTO TABLE-->

            <?php
                if(isset($_POST['add_device'])){
                    if(!empty($_POST['dev_model']) &&  !empty($_POST['dev_type']) && !empty($_POST['dev_year']) && !empty($_POST['dev_sn'])){
                        $model = $_POST['dev_model'];
                        $type = $_POST['dev_type'];
                        $year = $_POST['dev_year'];
                        $sn = $_POST['dev_sn'];
                        $time = date('y/m/d h:i:sa');
                        $add_device = "INSERT INTO devices (dev_model, dev_type, dev_year, dev_sn, dev_change) VALUES ( '$model', '$type', '$year', '$sn','$time')";
                        $result=mysqli_query($conn, $add_device) or die (mysqli_error($conn));
                    }
                }
            ?>

        <!-- ----------TABLE ACTION REMOVE DEVICE------------- -->

        <table id="table-dev-rem" class="table-dev-remove">
                <tr>
                    <th><?php echo $lang['remove-device']?>:</th>
                </tr>
                <tr>
                    <td>
                        <button id="btn-rem-bck" class="button-back">
                            <img src="img/icons/back-icon.svg">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><p class="form-text"><?php echo $lang['device']?>:</p></td>
                </tr>
                    <form method="POST">
                        <tr>
                            <td>
                                <select class="dev-rem-select">
                                    <?php
                                        $query = "SELECT * FROM devices ";
                                        $result = mysqli_query($conn, $query);
                                
                                        if($result && mysqli_num_rows($result) > 0)
                                        {
                                            while ($row = mysqli_fetch_assoc($result))
                                            {
                                                echo "<option>".$row["dev_model"].", ".$row["dev_sn"]."</option>";
                                            }
                                        echo "</select>";
                                        }
                                        else
                                        {
                                            echo "No Devices.";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="remove_device" value="<?php echo $lang['remove']?>"></td>
                        </tr>
                    </form>
            </table>
        </div>
    </div>

    

<!-- SCRIPT FOR SWITCHING THE TABLES -->

<script>

$(document).ready(function(){
    /* BUTTON ADD DEVICE */
    $("#btn-add-dev").click(function(){
        $("#table-dev-action").hide();
        $("#table-dev-add").show();
    });
    /* ADD DEVICE BUTTON FOR BACK */
    $("#btn-add-bck").click(function(){
        $("#table-dev-add").hide();
        $("#table-dev-action").show();
    });
    /* BUTTON REMOVE DEVICE */
    $("#btn-rem-dev").click(function(){
        $("#table-dev-action").hide();
        $("#table-dev-rem").show();
    });
    /* REMOVE DEVICE BUTTON FOR BACK */
    $("#btn-rem-bck").click(function(){
        $("#table-dev-rem").hide();
        $("#table-dev-action").show();
    });
});

</script>
    
</body>
</html>