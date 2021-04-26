<?php  

class Categories {
    
    private $conn;
    private $table = 'categories';

    public $id;
    public $category;
    
   


    public function __construct($db){
        $this->conn = $db;

    }

    public function read(){
        $query = 'SELECT * FROM categories
                         
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            // $quotes = $statement->fetchAll();
            // $statement->closeCursor();
            return $statement;
    }

    public function read_single($id){
        $query = 'SELECT id, category FROM categories
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