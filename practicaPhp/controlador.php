<?php
include_once("vista.php");
include_once("modelos/usuario.php");
include_once("modelos/reserva.php");
//include_once("modelos/instalacion.php");
include_once("modelos/seguridad.php");

class Controlador{

    private $vista, $usuario, $reserva, $instalacion;

    public function __construct(){
        $this->vista = new Vista();
        $this->usuario = new Usuario();
        $this->reserva = new Reserva();
       // $this->instalacion = new instalacion();
       $this->seguridad = new Seguridad();
    }

    public function mostrarListaReservas(){
        $data['listaReservas'] = $this->reserva->getAll();
        $this->vista->mostrar("reserva/listaReservas", $data);
    }

    public function mostrarFormularioLogin()
	{
		$this->vista->mostrar("usuario/formularioLogin");
	}

	/**
	 * Procesa el formulario de login e inicia la sesión
	 */
	public function procesarLogin()
	{
		$email = $_REQUEST["email"];
		$password = $_REQUEST["pass"];

		$usuario = $this->usuario->buscarUsuario($email, $password);
		
		if ($usuario) {
			$this->seguridad->abrirSesion($usuario);
			$this->mostrarListaReservas();
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Email o contraseña incorrectos";
			$this->vista->mostrar("usuario/formularioLogin", $data);
		}
	}

	/**
	 * Cierra la sesión
	 */
	public function cerrarSesion()
	{
		$this->seguridad->cerrarSesion();
		$data['msjInfo'] = "Sesión cerrada correctamente";
		$this->vista->mostrar("usuario/formularioLogin", $data);
	}

}