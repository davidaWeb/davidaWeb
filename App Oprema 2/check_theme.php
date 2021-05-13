<?php
$id = $_SESSION['admin_id'];
$query =" SELECT admin_theme FROM admins WHERE admin_id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$theme=$row['admin_theme'];
?>