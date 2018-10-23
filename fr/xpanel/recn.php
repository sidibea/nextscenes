


<?php
$connection = mysqli_connect ("og21315-001.privatesql:35357","nextscendidb","Sidere852");
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'c_users');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}


