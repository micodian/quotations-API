<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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
        array('message' => 'no detils added to authors')
    );
}
$authors->author = $data->author;


if($authors->create()){
    echo json_encode(
        array('message' => 'Author created')
    );
}else{
    echo json_encode(
        array('message' => 'Author Not created')
    );
}

?>