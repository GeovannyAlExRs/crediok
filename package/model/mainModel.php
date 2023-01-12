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

        /*** [FUNCTION ENCRYPT CADENA] ***/
		public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

        /*** [FUNCTION DENCRYPT CADENA] ***/
		protected static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

        /*** [FUNCTION GENERATE CODE RANDOM] ***/
        protected static function generateCodeRandom($letter, $longitude, $digit){
            for($i = 1; $i <= $longitude; $i++) {
                $random = rand(0,9);
                $letter.= $random;
            }
            return $letter."-".$digit;
		}

    }