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

        /*** [FUNCTION CLEAR CHAIN] ***/
        protected static function clearChain($chain) {
            $chain = str_ireplace("<script>", "", $chain);
            $chain = str_ireplace("</script>", "", $chain);
            $chain = str_ireplace("<script type=>", "", $chain);
            $chain = str_ireplace("<script src>", "", $chain);
            $chain = str_ireplace("SELECT * FROM", "", $chain);
            $chain = str_ireplace("INSERT INTO", "", $chain);
            $chain = str_ireplace("DELETE FROM", "", $chain);
            $chain = str_ireplace("DROP DATABASE", "", $chain);
            $chain = str_ireplace("DROP TABLE", "", $chain);
            $chain = str_ireplace("TRUNCATE TABLE", "", $chain);
            $chain = str_ireplace("SHOW DATABASES", "", $chain);
            $chain = str_ireplace("SHOW TABLE", "", $chain);
            $chain = str_ireplace("<?php", "", $chain);
            $chain = str_ireplace("?>", "", $chain);
            $chain = str_ireplace("-", "", $chain);
            $chain = str_ireplace("--", "", $chain);
            $chain = str_ireplace("[", "", $chain);
            $chain = str_ireplace("]", "", $chain);
            $chain = str_ireplace("{", "", $chain);
            $chain = str_ireplace("}", "", $chain);
            $chain = str_ireplace(">", "", $chain);
            $chain = str_ireplace("<", "", $chain);
            $chain = str_ireplace("^", "", $chain);
            $chain = str_ireplace("==", "", $chain);
            $chain = str_ireplace(";", "", $chain);
            $chain = str_ireplace("::", "", $chain);
            $chain = str_ireplace("->", "", $chain);
            $chain = str_ireplace("AND", "", $chain);
            $chain = str_ireplace("OR", "", $chain);
            $chain = stripslashes($chain);
            $chain = trim($chain);
            return $chain;
        }

        /*** [FUNCTION VERIFY DATA] ***/
        protected static function verifyData($filter, $chain) {
            if(preg_match("/^".$filter."$/", $chain)) { //EXPRESION REGULAR
                return false;
            } else {
                return true;
            }
        }

        /*** [FUNCTION VERIFY DATE] ***/
        protected static function verifyDate($date) {
            $value = explode('-', $date);
            if(count($value) == 3 && checkdate($value[1], $value[2], $value[0])) {
                return false;
            } else {
                return true;
            }
        }
    }