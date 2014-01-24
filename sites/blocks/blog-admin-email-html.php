<html lang="en">
	<head>
		<style type="text/css">
			body {
				margin: 0;
				padding: 0;
				font-size: 100%;
				color: #777;
				font-family: Georgia,"Times New Roman",Times,serif;
				background-color: #e5e5e5;
			}
			h1 {
				font-size: 26px;
				line-height: 1.3em;
				font-weight: normal;
				letter-spacing: 15px;
				text-align: center;
				text-transform: uppercase;
				border-bottom: dotted 2px #CCC;
				color: black;
			}
			.link {
				text-decoration: none;
				color: inherit;
				text-shadow: 0px 1px 0px white;
				font-size: 13px;
				line-height: 17px;
				font-style: italic
				font-family: Georgia,"Times New Roman",Times,serif;
				color: #C4856C;
			}
			.link:hover {
				text-decoration: underline;
			}
			.table {
				display: table;
				margin: 0px auto;
				border-collapse: collapse;
				border-spacing: 2px;
				border-color: gray;
				width: 750px;
				table-layout: fixed;
			}
			.table a {
				display: table-row;
				vertical-align: middle;
				text-decoration: none;
				color: inherit;
			}
			.table a:hover {
				background-color: #CCC;
			}
			.table span {
				display: table-cell;
  			font-family: monospace;
  			font-size: medium;
			}
			.cellHeader {
				color: white;
				font-weight: bold;
				text-transform: capitalize;
				text-decoration: underline;
				background-color: #999;
				border: solid 1px #CCC;
				padding: 5px 7px;
				border-bottom: none;
			}
			.cell {
				padding: 10px;
				border: solid 1px #CCC;
				vertical-align: top;
				cursor: pointer;
				word-break: break-word;
			}
			.center {
				text-align: center;
			}
			.left {
				text-align: left;
			}
			#id {
				width: 40px;
			}
			#date {
				width: 90px;
			}
			#username {
				width: 100px;
			}
			#subject {
				width: 150px;
			}
			#message {
				width: 380px;
			}
		</style>
	</head>
	<body>
		<h1>
			New Comment
		</h1>
		<div class="content">
			<center>
				<?php
					if($collection != "blog") {
						$action = 'http://localhost/lyle/administration.php?' . $collection . '-blog-admin=true';
					} else {
						$action = 'http://localhost/lyle/administration.php?blog-admin=true';
					}
					
					$action = $action . '&blog-comment-id=' . $id;
					
					echo '<a class="link" href="' . $action . '&blog-comment-status=approved#comment-' . $id . '">APPROVE</a>';
					echo ' --or-- ';
					echo '<a class="link" href="' . $action . '&blog-comment-status=rejected#comment-' . $id . '">REJECT</a>';
				?>
			</center>
			<br />
			<div class="table">
				<a class="row">
					<span id="id" class="cellHeader center">id:</span>
					<span id="date" class="cellHeader center">date:</span>
					<span id="username" class="cellHeader center">username:</span>
					<span id="subject" class="cellHeader left">subject:</span>
					<span id="message" class="cellHeader left">message:</span>
				</a>
				<?php  
					echo '<a href="' . $action . '#comment-' . $id . '" class="row">';
				?>
					<span id="id" class="cell center"><?php echo $id; ?></span>
					<span id="date" class="cell center"><?php echo $date; ?></span>
					<span id="username" class="cell center"><?php echo $username; ?></span>
					<span id="subject" class="cell left"><?php echo $subject; ?></span>
					<span id="message" class="cell left"><?php echo $message; ?></span>
				</a>
			</div>
			<br />
			<center>
				<?php
					echo '<a class="link" href="' . $action . '">';
				?>
					Visit the site and login as an administrator to see all comments.
				</a>
			</center>
		</div>
	</body>
</html>