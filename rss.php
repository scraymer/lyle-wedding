<?php
	
	if(!eregi("chrome", $_SERVER['HTTP_USER_AGENT'])) {
		header("Content-Type: application/rss+xml; charset=ISO-8859-1");
	} else {
		
	}
	
  //include required classes
	require_once('sites/classes/comment.php');
  
  //get all blog comments order by DESC date
	$comments = Comment::selectCommentsByCollection('blog', 'date', 'DESC');
 
	$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
	$rssfeed .= '<rss version="2.0">';
	$rssfeed .= '<channel>';
		$rssfeed .= '<title>Lisa Craymer and Kyle Watters\' Wedding Website</title>';
		$rssfeed .= '<link>http://localhost/lyle/</link>';
		$rssfeed .= '<description>';
			$rssfeed .= 'We will keep you informed on important news about our wedding as it happens.';
		$rssfeed .= '</description>';
		$rssfeed .= '<image>';
			$rssfeed .= '<url>https://dl.dropbox.com/u/36151686/sites/themes/wedding/images/logo.png</url>';
			$rssfeed .= '<title>Lisa and Kyle\'s Wedding</title>';
			$rssfeed .= '<link>http://localhost/lyle/</link>';
		$rssfeed .= '</image>';
		$rssfeed .= '<lastBuildDate>' . date('D, d M Y H:i:s O') . '</lastBuildDate>';
		$rssfeed .= '<category>Wedding Information</category>';
		$rssfeed .= '<managingEditor>lisa@craymer.com (Lisa Craymer)</managingEditor>';
		$rssfeed .= '<webMaster>sam@craymer.com (Samuel Craymer)</webMaster>';
		$rssfeed .= '<language>en-us</language>';
		$rssfeed .= '<copyright>Copyright (C) 2012. All rights reserved.</copyright>';
		$rssfeed .= '<ttl>60</ttl>';
 		
 		for($i=0; $i<count($comments); $i++) {
 			$id = $comments[$i]->get_id();
			$username = $comments[$i]->get_username();
			$subject = $comments[$i]->get_subject();
			$message = $comments[$i]->get_message();
			$date = $comments[$i]->get_date(false);
			$status = $comments[$i]->get_status();
 		
			if($username == null) {
				$username = "Anonymous";
			}
			
			if($subject == null) {
				$subject = $username . " wrote:";
			}
			
			if($status == "approved") {
				$rssfeed .= '<item>';
					$rssfeed .= '<title>' . $subject . '</title>';
					$rssfeed .= '<link>http://localhost/lyle/blog.php#comment-' . $id . '</link>';
					$rssfeed .= '<description xml:space="preserve">';
						$rssfeed .= preg_replace('/<br><br>/i', "<br/><br/>", $message);
					$rssfeed .= '</description>';
					$rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", $date) . '</pubDate>';
					$rssfeed .= '<author>' . $username . '</author>';
				$rssfeed .= '</item>';
			}
		}
		
	$rssfeed .= '</channel>';
	$rssfeed .= '</rss>';
 	
  echo $rssfeed;
  
?>