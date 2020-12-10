<h1>Reservas de instalaciones</h1>
	</header>
	
	<script>
    $(document).ready(function(){
        
        $(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar la reserva?")) {
				$.get("index.php?action=borrarReservaAjax&idReserva=" + this.id, null, function(idReservaBorrado) {
					if (idReservaBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar la reserva");
					} else {
						$('#msjInfo').html("Reserva borrada con éxito");
						$('#reserva' + idReservaBorrado).remove();
					}
				});
			}
		});
        $("#miSel").change(function () {
            var idOpt = $('select[id=miSel]').val();
            $(".horas").remove();
            $.get("index.php?action=cambiarHorario&idInstalacion=" + idOpt, null,  function(data){
                var horaInicio = parseInt(data.substr(0,2));
                var horaFin = parseInt(data.substr(8,2));
                for (var i=horaInicio; i<horaFin+1; i++) {
                    $("#horario").append("<tr><td>"+i+"</td><td><input type='radio' name='horas' value='"+i+":00:00' required></td></tr>")
                }

                    
            });
            $.get("index.php?action=cambiarPrecio&idInstalacion=" + idOpt, null,  function(data){
                    $("#miPrecio").attr("value",data);
                    $("#precio").html(data);
                    
            });
        })
    }); 
        
	</script>
<?php
$fecha = $data['fecha'];

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
                    <input type='hidden' name='action' value='insertarReserva'>
                    <input type='hidden' id='miFecha' name='miFecha' value='".$fecha."'>
                    <input type='hidden' id='miPrecio' name='miPrecio'>";
                                            
                echo "<p>Instalación </p><select name='instalaciones' id='miSel' class='actualizar' required>
                <option>--Selecciona una instalación--</option>";                
                foreach ($data['listaInstalaciones'] as $instalacion) {
                    echo "<option value='" . $instalacion->idInstalacion .
                    "'>" . $instalacion->nombre . "</option>";
                }
                echo "</select><br>
                <p>Horas</p>
                            <table>
                                <tbody id='horario'>";
                            echo"</tbody>
                            </table>
                <p>Precio = <span name='precio' id='precio'></span></p>
                
                <div class='container-login100-form-btn'>
                    <button class='botones'>Nueva</button>
                </div>	
                
            </form>
    </div>  
</div>
<h2 id='fecha'></h2>
</div>
";
if (is_array($data['listaReservas'])) {
    echo "<table border ='1'>";
	foreach ($data['listaReservas'] as $reserva) {
        
        echo "<tbody><tr id='reserva" . $reserva->idReserva . "'>";
        if($_SESSION['tipo']==1) echo "<td>Usuario: " . $reserva->nombre . "</td>";
        echo "<td>" . $reserva->hora . "</td>";
        echo "<td>" . $reserva->precio . "€</td>";
        echo "<script>
            var res = '$reserva->fecha'
            res = 'Reservas del día '+res.substr(9)+' del '+res.substr(8,2)+' de ' + res.substr(0,4)
            document.getElementById('fecha').innerHTML=res
             </script>";
		if ($this->seguridad->haySesionIniciada()) {
            echo "<td><a href='#' class='btnBorrar' id='" . $reserva->idReserva . "'>Borrar</a></td>";
		}
		
    }echo "</tr></tbody></table>";
    if($_SESSION['tipo']==2){
        if (count($data['listaReservas']) < 4) {
        echo "<form class='nuevo' style='float:none;width:230px;position:relative;margin:auto;'>	
                <div class='container-login100-form-btn'>
                    <a class='botones' href='#miModal'>Hacer reserva</a>
                </div>			
            </form>";
        }
    }else{
        echo "<form class='nuevo' style='float:none;width:230px;position:relative;margin:auto;'>	
                <div class='container-login100-form-btn'>
                    <a class='botones' href='#miModal'>Hacer reserva</a>
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
                

	
