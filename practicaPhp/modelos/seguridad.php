<?php
    class Seguridad {

        public function abrirSesion($usuario) {
            $_SESSION["idUsuario"] = $usuario->idUsuario;
            $_SESSION["email"] = $usuario->email;
            $_SESSION["nombre"] = $usuario->nombre;
            $_SESSION["imagen"] = $usuario->imagen;
            $_SESSION["tipo"] = $usuario->tipo;
        }

        public function cerrarSesion() {
            session_destroy();
        }

        public function get($variable) {
            return $_SESSION[$variable];
        }

        public function haySesionIniciada() {
            if (isset($_SESSION["idUsuario"])) {
                return true;
            } else {
                return false;
            }
        }

        public function esAdmin(){
            if ($_SESSION["tipo"] == 1) {
                return true;
            } else {
                return false;
            }
        }

        public function errorSesion() {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuario/formularioLogin", $data);
        }
    }