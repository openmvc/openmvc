<?php

Class errorController Extends Controller {

	public function dispatch() {
		
		/*** Global Exception object ***/
		global $e;
		$errorCode = $e->getCode();
		
		/*** Log the error ***/ 
		Logger::exceptionLog( $e->getMessage(), $errorCode, $e->getFile(), $e->getLine() );
		
    	/*** First step -> set all required variables ***/
    	switch($errorCode) {
    		case 404:
    			$this->View->pageTitle = '404 not found';
    			$this->View->errorMsg = 'Oops, 404!;)';
    			header("HTTP/1.0 404 Not Found");
    			break;
    		case 1001:
    		default:
    			$this->View->pageTitle = 'Technical Difficulties';
    			$this->View->errorMsg = 'Oops, technical difficulties..;)';
    			break;
    	}
    	
    	/*** Load defauls stuff ***/
		$this->loadDefaults();
    	/*** Last step -> print HTML from template ***/
    	$this->View->show();
    	
    }
}