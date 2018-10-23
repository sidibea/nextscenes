<?php
$page = "status";
require "central/functions.php";
$scene = $_REQUEST['scene'];
$score = $_REQUEST['score'];
$fro = $_REQUEST['fro'];

$reponse = applyRating($scene, $score, $fro);
echo $reponse;
?>