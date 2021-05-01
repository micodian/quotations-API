<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization
,X-Requested-With');


include_once '../../model/Database.php';
include_once '../../model/Authors.php';



$database = new Database();
$db = $database->connect();


$authors = new Authors($db);

$data = json_decode(file_get_contents("php://input"));


if(!$data){
    echo json_encode(
        array('message' => 'no detils added to quotes')
    );
}

$authors->id = $data->id;
$authors->author = $data->author;


if($authors->update()){
    echo json_encode(
        array('message' => 'Author updated')
    );
}else{
    echo json_encode(
        array('message' => 'Author Not updated')
    );
}

?>