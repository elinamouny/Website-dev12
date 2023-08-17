# Elina's Website


### Make your first request
To request our API, you need to update authorization header like : 
    
    Authorization: Bearer <token>

This part show you avaliables routes avaliable in our API. Note that all routes mentionned here are prefixed by "api/v1".

| Url                    | Method    | Description                         |  Documentation |
|-----                   |--------   |-------------                        | ------         |
| /user                  | GET       | Get all users                       | |
| /user                  | POST      | Store a user in database            | |
| /user/{id}             | GET       | Get info on a specific users        | |
| /user/{id}             | PUT/PATCH | Update info on a specific user      | |
| /user/{id}             | DELETE    | Delete a specific user              | |
| /user/{id}/habitations | GET       | Get All habitations for a user      | |
| /habitation            | GET       | Get all habitations                 | |
| /habitation            | POST      | To add an habitation in database    | |
| /habitation/{id}       | GET       | Get a specific habitations          | |
| /habitation/{id}       | PUT/PATCH | update an habitations               | |
| /habitation/{id}       | DELETE    | Delete an habitation                | |
| /habitation/{id}/user  | GET       | Get info about a habitotion owner   | |

