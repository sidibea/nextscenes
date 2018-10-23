<div id="currency">
  <?php if ($currencies): ?>
	  <div>
		  <?php foreach ($currencies as $k => $currency): ?>
			  <a <?php if ($currency['code'] == $currency_code) { echo 'class="selected"'; } ?> href="<?php echo $currency[ 'href' ] ?>"><?php echo $currency['symbol']; ?></a>
			  <?php if ( $k+1 < count($currency) ) { ?>
			  <span class="separator"></span>
			  <?php } ?>
		  <?php endforeach;
			echo $form['code'];
			echo $form['redirect'];
			?>
	  </div>
  <?php endif; ?>

</div>