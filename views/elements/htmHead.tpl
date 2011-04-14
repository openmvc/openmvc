<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $pageTitle ?></title>
	
	<?php
	
		if (isset($requiredCss)) {
			foreach ($requiredCss as $cssFile => $params) {
				if($params['show']) echo '<link rel="stylesheet" href="' . WWW_CSS_PATH . $cssFile . '" type="text/css" media="all" charset="utf-8" />' . "\n";
			}
		}
	
	?>
	
</head>
<body>