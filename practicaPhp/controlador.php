<?php
include_once("vista.php");
include_once("modelos/usuario.php");
//include_once("modelos/reserva.php");
//include_once("modelos/instalacion.php");

class Controlador{

    private $vista, $usuario, $reserva, $instalacion;

    public function __construct(){
        $this->vista = new Vista();
        $this->usuario = new Usuario();
       // $this->reserva = new Reserva();
       // $this->instalacion = new instalacion();
    }

    public function mostrar(){
        $this->vista->mostrar("reserva/listaReservas");
    }

    
}