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
    <link rel="stylesheet" href="design-emp.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Oprema-<?php echo $lang['employees']?></title>
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

<!-- ----------EMPLOYEES TABLE------------- -->

        <main>
            <table class="table-emp">
                <tr>
                    <th><?php echo $lang['name']?></th>
				    <th><?php echo $lang['personal-number']?></th>
				    <th><?php echo $lang['adress']?></th>
                    <th><?php echo $lang['postal']?></th>
				    <th><?php echo $lang['phone']?></th>
                </tr>

                <!-- LOAD EMPLOYEES FROM DATABASE -->

                <?php
				$query = "SELECT * FROM employees ";
				$result = mysqli_query($conn, $query);
			
				if($result && mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "<tr><td>".$row["emp"]."</td><td>".$row["emp_oib"]."</td><td>".$row["emp_adress"]."</td><td>".$row["emp_postal"]."</td><td>".$row["emp_phone"]."</td></td>";
					}
				echo "</table>";
				}
				else
				{
					echo "Table is empty.";
				}
				?>
            

        </main>

<!-- ----------ACTION------------- -->

        <div id="sidebar">

        <!-- TABLE EMPLOYEE ACTION -->

            <table id="table-emp-action" class="table-emp-action">
                <tr>
                    <th><?php echo $lang['action']?>:</th>
                </tr>
                <tr>
                    <td><img src="img/icons/employees.png" class="action-img"></td>
                </tr>
                <tr>
                    <td><button id="btn-add-emp" class="btn-action"><?php echo $lang['add-employee']?></button></td>
                </tr>
                <tr>
                    <td><button id="btn-rem-emp"class="btn-action" onclick=""><?php echo $lang['remove-employee']?></button></td>
                </tr>
            </table>

        <!-- TABLE ADD EMPLOYEE -->

            <table id="table-emp-add" class="table-emp-add">
                <tr>
                    <th><?php echo $lang['add-employee']?>:</th>
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
                        <td><p class="form-text"><?php echo $lang['name']?></p><input type="text" name="emp"></td>
                    </tr>
                    <tr>
                        <td><p class="form-text"><?php echo $lang['personal-number']?></p><input type="text" name="emp_oib"></td>
                    </tr>
                    <tr>
                        <td><p class="form-text"><?php echo $lang['adress']?></p><input type="text" name="emp_adress"></td>
                    </tr>
                    <tr>
                        <td><p class="form-text"><?php echo $lang['postal']?></p><input type="text" name="emp_postal"></td>
                    </tr>
                    <tr>
                        <td><p class="form-text"><?php echo $lang['phone']?></p><input type="text" name="emp_phone"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="add_employee" value="<?php echo $lang['add']?>"></td>
                    </tr>
                </form>
            </table>
            
        <!--INSERT NEW EMPLOYEE INTO TABLE-->
            <?php
                if(isset($_POST['add_employee'])){
                    /*if(!empty($_POST['emp']) &&  !empty($_POST['emp_oib']) && !empty($_POST['emp_adress']) && !empty($_POST['emp_postal']) && !empty($_POST['emp_phone'])){*/
                        $employee = $_POST['emp'];
                        $oib = $_POST['emp_oib'];
                        $adress = $_POST['emp_adress'];
                        $postal = $_POST['emp_postal'];
                        $phone = $_POST['emp_phone'];
                        $query = "INSERT INTO employees (emp, emp_oib, emp_adress, emp_postal, emp_phone) VALUES ( '$employee', '$oib', '$adress', '$postal', '$phone')";
                        $result=mysqli_query($conn, $query);
                    /*}*/
                }
            ?>

        <!-- TABLE REMOVE EMPLOYEE -->

            <table id="table-emp-rem" class="table-emp-remove">
                <tr>
                    <th><?php echo $lang['remove-employee']?>:</th>
                </tr>
                <tr>
                    <td>
                        <button id="btn-rem-bck" class="button-back">
                            <img src="img/icons/back-icon.svg">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><p class="form-text"><?php echo $lang['employee']?>:</p></td>
                </tr>
                    <form method="POST">
                        <tr>
                            <td>
                                <select class="emp-rem-select">
                                    <?php
                                        $query = "SELECT * FROM employees ";
                                        $result = mysqli_query($conn, $query);
                                
                                        if($result && mysqli_num_rows($result) > 0)
                                        {
                                            while ($row = mysqli_fetch_assoc($result))
                                            {
                                                echo "<option>".$row["emp"].", ".$row["emp_oib"]."</option>";
                                            }
                                        echo "</select>";
                                        }
                                        else
                                        {
                                            echo "No Employees.";
                                        }
                                    ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="<?php echo $lang['remove']?>"></td>
                        </tr>
                    </form>
            </table>
        </div>
    </div>

<!-- SCRIPT FOR SWITCHING THE TABLES -->

<script>

$(document).ready(function(){
    /* BUTTON ADD EMPLOYEE */
    $("#btn-add-emp").click(function(){
        $("#table-emp-action").hide();
        $("#table-emp-add").show();
    });
    /* ADD EMPLOYEE BUTTON FOR BACK */
    $("#btn-add-bck").click(function(){
        $("#table-emp-add").hide();
        $("#table-emp-action").show();
    });
    /* BUTTON REMOVE EMPLOYEE */
    $("#btn-rem-emp").click(function(){
        $("#table-emp-action").hide();
        $("#table-emp-rem").show();
    });
    /* REMOVE EMPLOYEE BUTTON FOR BACK */
    $("#btn-rem-bck").click(function(){
        $("#table-emp-rem").hide();
        $("#table-emp-action").show();
    });
});

</script>
    
</body>
</html>