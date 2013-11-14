<?php

class htmlDecorator{
	
	protected $docType;
	protected $headerDocument;
	protected $headerHtml;
	protected $footerHtml;
	protected $contenType;
	protected $metas;
	protected $linksCSS;
	protected $linksJavaScript;
	protected $title;
	protected $bodyHeader;
	protected $bodyFooter;
	protected $footerDocument;
	
	public function __construct(){
		$this->docType = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		$this->headerDocument = '<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >';
		
		$this->headerHtml = '<head>';
		$this->footerHtml = '</head>';
		
		$this->contentType = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		
		$this->metas = array();
		$this->linksCSS = array();
		$this->linksJavaScript = array();
		
		$this->title = '<title></title>';
		
		$this->bodyHeader = '<body>';
		$this->bodyFooter = '</body>';
		
		$this->footerDocument = '</html>';
	}
	
	public function __call($func,$arg_array){
		switch($func) {
			case "setContentType":
				//...
			break;
			
			case "setTitle":
			break;
			
			case "addLinkCSS":
			break;
			
			case "addLinkJavaScript":
			break;
			
			case "setBodyHeader":
			break;
			
			case "dispatch":
				printf($this->docType."\n");
				printf($this->headerDocument."\n");
				printf($this->headerHtml."\n");
				printf($this->contentType."\n");
				printf($this->title."\n");
				
				foreach($this->metas as $meta) printf($meta."\n");
				foreach($this->linksCSS as $css) printf($css."\n");
				foreach($this->linksJavaScript as $js) printf($js."\n");
				foreach($this->metas as $meta) printf($meta."\n");
				
				
				printf($this->footerHtml."\n");
				
				printf($this->bodyHeader."\n");
				

				foreach($arg_array as $objectView) $objectView->render();
				
				printf($this->bodyFooter."\n");
				
				printf($this->footerDocument."\n");			
			break;
		}
	}
	
	
	/* 
		funciones requeridas htmlDecorator()
		
		setContenType();->genera IMG/BIN/TEXT/XML/HTML/XHTML/RSS
		setTitle(String title);
		addLinkCSS(String css);
		addLinkJavaScript(String javascript);
		addMeta(String meta);
		setBodyHeader(String onload);
		dispatch(); -> envia el html generado a la salida HTTP ; la salida dispatch DEBE ser con printf
	*/ 
}

?>