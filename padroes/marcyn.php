<?php
	require __DIR__ . '/afilio.php';

	class Marcyn extends Afilio {

		var $xml_url = 'http://v2.afilio.com.br/aff/aff_get_boutique.php?boutiqueid=39281-895842&token=53e355b5e465b0.28149070&progid=1180&format=XML';

		var $produto = array();

		var $white_list_category = array();
		
		var $black_list_category = array();

		var $single_page = TRUE;


		public function prepare(){
			if( ! parent::prepare() ){ return false; }

			print_r($this->produto);die();
		}

		public function setProduct($produto){

			$this->produto = $produto;

		}


	}