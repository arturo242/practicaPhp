<?php
    include_once("DB.php");

    class Instalacion {
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
        public function buscarUsuario($imagen,$descripcion) {
            $imagen = $this->db->consulta("SELECT * FROM instalaciones WHERE imagen = '$imagen' AND descripcion = '$descripcion'");
            if ($imagen) {
                return $imagen[0];
            } else {
                return null;
            }

        }
        public function buscarImagen($img) {
            $imagen = $this->db->consulta("SELECT idInstalacion, imagen FROM instalaciones WHERE imagen = '$img'");
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
            $result = $this->db->consulta("SELECT * FROM instalaciones" );
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

        public function updateImg(){
            $ficheroSubido = "img/".$_FILES['fotoInstalacion']['name'].".jpg";

            if(move_uploaded_file($_FILES['fotoInstalacion']['tmp_name'], $ficheroSubido)){
                $imagen = $ficheroSubido;
            }
            else {
                $result = -1;
            }
            return $result;
        }
        public function update($idInstalacion, $nombre, $descripcion, $precio, $idHorario)
        {
            $arrayResult = array();
            if($result = $this->db->manipulacion("UPDATE instalaciones SET
                                    nombre = '$nombre',
                                    descripcion = '$descripcion',
                                    precio = '$precio',
                                    idHorario = '$idHorario'
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
    }