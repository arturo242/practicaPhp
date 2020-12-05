
<script>
var cabecera= document.getElementById("cabecera");
var padre = cabecera.parentNode;
padre.removeChild(cabecera);

</script>
</header>
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
					<div class="text-center w-full p-t-23">
						<a href="?action=mostrarFormularioRegistro" class="txt1" style="background-color:transparent;">
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
