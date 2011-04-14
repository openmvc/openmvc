<?php

class View extends Core {
	
	private static $instance;
	/*
	 * @Variables array
	 * @access private
	 */
	public $vars = array();
	private $viewContentFilePath;
	private $viewLayoutFilePath;
	private $viewLoaded;
	
	public static function obtain() { 
	    if (!self::$instance){  
	        self::$instance = new View();
	    }
	    return self::$instance;  
	}
	
	function __construct() {
		
	}
	
	/**
	 *
	 * @set undefined vars
	 *
	 * @param string $index
	 *
	 * @param mixed $value
	 *
	 * @return void
	 *
	 */
	public function __set($index, $value) {
	    $this->vars[$index] = $value;
	}
	
	public function show() {
	
		/*** Load variables ***/
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}
		
		/*** Render content page and load it into $viewContent variable for use in Layout ***/
		ob_start();
			include_once ($this->viewContentFilePath);
			$viewContent = ob_get_contents();
		ob_end_clean();
	
		/*** Render View Layout ***/
		ob_start();
		include_once ($this->viewLayoutFilePath);
		$html = ob_get_contents();
		ob_end_clean();
		
		/*** Output HTML ***/
		echo $html;
	}
	
	
	/**
	 *
	 * @set the view
	 *
	 * @access private
	 *
	 * @return void
	 *
	 */
	public function setView($layout='', $content='') {
	
		/*** set the file path ***/
		$this->viewLayoutFilePath = VIEWS_PATH . 'layouts/' . $layout . '.tpl';
		
		/*** check if file exists ***/
		if (is_readable($this->viewLayoutFilePath) == false) {
			throw new Exception ('Invalid view layout file: `' . $this->viewLayoutFilePath . '`');
		}
		
		
		/*** set the file path ***/
		$this->viewContentFilePath = VIEWS_PATH . 'content/' . $content . '.tpl';
		
		/*** check if file exists ***/
		if (is_readable($this->viewContentFilePath) == false) {
			throw new Exception ('Invalid view content file: `' . $this->viewContentFilePath . '`');
		}
		
		/*** update view Flag ***/
		$this->viewLoaded = true;
	
	}
	
	/**
	 *
	 * @include elements files. used by View Layouts
	 *
	 * @access private
	 *
	 * @return void
	 *
	 */
	private function includeElements($elements) {
		
		/*** throw an exception if incorrect parameter was passed ***/
		if(empty($elements) || !is_array($elements)) {
			throw new Exception('Wrong parameter type passed to includeElements() function', ERRORCODE_TECHNICAL_DIFFICULTIES);
		}
		
		/*** Load variables for included elements to access them - am not happy about such workaround, should be fixed later ***/
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}
		
		foreach($elements as $element) {
			$elementFilePath = VIEWS_PATH . 'elements/' . $element . '.tpl';
			if(!file_exists($elementFilePath)) {
				throw new Exception('Can\'t find view element ['.$elementFilePath.']', ERRORCODE_TECHNICAL_DIFFICULTIES);
			}
			
			include_once ($elementFilePath);
		}
		
		
	}
	
}