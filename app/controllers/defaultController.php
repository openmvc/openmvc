<?php

Class defaultController Extends Controller {

	public function dispatch() {
		
		/*** prepare variables used in template ***/
    	$this->View->pageTitle = $this->Router->pageArr['meta_title'];
    	$this->View->heading = 'INDEX';
    	
		/*** Load defauls stuff ***/
		$this->loadDefaults();
    	/*** Last step -> print HTML from template ***/
    	$this->View->show();
    	
    }
}