<?php
	include_once("modelos/seguridad.php");


	class Vista {
		private $seguridad;

		public function __construct() {
			$this->seguridad = new Seguridad();	
		}
		
		public function mostrar($nombreVista, $data = null) {
			include_once("vistas/header.php");
			include_once("vistas/$nombreVista.php");
			include_once("vistas/footer.php");
		}
	}