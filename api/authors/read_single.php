<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Authors.php';

$id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);


$database = new Database();
$db = $database->connect();


$authors = new Authors($db);

$result = $authors->read_single($id);


$num = $result->rowCount();

if($num > 0){
    $author_arr = array();
    $author_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
            
            
        );

        array_push($author_arr['data'], $author_item);

    }
    echo json_encode($author_arr);
}else{
    echo json_encode(
        array('message' => 'no author found')
    );
}




?>