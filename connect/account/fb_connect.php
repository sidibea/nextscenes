<?php
include('../include/webzone.php');

$f1 = new Fb_ypbox();
$result = $f1->fb_connect_flow();

echo '<script>window.location="../?connect=fb";</script>';	

?>