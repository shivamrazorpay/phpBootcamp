# Social-Media-Platform PHP mini-project

## Api Contracts 

| Api  | Type | Request | Description |
| ------------- | ------------- | ------------- | ------------- |
| http://127.0.0.1:8000/api/user  | POST  | {"first_name","last_name","email"} | Insert User in user_table |
| http://localhost:8000/api/user | GET  | {} | Get all user in user_table |
| http://127.0.0.1:8000/api/:user/post | POST  | {"description","tag"} | Insert post in post_table by a user|
| http://127.0.0.1:8000/api/:user/post?tag=others&limit=10&skip=0 | GET  | {} | Get all post a user , with given tag and limit=10 post & skip = 0 
| http://127.0.0.1:8000/api/:post/comment | POST  | {"description"} | Insert comment for a given post |
| http://127.0.0.1:8000/api/:post/comment?skip=0&limit=10 | GET  | {} | Get all comment on the post with limit of 10 post & skip=0 |

## Authorization:
Header:'token':'secret'

## Schemes:
|Table Name | Description |
| ------------- | ------------- |
|user_table| Store all user data|
|post_table| Store all Posts by Users|
|comment_table| Store all Comments on Posts|
