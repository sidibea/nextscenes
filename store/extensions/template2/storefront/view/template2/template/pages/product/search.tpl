<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
  <div class="middle">
  <div class="content">

	<b><?php echo $text_critea; ?></b>
    <div id="content_search">
      <table>
        <tr>
          <td><?php echo $entry_search; ?></td>
          <td><?php echo $keyword.$category; ?></td>
        </tr>
        <tr>
          <td colspan="2" ><?php echo $description; ?></td>
        </tr>
		<tr>
          <td colspan="2"><?php echo $model; ?></td>
        </tr>
      </table>
    </div>
    <div class="buttons">
      <table>
        <tr>
          <td align="right"><?php echo $submit; ?></td>
        </tr>
      </table>
    </div>
	<div class="pagination pagination_top"><?php echo $pagination; ?><br class="clr_both" /></div>
    <div class="heading"><?php echo $text_search; ?></div>
    <?php if ($products) { ?>
    <div class="list">
    <?php for ($j = 0; $j < sizeof($products); $j++) {
        echo $products[$j];
    }
    ?>
	<br class="clr_both" />
    </div>
    <div class="pagination"><?php echo $pagination; ?><br class="clr_both" /></div>

    <?php } else { ?>
    <div><?php echo $text_empty; ?></div>
    <?php }?>
  </div>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<script type="text/javascript"><!--
$('#content_search input').keydown(function(e) {
	if (e.keyCode == 13) {
		contentSearch();
	}
});
$('#search_button').click(function(e) {
		contentSearch();
});

$('#sort').change(function(){
	contentSearch();
});

function contentSearch() {
	url = 'index.php?rt=product/search&limit=<?php echo $limit; ?>';
	
	var keyword = $('#keyword').attr('value');
	
	if (keyword) {
		url += '&keyword=' + encodeURIComponent(keyword);
	}

	var category_id = $('#category_id').attr('value');
	
	if (category_id) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	if ($('#description').is(':checked')) {
		url += '&description=1';
	}
	
	if ($('#model').is(':checked')) {
		url += '&model=1';
	}
	url += '&sort='+$('#sort').val();
	
	location = url;
}
//--></script>