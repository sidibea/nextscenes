<div id="slideshow_wrapper">
    <div id="slideshow">
    <?php foreach ($slides as $i) : ?>
        <a href="<?php echo $i['slide_url']; ?>" onclick="window.open(this.href);return false;" title="<?php echo $i['slide_title']; ?>"><img src="<?php echo $i['thumbnail_url']; ?>" alt="<?php echo $i['slide_title']; ?>" /></a>
    <?php endforeach; ?>
    </div>
    <div id="slideshow_controls">
    	<div id="slideshow_nav"></div>
    </div>
</div>
<script type="text/javascript"><!--
$('#slideshow')
    .cycle({
        fx: 'fade',
        speed: <?php echo $this->config->get('slideshow2_speed'); ?>,
		timeout: <?php echo $this->config->get('slideshow2_timeout'); ?>,
        pause:  1,
        pager:  '#slideshow_nav'
    });

$('#slideshow_nav a:last').addClass('last');
--></script>