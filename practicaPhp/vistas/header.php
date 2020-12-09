<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Polideportivo</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<?php
echo "<header id='cabecera'>

  	<ul>
		<li><form class='login100-form validate-form'>	 
			<input type='hidden' name='action' value='cerrarSesion'>
			<div class='container-login100-form-btn'>
				<button class='botones'>Logout</button>
					
		</form>
		</li>
		<li>
		<form class='login100-form validate-form'>	 
			<input type='hidden' name='action' value='mostrarUsuarios'>
			<div class='container-login100-form-btn'>
				<button class='botones'>Usuarios</button>
			</div>			
		</form>
		</li>
		<li>
		<form class='login100-form validate-form'>	 
			<input type='hidden' name='action' value='mostrarInstalaciones'>
			<div class='container-login100-form-btn'>
				<button class='botones'>Instalaciones</button>
			</div>			
		</form>
		</li>
		<li>
		<form class='login100-form validate-form'>	 
			<input type='hidden' name='action' value='mostrarListaReservas'>
			<div class='container-login100-form-btn'>
				<button class='botones'>Reservas</button>
			</div>			
		</form>
		</li>
	</ul>
	</ul>";

?>