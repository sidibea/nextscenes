<?php
$page = "status";
require "central/functions.php";
$scene = $_POST['scene'];
$comment = $_POST['comment'];
$fro = $_POST['fro'];

$reponse = addComment($scene, $comment, $fro);
echo $reponse;
?>