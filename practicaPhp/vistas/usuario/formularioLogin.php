
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body style="background: -webkit-linear-gradient(left, #6a11cb, #2575fc);color:white;">
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
<div class="limiter">
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
						<button class="login100-form-btn" onclick="ejecutar_ajax()" >
							Sign in
						</button>
					</div>
					<div class="text-center w-full p-t-23"><p id="mensajeUsuario"></p></div>
					<div class="text-center w-full p-t-23">
						<a href="?action=mostrarFormularioRegistro" class="txt1">
							Create an account?
						</a>
					</div>
					<div class="text-center w-full p-t-23">
						<?php
							if (isset($data['msjError'])) {
								echo "<p style='color:white'>".$data['msjError']."</p>";
							}
							if (isset($data['msjInfo'])) {
								echo "<p style='color:white'>".$data['msjInfo']."</p>";
							}
						?>
					</div>
				</form>
			</div>
		</div>
</div>
