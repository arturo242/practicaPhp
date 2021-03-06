<?php
    include_once("DB.php");

    class Usuario {
        private $db;
        
        /**
         * Constructor. Establece la conexión con la BD y la guarda
         * en una variable de la clase
         */
        public function __construct() {
            $this->db = new DB();
        }

       
        /**
         * Busca un usuario por nombre de usuario y password
         * @param usuario El nombre del usuario
         * @param password La contraseña del usuario
         * @return True si existe un usuario con ese nombre y contraseña, false en caso contrario
         */

       
    
        public function buscarUsuario($email,$password) {
            $email = $this->db->consulta("SELECT * FROM usuarios WHERE email = '$email' AND pass = '$password'");
            if ($email) {
                return $email[0];
            } else {
                return null;
            }

        }
        public function buscarEmail($email) {
            $email = $this->db->consulta("SELECT idUsuario, email FROM usuarios WHERE email = '$email'");
            if ($email) {
                return $email[0];
            } else {
                return null;
            }

        }
        public function get($idUsuario)
        {
            $result = $this->db->consulta("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
            if ($result) {
                return $result[0];
            } else {
                return null;
            }
        }

        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM usuarios" );
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
            $password = $_REQUEST["password"];
            $email = $_REQUEST["email"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];

            $existeEmail = $this->buscarEmail($email);
            if ($existeEmail) {
                $result = -1;
            }else{
                $result = $this->db->manipulacion("INSERT INTO usuarios (nombre,pass,email,apellido1,apellido2,dni,tipo) 
                            VALUES ('$nombre','$password', '$email', '$apellido1', '$apellido2', '$dni' ,'2')");
            }
             return $result;
        }
        public function delete($id)
        {
            $r = $this->db->manipulacion("DELETE FROM usuarios WHERE idUsuario = '$id'");
            return $r;
        }

        public function existeNombre($email) {
            $result = $this->db->consulta("SELECT * FROM usuarios WHERE email = '$email'");
            if ($result != null)
                return 1;
            else  
                return 0;

        }

        

        public function update($idUsuario, $email, $pass, $nombre, $apellido1, $apellido2, $dni)
        {
            $arrayResult = array();
            if($result = $this->db->manipulacion("UPDATE usuarios SET
                                    email = '$email',
                                    pass = '$pass',
                                    nombre = '$nombre',
                                    apellido1 = '$apellido1',
                                    apellido2 = '$apellido2',
                                    dni = '$dni',
                                    imagen = '$idUsuario'
                                    WHERE idUsuario = '$idUsuario'"))
            {
               return $result; 
            }else{
                $arrayResult = null;
            } 
                                
        }

        public function procesarImagen() {
            $imagenBuena = true;
            $imagen = $_FILES['imagen']['name'];
            $idUsuario = $_REQUEST['idUsuario'];
            if (isset($imagen) && $imagen != "") {
                $tipo = $_FILES['imagen']['type'];
                $tamanyo = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                if (!((strpos($tipo, "gif") || strpos($tipo,"jpeg") || (strpos($tipo,"jpg") || strpos($tipo,"png")) && ($tamanyo < 2000000)))) {
                    $imagenBuena = false;
                } else {
                    if (move_uploaded_file($temp, 'img/usuarios/'.$idUsuario.'.jpg')) {
                        $this->db->manipulacion("UPDATE usuarios SET
                                                                imagen='$imagen'
                                                    WHERE idInstalacion = '$idUsuario'");
                    }
                }
            }
            return $imagenBuena;
        }
        
        public function busquedaAproximada($textoBusqueda)
        {
            $arrayResult = array();
            if ($result = $this->db->consulta("SELECT * FROM usuarios
                        WHERE email LIKE '%$textoBusqueda%'
                        OR nombre LIKE '%$textoBusqueda%'
                        OR apellido1 LIKE '%$textoBusqueda%'
                        OR apellido2 LIKE '%$textoBusqueda%'
                        OR dni LIKE '%$textoBusqueda%'")) {
              return $result;
            } else {
                $arrayResult = null;
            }
        }
        
    
    }