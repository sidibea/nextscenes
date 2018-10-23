<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class template2_Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $limits = array(10, 20, 30, 40, 50);
	public $num_links = 10;
	public $url = '';
	public $text = 'Showing {start} to {end} of {total} ({pages} Pages)';
	public $text_limit = 'Per Page';
	public $text_first = '|&lt;';
	public $text_last = '&gt;|';
	public $text_next = '&gt;';
	public $text_prev = '&lt;';
	public $style_links = 'links';
	public $style_results = 'results';
	public $style_limits = 'limits';
	 
	public function render() {
		$total = $this->total;		
		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}
		
		if (!$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}
		$this->url = str_replace('{limit}',$limit,$this->url);
		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);
		
		$stdout = '';
		
		if ($page > 1) {
			$stdout .= /*' <a class="first" href="' . str_replace('{page}', 1, $this->url) . '">' . $this->text_first . '</a>*/ '[ <a class="previous" href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a> ]';
    	}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
			
				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}
						
				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			if ($start > 1) {
				$stdout .= ' .... ';
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$stdout .= ' <b>' . $i . '</b> ';
				} else {
					$stdout .= ' <a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a> ';
				}	
			}
							
			if ($end < $num_pages) {
				$stdout .= ' .... ';
			}
		}
		
   		if ($page < $num_pages) {
			$stdout .= '[ <a class="next" href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a> ]';// <a class="last" href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a> ';
		}
		
		return ($stdout ? '<div class="' . $this->style_links . '">' . $this->text . $stdout . '</div>' : '');
	}
}
?>