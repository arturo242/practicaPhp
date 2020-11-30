<link rel='stylesheet' type='text/css' href='css/estilo.css'>
		<link rel='stylesheet' type='text/css' href='css/util.css'>
		<link rel='stylesheet' type='text/css' href='css/main.css'>
</head>

<body style='background: -webkit-linear-gradient(left, #6a11cb, #2575fc);color:white;'>
<div class='container-login100'>
			<div class='wrap-login100 p-b-160 p-t-50'>
            <?php
            $usuario = $data['usuario'];
            echo"
				<form class='login100-form validate-form' action='index.php'>
					<span class='login100-form-title p-b-43'>
						Account Login
					</span>
					
                    <div class='wrap-input100 rs1 validate-input' data-validate = 'Email is required'>
                        <input type='hidden' name='idUsuario' value='$usuario->idUsuario'>
						<input class='input100' type='text' name='email' id='email' value='$usuario->email'>
						<span class='label-input100' >Email</span>
					</div>
					
					
					<div class='wrap-input100 rs2 validate-input'  data-validate='Password is required'>
						<input class='input100' type='password' name='pass' value='$usuario->pass'>
                        <span class='label-input100'>Password</span>
                        <input type='hidden' name='action' value='procesarLogin'>
					</div>

					<div class='wrap-input100 rs1 validate-input' data-validate='Name is required'>
						<input class='input100' type='text' name='nombre' value='$usuario->nombre'>
                        <span class='label-input100'>Nombre</span>
					</div>

					<div class='wrap-input100 rs2'>
						<input class='input100' type='text' name='apellido1' value='$usuario->apellido1'>
                        <span class='label-input100'>Primer apellido</span>
					</div>

					<div class='wrap-input100 rs1'>
						<input class='input100' type='text' name='apellido2' value='$usuario->apellido2'>
                        <span class='label-input100'>Segundo apellido</span>
					</div>

					<div class='wrap-input100 rs2 validate-input'>
						<input class='input100' type='text' name='dni' value='$usuario->dni'>
						<span class='label-input100'>DNI</span>
						<input type='hidden' name='action' value='modificarUsuario'>
					</div>

					<div class='container-login100-form-btn'>
						<button class='login100-form-btn'>
							Sign in
						</button>
					</div>
					<div class='text-center w-full p-t-23'>";
						
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
