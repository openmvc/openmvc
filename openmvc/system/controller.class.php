<?php

Abstract class Controller extends Core {
	
	function __construct() {
		
	}
	
	public function loadDefaults()
	{
		$this->requireCss('main.css');
	}
	
	public function requireCss($cssFile)
	{
		$this->View->vars['requiredCss'][$cssFile] = array('show'=>true);
	}
	
	public function requireJs($jsFile)
	{
		$this->View->vars['requiredJs'][$jsFile] = array('show'=>true);
	}
	
	abstract function dispatch();

}