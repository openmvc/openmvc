	<?php
	
		if (isset($requiredJs)) {
			foreach ($requiredJs as $jsFile => $use) {
				if($params['show']) echo '<script type="text/javascript" language="javascript" charset="utf-8" src="' . WWW_JS_PATH . $jsFile . '"></script>' . "\n";
			}
		}
	
	?>
</body>
</html>