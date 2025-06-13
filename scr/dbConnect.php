<?php
    class DbConnect{
        //private $host = 'localhost';
        //private $host = '127.0.01';
        //private $host = '172.25.64.1'; // 192.168.0.63
        //private $host = '216.24.57.252';//RenderIp 216.24.57.252
        private $host = '172.18.0.1'; //docker db ip
        //private $host = '192.168.0.63';
        private $dbname = 'ussd_db';
        //private $dbname = 'ussd_database';
        private $user = 'root';
        private $pwd= 'password2';

        public function connect(){
            try{
                $dsn = 'mysql:host='.$this->host.';port=3306;dbname='.$this->dbname;
                //echo $dsn;
                $conn = new PDO($dsn, $this->user, $this->pwd);
                $conn -> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
                #$conn ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $conn;
            } catch(PDOException $e){
                echo 'END Database Error: '. $e->getMessage()."\n";
                return '404';
            }
        }
    }
//?>