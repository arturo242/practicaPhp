<script>

function ejecutar_ajax() {
	peticion_http = new XMLHttpRequest();
	peticion_http.onreadystatechange = procesa_respuesta();
	email = document.getElementById("email").value;
	peticion_http.open('GET', 'http://localhost/arturo/practicaPhp/index.php?action=comprobarEmail&email=' + email, true);
	peticion_http.send(null);
}	

function procesa_respuesta() {
	if(peticion_http.readyState == 4) {
		if(peticion_http.status == 200) {
			if (peticion_http.responseText == "0")
				document.getElementById('mensajeUsuario').innerHTML = "Error, ese usuario no existe";
			if (peticion_http.responseText == "1")
				document.getElementById('mensajeUsuario').innerHTML = "Usuario OK";
		}
	}
}	
</script>
	
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

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="ejecutar_ajax()">
							Sign in
						</button>
					</div>
					<div class="text-center w-full p-t-23"><p id="mensajeUsuario"></p></div>
					<div class="text-center w-full p-t-23">
						<a href="?action=mostrarFormularioRegistro" class="txt1">
							Create an account?
						</a>
					</div>
				</form>
			</div>
		</div>
