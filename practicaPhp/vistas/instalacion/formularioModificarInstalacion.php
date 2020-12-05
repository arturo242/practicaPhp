<?php
$instalacion = $data['instalacion'];
echo"
<div class='text-center p-t-100'>
		<div>
			<div>
					<form action='index.php'>
						<h2>MODIFICAR INSTALACIÓN</h2>
                        <input type='hidden' name='idInstalacion' value='$instalacion->idInstalacion'>
						<p>Nombre</p> <input type='text' name='nombre' value='$instalacion->nombre' class='inputModal' required>
						<p>Descripción</p> <textarea  rows='6' cols='22' type='text' class='inputModal' name='descripcion'>$instalacion->descripcion</textarea>
                        <p>Precio por Hora</p> <input type='number' name='precio' value='$instalacion->precio' class='inputModal' required>
                        <p>Horario</p> <input type='number' name='idHorario' value='$instalacion->idHorario' class='inputModal' required>
						<input type='hidden' name='action' value='modificarInstalacion'>
						<div class='container-login100-form-btn'>
							<button class='botones' style='width:200px;margin-top:20px;'>Actualizar.</button>
						</div>	
						
					</form>
			</div>  
        </div>
</div>";
?>