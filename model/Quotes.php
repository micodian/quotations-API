<?php  

class Quotes {
    
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author;
    public $category;
    public $categoryId;
    public $authorId;
    public $limit;


    public function __construct($db){
        $this->conn = $db;

    }

    public function read(){
        $query = 'SELECT quotes.id,quote,authorId,categoryId,author,category FROM quotes
                         INNER JOIN authors ON
                            quotes.authorId=authors.id
                         INNER JOIN categories ON
                             quotes.categoryId=categories.id
                             ORDER BY quotes.id
                             
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            // $quotes = $statement->fetchAll();
            // $statement->closeCursor();
            return $statement;
    }



    

    public function read_single($id){
        $query = 'SELECT id, quote FROM quotes
                         WHERE id = :id
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
        
            return $statement;
    }

    public function read_by_limit(){
      
        $query = 'SELECT quotes.id,quote,authorId,categoryId,author,category FROM quotes
                         INNER JOIN authors ON
                            quotes.authorId=authors.id
                         INNER JOIN categories ON
                             quotes.categoryId=categories.id
                             ORDER BY quotes.id ASC
                               LIMIT ?
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(1, $this->limit,PDO::PARAM_INT);
            $statement->execute();
           
            return $statement;
    }

    public function read_by_author($authorId){
        $query = 'SELECT quotes.id,author,category,quote,authorId,categoryId FROM quotes
                         INNER JOIN authors ON
                            quotes.authorId=authors.id
                         INNER JOIN categories ON
                             quotes.categoryId=categories.id
                             WHERE quotes.authorId=:authorId
                             ORDER BY quotes.id ASC
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':authorId', $authorId);
            $statement->execute();
           
            return $statement;
    }

    public function read_by_category($categoryId){
        $query = 'SELECT quotes.id,author,category,quote,authorId,categoryId FROM quotes
                         INNER JOIN authors ON
                            quotes.authorId=authors.id
                         INNER JOIN categories ON
                             quotes.categoryId=categories.id
                             WHERE quotes.categoryId=:categoryId
                             ORDER BY quotes.id ASC
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':categoryId', $categoryId);
            $statement->execute();
           
            return $statement;
    }

    public function read_both(){
        $query = 'SELECT quotes.id,author,category,quote,authorId,categoryId FROM quotes
                         INNER JOIN authors ON
                            quotes.authorId=authors.id
                         INNER JOIN categories ON
                             quotes.categoryId=categories.id
                             WHERE quotes.categoryId=:categoryId
                                AND quotes.authorId =:authorId
                             ORDER BY quotes.id ASC
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':authorId', $this->authorId);
            $statement->bindValue(':categoryId', $this->categoryId);
            $statement->execute();
           
            return $statement;
    }

    public function create(){
       
        $query = ' INSERT INTO quotes
                       
                     SET
                        quote = :quote,
                        authorId= :authorId,
                        categoryId = :categoryId
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->quote=htmlspecialchars(strip_tags($this->quote));
            $this->authorId =htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId=htmlspecialchars(strip_tags($this->categoryId));

            

            $statement->bindValue(':quote', $this->quote);
            $statement->bindValue(':authorId',$this->authorId );
            $statement->bindValue(':categoryId',$this->categoryId);
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function update(){
       
        $query = ' UPDATE quotes
                       
                     SET
                        quote = :quote,
                        authorId= :authorId,
                        categoryId = :categoryId
                          WHERE id = :id    
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $this->quote=htmlspecialchars(strip_tags($this->quote));
            $this->authorId =htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId=htmlspecialchars(strip_tags($this->categoryId));
            $this->id=htmlspecialchars(strip_tags($this->id));
            
            $statement->bindValue(':id', $this->id);
            $statement->bindValue(':quote', $this->quote);
            $statement->bindValue(':authorId',$this->authorId );
            $statement->bindValue(':categoryId',$this->categoryId);
            //$statement->execute();
            if($statement->execute()){
                return true;
            }
            echo json_encode($statement->error);
            return false;
    }

    public function delete(){
        $query = 'DELETE FROM quotes
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