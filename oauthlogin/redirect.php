<?php
if($result)
{
$_SESSION['userSession']=$result;
$home=$base_url.'forums.html';
echo "<script>window.location.href='".$home."'</script>";
//header("Location:$home");
}
?>