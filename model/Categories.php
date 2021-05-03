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

    public function create(){
       
        $query = ' INSERT INTO categories
                       
                     SET
                        category = :category
                        
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->category=htmlspecialchars(strip_tags($this->category));
            

            

            $statement->bindValue(':category', $this->category);
           
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function update(){
       
        $query = ' UPDATE categories
                       
                     SET
                        category = :category
                        WHERE id = :id
                        
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->category=htmlspecialchars(strip_tags($this->category));
            $this->id=htmlspecialchars(strip_tags($this->id));
            

            

            $statement->bindValue(':category', $this->category);
            $statement->bindValue(':id', $this->id);
           
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function delete(){
        $query = 'DELETE FROM categories
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