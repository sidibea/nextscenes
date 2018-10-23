<?php
session_start();
require_once("../central/dbcontroller.php");
$db_handle = new DBController();

$query = "select * from menu_lang";
$result = $db_handle->runQuery($query);

$forums = "select * from forums_lang";
$result2 = $db_handle->runQuery($forums);

$query2 = "select * from ns_lang";
$result3 = $db_handle->runQuery($query2); 

$query_info = "select * from ns_infos";
$infos = $db_handle->runQuery($query_info);  

$query_forums_desc = "select * from forums_desc";
$forums_desc = $db_handle->runQuery($query_forums_desc); 
?>
<div class="w100p c_footer">
	<div class="main">
        <ul class="oul">
            <li><a href="../terms1"><?php echo strtoupper($result3[10][$lang."_title"]); ?></a></li>
            <li><a href="../privacy1"><?php echo strtoupper($result3[11][$lang."_title"]); ?></a></li>
            <li>Copyright &copy; <?php date("Y")?> NextScenes, All Rights Reserved.</li>
            <span class="clear"></span>
        </ul>
        <div class="clear"></div>
    </div>
</div>    
<noscript><iframe src="http://www.googletagmanager.com/ns.html?id=GTM-KFC59B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='http://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KFC59B');</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyEgsSBXVzZXJzGICAgK3ik4wJDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->
<a href="javascript:void(0)" id="back-top" class="herald-goto-top"><i class="fa fa-angle-up"></i></a>
<script type='text/javascript' src='../wp-content/plugins/anti-spam/js/anti-spam-4.2.js'></script>
<script type='text/javascript' src='../wp-content/uploads/minit/f3b0c4ea208b4e28e5ff2f493ea400fe.js'></script>

	<!-- Asynchronous scripts by Minit -->

	<script id="async-scripts" type="text/javascript">
	(function() {
		var js, fjs = document.getElementById('async-scripts'),
			add = function( url, id ) {
				js = document.createElement('script'); 
				js.type = 'text/javascript'; 
				js.src = url; 
				js.async = true; 
				js.id = id;
				fjs.parentNode.insertBefore(js, fjs);
			};
		add('../wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js', 'async-script-wc-add-to-cart'); add('../wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js', 'async-script-woocommerce'); add('../wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js', 'async-script-wc-cart-fragments');
	});
	</script>