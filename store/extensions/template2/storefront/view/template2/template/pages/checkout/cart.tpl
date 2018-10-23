<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
    </div>
  </div>
  <div class="middle">
  <div class="content">
      <h1>
        <?php echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?>
      </h1>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php }
	  echo $form['form_open'];
	  ?>

      <table class="cart"  cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th align="center"><?php echo $column_remove; ?></th>
          <th align="center"><?php echo $column_image; ?></th>
          <th align="left" ><?php echo $column_name; ?></th>
          <th align="left"><?php echo $column_model; ?></th>
          <th align="center"><?php echo $column_quantity; ?></th>
          <th align="right"><?php echo $column_price; ?></th>
          <th align="right"><?php echo $column_total; ?></th>
        </tr>
        <?php $class = 'odd'; ?>
        <?php foreach ($products as $product) { ?>
        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
        <tr class="<?php echo $class; ?>">
          <td align="center"><?php echo $product['remove']; ?></td>
          <td align="center"><a href="<?php echo $product['href']; ?>"><?php echo $product['thumb']['thumb_html']; ?></a></td>
          <td align="left" ><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <?php if (!$product['stock']) { ?>
            <span style="color: #FF0000; font-weight: bold;">***</span>
            <?php } ?>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
              <?php } ?>
            </div></td>
          <td align="left" ><?php echo $product['model']; ?></td>
          <td align="center"><?php echo $product['quantity']; ?></td>
          <td align="right"><?php echo $product['price']; ?></td>
          <td align="right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>
      </table>
	  <div style="width: 100%; display: inline-block;">
        <table style="float: right; display: inline-block;">
          <?php foreach ($totals as $total) { ?>
          <tr>
            <td align="right"><b><?php echo $total['title']; ?></b></td>
            <td align="right"><?php echo $total['text']; ?></td>
          </tr>
          <?php } ?>
        </table>
        <br />
      </div>
      <div class="buttons">
        <table>
          <tr>
            <td align="left"><?php echo $form['update']; ?></td>
            <td align="center"></td>
            <td align="right"><?php echo $form['checkout']; ?></td>
          </tr>
        </table>
      </div>
    </form>
  </div>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<script type="text/javascript">
	$('#cart_checkout').click( function(){
		location = '<?php echo $checkout; ?>';
	})
</script>