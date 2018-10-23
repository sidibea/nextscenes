<div class="list_item">
    <div class="image"><a href="<?php echo $item['info_url']?>"><?php echo $item['thumb']['thumb_html']?></a></div>
    <div class="title"><a href="<?php echo $item['info_url']?>"><?php echo $item['title']?></a></div>
    <?php if ($item['display_price']) { ?>
	<div class="price-add">
        <span class="price">
            <?php if (!$item['special']) {
                echo $item['price'];
            } else {
                echo "<span class='normal'>".$item['price']."</span> ".$item['special'];
            }
            ?>
        </span>
    </div>
	<?php } ?>
    <?php if ($item['buy']) { ?>
    <a class="buy" href="<?php echo $item['buy_url']?>."><?php echo $text_buy_now; ?></a>
    <?php } ?>
</div>