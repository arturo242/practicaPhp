<?php
$instalacion = $data['instalacion'];
echo"
<div class='text-center p-t-100'>
		<div>
			<div>
					<form method='POST' action='index.php' enctype='multipart/form-data'>
						<h2>MODIFICAR INSTALACIÓN</h2>
						<img src='img/instalaciones/$instalacion->imagen.jpg'>
						<input type='hidden' name='idInstalacion' value='$instalacion->idInstalacion' required>
						<p>Subir foto</p><input type='file' name='imagen'>
						<p>Nombre</p> <input type='text' name='nombre' value='$instalacion->nombre' class='inputModal' required>
						<p>Descripción</p> <textarea  rows='6' cols='22' type='text' class='inputModal' name='descripcion'>$instalacion->descripcion</textarea>
						<p>Precio por Hora</p> <input type='number' name='precio' value='$instalacion->precio' class='inputModal' required>
						<p>Horario</p><select id='miSel' name='idHorario'>
                		<option>--Selecciona un horario--</option>";
                        foreach ($data['horario'] as $horario) {
							$horaInicio = substr(strval($horario->horaInicio),0,2);
							$horaFin = substr(strval($horario->horaFin),0,2);
							$horas = "De ".$horaInicio." horas a ".$horaFin." horas";
							echo "<option value='" . $horario->idHorario .
							"'>" . $horas . "</option>";
						}echo"</select><br>
						<input type='hidden' name='action' value='modificarInstalacion'>
						<div class='container-login100-form-btn'>
							<button class='botones' style='width:200px;margin-top:20px;'>Actualizar.</button>
						</div>	
						
					</form>
			</div>  
        </div>
</div>";
?>