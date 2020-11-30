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
            $email = $this->db->consulta("SELECT idUsuario, email, nombre FROM usuarios WHERE email = '$email' AND pass = '$password'");
            if ($email) {
                return $email;
            } else {
                return null;
            }

        }
        public function buscarEmail($email) {
            $email = $this->db->consulta("SELECT idUsuario, email FROM usuarios WHERE email = '$email'");
            if ($email) {
                return $email;
            } else {
                return null;
            }

        }
        public function get($idUsuario)
        {
            $result = $this->db->consulta("SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'");
            return $result;
        }

        public function getAll() {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM usuarios" );

            return $result;
        
        }

        public function insert()
        {
            $nombre = $_REQUEST["nombre"];
            $password = $_REQUEST["pass"];
            $email = $_REQUEST["email"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];
    
            $result = $this->db->manipulacion("INSERT INTO usuarios (nombre,pass,email,apellido1,apellido2,dni) 
                            VALUES ('$nombre','$password', '$email', '$apellido1', '$apellido2', '$dni')");
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
            $result = $this->db->manipulacion("UPDATE usuarios SET
                                    email = '$email',
                                    pass = '$pass',
                                    nombre = '$nombre',
                                    apellido1 = '$apellido1',
                                    apellido2 = '$apellido2',
                                    dni = '$dni'
                                    WHERE idUsuario = '$idUsuario'");
            return $result;
        }
    
    }