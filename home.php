<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Welcome | Lisa Craymer and Kyle Watters Wedding</title>
	
	<!-- ### START | METADATA ### -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Samuel W. Craymer" />
  <meta name="description" content="Lisa & Kyle's wedding website welcome page." />
  <meta charset="utf-8" />
  <!-- ### END | METADATA ### -->
	
	<?php include("include.php"); ?>
	
</head>
<body class="no-sidebars" onload="activeMenuLink('menu-home')">

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
							echo "<!-- START | BLOCK-BANNER-SLIDESHOW -->";
							include("sites/blocks/banner-slideshow.php");
							echo "<!-- END | BLOCK-BANNER-SLIDESHOW -->";
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
