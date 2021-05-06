<?php
    class Account {
        private $con;
        private $errorArray = array();

        public function __construct($con) {
            $this->con = $con;
        }

        public function register($n, $un, $pnum, $em, $pw, $pw2) {
            $this -> validateName($n);
            $this -> validateUsername($un);
            $this -> validateNumber($pnum);
            $this -> validateEmails($em);
            $this -> validatePasswords($pw, $pw2);
            


            if(empty($this -> errorArray)) {
                return $this -> insertUserDetails($n, $un, $pnum, $em, $pw,$pw2); 
            }

            return false;
        }

        public function login($un, $pw) {
            $pw = hash("sha512", $pw);
            $query = $this -> con -> prepare("SELECT * FROM u_details WHERE Username = :Username AND Password = :Password");
            $query -> bindValue(":Username", $un);
            $query -> bindValue(":Password", $pw);
            $query -> execute();
            $this -> data=$query -> fetch(PDO::FETCH_ASSOC);
            //echo $this -> data["Username"]; 
            //echo $this -> data["Password"];

            if($query -> rowCount() == 1) {
                $_SESSION["userId"] = $this->data["id"];
                return true;
            }
            array_push($this -> errorArray, Constants::$loginFailed);
            return false;
        }

        private function insertUserDetails($n, $un, $pnum, $em, $pw) {
            $pw = hash("sha512", $pw);
            $query = $this -> con -> prepare("INSERT INTO u_details (Name, Username, Phno, Email, Password)
                                                VALUES (:Name, :username, :number, :email, :password)");
            $query -> bindValue(":Name", $n);
            $query -> bindValue(":username", $un);
            $query -> bindValue(":number", $pnum);
            $query -> bindValue(":email", $em);
            $query -> bindValue(":password", $pw);

            return $query -> execute();
        }

        // We are only calling these 2 functions from within the class
        private function validateName($n) {
            if(strlen($n) < 2 || strlen($n) > 25) {
                array_push($this -> errorArray, Constants::$NameCharacters);
            }
        }

     
        private function validateUsername($un) {
            if(strlen($un) < 2 || strlen($un) > 25) {
                array_push($this -> errorArray, Constants::$usernameCharacters);
                return;
            }

            // A prepared statement - Preparing SQL statement - and underneath we're binding
            // the parameter value to un. More secure - Less at risk to SQL Injection
            // Where values injected to queries
            $query = $this -> con -> prepare("SELECT * FROM u_details WHERE username = :username");
            $query -> bindValue(":username", $un);

            $query -> execute();
            if($query -> rowCount() != 0) {
                array_push($this -> errorArray, Constants::$usernameTaken);
            }
        }

        private function validateNumber($pnum) {
            if(strlen($pnum) != 10) {
                array_push($this -> errorArray, Constants::$numberCharacters);
                return;
            }

        $query = $this -> con -> prepare("SELECT * FROM u_details WHERE Phno = :Phno");
            $query -> bindValue(":Phno", $pnum);

            $query -> execute();
            if($query -> rowCount() != 0) {
                array_push($this -> errorArray, Constants::$numberTaken);
            }
        }

        private function validateEmails($em) {
            
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this -> errorArray, Constants::$emailInvalid);
                return;
            }

            $query = $this -> con -> prepare("SELECT * FROM u_details WHERE Email = :email");
            $query -> bindValue(":email", $em);
            
            $query -> execute();
            $this -> data=$query -> fetch(PDO::FETCH_ASSOC);
            //echo $this -> data ["Email"];
          
            if($query -> rowCount() != 0) {
                array_push($this -> errorArray, Constants::$emailTaken);
            }
        }

        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this -> errorArray, Constants::$passwordsDontMatch);
                return;
            }

            if(strlen($pw) < 5 || strlen($pw) > 25) {
                array_push($this -> errorArray, Constants::$passwordLength);
            }
        
        }

        public function getError($error) {
            if(in_array($error, $this -> errorArray)) {
                return "<div class = 'errorMessage'> $error </div>";
            }
        }
    }
?>