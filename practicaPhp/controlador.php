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

	public function mostrarUsuarios() {
		$data['listaUsuarios'] = $this->usuario->getAll();
        $this->vista->mostrar("usuario/configuracion", $data);
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
		$apellido1 = $_REQUEST["apellido1"];
		$apellido2 = $_REQUEST["apellido2"];
		$dni = $_REQUEST["dni"];

		$result = $this->usuario->buscarEmail($email);

		if ($result) {
			$data['msjError'] = "Email en uso.";
			$this->vista->mostrar("usuario/formularioRegistro", $data);
		} else {
			$this->usuario->insert($nombre,$pass,$email,$apellido1,$apellido2,$dni);
			$data['msjInfo'] = "Registrado correctamente, por favor, inicie sesión.";
			$this->vista->mostrar("usuario/formularioLogin",$data);
		}
		
	}

	public function formularioModificarUsuario()
	{
			$idUsuario = $_REQUEST["idUsuario"];
			$data['usuario'] = $this->usuario->get($idUsuario);
			$this->vista->mostrar('usuario/formularioModificarUsuario', $data);
	}
	public function modificarUsuario()
	{
			$idUsuario = $_REQUEST["idUsuario"];
			$email = $_REQUEST["email"];
			$pass = $_REQUEST["pass"];
			$nombre = $_REQUEST["nombre"];
			$apellido1 = $_REQUEST["apellido1"];
			$apellido2 = $_REQUEST["apellido2"];
			$dni = $_REQUEST["dni"];

			$result = $this->usuario->update($idUsuario, $email, $pass, $nombre, $apellido1, $apellido2, $dni);

			if ($result == 1) {
				$data['msjInfo'] = "Usuario actualizado con éxito";
			} else {
				$data['msjError'] = "Ha ocurrido un error al modificar el usuario. Por favor, inténtelo más tarde.";
			}
			$data['listaUsuarios'] = $this->usuario->getAll();
			$this->vista->mostrar("usuario/configuracion", $data);
		
	}

}