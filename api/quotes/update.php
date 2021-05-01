<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization
,X-Requested-With');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';



$database = new Database();
$db = $database->connect();


$quotes = new Quotes($db);

$data = json_decode(file_get_contents("php://input"));


if(!$data){
    echo json_encode(
        array('message' => 'no detils added to quotes')
    );
}

$quotes->id = $data->id;
$quotes->quote = $data->quote;
$quotes->authorId = $data->authorId;
$quotes->categoryId = $data->categoryId;

if($quotes->update()){
    echo json_encode(
        array('message' => 'Quote updated')
    );
}else{
    echo json_encode(
        array('message' => 'Quote Not updated')
    );
}

?>