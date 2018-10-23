<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
    </div>
  </div>
  <div class="middle">
  <div class="content">
	<div class="pagination pagination_top"><?php echo $pagination; ?><br class="clr_both" /></div>
    <h1><?php echo $heading_title; ?></h1>
    <?php if ($description) { ?>
    <div style="margin-bottom: 15px;"><?php echo $description; ?></div>
    <?php } ?>
	<?php if (!$categories && !$products) { ?>
    <div class="content"><?php echo $text_error; ?></div>
    <?php } ?>
    <?php if ($categories) { ?>
      <div class="subcategories">
      <?php for ($j = 0; $j < sizeof($categories); $j++) { ?>
        <div class="category_item">
          <a href="<?php echo $categories[$j]['href']; ?>"><?php echo $categories[$j]['thumb']['thumb_html']; ?></a><br />
          <a href="<?php echo $categories[$j]['href']; ?>"><?php echo $categories[$j]['name']; ?></a>
        </div>
      <?php } ?>
      <br class="clr_both" />
      </div>
    <?php } ?>

    <?php if ($products) { ?>
    <div class="list">
    <?php for ($j = 0; $j < sizeof($products); $j++) {
        echo $products[$j];
    }
    ?>
	<br class="clr_both" />
    </div>
    <div class="pagination"><?php echo $pagination; ?><br class="clr_both" /></div>
    <?php } ?>
  </div>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<script type="text/javascript"><!--

$('#sort').change(function() {
	Resort();
});

function Resort() {
	url = '<?php echo $url; ?>';
	url += '&sort=' + $('#sort').val();
	url += '&limit=' + $('#limit').val();
	location = url;
}
//--></script>