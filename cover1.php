<?php
session_start();
function clean($str){
	return mysql_real_escape_string($str);
}
if(empty($_SESSION['idsession'])) {
	header("Location: login1");
}
	require "central/fr_functions.php";
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$page = "account";
	$me = getUser($page);
	if($me['c_usertypes_ut_id'] == 1){
		$_SESSION['toSuper'] = true;
		header("location: manage-account-user");
		exit;
	}
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Create Book Cover</title>
<style type="text/css">
.cc-selector-2 input[type="radio"]{
    position:absolute;
    z-index:999;
}

.i1{background-image:url(covers/1.jpg);}
.i2{background-image:url(covers/2.jpg);}
.i3{background-image:url(covers/3.jpg);}
.i4{background-image:url(covers/4.jpg);}
.i5{background-image:url(covers/5.jpg);}
.i6{background-image:url(covers/6.jpg);}
.i7{background-image:url(covers/7.jpg);}
.i8{background-image:url(covers/8.jpg);}
.i9{background-image:url(covers/9.jpg);}
.i10{background-image:url(covers/10.jpg);}
.i11{background-image:url(covers/11.jpg);}
.i12{background-image:url(covers/12.jpg);}
.i13{background-image:url(covers/13.jpg);}
.i14{background-image:url(covers/14.jpg);}
.i15{background-image:url(covers/15.jpg);}

.cc-selector-2 input[type="radio"]:active +.drinkcard-cc, .cc-selector input[type="radio"]:active +.drinkcard-cc{opacity: .9;}
.cc-selector-2 input[type="radio"]:checked +.drinkcard-cc, .cc-selector input[type="radio"]:checked +.drinkcard-cc{
    -webkit-filter: none;
       -moz-filter: none;
            filter: none;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    width:100px;height:70px;
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);
}
.drinkcard-cc:hover{
    -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
       -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
            filter: brightness(1.2) grayscale(.5) opacity(.9);
    background-size:100% 100%;
}
</style>
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">
				<div class="twins">
                	<a href="account-activities1"><?php echo $result3[25][$lang."_".title];?></a>
                	<a href="manage-account1"><?php echo $result3[26][$lang."_".title];?></a>
                	<a href="cover1"><?php echo $result3[27][$lang."_".title];?></a>
                	<a href="messaging1">Message</a>
                	<a href="notification1">Notification</a>
                </div>
            	<fieldset>
					<legend><?php echo $result3[28][$lang."_".title];?></legend>
					<form action="mint1?action=cover" method="post" class="e-form">
						<label for="bookTitle"><?php echo $result3[29][$lang."_".title];?></label>
						<input type="text" name="title" />
						<label for="author"><?php echo $result3[31][$lang."_".title];?></label>
						<input type="text" name="written" />
						<label for="desc"><?php echo $result3[32][$lang."_".title];?></label>
						<textarea name="desc"></textarea>
						<label for="pattern"><?php echo $result3[33][$lang."_".title];?></label>
						<div class="cc-selector-2">
							<input id="i1" type="radio" name="pattern" value="i1" />
							<label class="drinkcard-cc i1" for="i1"></label>
							<input id="i2" type="radio" name="pattern" value="i2" />
							<label class="drinkcard-cc i2" for="i2"></label>
							<input id="i3" type="radio" name="pattern" value="i3" />
							<label class="drinkcard-cc i3" for="i3"></label>
							<input id="i4" type="radio" name="pattern" value="i4" />
							<label class="drinkcard-cc i4" for="i4"></label>
							<input id="i5" type="radio" name="pattern" value="i5" />
							<label class="drinkcard-cc i5" for="i5"></label>
							<input id="i6" type="radio" name="pattern" value="i6" />
							<label class="drinkcard-cc i6" for="i6"></label>
							<input id="i7" type="radio" name="pattern" value="i7" />
							<label class="drinkcard-cc i7" for="i7"></label>
							<input id="i8" type="radio" name="pattern" value="i8" />
							<label class="drinkcard-cc i8" for="i8"></label>
							<input id="i9" type="radio" name="pattern" value="i9" />
							<label class="drinkcard-cc i9" for="i9"></label>
							<input id="i10" type="radio" name="pattern" value="i10" />
							<label class="drinkcard-cc i10" for="i10"></label>
							<input id="i11" type="radio" name="pattern" value="i11" />
							<label class="drinkcard-cc i11" for="i11"></label>
							<input id="i12" type="radio" name="pattern" value="i12" />
							<label class="drinkcard-cc i12" for="i12"></label>
							<input id="i13" type="radio" name="pattern" value="i13" />
							<label class="drinkcard-cc i13" for="i13"></label>
							<input id="i14" type="radio" name="pattern" value="i14" />
							<label class="drinkcard-cc i14" for="i14"></label>
							<input id="i15" type="radio" name="pattern" value="i15" />
							<label class="drinkcard-cc i15" for="i15"></label>
						</div>
						<div align="center"><input type="submit" value="<?php echo $result3[34][$lang."_".title];?>" class="btn btn-success" /></div>
					</form>
				</fieldset>
			</div>
			</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>