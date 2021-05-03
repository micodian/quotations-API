<?php
require_once('model/Database.php');
require_once('model/Authors.php');
require_once('model/Categories.php');
require_once('model/Quotes.php');


$database = new Database();
$db = $database->connect();
$author = new Authors($db);
$category = new Categories($db);
$quote = new Quotes($db);

$categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
$authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
// $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
if ($authorId) $quote->authorId = $authorId;
if ($categoryId) $quote->categoryId = $categoryId;


$authors = $author->read();


$categories = $category->read();

if($authorId) $quotes = $quote->read_by_author($authorId);
if($categoryId) $quotes = $quote->read_by_category($categoryId);
if($authorId && $categoryId) $quotes = $quote->read_both();
//if($authorId) $quotes = $quote->read_by_author($authorId);


if(!$authorId && !$categoryId) $quotes= $quote->read();






include('view/quotes_list.php');