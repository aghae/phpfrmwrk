<?php

class pagin{

	function make($total, $PerPage, $current, $urlPattern){
		$current=$current?:1;
		$pg =getinstance('Paginator','lib',[$total, $PerPage, $current,$urlPattern]);
		return $pg;
	}

}