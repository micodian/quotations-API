<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';

$id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);


$database = new Database();
$db = $database->connect();


$quotes = new Quotes($db);

$result = $quotes->read_single($id);


$num = $result->rowCount();

if($num > 0){
    $quotes_arr = array();
    //$quotes_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote
            
            
        );

        array_push($quotes_arr, $quote_item);

    }
    echo json_encode($quotes_arr);
}else{
    echo json_encode(
        array('message' => 'no author found')
    );
}




?>