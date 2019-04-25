<?php

class Common {

	public function checkStringSanitize($string)
	{
		if(!empty($string)) 
		{
			$string = ucwords($string);
			$string = trim($string);
			return $string;
		} else {
			return '';
		}
	}

	function save_image($inPath, $outPath) { 
		$in = fopen($inPath, "rb");
    	$out = fopen($outPath, "wb");
    	while ($chunk = fread($in,8192)) {
    		fwrite($out, $chunk, 8192);
    	}
    	fclose($in);
    	fclose($out);	
	}

	function isValidEmail($email) {
		return preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email);
	}
	
	public function paginationList($totalCount, $pageSize, $page, $url)
	{
		if($totalCount > $pageSize) {
			$noOfIteration = ceil($totalCount/$pageSize);
			$prev = $page - 1;
			$next = $page + 1;
			$minLimit = $page - 4;
			$maxLimit = $page + 4;

			if($prev > 1) {
				$prevUrl = $url.'-'.$prev;
			} else {
				$prevUrl = $url;
			}

			echo '<nav class="text-center"><ul class="pagination">';
			if($page == 1) {
				echo '<li><a href="#" aria-label="Previous"><i class="zmdi zmdi-chevron-left"></i></a></li>';
	 		} else {
	 			echo '<li><a href="'.$prevUrl.'" aria-label="Previous"><i class="zmdi zmdi-chevron-left"></i></a></li>';
			}

			for($i = 1; $i <= $noOfIteration; $i++)
			{

				if($i > 1) {
					$pUrl = $url.'-'.$i;
				} else {
					$pUrl = $url;
				}

				if($i >= $page) {
					if($page == $i) {
						if($noOfIteration != 1) {
							echo '<li class="active"><a href="#">'.$i.'</a></li>';
						}
					} else {
						if($i >= $minLimit && $i <= $maxLimit) {
			        		echo '<li><a href="'.$pUrl.'">'.$i.'</a></li>';
						}
					
					}
				} else {
					if($page == $i) {
						if($noOfIteration !=1) {
				    		echo '<li class="active"><a href="#">'.$i.'</a></li>';
						}
					} else {
						if($i >= $minLimit && $i <= $maxLimit) {
							echo '<li><a href="'.$pUrl.'">'.$i.'</a></li>';
						}
					}
				}
			}
			
			if($noOfIteration == $page) {
            	echo '<li><a href="#" aria-label="Next"><i class="zmdi zmdi-chevron-right"></i></a></li>';                                
			} else {    
           		echo '<li><a href="'.$url.'-'.$next.'" aria-label="Previous"><i class="zmdi zmdi-chevron-right"></i></a></li>';
			}
      		echo '</ul>';  
		} 
	}


}
