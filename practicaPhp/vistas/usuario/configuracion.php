<link rel="stylesheet" type="text/css" href="css/estilo.css">
	
</head>

<body style="background: -webkit-linear-gradient(left, #6a11cb, #2575fc);color:white;"> 
<script>
	// **** Petición y respuesta AJAX con JS tradicional ****

	peticionAjax = new XMLHttpRequest();

	function borrarPorAjax(idLibro) {
		if (confirm("¿Está seguro de que desea borrar el libro?")) {
			idLibroGlobal = idLibro;
			peticionAjax.onreadystatechange = borradoLibroCompletado;
			peticionAjax.open("GET", "index.php?action=borrarLibroAjax&idLibro=" + idLibro, true);
			peticionAjax.send(null);
		}
	}

	function borradoLibroCompletado() {
		if (peticionAjax.readyState == 4) {
			if (peticionAjax.status == 200) {
				idLibro = peticionAjax.responseText;
				if (idLibro == -1) {
					document.getElementById('msjError').innerHTML = "Ha ocurrido un error al borrar el libro";
				} else {
					document.getElementById('msjInfo').innerHTML = "Libro borrado con éxito";
					document.getElementById('libro' + idLibro).remove();
				}
			}
		}
	}

	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar el libro?")) {
				$.get("index.php?action=borrarLibroAjax&idLibro=" + this.id, null, function(idLibroBorrado) {
					if (idLibroBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar el libro");
					} else {
						$('#msjInfo').html("Libro borrado con éxito");
						$('#libro' + idLibroBorrado).remove();
					}
				});
			}
		});
	});
</script>



<?php
echo "<h1>Configuración de usuarios</h1>";

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
echo "<form action='index.php'>
			<input type='hidden' name='action' value='buscarUsuarios'>
           	<input type='text' name='textoBusqueda'>
			<input type='submit' value='Buscar'>
        </form><br>";

if (count($data['listaUsuarios']) > 0) {

	// Ahora, la tabla con los datos de los libros
	echo "<table border ='1' class='tablas'>";
	foreach ($data['listaUsuarios'] as $usuario) {
		echo "<tr id='usuario" . $usuario->idUsuario . "'>";
		echo "<td>" . $usuario->email . "</td>";
		echo "<td class='nombre'>" . $usuario->nombre . "</td>";
		echo "<td>" . $usuario->apellido1 . "</td>";
		echo "<td>" . $usuario->apellido2 . "</td>";
		echo "<td>" . $usuario->dni . "</td>";
		echo "<td>" . $usuario->tipo . "</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			echo "<td><a href='index.php?action=formularioModificarUsuario&idUsuario=" . $usuario->idUsuario . "'>Modificar</a></td>";
			echo "<td><a href='index.php?action=borrarUsuario&idUsuario=" . $usuario->idUsuario . "'>Borrar mediante enlace</a></td>";
			//echo "<td><a href='#' onclick='borrarPorAjax(" . $libro->idLibro . ")'>Borrar por Ajax/JS</a></td>";
			//echo "<td><a href='#' class='btnBorrar' id='" . $libro->idLibro . "'>Borrar por Ajax/jQuery</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}
// El botón "Nuevo libro" solo se muestra si hay una sesión iniciada
if (isset($_SESSION["idUsuario"])) {
	echo "<p><a href='index.php?action=formularioInsertarLibros'>Nuevo</a></p>";
}