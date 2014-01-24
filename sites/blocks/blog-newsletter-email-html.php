<html lang="en">
	<head>
		<style type="text/css">
			body {
				margin: 0;
				padding: 20px;
				color: #777;
				font-family: Georgia,"Times New Roman",Times,serif;
			}
			a {
				color: inherit;
				text-decoration: none;
				cursor: auto;
			}
			a.colorLink {
				color: #C4856C;
			}
			a.colorLink:hover {
				text-decoration: underline;
			}
			
			h2 {
				color: black;
				text-align: center;
				font-style: normal;
				font-weight: normal;
				line-height: 1.3em; /* 1.3em */
				letter-spacing: 8px;
				text-transform: uppercase;
				font-size: 20px;
				border-bottom: dotted 1px #CCC;
				margin: 0;
				display: block;
			}
			h3 {
				color: black;
				font-size: 18px;
				font-weight: bold;
				line-height: 1.2em;
				text-decoration: underline;
				margin: 0px;
				padding: 0px;
				display: block;
			}
			.username {
				font-weight: bold;
			}
			#content {
				width: 700px;
				line-height: 1.286em;
				background-color: white;
				padding: 10px 20px 1px 20px;
				margin: 0px auto 0px auto;
				position: relative;
				display: block;
				box-shadow: 0px 1px 3px #666;
				-moz-box-shadow: 0px 0px 3px #666;
				-webkit-box-shadow: 0px 0px 3px #666;
			}
			#footer {
				color: #7F7F7F;
				text-align: center;
				text-decoration: none;
				text-shadow: 0px 1px 0px white;
				font-style: italic;
				font-size: 12px;
				margin: 0px auto;
			}
			#comment {
				padding: 15px 20px 5px 20px;
				margin-top: 20px;
				background-color: #F5F5F5;
				border: double 3px #CCC;
				display: block;
			}
			#details {
				font-size: 12px;
				font-style: italic;
			}
			#message {
				display: block;
				font-size: 0.875em;
				line-height: 1.286em;
			}
		</style>
		<?php
			$link = 'http://localhost/lyle/' . $collection . '.php';
		?>
	</head>
	<body>
		<div id="content">
			<h2 id="title">
				<?php echo '<a href="' . $link . '">'; ?>
					Lisa & Kyle's Wedding Newsletter
				</a>
			</h2>
			<div id="comment">
				<h3 id="subject">
					<?php echo '<a href="' . $link . '#comment-' . $id . '" rel="bookmark" class="colorLink">'; ?>
						<?php echo $subject; ?>
					</a>
				</h3>
				<div id="details">
					Submitted by <span class="username"><?php echo $username; ?></span> on <?php echo $date; ?>
				</div>
				<div id="message">
					<p>
						<?php echo $message; ?>
					</p>
				</div>
			</div>
			<div id="footer">
				<p>
					<a href="http://localhost/lyle/home.php">Home</a> | 
					<a href="http://localhost/lyle/rss-check.php">RSS Feed</a> | 
					<a href="http://localhost/lyle/contact.php">Contact</a> | 
					<?php
						echo '<a href="http://localhost/lyle/blog.php?newsletter=unsubscribe&email=' . $email . '">Unsubscribe</a>'
					?>
				</p>
			</div>
		</div>
	</body>
</html>