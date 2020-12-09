<h1>Reservas de instalaciones</h1>
	</header>
	
	<script>
    $(document).ready(function(){
        
        
        $("#miSel").change(function () {
            var idOpt = $('select[id=miSel]').val();
            $(".horas").remove();
            $.get("index.php?action=cambiarHorario&idInstalacion=" + idOpt, null,  function(data){
                var horaInicio = parseInt(data.substr(0,2));
                var horaFin = parseInt(data.substr(8,2));
                for (var i=horaInicio; i<horaFin+1; i++) {
                    
                    $("#horario").append("<tr class='horas'><td>"+i+"</td><td><input type='radio' name='horas'></td></tr>")
                }

                    
            });
            $.get("index.php?action=cambiarPrecio&idInstalacion=" + idOpt, null,  function(data){
                    $("#precio").html(data)
            });
        })
    }); 
   /* $(".btnBorrar").click(function() {
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
		});*/
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
echo " <div class='text-center p-t-100'>
                        
            <div id='miModal' class='modal'>
                <div class='modal-contenido'>
                    <a href='#' class='botonX'>X</a>
                <form action='index.php' class='formModal'>
                    <input type='hidden' name='action' value='insertarReserva' required>";
                                            
                echo "Instalación <br><select name='instalaciones[]' id='miSel' class='actualizar'>
                <option>--Selecciona una instalación--</option>";                
                foreach ($data['listaInstalaciones'] as $instalacion) {
                    echo "<option value='" . $instalacion->idInstalacion .
                    "'>" . $instalacion->nombre . "</option>";
                }
                echo "</select><br>
                Horas<br>
                            <table>
                                <tbody id='horario'>";
                            echo"</tbody>
                            </table>
                Precio = <span id='precio'></span>
                
                <div class='container-login100-form-btn'>
                    <button class='botones'>Nueva</button>
                </div>	
                
            </form>
    </div>  
</div>
<h2 id='fecha'></h2>
</div>
";
if (count($data['listaReservas']) > 0) {
    echo "<table border ='1'>";
	foreach ($data['listaReservas'] as $reserva) {
        
		echo "<tr id='reserva" . $reserva->idReserva . "'>";
		echo "<td>" . $reserva->hora . "</td>";
        echo "<td>" . $reserva->precio . "€</td>";
        echo "<script>
            var res = '$reserva->fecha'
            res = 'Reservas del día '+res.substr(9)+' del '+res.substr(8,2)+' de ' + res.substr(0,4)

            document.getElementById('fecha').innerHTML=res
             </script>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {
			//echo "<td><a href='index.php?action=formularioModificarLibro&idLibro=" . $reserva->idLibro . "'>Modificar</a></td>";
			//echo "<td><a href='index.php?action=borrarLibro&idLibro=" . $reserva->idLibro . "'>Borrar mediante enlace</a></td>";
			//echo "<td><a href='#' onclick='borrarPorAjax(" . $reserva->idLibro . ")'>Borrar por Ajax/JS</a></td>";
            //echo "<td><a href='#' class='btnBorrar' id='" . $reserva->idLibro . "'>Borrar por Ajax/jQuery</a></td>";
            
		}
		echo "</tr></table>";
    }
    if (count($data['listaReservas']) < 2) {
    echo "<form class='nuevo' style='float:none;width:230px;position:relative;margin:auto;'>	
            <div class='container-login100-form-btn'>
                <a class='botones' href='#miModal'>Hacer otra reserva</a>
            </div>			
        </form>";
    }
} else {
    echo "<h2 align='center'>No hay reservas para este dia</h2><form class='nuevo' style='float:none;width:200px;position:relative;margin:auto;'>	
            <div class='container-login100-form-btn'>
                <a class='botones' href='#miModal'>Hacer reserva</a>
            </div>			
        </form>";
}
                

	
