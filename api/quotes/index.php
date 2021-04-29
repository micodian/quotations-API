<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';

$limit =filter_input(INPUT_GET, 'limit',FILTER_VALIDATE_INT);
$categoryid = filter_input(INPUT_GET, 'categoryid',FILTER_VALIDATE_INT);
$authorid =filter_input(INPUT_GET, 'authorid',FILTER_VALIDATE_INT);


$database = new Database();
$db = $database->connect();


$quotes = new Quotes($db);
if($limit){
    $result = $quotes->read_by_limit($limit);
}else if($authorid){
    $result = $quotes->read_by_author($authorid);
}else{
    $result = $quotes->read();
}
// $result = $quotes->read();

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
            'category' => $category
            // 'categoryid' => $categoryid,
            // 'authorid' => $authorid
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