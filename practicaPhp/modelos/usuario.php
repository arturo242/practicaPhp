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

        public function get($id) {
        }

        public function getAll() {
        }

        public function insert() {
        }

        public function update() {
        }

        public function delete() {
        }

        public function existeNombre($email) {
            $result = $this->db->consulta("SELECT * FROM usuarios WHERE email = '$email'");
            if ($result != null)
                return 1;
            else  
                return 0;

        }

    }