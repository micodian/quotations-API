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
            $statement->bindValue(':authorid', $this->authorId);
            $statement->bindValue(':categoryid', $this->categoryId);
            $statement->execute();
           
            return $statement;
    }
}


?>