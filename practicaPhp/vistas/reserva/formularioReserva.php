<h1>Reservas de instalaciones</h1>
	</header>
	
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
if (count($data['listaReservas']) > 0) {

    echo " <div class='text-center p-t-100'>
                        
            <div id='miModal' class='modal'>
                <div class='modal-contenido'>
                    <a href='#' class='botonX'>X</a>
                <form action='index.php' class='formModal'>
                    <input type='hidden' name='action' value='insertarReserva' required>";
                                            
                echo "<p>Instalación: </p><select name='instalaciones[]'>";
                foreach ($data['listaInstalaciones'] as $instalacion) {
                    echo "<option value='" . $instalacion->idInstalacion . "'>" . $instalacion->nombre . "</option>";
                }
                echo "</select>
                <p>Hora</p> <input type='text' class='inputModal' name='hora'>
                <p>Precio = </p>
                
                <div class='container-login100-form-btn'>
                    <button class='botones'>Nueva</button>
                </div>	
                
            </form>
    </div>  
</div>
</div>";
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
    echo "</table>
    <form class='nuevo' style='float:none;width:200px;position:relative;margin:auto;'>	
            <div class='container-login100-form-btn'>
                <a class='botones' href='#miModal'>Hacer otra reserva</a>
            </div>			
        </form>";
} else {
	// La consulta no contiene registros
	echo "<form class='nuevo' style='float:none;width:200px;position:relative;margin:auto;'>	
            <div class='container-login100-form-btn'>
                <a class='botones' href='#miModal'>Hacer reserva</a>
            </div>			
        </form>";
}
                

	
