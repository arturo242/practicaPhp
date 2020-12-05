


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

<h1>Configuración de usuarios</h1>
	</header>
	<div class="text-center p-t-100">
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
<input type='hidden' name='action' value='mostrarFormularioRegistro'>
<div class='container-login100-form-btn'>
<button class='botones'>Nuevo</button>
</div>			
</form>";

if (is_array($data['listaUsuarios'])) {

	// Ahora, la tabla con los datos de los libros
	echo "<table border ='1' class='tablas'>";
	foreach ($data['listaUsuarios'] as $usuario) {
		echo "<tr id='usuario" . $usuario->idUsuario . "'>";
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
	echo "</table>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}
