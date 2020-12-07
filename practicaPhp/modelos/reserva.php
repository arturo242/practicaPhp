<?php

include_once("DB.php");
class Reserva
{
    private $db;
    
    public function __construct()
    {
        $this->db = new DB();
    }

    public function get($id)
    {
        $result = $this->db->consulta("SELECT * FROM reservas
                                            WHERE idReserva = '$id'");
        return $result;
    }
    public function getAll()
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM reservas" );

        return $result;
    }
    public function getAllDia($fecha)
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM reservas
                                            WHERE fecha = '$fecha'" );

        return $result;
    }


}