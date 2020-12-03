<link rel="stylesheet" type="text/css" href="css/estilo.css">
	
</head>

<body style="background: -webkit-linear-gradient(left, #6a11cb, #2575fc);color:white;"> 
<script>
	
	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar el instalacion?")) {
				$.get("index.php?action=borrarinstalacionAjax&idInstalacion=" + this.id, null, function(idInstalacionBorrado) {
					if (idInstalacionBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar la instalación");
					} else {
						$('#msjInfo').html("instalacion borrado con éxito");
						$('#instalacion' + idInstalacionBorrado).remove();
					}
				});
			}
		});
	});
</script>


<nav><form class="login100-form validate-form">	 
			<input type='hidden' name='action' value='mostrarListaReservas'>
			<div class="container-login100-form-btn">
				<button class="usuariosButton">INICIO</button>
			</div>			
		</form></nav>
<?php
echo "<h1>Configuración de instalaciones</h1>";

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
			<input type='hidden' name='action' value='buscarInstalaciones'>
           	<input type='text' name='textoBusqueda'>
			<input type='submit' value='Buscar'>
        </form><br>";

if (is_array($data['listaInstalaciones'])) {

	// Ahora, la tabla con los datos de los libros
	echo "<table border ='1' class='tablas'>";
	foreach ($data['listaInstalaciones'] as $instalacion) {
		echo "<tr id='instalacion" . $instalacion->idInstalacion . "'>";
		echo "<td>" . $instalacion->nombre . "</td>";
		echo "<td class='nombre'>" . $instalacion->$descripcion . "</td>";
		echo "<td>" . $instalacion->precio . " €</td>";
        echo "<td>" . $instalacion->idHorario . "</td>";
		echo "<td><img class='img' src='" . $instalacion->imagen . "'></img></td>";
		//echo "<td>" . $instalacion->tipo . "</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			echo "<td><a href='index.php?action=formularioModificarinstalacion&idInstalacion=" . $instalacion->idInstalacion . "'>Modificar</a></td>";
			//echo "<td><a href='index.php?action=borrarinstalacion&idInstalacion=" . $instalacion->idInstalacion . "'>Borrar mediante enlace</a></td>";
			//echo "<td><a href='#' onclick='borrarPorAjax(" . $libro->idLibro . ")'>Borrar por Ajax/JS</a></td>";
			echo "<td><a href='#' class='btnBorrar' id='" . $instalacion->idInstalacion . "'>Borrar</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}
// El botón "Nueva instalacion" solo se muestra si hay una sesión iniciada

	echo "<p><a href='index.php?action=mostrarInsertarInstalacion'>Nuevo</a></p>";
