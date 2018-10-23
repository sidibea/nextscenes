<?php
$page = "status";
require "central/functions.php";
$scene = $_POST['scene'];
$fro = $_POST['fro'];

$reponse = loadScene($scene, $fro);
echo $reponse;
?>