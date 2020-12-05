<h1>Polideportivo - Reservas</h1>
	</header>
	<div class="text-center p-t-100">
<?php

echo "";
// Mostramos info del usuario logueado (si hay alguno)
if ($this->seguridad->haySesionIniciada()) {
	echo "<p style='color:white';>Hola, " . $this->seguridad->get("nombre") . "</p>";
}
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
/*echo "<form action='index.php'>
			<input type='hidden' name='action' value='buscarLibros'>
           	<input type='text' name='textoBusqueda'>
			<input type='submit' value='Buscar'>
            </form><br>";
*/
if (count($data['listaReservas']) > 0) {

	// Ahora, la tabla con los datos de los libros
	echo "<table border ='1'>";
	foreach ($data['listaReservas'] as $reserva) {
		echo "<tr id='reserva" . $reserva->idReserva . "'>";
		echo "<td>" . $reserva->fecha . "</td>";
		echo "<td>" . $reserva->hora . "</td>";
		echo "<td>" . $reserva->precio . "€</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			//echo "<td><a href='index.php?action=formularioModificarLibro&idLibro=" . $reserva->idLibro . "'>Modificar</a></td>";
			//echo "<td><a href='index.php?action=borrarLibro&idLibro=" . $reserva->idLibro . "'>Borrar mediante enlace</a></td>";
			//echo "<td><a href='#' onclick='borrarPorAjax(" . $reserva->idLibro . ")'>Borrar por Ajax/JS</a></td>";
			//echo "<td><a href='#' class='btnBorrar' id='" . $reserva->idLibro . "'>Borrar por Ajax/jQuery</a></td>";
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
	//echo "<p><a href='index.php?action=formularioInsertarLibros'>Nuevo</a></p>";
}
?>
</div>