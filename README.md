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











 