<?php
    $id = $_SESSION['admin_id'];
    $query =" SELECT admin_lang FROM admins WHERE admin_id = '$id'";
	$result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $language=$row['admin_lang'];


    $_SESSION['lang'] = $language;

    if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){

        if($_GET['lang'] == "en")
            $_SESSION['lang'] = "en";

        else if($_GET['lang'] == "hr")
            $_SESSION['lang'] = "hr";
        
        else if($_GET['lang'] == "it")
            $_SESSION['lang'] = "it";
        
        else if($_GET['lang'] == "de")
            $_SESSION['lang'] = "de";
        
    }
  
    require_once "lang/" . $_SESSION['lang'] . ".php";
    
?>