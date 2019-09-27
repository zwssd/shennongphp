<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Pag {
	public $url = '';
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 8;

	public $first = '|&lt;';
	public $last = '&gt;|';
	public $next = '&gt;';
	public $prev = '&lt;';
	public $full_start = '<div class="pag">';
	public $full_end = '</div>';
	public $cur_start = '<strong>';
	public $cur_end = '</strong>';
	public $num_start = '<li>';
	public $num_end = '</li>';
	public $first_start = '<li>';
	public $first_end = '</li>';
	public $last_start = '<li>';
	public $last_end = '</li>';
	public $next_start = '<li>';
	public $next_end = '</li>';
	public $prev_start = '<li>';
	public $prev_end = '</li>';

	public function __construct($lang, $params = array())
	{
		foreach (array('first', 'next', 'prev', 'last') as $key)
		{
			if (($val = $lang->get_key($key)) !== FALSE)
			{
				$this->$key = $val;
			}
		}

		foreach ($params as $key => $val)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $val;
			}
		}
	}

	public function get_link() {
		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		$out = $this->full_start;

		if ($page > 1) {
			$out .= $this->first_start.'<a href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">' . $this->first . '</a>'.$this->first_end;
			
			if ($page - 1 === 1) {
				$out .= $this->prev_start.'<a href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">' . $this->prev . '</a>'.$this->prev_end;
			} else {
				$out .= $this->prev_start.'<a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->prev . '</a>'.$this->prev_end;
			}
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

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$out .= $this->cur_start . $i . $this->cur_end;
				} else {
					if ($i === 1) {
						$out .= $this->num_start.'<a href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">' . $i . '</a>'.$this->num_end;
					} else {
						$out .= $this->num_start.'<a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a>'.$this->num_end;
					}
				}
			}
		}

		if ($page < $num_pages) {
			$out .= $this->next_start.'<a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->next . '</a>'.$this->num_end;
			$out .= $this->last_start.'<a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->last . '</a>'.$this->last_end;
		}

		$out .= $this->full_end;

		if ($num_pages > 1) {
			return $out;
		} else {
			return '';
		}
	}
}
