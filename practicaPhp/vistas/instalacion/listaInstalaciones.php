<h1>Configuración de instalaciones</h1>
	</header>
	<div class="text-center p-t-100">
		
		<div id="miModal" class="modal">
			<div class="modal-contenido">
				<a href="#" class="botonX">X</a>
					<form action='index.php' class="formModal">
						<h2>NUEVA INSTALACIÓN</h2>
						<input type='hidden' name='action' value='insertarInstalacion' required>
						<p>Nombre</p> <input type='text' name='nombre' class="inputModal" required>
						<p>Descripción</p> <textarea  rows="6" cols="22" type='text' class="inputModal" name="descripcion"></textarea>
						<p>Precio por Hora</p> <input type='number' name='precio' class="inputModal" required>
						
						<div class='container-login100-form-btn'>
							<button class='botones'>Nueva</button>
						</div>	
						
					</form>
			</div>  
		</div>
		<div id='miModal2' class='modal2'>
			<div class='modal-contenido2'>
				<a href='#' class='botonX'>X</a>
			
		</div>
	</div>
	<script>

	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar el usuario?")) {
				$.get("index.php?action=borrarInstalacionAjax&idInstalacion=" + this.id, null, function(idInstalacionBorrado) {
					if (idInstalacionBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar la instalación");
					} else {
						$('#msjInfo').html("Instalación borrada con éxito");
						$('#instalacion' + idInstalacionBorrado).remove();
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
			<input type='hidden' name='action' value='buscarInstalaciones'>
			<div class='nuevoB'>
			   <input type='text' name='textoBusqueda' class='busq'>
			    <div class='botonB'>
					<button class='boton4'>Buscar</button>
				</div>
			</div>
		</form>
		<form class='nuevo'>	
		<div class='container-login100-form-btn'>
			<a class='botones' href='#miModal'>Nueva</a>
		</div>			
	</form>";

if (is_array($data['listaInstalaciones'])) {

	echo "<table border ='1' class='tablas'>";
	foreach ($data['listaInstalaciones'] as $instalacion) {
		echo "<tr id='instalacion" . $instalacion->idInstalacion . "'>";
		echo "<td>" . $instalacion->nombre . "</td>";
		echo "<td>" . $instalacion->descripcion . "</td>";
		echo "<td>" . $instalacion->precio . " €</td>";
        echo "<td>" . $instalacion->idHorario . "</td>";
		if(isset($instalacion->imagen)){
		echo "<td><img class='img' src='" . $instalacion->imagen . "'></img></td>";
		}
			echo"<td>
			<form method='POST' action='index.php' enctype='multipart/form-data'>
							<input type='file' name='fotoInstalacion'>
							<input type='hidden' value='subirFoto'>
							<div class='container-login100-form-btn'>
							<button class='botones' style='width:90px;height:50px;'>Subir foto</button>
							</div>	
			</form>
			</td>";
		
		//echo "<td>" . $instalacion->tipo . "</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			echo "<td><a class='botones' href='index.php?action=formularioModificarInstalacion&idInstalacion=" . $instalacion->idInstalacion . "'>Modificar</a></td>";
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

	
