<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../model/Database.php';
include_once '../../model/Quotes.php';
include_once '../../model/Categories.php';
include_once '../../model/Authors.php';


$database = new Database();
$db = $database->connect();


$authors = new Authors($db);

$result = $authors->read();

$num = $result->rowCount();

if($num > 0){
    $author_arr = array();
    //$author_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
            
            
        );

        array_push($author_arr, $author_item);

    }
    echo json_encode($author_arr);
}else{
    echo json_encode(
        array('message' => 'no author found')
    );
}




?>