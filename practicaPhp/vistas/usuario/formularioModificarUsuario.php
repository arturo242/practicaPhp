<?php
$usuario = $data['usuario'];
echo"
<div class='text-center p-t-100'>
		<div>
			<div>
					<form method='POST' action='index.php' enctype='multipart/form-data'>
						<h2>MODIFICAR USUARIO</h2>
						<img src='img/usuarios/$usuario->imagen.jpg'>
						<p>Subir foto</p><input type='file' name='imagen'>
						<input type='hidden' name='idUsuario' value='$usuario->idUsuario'>
						<p>Email</p> <input type='text' name='email' value='$usuario->email' class='inputModal' required>
						<p>Password</p> <input type='password' class='inputModal' name='password' required>
                        <p>Nombre</p> <input type='text' name='nombre' value='$usuario->nombre' class='inputModal' required>
						<p>Primer Apellido</p> <input type='text' name='apellido1' value='$usuario->apellido1' class='inputModal'>
						<p>Segundo Apellido</p> <input type='text' name='apellido2' value='$usuario->apellido2' class='inputModal'>
                        <p>DNI</p> <input type='text' name='dni' value='$usuario->dni' class='inputModal' required>

						<input type='hidden' name='action' value='modificarUsuario'>
						<div class='container-login100-form-btn'>
							<button class='botones' style='width:200px;margin-top:20px;'>Actualizar.</button>
						</div>	
						
					</form>
			</div>  
        </div>
</div>";
?>