<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization
,X-Requested-With');


include_once '../../model/Database.php';
include_once '../../model/Categories.php';



$database = new Database();
$db = $database->connect();


$categories = new Categories($db);

$data = json_decode(file_get_contents("php://input"));
if(!$data){
    echo json_encode(
        array('message' => 'no detils added to categories')
    );
}
$categories->category = $data->category;


if($categories->create()){
    echo json_encode(
        array('message' => 'Category created')
    );
}else{
    echo json_encode(
        array('message' => 'Category Not created')
    );
}

?>