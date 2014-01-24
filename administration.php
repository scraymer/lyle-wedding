<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Administration | Lisa Craymer and Kyle Watters Wedding</title>
	
	<!-- ### START | METADATA ### -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Samuel W. Craymer" />
  <meta name="description" content="Lisa & Kyle's wedding website administration page." />
  <meta charset="utf-8" />
  <!-- ### END | METADATA ### -->
	
	<?php 
	include_once("include.php");
	?>
	
</head>
<body class="no-sidebars">

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
        <h1 class="title" id="page-title">Administration</h1>
    		<!-- *** END | Content Title *** -->
    		
    		<!-- *** START | Account Menues *** -->
    		<?php
					//get global variables
					global $auth;
					
					//blocks if there is no user authenticated
					if($auth[0] == null) {
						
					}
					
					//blocks if any user has been authenticated
					if($auth[0] != null) {
						echo "<!-- START USER MENU BLOCK -->";
						include("sites/blocks/user-menu.php");
						echo "<!-- END USER MENU BLOCK -->";
					}
					
					//blocks if developer has been authenticated
					if($auth[0] != null && $auth[1] >= 100 && $auth[1] <= 199) {
						echo "<!-- START DEV MENU BLOCK -->";
						include("sites/blocks/dev-menu.php");
						echo "<!-- END DEV MENU BLOCK -->";
					}
					
					//footer of account menues
					if($auth[0] != null) {
						echo "<div class=\"seperator\"></div>";
					} 				
    		?>
    		<!-- *** END | Account Menues *** -->
    		
    		
    		<!-- END HEADER HERE! -->		
    		
    				
  		</div><!-- /.region -->
  		<!-- ### END | HIGHLIGHT REGION ### -->
      
      <!-- ### START | MAIN CONTENT REGION ### -->
      <div class="region region-content">
      
     		<!-- *** START | Main Content *** -->
    		<div id="block-system-admin" class="block block-system first odd">
    			<div class="content">
    				
    				
    				<!-- START HERE! -->
    				
    				
    				<!-- *** START | Account Content *** -->
    				<?php
    					//blocks if there is no user authenticated
							if($auth[0] == null) {
								echo "<!-- START LOGIN-FORM BLOCK -->";
								include("sites/blocks/login-form.php");
								echo "<!-- END LOGIN-FORM BLOCK -->";
								
								echo "<!-- START LOGIN-STATUS BLOCK-->";
								include("sites/blocks/login-status.php");
								echo "<!-- END LOGIN-STATUS BLOCK -->";
								
								echo "<!-- START DEV-INFO BLOCK -->";
								include("sites/blocks/dev-info.php");
								echo "<!-- END DEV-INFO BLOCK -->";
    					}
    					
    					//blocks if any user has been authenticated
							if($auth[0] != null) {
								
							}
							
							//blocks if administration has been authenticated
							if($auth[0] != null && $auth[1] >= 100 && $auth[1] <= 299) {
								if(isset($_GET['blog-admin']) && $_GET['blog-admin'] == "true") {
									echo "<!-- START BLOG ADMIN HEADER BLOCK -->";
									include("sites/blocks/blog-admin-header.php");
									echo "<!-- END BLOG ADMIN HEADER BLOCK -->";
									
									echo "<!-- START BLOG-FORM BLOCK -->";
									include("sites/blocks/blog-admin-form.php");
									echo "<!-- END BLOG-FORM BLOCK -->";
									
									echo "<!-- START BLOG ADMIN BLOCK -->";
									include("sites/blocks/blog-admin.php");
									echo "<!-- END BLOG ADMIN BLOCK -->";
								}
								if(isset($_GET['gallery-blog-admin']) && $_GET['gallery-blog-admin'] == "true") {
									echo "<!-- START GALLERY BLOG ADMIN BLOCK -->";
									include("sites/blocks/gallery-blog-admin.php");
									echo "<!-- END GALLERY BLOG ADMIN BLOCK -->";
								}
								if(isset($_GET['story-blog-admin']) && $_GET['story-blog-admin'] == "true") {
									echo "<!-- START STORY BLOG ADMIN BLOCK -->";
									include("sites/blocks/story-blog-admin.php");
									echo "<!-- END STORY BLOG ADMIN BLOCK -->";
								}
							}
							
							//blocks if developer has been authenticated
							if($auth[0] != null && $auth[1] >= 100 && $auth[1] <= 199) {
								if(isset($_GET['error-chart']) && $_GET['error-chart'] == "true") {
									echo "<!-- START ERROR-CHART BLOCK -->";
									include("sites/blocks/error-chart.php");
									echo "<!-- END ERROR-CHART BLOCK -->";
								}
								if(isset($_GET['test-email']) && $_GET['test-email'] =="true") {
									echo "<!-- START TEST-EMAIL BLOCK -->";
									include("sites/blocks/test-email.php");
									echo "<!-- END TEST-EMAIL BLOCK -->";
								}
							}
    				?>
    				<!-- *** END | Account Content *** -->
    				
    				
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
