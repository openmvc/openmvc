<?php

Class defaultController Extends Controller {

	public function dispatch() {
		
		if(    count($this->requestURIChain) == 1
			&& $this->requestURIChain[0] == '' ) {
				
				/*** prepare variables used in template ***/
		    	$this->View->pageTitle = '';
		    	$this->View->heading = 'INDEX';
		    	
		    	
		    	/*** Last step -> print HTML from template ***/
		    	$this->View->setView('default', 'index');
		    	$this->View->render();
		    	
				
		} else {
			
			throw new Exception($this->requestURI, 404);
			
		}
    	
    }
}