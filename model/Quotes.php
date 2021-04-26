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
            // $quotes = $statement->fetchAll();
            // $statement->closeCursor();
            return $statement;
    }
}


?>