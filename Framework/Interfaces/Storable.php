<?php

namespace BDB\Framework\Interfaces;

interface Storable {
	public function GetBaseQuery();
	
	public function Store();
}

?>