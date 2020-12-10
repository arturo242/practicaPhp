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

        if($_SESSION['tipo'] == 2){
            $result = $this->db->consulta("SELECT * FROM reservas
                                            WHERE idUsuario =". $_SESSION['idUsuario']."");
        }else $result = $this->db->consulta("SELECT * FROM reservas" );
        if(count($result) == 1){
            $arrayResult[]=$result[0];
            return $arrayResult;
        }else{
            return $result;
        }
    }
    public function getAllDia($fecha)
    {
        $arrayResult = array();
        if($_SESSION['tipo'] == 2){
            $result = $this->db->consulta("SELECT * FROM reservas
                                            WHERE fecha = '$fecha' AND
                                            idUsuario =". $_SESSION['idUsuario']."");
        }else {
            $result = $this->db->consulta("SELECT * FROM reservas 
                                            INNER JOIN usuarios 
                                                    ON reservas.idUsuario=usuarios.IdUsuario
                                            WHERE reservas.fecha = '$fecha'" );
        }
        return $result;
    }

    public function delete($id)
        {
            $r = $this->db->manipulacion("DELETE FROM reservas WHERE idReserva = '$id'");
            return $r;
        }

        public function insert()
        {
               
                $idInstalacion = $_REQUEST["instalaciones"];
                $hora = $_REQUEST["horas"];
                $precio = $_REQUEST["miPrecio"];
                $fecha = $_REQUEST["miFecha"];
                $idUsuario = $_SESSION['idUsuario'];

                $result = $this->db->manipulacion("INSERT INTO reservas (fecha,hora,precio,idInstalacion,idUsuario) 
                                VALUES ('$fecha','$hora', '$precio', '$idInstalacion','$idUsuario')");
                return $result;
        }


}