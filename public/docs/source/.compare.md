---
title: API Reference

language_tabs:
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
[Get Postman Collection](local.adu-sys-core/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_00e7e21641f05de650dbe13f242c6f2c -->
## api/logout
> Example request:

```bash
curl -X GET -G "local.adu-sys-core/api/logout" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("local.adu-sys-core/api/logout");

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

<!-- START_fc1e4f6a697e3c48257de845299b71d5 -->
## api/users
> Example request:

```bash
curl -X GET -G "local.adu-sys-core/api/users" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("local.adu-sys-core/api/users");

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
## api/users
> Example request:

```bash
curl -X PUT "local.adu-sys-core/api/users" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"harum","profile_picture":"blanditiis"}'

```

```javascript
const url = new URL("local.adu-sys-core/api/users");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "harum",
    "profile_picture": "blanditiis"
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

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login
> Example request:

```bash
curl -X POST "local.adu-sys-core/api/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"nostrum","password":"et"}'

```

```javascript
const url = new URL("local.adu-sys-core/api/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "nostrum",
    "password": "et"
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

```bash
curl -X POST "local.adu-sys-core/api/register" \
    -H "Content-Type: application/json" \
    -d '{"email":"cupiditate","password":"repellendus","password_confirmation":"et","name":"quia"}'

```

```javascript
const url = new URL("local.adu-sys-core/api/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "cupiditate",
    "password": "repellendus",
    "password_confirmation": "et",
    "name": "quia"
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


