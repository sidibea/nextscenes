<div class="footer_menu">
    <div class="flt_left">
        <ul>
            <li><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
            <li class="separator">|</li>
            <?php if (!$logged) { ?>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } ?>
            <li class="separator">|</li>
            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
            <li class="separator">|</li>
            <li><a href="<?php echo $cart; ?>"><?php echo $text_cart; ?></a></li>
            <li class="separator">|</li>
            <li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
        </ul>
    </div>
    <div class="flt_right payment">
        <img src="<?php echo $this->templateResource('/image/cc.gif'); ?>" alt="" style="vertical-align:middle;" />
    </div>
</div>
<!-- footer blocks placeholder -->
<?php foreach ($children_blocks as $k => $block) { ?>
    <?php if ($k == count($children_blocks)-1 ) { ?>
        <div class="flt_right"><?php echo ${$block}; ?></div>
    <?php } else { ?>
        <div class="flt_left"><?php echo ${$block}; ?></div>
    <?php } ?>
<?php } ?>
<!-- footer blocks placeholder (EOF) -->
<div class="clr_both"></div>
<div class="copyright">
	<?php echo $text_powered_by; ?>
	<a href="http://www.abantecart.com" onclick="window.open(this.href);return false;" title="Ideal OpenSource E-commerce Solution">AbanteCart</a><br />
	<?php echo $text_copy; ?>
</div>
<!--
AbanteCart is open source software and you are free to remove the Powered By AbanteCart if you want, but its generally accepted practise to make a small donatation.
Please donate via PayPal to donate@abantecart.com
//-->