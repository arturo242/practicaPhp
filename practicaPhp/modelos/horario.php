<?php
    include_once("DB.php");

    class Horario {
        private $db;
        
        /**
         * Constructor. Establece la conexión con la BD y la guarda
         * en una variable de la clase
         */
        public function __construct() {
            $this->db = new DB();
        }

       
        /**
         * Busca un usuario por nombre de usuario y descripcion
         * @param usuario El nombre del usuario
         * @param descripcion La contraseña del usuario
         * @return True si existe un usuario con ese nombre y contraseña, false en caso contrario
         */
        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM horarios");
            if(count($result) == 1){
                $arrayResult[]=$result[0];
                return $arrayResult;
            }else{
                return $result;
            }

        }

        public function getHoras($idInstalacion){
            $arrayResult = array();
            $result = $this->db->consulta("SELECT horarios.horaInicio,horarios.horaFin FROM horarios 
                                        INNER JOIN instalaciones 
                                            ON horarios.idHorario = instalaciones.idHorario 
                                            WHERE idHorario=".$idInstalacion);
            return $result;
        }
    }