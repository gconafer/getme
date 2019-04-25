<?php



class Blog {

	public function getLatestBlog($BlogDBLink)
	{
		$blogArray = array();
		$q = "select * from wp_posts where post_type = 'post' and post_status = 'publish' order by post_date desc limit 0, 3";
    	if (mysqli_query($BlogDBLink, $q)) {
    		$blogResult = mysqli_query($BlogDBLink, $q);
    		while ($row = mysqli_fetch_array($blogResult)) {
    			$blogArray[] = $row;
    		}
    		return $blogArray;
    	} else {
    		//die('Can not Connect to Blog Mysql Server');
    	}
    	mysqli_free_result($blogResult);
    	mysqli_close($BlogDBLink);
	}
}
?>