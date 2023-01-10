<?php

    if($peticionAjax) {
        require_once "../config/server.php";
    } else {
        require_once "./config/server.php";
    }

    class mainModel {

        /*** [MODEL CONNECTION BD] ***/
        protected static function connection() {
            $connection = new PDO(SGBD, USER, PASS);
            $connection -> exec("SET CHARACTER SET utf8");
            return $connection;
        }

        /*** [MODEL EXECUTE SIMPLE CONSULT] ***/
        protected static function executeSimpleConsult($queryBD) {
            $sql = self::connection() -> prepare($queryBD);
            $sql -> execute();
            return $sql;
        }
    }