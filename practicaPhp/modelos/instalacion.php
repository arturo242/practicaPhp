<?php
    include_once("DB.php");

    class Instalacion {
        private $db;
        public function __construct() {
            $this->db = new DB();
        }       
        
        public function buscarUsuario($imagen,$descripcion) {
            $imagen = $this->db->consulta("SELECT * FROM instalaciones WHERE imagen = '$imagen' AND descripcion = '$descripcion'");
            if ($imagen) {
                return $imagen[0];
            } else {
                return null;
            }

        }
        public function buscarImagen() {
            $imagen = $this->db->consulta("SELECT * FROM instalaciones");
            if ($imagen) {
                return $imagen[0];
            } else {
                return null;
            }

        }
        public function get($idInstalacion)
        {
            $result = $this->db->consulta("SELECT * FROM instalaciones WHERE idInstalacion = '$idInstalacion'");
            if ($result) {
                return $result[0];
            } else {
                return null;
            }
        }


        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM instalaciones
                                                 INNER JOIN horarios 
                                                    ON horarios.idHorario = instalaciones.idHorario
                                                    ORDER BY instalaciones.nombre
            " );
            if(count($result) == 1){
                $arrayResult[]=$result[0];
                return $arrayResult;
            }else{
                return $result;
            }
            
        
        }

        public function insert()
        {
                $nombre = $_REQUEST["nombre"];
                $descripcion = $_REQUEST["descripcion"];
                $precio = $_REQUEST["precio"];
                $idHorario = $_REQUEST["idHorario"];
        
                $result = $this->db->manipulacion("INSERT INTO instalaciones (nombre,descripcion,precio,idHorario) 
                                VALUES ('$nombre','$descripcion', '$precio', '$idHorario')");
           
                return $result;
        }
        public function delete($id)
        {
            $r = $this->db->manipulacion("DELETE FROM instalaciones WHERE idInstalacion = '$id'");
            return $r;
        }

        public function existeNombre($nombre) {
            $result = $this->db->consulta("SELECT * FROM instalaciones WHERE nombre = '$nombre'");
            if ($result != null)
                return 1;
            else  
                return 0;

        }
        public function update($idInstalacion, $nombre, $descripcion, $precio, $idHorario)
        {
            $arrayResult = array();
            if($result = $this->db->manipulacion("UPDATE instalaciones SET
                                    nombre = '$nombre',
                                    descripcion = '$descripcion',
                                    precio = '$precio',
                                    idHorario = '$idHorario',
                                    imagen ='$idInstalacion'
                                    WHERE idInstalacion = '$idInstalacion'"))
            {
               return $result; 
            }else{
                $arrayResult = null;
            } 
                                
        }
        
        public function busquedaAproximada($textoBusqueda)
        {
            $arrayResult = array();
            if ($result = $this->db->consulta("SELECT * FROM instalaciones
                        WHERE imagen LIKE '%$textoBusqueda%'
                        OR nombre LIKE '%$textoBusqueda%'
                        OR precio LIKE '%$textoBusqueda%'
                        OR idHorario LIKE '%$textoBusqueda%'
                ")) {
              return $result;
            } else {
                $arrayResult = null;
            }
        }

        public function procesarImagen() {
            $imagenBuena = true;
            $imagen = $_FILES['imagen']['name'];
            $idInstalacion = $_REQUEST['idInstalacion'];
            if (isset($imagen) && $imagen != "") {
                $tipo = $_FILES['imagen']['type'];
                $tamanyo = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                if (!((strpos($tipo, "gif") || strpos($tipo,"jpeg") || (strpos($tipo,"jpg") || strpos($tipo,"png")) && ($tamanyo < 2000000)))) {
                    $imagenBuena = false;
                } else {
                    if (move_uploaded_file($temp, 'img/instalaciones/'.$idInstalacion.'.jpg')) {
                        $this->db->manipulacion("UPDATE instalaciones SET
                                                                imagen='$imagen'
                                                    WHERE idInstalacion = '$idInstalacion'");
                    }
                }
            }
            return $imagenBuena;
        }
    }