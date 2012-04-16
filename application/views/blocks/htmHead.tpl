<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $pageTitle ?></title>
	
	<?php
	
		if (isset($requiredCss)) {
			foreach ($requiredCss as $cssFile => $params) {
				if($params['show']) echo '<link rel="stylesheet" href="' . WWW_CSS_PATH . $cssFile . '" type="text/css" media="all" charset="utf-8" />' . "\n";
			}
		}
		
		if (!@empty($requiredStyle)) {
			echo '<style type="text/css">';
			foreach ($requiredStyle as $styleCss) {
				echo $styleCss;
			}
			echo '</style>';
		}
	
	?>
	
</head>
<body>