<?php
echo "<h1>Polideportivo</h1>";
// Mostramos info del usuario logueado (si hay alguno)
if ($this->seguridad->haySesionIniciada()) {
	echo "<p>Hola, " . $this->seguridad->get("nombre") . "</p>";
	echo "<p align='right'><img width='50' src='" . $this->seguridad->get("imagen") . "'></p>";
}