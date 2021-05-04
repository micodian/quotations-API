<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';
include_once '../../model/Categories.php';




$database = new Database();
$db = $database->connect();


$categories = new Categories($db);

$result = $categories->read();


$num = $result->rowCount();

if($num > 0){
    $category_arr = array();
    //$category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = array(
            'id' => $id,
            'category' => $category
            
            
        );

        array_push($category_arr, $category_item);

    }
    echo json_encode($category_arr);
}else{
    echo json_encode(
        array('message' => 'no category found')
    );
}




?>