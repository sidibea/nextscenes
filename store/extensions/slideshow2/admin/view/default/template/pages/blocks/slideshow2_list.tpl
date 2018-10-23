<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<div class="contentBox">
  <div class="cbox_tl"><div class="cbox_tr"><div class="cbox_tc">
    <div class="heading icon_title_product"><?php echo $slideshow2_name; ?></div>
	<div class="toolbar">
		<div class="buttons">
		  <a class="btn_toolbar" title="Insert" href="<?php echo $insert; ?>">
			<span class="icon_add">&nbsp;</span>
		  </a>
        </div>
	</div>
  </div></div></div>
  <div class="cbox_cl"><div class="cbox_cr"><div class="cbox_cc">

	  <h2><?php echo $form_title; ?></h2>

	  <table class="list">
          <thead>
            <tr>
              <td class="left" width="20%"><b><?php echo $entry_img; ?></b></td>
              <td class="left"><b><?php echo $entry_title; ?></b></td>
              <td class="left"><b><?php echo $entry_url; ?></b></td>
              <td></td>
            </tr>
          </thead>
          <?php $discount_row = 0; ?>
          <?php foreach ($images as $item) { ?>
          <tbody>
            <tr>
              <td class="left"><img src="<?php echo $item['thumbnail_url']; ?>" /></td>
              <td class="left"><?php echo $item['slide_title']; ?></td>
              <td class="left"><?php echo $item['slide_url']; ?></td>
              <td class="left">
                <a href="<?php echo str_replace('%ID%', $item['slide_resource_id'], $update); ?>" class="btn_standard"><?php echo $button_edit; ?></a>
                <a href="<?php echo str_replace('%ID%', $item['slide_resource_id'], $delete); ?>" class="btn_standard"><?php echo $button_remove; ?></a>
              </td>
            </tr>
          </tbody>
          <?php $discount_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="2"></td>
              <td class="left"><a href="<?php echo $insert ?>" class="btn_standard"><?php echo $button_add_slide; ?></a></td>
            </tr>
          </tfoot>
        </table>

  </div></div></div>
  <div class="cbox_bl"><div class="cbox_br"><div class="cbox_bc"></div></div></div>
</div>