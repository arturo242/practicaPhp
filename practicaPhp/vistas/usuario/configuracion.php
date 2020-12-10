<h1>Configuración de usuarios</h1>
	</header>
	<div class="text-center p-t-100">
	<div id="miModal" class="modal">
			<div class="modal-contenido">
				<a href="#" class="botonX">X</a>
					<form action='index.php' class="formModal">
						<h2>NUEVO USUARIO</h2>
						<input type='hidden' name='action' value='insertarUsuario'>
						<p>Email</p> <input type='text' name='email' class='inputModal' required>
						<p>Password</p> <input type='password' class='inputModal' name='password'>
                        <p>Nombre</p> <input type='text' name='nombre' class='inputModal' required>
						<p>Primer Apellido</p> <input type='text' name='apellido1' class='inputModal'>
						<p>Segundo Apellido</p> <input type='text' name='apellido2' class='inputModal'>
                        <p>DNI</p> <input type='text' name='dni' class='inputModal' required>
						<div class='container-login100-form-btn'>
							<button class='botones'>Nuevo</button>
						</div>	
						
					</form>
			</div>  
		</div>
	</div>
<script>

	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar el usuario?")) {
				$.get("index.php?action=borrarUsuarioAjax&idUsuario=" + this.id, null, function(idUsuarioBorrado) {
					if (idUsuarioBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar el libro");
					} else {
						$('#msjInfo').html("Usuario borrado con éxito");
						$('#usuario' + idUsuarioBorrado).remove();
					}
				});
			}
		});
	});
</script>


<?php

// Mostramos mensaje de error o de información (si hay alguno)
if (isset($data['msjError'])) {
	echo "<p style='color:white' id='msjError'>" . $data['msjError'] . "</p>";
} else {
	echo "<p style='color:white' id='msjError'></p>";
}
if (isset($data['msjInfo'])) {
	echo "<p style='color:white' id='msjInfo'>" . $data['msjInfo'] . "</p>";
} else {
	echo "<p style='color:white' id='msjInfo'></p>";
}


// Primero, el formulario de búsqueda
echo "<form action='index.php' class='formB'>
<input type='hidden' name='action' value='buscarUsuarios'>
<div class='nuevoB'>
   <input type='text' name='textoBusqueda' class='busq'>
	<div class='botonB'>
		<button class='boton4'>Buscar</button>
	</div>
</div>
</form>
<form class='nuevo'>	
		<div class='container-login100-form-btn'>
			<a class='botones' href='#miModal'>Nuevo</a>
		</div>			
	</form>";

if (is_array($data['listaUsuarios'])) {

	// Ahora, la tabla con los datos de los libros
	echo "<div class='text-center p-t-100'>
	<table border ='1' class='tablas'>";
	foreach ($data['listaUsuarios'] as $usuario) {
		echo "<tr id='usuario" . $usuario->idUsuario . "'>";
		if($usuario->imagen != null){
			echo "<td><img src='img/usuarios/" . $usuario->idUsuario . ".jpg'></img></td>";
		}else{
				echo"<td><img src='img/usuarios/default.jpg'></td>";
		}
		echo "<td>" . $usuario->email . "</td>";
		echo "<td>" . $usuario->nombre . "</td>";
		echo "<td>" . $usuario->apellido1 . "</td>";
		echo "<td>" . $usuario->apellido2 . "</td>";
		echo "<td>" . $usuario->dni . "</td>";
		//echo "<td>" . $usuario->tipo . "</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			echo "<td><a class='botones' href='index.php?action=formularioModificarUsuario&idUsuario=" . $usuario->idUsuario . "'>Modificar</a></td>";
			//echo "<td><a href='index.php?action=borrarUsuario&idUsuario=" . $usuario->idUsuario . "'>Borrar mediante enlace</a></td>";
			//echo "<td><a href='#' onclick='borrarPorAjax(" . $libro->idLibro . ")'>Borrar por Ajax/JS</a></td>";
			echo "<td><a href='#' class='btnBorrar' id='" . $usuario->idUsuario . "'>Borrar</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>
	</div>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}
