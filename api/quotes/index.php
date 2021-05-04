<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';

$limit =filter_input(INPUT_GET, 'limit',FILTER_VALIDATE_INT);
$categoryId = filter_input(INPUT_GET, 'categoryId',FILTER_VALIDATE_INT);
$authorId =filter_input(INPUT_GET, 'authorId',FILTER_VALIDATE_INT);
$random = filter_input(INPUT_GET, 'random', FILTER_VALIDATE_BOOLEAN);

$database = new Database();
$db = $database->connect();


$quotes = new Quotes($db);
if($limit){
    $quotes->limit = $limit;
    $result = $quotes->read_by_limit();
}else if($categoryId && $authorId){
    $quotes->authorId = $authorId;
    $quotes->categoryId = $categoryId;
    $result = $quotes->read_both();
}
else if($authorId){
    $result = $quotes->read_by_author($authorId);
}else if($categoryId){
    $result = $quotes->read_by_category($categoryId);
}
else{
    $result = $quotes->read();
}
// $result = $quotes->read();

$num = $result->rowCount();

if($num > 0){
    $quote_arr = array();
    //$quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
            //'categoryId' => $categoryId,
            //'authorId' => $authorId
        );

        array_push($quote_arr, $quote_item);

    }
    if($random){
        $random_quote = $quote_arr[random_int(0,count($quote_arr))];
        echo json_encode($random_quote);
    }else{
        echo json_encode($quote_arr);
    }
    //echo json_encode($quote_arr);
}else{
    echo json_encode(
        array('message' => 'no quotes found')
    );
}




?>