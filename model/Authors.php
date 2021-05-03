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

    public function create(){
       
        $query = ' INSERT INTO authors
                       
                     SET
                        author = :author
                        
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->author=htmlspecialchars(strip_tags($this->author));
            

            

            $statement->bindValue(':author', $this->author);
           
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function update(){
       
        $query = ' UPDATE authors
                       
                     SET
                        author = :author
                        WHERE id = :id
                        
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->author=htmlspecialchars(strip_tags($this->author));
            $this->id=htmlspecialchars(strip_tags($this->id));

            

            $statement->bindValue(':author', $this->author);
            $statement->bindValue(':id', $this->id);
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function delete(){
        $query = 'DELETE FROM authors
                        WHERE id =:id';
        $statement = $this->conn->prepare($query); 
        
        $this->id=htmlspecialchars(strip_tags($this->id));  
        
        $statement->bindValue(':id', $this->id);

        if($statement->execute()){
            return true;
        }
        echo json_encode($statement->error);
        return false;
    }
}


?>