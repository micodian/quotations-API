<?php  

class Authors {
    
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;
    
   


    public function __construct($db){
        $this->conn = $db;

    }

    public function read(){
        $query = 'SELECT * FROM authors
                         
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            // $quotes = $statement->fetchAll();
            // $statement->closeCursor();
            return $statement;
    }

    public function read_single($id){
        $query = 'SELECT id, author FROM authors
                         WHERE id = :id
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            // $quotes = $statement->fetchAll();
            // $statement->closeCursor();
            return $statement;
    }
}


?>