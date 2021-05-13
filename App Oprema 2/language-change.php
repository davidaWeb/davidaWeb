<?php
                echo "zahtev poslan";
                if(isset($_POST['lang-en'])) {
                    $query="UPDATE language_choose SET lang_value='$_POST[lang-en]'";
                    $query_run = mysqli_query($conn, $query);
                    echo "update";
                }
?>