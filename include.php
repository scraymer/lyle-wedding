<!-- ### START | LINKS ### -->
<link rel="shortcut icon" href="https://dl.dropbox.com/u/36151686/sites/themes/wedding/images/favicon.png" type="image/png" />
<link rel="alternate" type="application/rss+xml" title="Lisa and Kyle's Wedding RSS Feed" href="rss.php">
<!-- ### END | LINKS ### -->

<!-- ### START | STYLESHEETS ### -->
<style type="text/css" media="all">
	@import url("sites/themes/wedding/css/html-reset.css");
	@import url("sites/themes/wedding/css/wireframes.css");
	@import url("sites/themes/wedding/css/layout-liquid.css");
	@import url("sites/themes/wedding/css/page-backgrounds.css");
	@import url("sites/themes/wedding/css/tabs.css");
	@import url("sites/themes/wedding/css/pages.css");
	@import url("sites/themes/wedding/css/blocks.css");
	@import url("sites/themes/wedding/css/blocks-admin.css");
	@import url("sites/themes/wedding/css/navigation.css");
	@import url("sites/themes/wedding/css/views-styles.css");
	@import url("sites/themes/wedding/css/nodes.css");
	@import url("sites/themes/wedding/css/comments.css");
	@import url("sites/themes/wedding/css/forms.css");
	@import url("sites/themes/wedding/css/fields.css");
	@import url("sites/themes/wedding/js/shadowbox-3.0.3/shadowbox.css");
</style>
<style type="text/css" media="print">
	@import url("sites/themes/wedding/css/print.css");
</style>
<?php
	$browser = get_browser();
	if($browser->browser == 'IE' && $browser->majorver == 6) {
		echo "<!--IE6-->";
		echo "<style type=\"text/css\" media=\"all\">";
		echo "@import url(\"sites/themes/wedding/css/ie7.css\");";
		echo "</style>";
	} elseif($browser->browser == 'IE' && $browser->majorver == 7) {
		echo "<!--IE7-->";
		echo "<style type=\"text/css\" media=\"all\">";
		echo "@import url(\"sites/themes/wedding/css/ie6.css\");";
		echo "</style>";
	}
?>
<!-- ### END | STYLESHEETS ### -->

<!-- ### START | JAVASCRIPT ### -->
<script type="text/javascript" src="sites/themes/wedding/js/shadowbox-3.0.3/shadowbox.js" charset="utf-8"></script>
<script type="text/javascript" src="sites/themes/wedding/js/shadowbox_attributes.js" charset="utf-8"></script>
<script type="text/javascript" src="sites/themes/wedding/js/jquery_min.js" charset="utf-8"></script>
<script type="text/javascript" src="sites/themes/wedding/js/rotate-banner.js" charset="utf-8"></script>
<script type="text/javascript" src="sites/themes/wedding/js/menu-active.js" charset="utf-8"></script>
<!-- ### END | JAVASCRIPT ### -->

<!-- ### START | PHP ### -->
<?php

include_once("sites/scripts/error_report.php");
include_once("sites/scripts/authenticate.php");
include_once("sites/scripts/send_email.php");
?>
<!-- ### END | PHP ### -->