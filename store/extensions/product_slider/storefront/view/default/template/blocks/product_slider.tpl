<div class="c_block jcarousel">
	<div class="block_tl">
		<div class="block_tr">
			<div class="block_tc"><?php echo $heading_title; ?></div>
		</div>
	</div>
    <div class="block_cl">
    	<div class="block_cr">
        	<div class="block_cc">

                <ul id="mycarousel" class="jcarousel-skin-ie7 list">
                   <!-- The content goes in here -->
                </ul>

            </div>
        </div>
    </div>
	<div class="block_bl">
		<div class="block_br">
			<div class="block_bc">&nbsp;</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<!--
var url = '<?php echo $product_slider_url ?>';

function mycarousel_itemLoadCallback(carousel, state)
{
    if (carousel.has(carousel.first, carousel.last)) {
        return;
    }

    jQuery('#mycarousel .jcarousel-item').addClass('loading');
    var data = {
        first: carousel.first,
        last: carousel.last
    };
    jQuery.get(
        url,
        data,
        function(data) {
            mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, data);
        },
        'json'
    );
};
function mycarousel_itemAddCallback(carousel, first, last, data)
{
    carousel.size(data.total);
    for ( i = 0; i < data.products.length; i++ ) {
        carousel.add(first + i, data.products[i] );
    }
    jQuery('#mycarousel .jcarousel-item').removeClass('loading');
};

myCarousel = null; // This will be the carousel object

function mycarousel_onInitCarousel(carousel, state) {
    if (state == 'init') {
        myCarousel = carousel;
    }
}

function mycarousel_init( ){
    jQuery('#mycarousel').jcarousel({
        initCallback: mycarousel_onInitCarousel,
        itemLoadCallback: mycarousel_itemLoadCallback,
        scroll: 4
    });
}

jQuery(function($){
    mycarousel_init();
});
-->
</script>