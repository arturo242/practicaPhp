
<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
				<form class="login100-form validate-form" action="index.php">
					<span class="login100-form-title p-b-43">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1 validate-input" data-validate = "Email is required">
						<input class="input100" type="text" name="email" id="email" >
						<span class="label-input100" >Email</span>
					</div>
					
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
                        <span class="label-input100">Password</span>
                        <input type="hidden" name="action" value="procesarLogin">
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Name is required">
						<input class="input100" type="text" name="nombre">
                        <span class="label-input100">Nombre</span>
					</div>

					<div class="wrap-input100 rs2 validate-input">
						<input class="input100" type="text" name="apellido1">
                        <span class="label-input100">Primer apellido</span>
					</div>

					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="text" name="apellido2">
                        <span class="label-input100">Segundo apellido</span>
					</div>

					<div class="wrap-input100 rs2 validate-input">
						<input class="input100" type="text" name="dni">
						<span class="label-input100">DNI</span>
						<input type="hidden" name='action' value='insertarUsuario'>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>
					<div class="text-center w-full p-t-23"><p id="mensajeUsuario"></p></div>
					
				</form>
			</div>
		</div>
<?php
			// Comprobamos si hay una sesión iniciada o no
				echo "<h1>Nuevo usuario</h1>";

				// Creamos el formulario con los campos del libro
				echo "<form action = 'index.php' method = 'get'>
						User:<input type='text' name='nombre'><br>
						Email:<input type='text' name='email'><br>
						Password:<input type='password' name='pass'><br>";
				// Finalizamos el formulario
				echo "  <input type='hidden' name='action' value='insertarUsuario'>
						<input type='submit'>
					</form>";
				echo "<p><a href='index.php'>Volver</a></p>";