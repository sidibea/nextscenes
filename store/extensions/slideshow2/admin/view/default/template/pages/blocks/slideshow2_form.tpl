<?php if ( !empty($error['warning']) ) { ?>
<div class="warning"><?php echo $error['warning']; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php echo $resources_scripts ?>
<div class="contentBox">
  <div class="cbox_tl"><div class="cbox_tr"><div class="cbox_tc">
    <div class="heading icon_title_product"><?php echo $slideshow2_name; ?></div>
	<?php echo $product_tabs ?>
  </div></div></div>
  <div class="cbox_cl"><div class="cbox_cr"><div class="cbox_cc">

	<?php echo $summary_form; ?>
	<?php echo $form['form_open']; ?>
		<div class="fieldset">
          <div class="heading"><?php echo $form_title; ?></div>
          <div class="top_left"><div class="top_right"><div class="top_mid"></div></div></div>
          <div class="cont_left"><div class="cont_right"><div class="cont_mid">
            <table class="form">
            <tr>
				<td><?php echo $entry_img ?></td>
				<td><?php echo $thumb.$form['fields']['image']; ?></td>
			</tr>
            <tr>
				<td><?php echo $entry_title; ?></td>
				<td>
					<?php echo $form['fields']['title']; ?>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_url; ?></td>
				<td>
					<?php echo $form['fields']['url']; ?>
				</td>
			</tr>
          </table>
	      </div></div></div>
          <div class="bottom_left"><div class="bottom_right"><div class="bottom_mid"></div></div></div>
	    </div><!-- <div class="fieldset"> -->

	<div class="buttons align_center">
	  <button type="submit" class="btn_standard"><?php echo $form['submit']; ?></button>
	  <a class="btn_standard" href="<?php echo $cancel; ?>" ><?php echo $form['cancel']; ?></a>
    </div>
	</form>

  </div></div></div>
  <div class="cbox_bl"><div class="cbox_br"><div class="cbox_bc"></div></div></div>
</div>

<script type="text/javascript"><!--
jQuery(function($){
    $('#slide_image img').click(function(){
        selectDialog('image', $(this).attr('id'));
        return false;
    });
});
//--></script>