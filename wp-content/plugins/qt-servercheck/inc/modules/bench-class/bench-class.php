<?php
/*
##########################################################################
#                      PHP Benchmark Performance Script                  #
#                         � 2010 Code24 BV                               # 
#                                                                        #
#  Author      : Alessandro Torrisi                                      #
#  Company     : Code24 BV, The Netherlands                              #
#  Date        : July 31, 2010                                           #
#  version     : 1.0.1                                                   #
#  License     : Creative Commons CC-BY license                          #
#  Website     : http://www.php-benchmark-script.com                     #	
#                                                                        #
##########################################################################
*/

class benchmark {

	private static function test_Math($count = 140000) {
		$time_start = microtime(true);
		$mathFunctions = array("abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan", "sqrt");
		foreach ($mathFunctions as $key => $function) {
			if (!function_exists($function)) unset($mathFunctions[$key]);
		}
		for ($i=0; $i < $count; $i++) {
			foreach ($mathFunctions as $function) {
				$r = call_user_func_array($function, array($i));
			}
		}
		return number_format(microtime(true) - $time_start, 3);
	}
	
	
	private static function test_StringManipulation($count = 130000) {
		$time_start = microtime(true);
		$stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");
		foreach ($stringFunctions as $key => $function) {
			if (!function_exists($function)) unset($stringFunctions[$key]);
		}
		$string = "the quick brown fox jumps over the lazy dog";
		for ($i=0; $i < $count; $i++) {
			foreach ($stringFunctions as $function) {
				$r = call_user_func_array($function, array($string));
			}
		}
		return number_format(microtime(true) - $time_start, 3);
	}


	private static function test_Loops($count = 19000000) {
		$time_start = microtime(true);
		for($i = 0; $i < $count; ++$i);
		$i = 0; while($i < $count) ++$i;
		return number_format(microtime(true) - $time_start, 3);
	}

	
	private static function test_IfElse($count = 9000000) {
		$time_start = microtime(true);
		for ($i=0; $i < $count; $i++) {
			if ($i == -1) {
			} elseif ($i == -2) {
			} else if ($i == -3) {
			}
		}
		return number_format(microtime(true) - $time_start, 3);
	}	
	
	public static function run ($echo = true) {
		$total = 0;
		$server = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '?') . '@' . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '?' );
		$methods = get_class_methods('benchmark');
		$line = str_pad("-",38,"-");
		$return = "<pre>$line\n|".str_pad("PHP BENCHMARK SCRIPT",36," ",STR_PAD_BOTH)."|\n$line\nStart : ".date("Y-m-d H:i:s")."\nServer : $server\nPHP version : ".PHP_VERSION."\nPlatform : ".PHP_OS. "\n$line\n";
		foreach ($methods as $method) {
			if (preg_match('/^test_/', $method)) {
				$total += $result = self::$method();
				$return .= str_pad($method, 25) . " : " . $result ." sec.\n";
			}
		}
		$return .= str_pad("-", 38, "-") . "\n" . str_pad("Total time:", 25) . " : " . $total ." sec.</pre>";

		$return .= '<h3>Final response</h3>';
		if($total > 10){
			$return .= '<h4>Unacceptable</h4>';
			$return .= '<p>Your server is really slowest than 80% of the servers out there. You will for sure have problems. We recommend going for a higher hosting package or provider.</p>';
		} elseif($total > 7){
			$return .= '<h4>Very slow</h4>';
			$return .= '<p>The performance of your server appears to be low. You may experience troubles.</p>';
		} elseif($total > 5){
			$return .= '<h4>Still acceptable</h4>';
			$return .= '<p>You shouldn\'t have problems but your server appears to be a bit slow</p>';
		} elseif($total > 3){
			$return .= '<h4>Nice</h4>';
			$return .= '<p>All may work fine, still there are better providers out there</p>';
		} else {
			$return .= '<h4>Top!</h4>';
			$return .= '<p>You have a very fast server. The theme functionalities will be fine.</p>';
		}


		if ($echo) echo $return;
		return $return;
	}

}



	
?>