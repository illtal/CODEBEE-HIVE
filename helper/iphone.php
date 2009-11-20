<?php
	class IPHONE_Helper
	{
		var $title;
		var $charset;
		var $toolbar;
		var $body;
		var $dom;
		
		function __construct()
		{
			;
		}
		
		function create($title = null)
		{
			
			$this->_CreateDocument($title);	
			//$this->body = new iphone_element("body","");
		}
		
		function getDocument()
		{
			return $this->dom->saveXML();
		}
		
		private function _body()
		{
			$obj =  $this->dom->getElementsByTagName("body");
			
			if ($obj->item(0))
				return $obj->item(0);
		}
		
		private function _CreateDocument($titleText=null)
		{
			$doctype = DOMImplementation::createDocumentType("html","-//W3C//DTD XHTML 1.0 Transitional//EN", "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" );
			
			//$this->dom = new DOMDocument();
			$this->dom = DOMImplementation::createDocument(null, null, $doctype);
			
			$root = $this->dom->createElement("html");
			$root->setAttribute("xmlns", "http://www.w3.org/1999/xhtml");
			
			$head = $this->dom->createElement("head");
				$title = $this->dom->createElement("title");
				$css = $this->dom->createElement("link");
				$ip_meta = $this->dom->createElement("meta");
				$iptouch_meta = $this->dom->createElement("meta");
				$script_lib = $this->dom->createElement("script");
				$script = $this->dom->createElement("script");
				
			$body = $this->dom->createElement("body");
				
			if ($titleText)
				$title->appendChild($this->dom->createTextNode($titleText));
				
			$ip_meta->setAttribute("name", "viewport");
			$ip_meta->setAttribute("content", "width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;");
			
			$iptouch_meta->setAttribute("name", "apple-touch-fullscreen");
			$iptouch_meta->setAttribute("content", "yes");
			
			$script_lib->setAttribute("type", "application/x-javascript");
			$script_lib->setAttribute("src", BASEURL."external/iui/iui.js");
			
			$script->setAttribute("type", "text/javascript");
			$script->appendChild($this->dom->createTextNode("iui.animOn = true;"));
			
			$css->setAttribute("type", "text/css");
			$css->setAttribute("rel", "stylesheet");
			$css->setAttribute("media", "all");
			$css->setAttribute("href", BASEURL."external/iui/iui.css");
			
			$head->appendChild($title);
			$head->appendChild($ip_meta);
			$head->appendChild($iptouch_meta);
			$head->appendChild($css);
			$head->appendChild($script_lib);
			$head->appendChild($script);
			
			$root->appendChild($head);
			$root->appendChild($body);
			$this->dom->appendChild($root);
			
			$setToolbar = true;
			if ($setToolbar)
				$this->addToolbar($titleText);
				
		}
		
		public function addToolbar($titleText)
		{
			$toolbar = $this->dom->createElement("div");
			$toolbar->setAttribute("class", "toolbar");
			
			$title = $this->dom->createElement("h1");
			$title->setAttribute("id", "pageTitle");
			//$title->appendChild($this->dom->createTextNode($titleText));
			
			$backBtn = $this->dom->createElement("a");
			$backBtn->setAttribute("id", "backButton");
			$backBtn->setAttribute("class", "button");
			$backBtn->setAttribute("href", "#");
			
			$toolbar->appendChild($title);
			$toolbar->appendChild($backBtn);
			
			$this->_body()->appendChild($toolbar);
		}
		
		private function _hasPage($id)
		{
			$item = $this->dom->getElementById($id);
			
			if ($item)
				return true;
			
			return false;
		}
		
		private function _get($id)
		{
			return $this->dom->getElementById($id);
		}
		
		private function _setAttr(&$elmt, $key, $val)
		{
			$attr = $this->dom->createAttribute($key);
			$attr->appendChild($this->dom->createTextNode($val));
			$elmt->appendChild($attr);
			
		}
		
		public function addListPage($id, $title, $default = false)	
		{
			if ($this->_hasPage($id))
				return false;
				
			$list = $this->dom->createElement("ul");
			$this->_body()->appendChild($list);
			$list->setAttribute("xml:id", $id);
			$list->setAttribute("title", $title);
			
			if ($default)
			{
				$list->setAttribute("selected", "true");
				$list->setAttribute("xml:selected", "true");
			}
				
			
			return true;
		}
		
		public function addListItem($item, $id)
		{
			if (!$this->_hasPage($id))
				return false;

				
			$li = $this->dom->createElement("li");

			if ($item["anchor"])
			{
				$listElmt = $this->dom->createElement("a");
				$listElmt->setAttribute("href", $item["anchor"]);
				$listElmt->appendChild($this->dom->createTextNode($item["text"]));
				
				$li->appendChild($listElmt);
			}
			else
				$li->appendChild($this->dom->createTextNode($item["text"]));	

			$this->_get($id)->appendChild($li);
			
				
			return true;
		}
		
		
		
		private function _Doctype()
		{
			//$doctype = $this->createElement("html")
		} 
		
	}
	
	
	
?>