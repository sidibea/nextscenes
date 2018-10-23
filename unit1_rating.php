<?php
$page = "status";
require "central/functions.php";
$pscene = $_REQUEST['pscene'];
$scene = $_REQUEST['scene'];
$score = $_REQUEST['score'];
$fro = $_REQUEST['fro'];

$reponse = applyunit1Rating($scene, $score, $fro, $pscene);
echo $reponse;
?>