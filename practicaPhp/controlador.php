<?php
include_once("vista.php");
include_once("modelos/usuario.php");
include_once("modelos/reserva.php");
include_once("modelos/instalacion.php");
include_once("modelos/seguridad.php");
include_once("modelos/horario.php");
class Controlador{

    private $vista, $usuario, $reserva, $instalacion,$horario;

    public function __construct(){
        $this->vista = new Vista();
        $this->usuario = new Usuario();
        $this->reserva = new Reserva();
		$this->instalacion = new Instalacion();
		$this->horario = new Horario();
       $this->seguridad = new Seguridad();
    }

	public function mostrarListaReservas(){
        $data['listaReservas'] = $this->reserva->getAll();
        $this->vista->mostrar("reserva/listaReservas", $data);
    }


	/**************************************************   INICIO DE SESION   ************************************************************/
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
	/**************************************************   RESERVAS   ***************************************************************/

	public function formularioReserva(){
		$fecha = $_REQUEST["fecha"];
		$data['listaReservas'] = $this->reserva->getAllDia($fecha);
		$data['listaInstalaciones'] = $this->instalacion->getAll();
        $this->vista->mostrar("reserva/formularioReserva", $data);
	}
	
	public function cambiarHorario()
	{
			$idInstalacion = $_REQUEST["idInstalacion"];
			$result = $this->horario->getHoras($idInstalacion);
			if ($result == 0) {
				// Error al borrar. Enviamos el código -1 al JS
				echo "";
			}
			else {
				// Borrado con éxito. Enviamos el id del libro a JS
				echo $idInstalacion;
			}
		
	}
	public function cambiarPrecio()
	{
			$idInstalacion = $_REQUEST["idInstalacion"];
			echo $idInstalacion;
			$result = $this->instalacion->getPrecio($idInstalacion);
			echo $result;
			
		
	}
	/**************************************************   USUARIOS   ***************************************************************/
	public function mostrarUsuarios() {
		$data['listaUsuarios'] = $this->usuario->getAll();
        $this->vista->mostrar("usuario/configuracion", $data);
	}
    public function mostrarFormularioLogin()
	{
		$this->vista->mostrar("usuario/formularioLogin");
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

	public function borrarUsuarioAjax()
	{
		if ($this->seguridad->haySesionIniciada()) {
			$idUsuario = $_REQUEST["idUsuario"];
			$result = $this->usuario->delete($idUsuario);
			if ($result == 0) {
				// Error al borrar. Enviamos el código -1 al JS
				echo "-1";
			}
			else {
				// Borrado con éxito. Enviamos el id del libro a JS
				echo $idUsuario;
			}
		} else {
			echo "-1";
		}
	}

	public function buscarUsuarios()
	{
		// Recuperamos el texto de búsqueda de la variable de formulario
		$textoBusqueda = $_REQUEST["textoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de libros
		$data['listaUsuarios'] = $this->usuario->busquedaAproximada($textoBusqueda);
		$data['msjInfo'] = "Resultados de la búsqueda: \"$textoBusqueda\"";
		$this->vista->mostrar("usuario/configuracion", $data);

	}
	/**************************************************   INSTALACIONES   ***************************************************************/
	
	public function mostrarInstalaciones() {
		$data['listaInstalaciones'] = $this->instalacion->getAll();
        $this->vista->mostrar("instalacion/listaInstalaciones", $data);
	}
	
	public function buscarInstalaciones()
	{
		// Recuperamos el texto de búsqueda de la variable de formulario
		$textoBusqueda = $_REQUEST["textoBusqueda"];
		// Lanzamos la búsqueda y enviamos los resultados a la vista de lista de libros
		$data['listaInstalaciones'] = $this->instalacion->busquedaAproximada($textoBusqueda);
		$data['msjInfo'] = "Resultados de la búsqueda: \"$textoBusqueda\"";
		$this->vista->mostrar("instalacion/listaInstalaciones", $data);

	}
	
	public function insertarInstalacion()
	{
		$result = $this->instalacion->insert();
		
		if($result == 1){
			$data['msjInfo'] = "Instalación insertada correctamente.";
		}
		else{
			$data['msjError'] = "No se ha podido insertar la instalación.";
		}
		$data['listaInstalaciones'] = $this->instalacion->getAll();
		$this->vista->mostrar("instalacion/listaInstalaciones",$data);
	}
	public function borrarInstalacionAjax()
	{
		if ($this->seguridad->haySesionIniciada()) {
			$idInstalacion = $_REQUEST["idInstalacion"];
			$result = $this->instalacion->delete($idInstalacion);
			if ($result == 0) {
				// Error al borrar. Enviamos el código -1 al JS
				echo "-1";
			}
			else {
				// Borrado con éxito. Enviamos el id del libro a JS
				echo $idInstalacion;
			}
		} else {
			echo "-1";
		}
	}

	public function formularioModificarInstalacion()
	{
			$idInstalacion = $_REQUEST["idInstalacion"];
			$data['instalacion'] = $this->instalacion->get($idInstalacion);
			$this->vista->mostrar('instalacion/formularioModificarInstalacion', $data);
	}
	public function modificarInstalacion()
	{
			$idInstalacion = $_REQUEST["idInstalacion"];
			$nombre = $_REQUEST["nombre"];
			$descripcion = $_REQUEST["descripcion"];
			$precio = $_REQUEST["precio"];
			$idHorario = $_REQUEST["idHorario"];

			$result = $this->instalacion->update($idInstalacion, $nombre, $descripcion, $precio, $idHorario);

			if ($result == 1) {
				$data['msjInfo'] = "Instalacion actualizada con éxito";
			} else {
				$data['msjError'] = "Ha ocurrido un error al modificar la instalación. Por favor, inténtelo más tarde.";
			}
			$data['listaInstalaciones'] = $this->instalacion->getAll();
			$this->vista->mostrar("instalacion/listaInstalaciones", $data);
		
	}
	
}