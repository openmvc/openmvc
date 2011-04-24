<?php

class Router extends Core {
	
	private static $instance;
	
	/*** data retrieved from database ***/
	public $pageArr = array();
	
	private $controllerLoaded;
	private $controller;
	private $controllerFilePath;
	
	/*** Singleton declaration ***/
	public static function obtain(){ 
	    if (!self::$instance){  
	        self::$instance = new Router();
	    }
	    return self::$instance;  
	}
	
	function __construct() {}
	
	/**
	 *
	 * @load the controller
	 *
	 * @access public
	 *
	 * @return void
	 *
	 */
	 public function loader() {
	 		
					/*** Search for route only if Controller and View are not set yet ***/
		 			if(!$this->controllerLoaded && !$this->View->viewLoaded) {
		 				
		 					/*** Extract exact URI we are looking for ***/
		 					$requestURI = str_replace(STATIC_DIR, '', $_GET['url']);
		 					
		 					/*** Avoid 404 error for favicon ***/
						 	if ($requestURI === 'favicon.ico') { die(); }
						 	
						 	$this->requestURIChain = explode('/', $requestURI);
						 	
						 	/*** Check if route exists ***/
						 	$STH = $this->Database->prepare("SELECT `page_ID`, `controller`, `layout`, `content`,
					 												`meta_title`, `meta_keywords`, `meta_description`
					 										 FROM pages WHERE page_uri = ?");
							$STH->execute(array($this->requestURIChain[0]));
							$STH->setFetchMode(PDO::FETCH_ASSOC);
							
						 	/*** If route found - load Controller and View ***/
						 	if($STH->rowCount()>0) {
						 		
						 		/*** assign result to $this->pageArr ***/
						 		$this->pageArr = $STH->fetch();
						 		
						 		/*** set View ***/
							 	$this->View->setView( ($this->pageArr['layout']!=null?$this->pageArr['layout']:$this->Config->system['default_layout']), ($this->pageArr['content']!=null?$this->pageArr['content']:$this->Config->system['default_content']) );
							 
								/*** set Controller ***/
								$this->setController( ($this->pageArr['controller']!=null?$this->pageArr['controller']:$this->Config->system['default_controller']) );
						 		
							/*** If no route found - throw Exception that will be catched in index.php ***/
						 	} else {
						 		throw new Exception($requestURI, 404);
						 	}
					
		 			}
	
		/*** include the Controller ***/
		include_once($this->controllerFilePath);
	
		/*** launch Controller ***/
		$controller = new $this->controller();
		$controller->dispatch();
	 }
	
	 /**
	 *
	 * @set the controller
	 *
	 * @access private
	 *
	 * @return void
	 *
	 */
	private function setController($controller) {
	
		/*** set the file path ***/
		$this->controllerFilePath = CONTROLLERS_PATH . $controller . '.php';

		/*** if the file is not there diaf ***/
		if (is_readable($this->controllerFilePath) == false) {
			throw new Exception ('Invalid controller file: `' . $this->controllerFilePath . '`', ERRORCODE_TECHNICAL_DIFFICULTIES);
		}
		
		/*** update controller ***/
		$this->controller = $controller;
		
		/*** update controller Flag ***/
		$this->controllerLoaded = true;
	}
	
	
	/**
	 *
	 * @sets Error controller, Error Layout, Error content and re-lauches Router's loader() method.
	 *
	 * @access public
	 *
	 * @return void
	 *
	 */
	public function loadError() {
		$this->setController($this->Config->system['error_controller']);
		$this->View->setView($this->Config->system['error_layout'], $this->Config->system['error_content']);
		$this->loader();
	}
	
}