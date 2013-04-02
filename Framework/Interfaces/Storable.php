<?php

namespace BDB\Framework\Interfaces;

interface Storable {
	public static function GetBaseQuery();
	
	public function Store();
}

?>