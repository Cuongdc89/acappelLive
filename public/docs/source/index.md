---
title: API Reference

language_tabs:
- php
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Autentication


<!-- START_00e7e21641f05de650dbe13f242c6f2c -->
## api/logout
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/logout", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/logout" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/logout");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "true"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/logout`


<!-- END_00e7e21641f05de650dbe13f242c6f2c -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/login", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "cuongdc@gmail.com",
            "password" => "12345678@a",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"cuongdc@gmail.com","password":"12345678@a"}'

```

```javascript
const url = new URL("http://localhost/api/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "cuongdc@gmail.com",
    "password": "12345678@a"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
    "user": {
        "id": "2",
        "name": "Cuongdc",
        "email": "cuongdc316@gmail.com",
        "created_at": "2019-10-23 04:15:26",
        "updated_at": "2019-10-23 04:15:26"
    }
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "These credentials do not match our records."
        ]
    }
}
```

### HTTP Request
`POST api/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | The email which user has been register.
    password | string |  required  | The password required min 8 char.

<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## api/register
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/register", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "ratione",
            "password" => "velit",
            "password_confirmation" => "veniam",
            "name" => "iste",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/register" \
    -H "Content-Type: application/json" \
    -d '{"email":"ratione","password":"velit","password_confirmation":"veniam","name":"iste"}'

```

```javascript
const url = new URL("http://localhost/api/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "ratione",
    "password": "velit",
    "password_confirmation": "veniam",
    "name": "iste"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
    "user": {
        "id": "2",
        "name": "Cuongdc",
        "email": "cuongdc316@gmail.com",
        "created_at": "2019-10-23 04:15:26",
        "updated_at": "2019-10-23 04:15:26"
    },
    "status": "true"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```

### HTTP Request
`POST api/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | This param must validate email format.
    password | string |  required  | The password must has min 8 chars.
    password_confirmation | string |  required  | The password must has min 8 chars.
    name | string |  required  | This param will be use to display on user info and comment of user.

<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

#User Information


<!-- START_fc1e4f6a697e3c48257de845299b71d5 -->
## API for get user information

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/users", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/users" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/users");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "true",
    "user": {
        "email": "cuongdc@gmail.com",
        "id": "1",
        "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
    }
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/users`


<!-- END_fc1e4f6a697e3c48257de845299b71d5 -->

<!-- START_c527dcd7f3e7400067a0c62602aeaf10 -->
## API for update user information (user name, profile picture)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("http://localhost/api/users", [
    'headers' => [
            "Authorization" => "Bearer {token}",
            "Content-Type" => "application/json",
        ],
    'json' => [
            "name" => "perferendis",
            "profile_picture" => "iusto",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X PUT "http://localhost/api/users" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"perferendis","profile_picture":"iusto"}'

```

```javascript
const url = new URL("http://localhost/api/users");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "perferendis",
    "profile_picture": "iusto"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "user": {
        "email": "cuongdc@gmail.com",
        "id": "1",
        "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
    }
}
```

### HTTP Request
`PUT api/users`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | option update user name of auth user.
    profile_picture | file |  optional  | option update profile of user

<!-- END_c527dcd7f3e7400067a0c62602aeaf10 -->

#Videos


<!-- START_59ee96c738b1698066925e6b55db1f79 -->
## api/videos
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/videos", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/videos" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/videos");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/videos`


<!-- END_59ee96c738b1698066925e6b55db1f79 -->

<!-- START_601a654e2e8877a87e1cd5cc20a96101 -->
## api/videos/{id}/comments
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/videos/1/comments", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/videos/1/comments" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/videos/1/comments");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/videos/{id}/comments`


<!-- END_601a654e2e8877a87e1cd5cc20a96101 -->

<!-- START_163aba6e8558a53b9c4ee0dfa18a20e9 -->
## api/videos
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/videos");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos`


<!-- END_163aba6e8558a53b9c4ee0dfa18a20e9 -->

<!-- START_67017d22b6a0694f3e6e08c957718e2a -->
## api/videos/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos/1", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/videos/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos/{id}`


<!-- END_67017d22b6a0694f3e6e08c957718e2a -->

<!-- START_fb3f8db5430de186ffbaf022e71f054f -->
## api/videos/{id}/comments
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos/1/comments", [
    'headers' => [
            "Authorization" => "Bearer {token}",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos/1/comments" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/api/videos/1/comments");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos/{id}/comments`


<!-- END_fb3f8db5430de186ffbaf022e71f054f -->

<!-- START_59ee96c738b1698066925e6b55db1f79 -->
## api/videos
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/videos", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/videos" 
```

```javascript
const url = new URL("http://localhost/api/videos");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/videos`


<!-- END_59ee96c738b1698066925e6b55db1f79 -->

<!-- START_601a654e2e8877a87e1cd5cc20a96101 -->
## api/videos/{id}/comments
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/videos/1/comments", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X POST "http://localhost/api/videos/1/comments" 
```

```javascript
const url = new URL("http://localhost/api/videos/1/comments");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/videos/{id}/comments`


<!-- END_601a654e2e8877a87e1cd5cc20a96101 -->

<!-- START_163aba6e8558a53b9c4ee0dfa18a20e9 -->
## api/videos
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos" 
```

```javascript
const url = new URL("http://localhost/api/videos");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos`


<!-- END_163aba6e8558a53b9c4ee0dfa18a20e9 -->

<!-- START_67017d22b6a0694f3e6e08c957718e2a -->
## api/videos/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos/1", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos/1" 
```

```javascript
const url = new URL("http://localhost/api/videos/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos/{id}`


<!-- END_67017d22b6a0694f3e6e08c957718e2a -->

<!-- START_fb3f8db5430de186ffbaf022e71f054f -->
## api/videos/{id}/comments
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/videos/1/comments", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```bash
curl -X GET -G "http://localhost/api/videos/1/comments" 
```

```javascript
const url = new URL("http://localhost/api/videos/1/comments");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/videos/{id}/comments`


<!-- END_fb3f8db5430de186ffbaf022e71f054f -->


