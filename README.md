# Rest Api of famous Quotes

## All Requests provide a JSON data response

GET Request:                               |                Response (fields):    
-------------------------------------- | ----------------------------------       
/api/quotes/                            | All quotes are returned (id,  quote, author, category)
/api/quotes/read_single.php?id=4        | The specific quote
/api/quotes/?authorId=10                | All quotes from authorId=10
/api/quotes/?categoryId=8               | All quotes in categoryId=8
/api/quotes/?authorId=3&categoryId=4    | All quotes from authorId=3 that are in categoryId=4 
/api/quotes/?limit=3                    | All quotes but limited to 3 quotes
/api/authors/                           | All authors with their id
/api/authors/read_single.php?id=5       | The specific author with their id
/api/categories/                        | All categories with their ids (id, category)
/api/categories/read_single.php?id=7    | The specific category with its id



POST Requests:                                           Response:
----------------------------------------  | -----------------------------------------
/api/quotes/create.php                    |      { message: ‘Quote Created’ }
/api/authors/create.php                   |    { message: ‘Author Created’ }
/api/categories/create.php                |      { message: ‘Category Created’ }


## Note For POSTS: 
To create a quote, the POST submission MUST contain the quote, authorId, and categoryId.
To create an author, the POST submission MUST contain the author.
To create a category, the POST submission MUST contain the category.

 
 PUT Requests:                                           Response:
---------------------------------------- | -----------------------------------------
/api/quotes/update.php                   |      { message: ‘Quote Updated’ }
/api/authors/update.php                  |       { message: ‘Author Updated’ }
/api/categories/update.php               |      { message: ‘Category Updated’ }

## Note For PUT:
To update a quote, the PUT submission MUST contain the id, quote, authorId, and categoryId.
To create an author, the PUT submission MUST contain the id and author.
To create a category, the PUT submission MUST contain the id and category.

DELETE Requests:                                           Response:
---------------------------------------- | -----------------------------------------
/api/quotes/delete.php                   |      { message: ‘Quote Deleted’ }
/api/authors/delete.php                  |      { message: ‘Author Deleted’ }
/api/categories/delete.php               |      { message: ‘Category Deleted’ }

## Note For DELETE:
All delete requests require the id to be submitted.
