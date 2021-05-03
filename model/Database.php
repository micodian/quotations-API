<?php

class Database{
    
    private $host = 'localhost';
    private $db_name = 'quotesdb';
    private $username = 'root';
    private $password ='';
    private $conn;

    public function connect(){

        if(!isset($this->conn)){
            if(getenv('JAWSDB_URL', $local_only=false)){
                try{
                        $url = getenv('JAWSDB_URL');
                        $dbparts = parse_url($url);

                        $hostname = $dbparts['host'];
                        $username = $dbparts['user'];
                        $password = $dbparts['pass'];
                        $database = ltrim($dbparts['path'],'/');
                        $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        // set the PDO error mode to exception
                        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //echo "Connected successfully";
                }catch(PDOException $e){
                    echo "Connection failed: " . $e->getMessage();
                }
            }else{
                try{
                    $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,$this->username, $this->password);
                    //echo 'connected';
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    echo 'Error: ' . $e->getMessage();
                    
                }
            }

        }
        
        return $this->conn;
    }
    
}



    
    
?>