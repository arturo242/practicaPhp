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
		//$nombre = $this->seguridad->get("nombre");

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
	public function comprobarEmail() {
		$email = $_REQUEST["email"];
		$result = $this->usuario->existeNombre($email);
		echo $result;
	}
	public function mostrarFormularioRegistro()
	{
		$this->vista->mostrar("usuario/formularioRegistro");
	}
	public function insertarUsuario()
	{
		$nombre = $_REQUEST["nombre"];
		$pass = $_REQUEST["pass"];
		$email = $_REQUEST["email"];



		$result = $this->usuario->buscarUsuario($email,$pass,$nombre);

		if ($result) {
			// De momento, dejamos aquí este echo. Ya lo quitaremos
			$data['msjError'] = "Nombre de usuario o email en uso.";
			$this->vista->mostrar("usuario/formularioRegistro", $data);
		} else {
			$this->usuario->insert($nombre,$pass,$email);
			$data['msjInfo'] = "Registrado correctamente, por favor, inicie sesión.";
			$this->vista->mostrar("usuario/formularioLogin",$data);
		}
		
	}
}