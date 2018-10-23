<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
    </div>
  </div>
  <div class="middle">
  <div class="content">
      <h1><?php echo $heading_title; ?></h1>
   <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <b style="margin-bottom: 2px; display: block;"><?php echo $text_payment_address; ?></b>
    <div class="content">
      <table width="100%">
        <tr>
          <td width="50%" valign="top"><?php echo $text_payment_to; ?><br />
            <br />
            <div style="text-align: center;"><?php echo  $change_address; ?></div>
          </td>
          <td width="50%" valign="top"><b><?php echo $text_payment_address; ?></b><br />
            <?php echo $address; ?></td>
        </tr>
      </table>
    </div>
    <?php if ($coupon_status) { ?>
    <div class="content">
		<?php if ($coupon_status) {
				echo $coupon_form;
			} ?>
    </div>
    <?php }
	  echo $form['form_open'];
	  ?>
      <?php if ($payment_methods) { ?>
      <b style="margin-bottom: 2px; display: block;"><?php echo $text_payment_method; ?></b>
      <div class="content">
        <p><?php echo $text_payment_methods; ?></p>
        <table width="100%" cellpadding="3">
          <?php foreach ($payment_methods as $payment_method) { ?>
          <tr>
            <td width="1"><?php echo $payment_method['radio']; ?></td>
            <td><label for="payment_payment_method<?php echo $payment_method['id']; ?>" style="cursor: pointer;"><?php echo $payment_method['title']; ?></label></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <?php } ?>
      <b style="margin-bottom: 2px; display: block;"><?php echo $text_comments; ?></b>
      <div class="content">
      	<?php echo $form['comment']?>
		  <div class="clr_both"></div>
      </div>
      <?php echo $this->getHookVar('buttons_pre'); ?>
      <?php echo $buttons; ?>
      <?php echo $this->getHookVar('buttons_post'); ?>
    </form>
  </div>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<script language="JavaScript">
	$('#change_address').click( function(){
		location = '<?php echo $change_address_href; ?>';
	} );
	$('#payment_back').click( function(){
		location = '<?php echo $back; ?>';
	} );
</script>