<?php
	echo 'Lisa and Kyle\'s Wedding Newsletter' . "\r\n";
	
	echo $subject . "\r";
	echo 'Submitted by ' . $username . ' on ' . $date . "\r\n";
	
	echo preg_replace('/<br><br>/i', "\r\n", preg_replace('/<br/><br/>/i', "\r\n", $message)) . "\r\n";
	
	echo 'Read More: http://localhost/lyle/blog.php#comment-' . $id . "\r";
	echo 'RSS Feed: http://localhost/lyle/rss-check.php' . "\r";
	echo 'Contact: http://localhost/lyle/contact.php' . "\r";
	echo 'Unsubscribe: http://localhost/lyle/blog.php?newsletter=unsubscribe&email=' . $email . "\r\n";
?>