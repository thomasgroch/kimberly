<?php
	require __DIR__ . '/cityads.php';	

	class NorthFace extends Cityads{

		var $xml_url = 'http://api.cityads.com/api/rest/webmaster/xml/goods?remote_auth=e2f6b2dd8b899aed22134a3602d3fe27&filter=NDQ5NjM4Nzk1&limit=1000&start=';

		var $produto = array();

		var $link_produto = '';
		
		var $white_list_category = array();
		
		var $black_list_category = array();


		public function NorthFace($array = array()){
			parent::__construct($array);
			$this->loja = 'North Face';
		}




	}