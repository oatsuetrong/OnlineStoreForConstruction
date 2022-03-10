<?php
	// Convert a string to an array with multibyte string
	function getMBStrSplit ($string, $split_length = 1) {
		mb_internal_encoding('UTF-8');
		mb_regex_encoding('UTF-8'); 
		
		$split_length = ($split_length <= 0) ? 1 : $split_length;
		$mb_strlen = mb_strlen($string, 'utf-8');
		$array = array();
		$i = 0; 
		
		while ($i < $mb_strlen) {
			$array[] = mb_substr($string, $i, $split_length);
			$i = $i+$split_length;
		}
		return $array;
	}

	// Get string length for Character Thai
	function getStrLenTH ($string) {
		$array = getMBStrSplit($string);
		$count = 0;
		
		foreach ($array as $value) {
			$ascii = ord(iconv("UTF-8", "TIS-620", $value ));
			if( !($ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 ))) {
				$count += 1;
			}
		}
		return $count;
	}

	// Get part of string for Character Thai
	function getSubStrTH ($string, $start, $length) {			
		$length = ($length+$start)-1;
		$array = getMBStrSplit($string);
		$count = 0;
		$return = "";
			
		for ($i=$start; $i < count($array); $i++) {
			$ascii = ord(iconv("UTF-8", "TIS-620", $array[$i] ));
			
			if ($ascii == 209 ||  ($ascii >= 212 && $ascii <= 218) || ($ascii >= 231 && $ascii <= 238)) {
				$length++;
			}
			
			if ($i >= $start) {
				$return .= $array[$i];
			}
			
			if ($i >= $length) {
				break;
			}
		}
		return $return;
	}
?>