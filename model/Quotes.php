<?php  

class Quotes {
    
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author;
    public $category;
    public $categoryid;
    public $authorid;
    public $limit;


    public function __construct($db){
        $this->conn = $db;

    }

    public function read(){
        $query = 'SELECT * FROM quotes
                         INNER JOIN authors ON
                            quotes.authorid=authors.id
                         INNER JOIN categories ON
                             quotes.categoryid=categories.id
                             ORDER BY quotes.id ASC
                        
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

    public function read_by_limit($limit){
        $query = 'SELECT * FROM quotes
                         INNER JOIN authors ON
                            quotes.authorid=authors.id
                         INNER JOIN categories ON
                             quotes.categoryid=categories.id
                             ORDER BY quotes.id ASC
                               LIMIT ?
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue('?', $limit,PDO::PARAM_INT);
            $statement->execute();
           
            return $statement;
    }

    public function read_by_author($authorid){
        $query = 'SELECT * FROM quotes
                         INNER JOIN authors ON
                            quotes.authorid=authors.id
                         INNER JOIN categories ON
                             quotes.categoryid=categories.id
                             WHERE quotes.authorid=:authorid
                             ORDER BY quotes.id ASC
                              
                        
                                                 ';
            $statement = $this->conn->prepare($query);
            $statement->bindValue('authorid', $authorid);
            $statement->execute();
           
            return $statement;
    }
}


?>