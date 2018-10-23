<?php
$page = "status";
require "common/functions.php";
$scene = $_POST['scene'];
$score = $_POST['score'];
$fro = $_POST['fro'];

$reponse = applyRating($scene, $score, $fro);
echo $reponse;
?>