<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';


$database = new Database();
$db = $database->connect();


$quotes = new Quotes($db);

$result = $quotes->read();

$num = $result->rowCount();

if($num > 0){
    $quote_arr = array();
    $quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category,
            'categoryid' => $categoryid,
            'authorid' => $authorid
        );

        array_push($quote_arr['data'], $quote_item);

    }
    echo json_encode($quote_arr);
}else{
    echo json_encode(
        array('message' => 'no quotes found')
    );
}




?>