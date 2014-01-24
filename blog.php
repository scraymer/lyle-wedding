<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>News | Lisa Craymer and Kyle Watters Wedding</title>
	
	<!-- ### START | METADATA ### -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Samuel W. Craymer" />
  <meta name="description" content="Lisa & Kyle's wedding website news." />
  <meta charset="utf-8" />
  <!-- ### END | METADATA ### -->
	
	<?php include("include.php"); ?>
	
</head>
<body class="no-sidebars" onload="activeMenuLink('menu-blog')">

	<div id="page-wrapper"><div id="page">
	<div id="header"><div class="section clearfix">
	
		<!-- ### START | HEADER REGION ### -->
		<div class="region region-header">
			
			<?php include("header.php"); ?>
			
		</div><!-- /.region -->
		<!-- ### END | HEADER REGION ### -->
		
	</div></div><!-- /.section, /#header -->
  <div id="main-wrapper"><div id="main" class="clearfix">
    <div id="content" class="column"><div class="section">
    	
    	<!-- ### START | HIGHLIGHT REGION ### -->
    	<div class="region region-highlighted">
    	
    	
    		<!-- START HEADER HERE! -->
    		
    		<!-- *** START | Content Title *** -->
				<h1 class="title" id="page-title">News Wall</h1>
				<!-- *** END | Content Title *** -->
    		
    		<!-- END HEADER HERE! -->		
    		
    				
  		</div><!-- /.region -->
  		<!-- ### END | HIGHLIGHT REGION ### -->
      
      <!-- ### START | MAIN CONTENT REGION ### -->
      <div class="region region-content">
      
     		<!-- *** START | Main Content *** -->
    		<div id="block-system-main" class="block block-system first odd">
    			<div class="content">
    				
    				
    				<!-- START HERE! -->
    				
    				<?php
							if(isset($_GET['newsletter'])) {
								if($_GET['newsletter'] == 'subscribe') {
									echo "<!-- START BLOG-NEWSLETTER-SUBSCRIBE BLOCK -->";
									include("sites/blocks/blog-newsletter-subscribe.php");
									echo "<!-- END BLOG-NEWSLETTER-SUBSCRIBE BLOCK -->";
								} elseif($_GET['newsletter'] == 'unsubscribe' && isset($_GET['email'])) {
									echo "<!-- START BLOG-NEWSLETTER-UNSUBSCRIBE BLOCK -->";
									include("sites/blocks/blog-newsletter-unsubscribe.php");
									echo "<!-- END BLOG-NEWSLETTER-UNSUBSCRIBE BLOCK -->";
								}
								
							}
    				?>
    				
    				<?php
							echo "<!-- START BLOG-WALL BLOCK -->";
							include("sites/blocks/blog-wall.php");
							echo "<!-- END BLOG-WALL BLOCK -->";
    				?>
    				
    				<?php
							echo "<!-- START | BLOCK-DATE-BIGDAY -->";
							include("sites/blocks/date-bigDay.php");
							echo "<!-- END | BLOCK-DATE-BIGDAY -->";
    				?>
    				
    				<!-- END HERE! -->
    				
    				
  				</div><!--/.content-->
				</div><!-- /.block -->
				<!-- *** END | Main Content *** -->
				
  		</div><!-- /.region -->
  		<!-- ### END | MAIN CONTENT REGION ### -->
  		
    </div></div><!-- /.section, /#content -->
	</div></div><!-- /#main, /#main-wrapper -->
  
	<!-- ### START | FOOTER REGION ### -->
	<div class="region region-footer">
	
		<?php include("footer.php"); ?>
	
	</div><!-- /.region -->
	<!-- ### END | FOOTER REGION ### -->
  
	</div>
	</div><!-- /#page, /#page-wrapper -->

</body>
</html>
