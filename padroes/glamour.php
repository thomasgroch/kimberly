<?php
	require __DIR__ . '/zanox.php';

	Class Glamour extends Zanox{

		private $categorias_validas = array(
				);

		public function Glamour($array = array()){
			parent::__construct($array);
		}

		public function set_produto($produto){
			$link_arrumado = str_replace('asd', replace, $this->produto['trackingLinks']['trackingLink']['ppc']);
			$this->produto['trackingLinks']['trackingLink']['ppc'] = $link_arrumado;
			$this->produto = $produto;
		}

		/*
		* Se for um produto que interessar a tagbox, 
		* devera retornar true
		* Entrada: array de um produto
		* Saida: (bool) 
		*/
		// public function validate(){
			//parent::validate();
		// }

		/*
		* Funcao para retornar url do sistema de afiliados
		* sem o numero de paginacao
		*/
		public function getUrl() {
			return 'http://api.zanox.com/xml/2011-03-01/products/?connectid=089EAF947B7A0B3C896E&adspace=1916212&programs=15305&items=500&page=';
		}

		/*
		* Funcao para capturar dados extras
		* Entrada: array de um produto
		* Saida: array de um produto + campos extras
		*/
		public function prepare(){
			$html = parent::prepare();
			
			// Obtem tamanho
			$tamanho_script = $html->find('head',0);
			if( empty($tamanho_script)){
			 	$this->logger->info('[Skip] Nao foi foi possivel encontrar tamanhos');
			 	return false;
			}
			$json = $tamanho_script->last_child();
			$json = get_string_between($json, '<script>var skuJson_0 = ', ';CATALOG_SDK.');
			$json = json_decode($json, true);

			foreach ($json['skus'] as $key => $sku) {
				if( $sku['available'] ){
					$tamanhos[] = $sku['dimensions']['Tamanho'];
				}
			}
			$this->produto['tamanho'] = implode('|', $tamanhos);


			// Obtem marca
			$marca = trim($html->find('p.brand', 0)->find('a',0)->plaintext);
			if( empty($marca)){
			 	$this->logger->info('[Skip] Nao foi foi possivel encontrar marca');
			 	return false;
			}
			$this->produto['marca'] = $marca;

			// Produto Tratado com sucesso
			return true;
		}
	}