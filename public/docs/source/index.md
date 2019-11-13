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
[Get Postman Collection](http://34.87.16.238/docs/collection.json)

<!-- END_INFO -->

#Autentication


<!-- START_00e7e21641f05de650dbe13f242c6f2c -->
## api/logout
> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/logout" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://34.87.16.238/api/logout");

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

```bash
curl -X POST "http://34.87.16.238/api/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"cuongdc@gmail.com","password":"12345678@a"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/login");

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

```bash
curl -X POST "http://34.87.16.238/api/register" \
    -H "Content-Type: application/json" \
    -d '{"email":"cuongdc@gmail.com","password":"12345678@a","password_confirmation":"12345678@a","name":"Cuongdc"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "cuongdc@gmail.com",
    "password": "12345678@a",
    "password_confirmation": "12345678@a",
    "name": "Cuongdc"
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
        "email": "cuongdc@gmail.com",
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

#Comments


<!-- START_12843026c1a22533a2513cb16ccd1cc4 -->
## API for create a comment for a video

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://34.87.16.238/api/video/1/comment" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"comment_text":"Comment content for video."}'

```

```javascript
const url = new URL("http://34.87.16.238/api/video/1/comment");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "comment_text": "Comment content for video."
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
    "status": true,
    "comment": {
        "user_id": 2,
        "video_id": 1,
        "comment_text": "this is a comment too",
        "updated_at": "2019-11-04 08:45:17",
        "created_at": "2019-11-04 08:45:17",
        "id": 2,
        "user": {
            "id": 1,
            "name": "Cuongdc",
            "email": "do.cao.cuong@alliedtechbase.com",
            "created_at": "2019-10-23 04:01:24",
            "updated_at": "2019-10-23 04:01:24",
            "profile_picture_url": null
        }
    }
}
```

### HTTP Request
`POST api/video/{id}/comment`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    comment_text | string |  required  | comment content for video.

<!-- END_12843026c1a22533a2513cb16ccd1cc4 -->

<!-- START_5a530f12a0b9a4af4285402ac872fe67 -->
## API for get list comments of a video

> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/video/1/comments?page=1" 
```

```javascript
const url = new URL("http://34.87.16.238/api/video/1/comments");

    let params = {
            "page": "1",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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


> Example response (200):

```json
{
    "status": true,
    "comments": [
        {
            "id": 1,
            "user_id": 2,
            "video_id": 1,
            "comment_text": "this is a comment",
            "deleted_at": null,
            "created_at": "2019-11-04 08:45:04",
            "updated_at": "2019-11-04 08:45:04",
            "user": {
                "id": 1,
                "name": "Cuongdc",
                "email": "do.cao.cuong@alliedtechbase.com",
                "created_at": "2019-10-23 04:01:24",
                "updated_at": "2019-10-23 04:01:24",
                "profile_picture_url": null
            }
        },
        {
            "id": 2,
            "user_id": 2,
            "video_id": 1,
            "comment_text": "this is a comment too",
            "deleted_at": null,
            "created_at": "2019-11-04 08:45:17",
            "updated_at": "2019-11-04 08:45:17",
            "user": {
                "id": 1,
                "name": "Cuongdc",
                "email": "do.cao.cuong@alliedtechbase.com",
                "created_at": "2019-10-23 04:01:24",
                "updated_at": "2019-10-23 04:01:24",
                "profile_picture_url": null
            }
        }
    ],
    "meta_data": {
        "total": 0,
        "paging": {
            "current_page": 1,
            "last_page": 0,
            "per_page": 10,
            "from": 0,
            "to": 0
        }
    }
}
```
> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/video/{id}/comments`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    page |  optional  | int option this field use to filter what page client want to get.( default 10 video for 1 page):

<!-- END_5a530f12a0b9a4af4285402ac872fe67 -->
#Reaction


<!-- START_d824dd7c6cd0e02c7f529f49e8deee33 -->
## API for create a reaction for a video

> Example request:

```bash
curl -X POST "http://34.87.16.238/api/video/1/reation" \
    -H "Content-Type: application/json" \
    -d '{"type":1,"device_id":"1","user_id":1}'

```

```javascript
const url = new URL("http://34.87.16.238/api/video/1/reation");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "type": 1,
    "device_id": "1",
    "user_id": 1
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
    "status": true,
    "reaction_id": 1
}
```
> Example response (404):

```json
{
    "status": false,
    "errors": {
        "code": -1,
        "msg": "User already Reaction"
    }
}
```

### HTTP Request
`POST api/video/{id}/reation`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    type | integer |  required  | The type of reaction. (must be in array [1,2,3,4, 5]. 1: REED, 2: HARMONIZED, 3: EXPRESSIVE, 4: RHYTHM, 5: CARE (消さないで！).
    device_id | string |  required  | The  id of device.
    user_id | integer |  optional  | option The user of reaction if user already login please sent token on header.

<!-- END_d824dd7c6cd0e02c7f529f49e8deee33 -->

<!-- START_e28b9d76507ebad5dd4d972475e1fc56 -->
## API for get list reaction of a video

> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/video/1/reations" \
    -H "Content-Type: application/json" \
    -d '{"device_id":"1"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/video/1/reations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "device_id": "1"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": false,
    "errors": {
        "code": -100,
        "msg": "device_id of action is required"
    }
}
```

### HTTP Request
`GET api/video/{id}/reations`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    device_id | string |  required  | The  id of device.

<!-- END_e28b9d76507ebad5dd4d972475e1fc56 -->

<!-- START_b46af183f877acfaf4352aa6b9461427 -->
## API for destroy a reaction.

> Example request:

```bash
curl -X DELETE "http://34.87.16.238/api/reation/1" \
    -H "Content-Type: application/json" \
    -d '{"device_id":"1"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/reation/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "device_id": "1"
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true
}
```

### HTTP Request
`DELETE api/reation/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    device_id | string |  required  | The  id of device.

<!-- END_b46af183f877acfaf4352aa6b9461427 -->

<!-- START_c86f4b1d71b40043ed48fcedfd118f13 -->
## API for create a view for a video

> Example request:

```bash
curl -X POST "http://34.87.16.238/api/video/1/view" 
```

```javascript
const url = new URL("http://34.87.16.238/api/video/1/view");

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


> Example response (200):

```json
{
    "status": true
}
```

### HTTP Request
`POST api/video/{id}/view`


<!-- END_c86f4b1d71b40043ed48fcedfd118f13 -->

#User Autentication


<!-- START_9ed4bf21f47b2cbe9f28def42fbb482c -->
## API for get user change password

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://34.87.16.238/api/users/pass/change" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"new_password":"23456789@a"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/users/pass/change");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "new_password": "23456789@a"
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
    "status": "true",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
    "user": {
        "name": "Cuongdc123",
        "email": "cuongdc@gmail.com",
        "id": "1",
        "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
    }
}
```

### HTTP Request
`POST api/users/pass/change`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    new_password | string |  required  | The password required min 8 char.

<!-- END_9ed4bf21f47b2cbe9f28def42fbb482c -->

<!-- START_9ed4bf21f47b2cbe9f28def42fbb482c -->
## API for get user change password

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://34.87.16.238/api/users/pass/change" \
    -H "Content-Type: application/json" \
    -d '{"new_password":"23456789@a"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/users/pass/change");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "new_password": "23456789@a"
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
    "status": "true",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
    "user": {
        "name": "Cuongdc123",
        "email": "cuongdc@gmail.com",
        "id": "1",
        "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
    }
}
```

### HTTP Request
`POST api/users/pass/change`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    new_password | string |  required  | The password required min 8 char.

<!-- END_9ed4bf21f47b2cbe9f28def42fbb482c -->

#User Information


<!-- START_fc1e4f6a697e3c48257de845299b71d5 -->
## API for get user information

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/users" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://34.87.16.238/api/users");

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
        "name": "Cuongdc123",
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

<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## API for update user information (user name, profile picture)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://34.87.16.238/api/users" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"Cuongdc123","activity_area":"hanoi","brand_name":"vingroup","image":"iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAhFBMVEX\/\/\/8AAAD8\/PwEBAT5+fnx8fH29va0tLTp6elGRkb09PSSkpLk5OSdnZ3GxsbY2Nirq6suLi5tbW0pKSnS0tJVVVV9fX3Jycm3t7fe3t6Hh4dfX19zc3OXl5e9vb2oqKhNTU1DQ0OJiYkUFBQ1NTU0NDRcXFwhISFoaGgPDw8iIiI8PDxlT7X8AAAQwUlEQVR4nO1diZqiOBAO4RAV8Nb2vro9xvd\/v80FEgiQhCC6nzW7PT3dgPmpSqVSV4D1fyfQ9gAapy\/Cz6cvws+nL8LPpy\/Cz6cvws+nL8LPpy\/CGmTb9K\/4m9JrmxvGG\/DQzn1jlJrkIfePSXd228wpbW6zw+hceK1Zag4hGfS5O9v0h9Ol63mOAyEElCB0HM8NBj\/bzeUwaWwIhJqU0sswGrgxKI7SP\/SWUWd+rn6aLhlCaHN\/WZN1PxJCK6ZBuHlknmaGjPKQjOz+WE19Rw0eJX8Qdq9WrIQlNLAUmZbS236gAw7guUlQduZ3syMyifB6GdJp9\/wij+\/5tRfdsLyaElVzCK\/bARkixH+gIkByF4DxfX6na2xcdREyi+U8n6ohqiT\/9EueT6hNhIRG2yCeRwbJ7RwoxHqDq4XQJpOl2+kB1WlXSfRx0bg+xto8PER4ZUAMdExihITQ38H6XFPp1ET4S\/EBpiqMImSMnK7rDVEXIXmth51x6cxjRebOxiIGgK3FzBoIJ6HbOD62+OzQAnnXlFYdhHTmrxA+50UQAdxfJffSJhASYVlP6QL9CiklisxdaWpVTSkNmd1ifBHMI4Txp+xGWnKqhtAm893auE3jEoPt00E0iZBAPO+19kYmaHFUh6jIQ\/T\/zG\/AQpMiLK\/zpnloWdvXTL8CgBBEV8UBqyKM6A6pPYQgODaGEEnHzW9+eaiAif7fKq0b0gjxI+ctyWcW5P6uMBnlEVrWELQ1BdPw8OdPR9IAFaR0siCf0DpC8sWdmUf4N2ifgYDCw396F5MIsR1zgIZ3gLVpYxShtXbbVqI5cvpyi7+clK7fQ0AzFEqNXQrhGDJHxTsReuV7Uwhv8Rx8K4h4SEMDCNFCv24bSwkNq+diBUIE8Oa1DaOM9pUQqxBas7cSzTz1K1hYKaUz771mX5YgmNdD+Oe3DaGcoAOcCuumBCGW79b28yp01ESIt0s\/72aqCQntiUu2i6U83IM3WwMLaKDJQ+vU+l5JjiD40UJo\/fboHHxnkPHYTooISYDg35ur0Sc5EHhrrBiFk1HMQzxxd2\/NPJ4c4FskOiUvpba1YVHKTyCs8HdFOUZiKUXGWu8T1glGhBdFU7FI0wywdH8SD0HvITcP2UXDz2EgIwimSWxMgofHDxJRRpBsMwRcFCBEV5lOcHoBoanoHkWBcCEPt87HqNEUUTmV4SH6IdmWfBYRvTi28hhzCNEFi7ZHq03+X56JAoTjtsdZg4bVCNEFQdvD1CcI83mp+Xl4+riF4kkONt6qEN79D1SjKTpUIgw\/mIVYnS6z2WEcQvTzR+uR+jqExW8TZ\/YKERLXzOcCJBQU85D81HQq7IsJkmWfs9wyCMOP2TEJieRKLso0zeNNfTNJHpbU6x9bBTxEP+83PFJdouhk61QWhQgtq52sympC2IKOJ+m+hXBWoEtta974UDUJgp+ztZJUgRB0Cufh4m3V6OJsWRdPVgt61wKE3WZHqUdEPe6Ipt9L39QvQNhpcKDaRNLYqI9pI6dLqemWbIVTCCfvuVSQpBJSwDaXnkQwtWCkEM7BW1ps7iZOJw0l74BE19h5hFGjA9WlH7KnJX7QqRwDiHGQm4cYcNNjlaVUwWzQ+WXjs3E4E+AKOTkX2SY3D8kD3oIgW9gdt3P7SziBhuupFODuMjy0rTfysBEA7n6WjIzSkPxyEcntDfwHz0MkA933sdgQguEog886eF4w6HetP2nzm92d8PBtfIho\/M4q16XB+ptfiKXyK4kwEdNE07yHkJJIYFCWpz6V3MG6PA+t99hWUC3ijwqS8ZhClXzWjechziFtn0h5czApCFfjJXEkn04fZhDK2guNEmahW9gWA5fNDeTNrkUG4btsnLxZWUFzCKTzJyCYcAgnbTug0Od7g+jnVNpw6KLyQHDhEB4aGrj8gKB\/OdPZVkj3pZKghRzCfvtCStPvylKat2quzgGHUHaVaYyQkvmtyNjuumrOan+SRth6zBBWlxYoJbtiy+iWQjhrfb3HIypOZ8bMnSg\/c5VCOG99d48nybSUhUPlZ+5TCN\/B151xc2aZeOwpP3GZQvgWmZZucW8oWzngQMIAKYQ+aF9MK+q0lqqPQ3gYwtZdNA41xIISeDZlgip1sQUYI2yTg7QF2qV8OVTkIaFVIqVH44NWIbofCiuaz6irUqpMbYKw3ZgTmTLl9aBo37TVePIu4WEI2hRTzMEfNtuK6LjUaSW2SBD+mB+2HLEmhLgPRDn9atnNg2sspS368zFAr6rAziKbe3VaTmIetudnw7I3PUqUnesoGuwWpgjP7SU9Q+BjlV7VqeTRj3QUhXdgCP\/pNlU1QMNfFhwspWNPax7CGUP49+rdIWuKCPxQtgnLUE\/ZXyxqtf2+LvibavAGl3PaoVQG4cTV8kGsGcJjC\/vfaUiak8p20Xvoqfsbk9IXh5285WL+p9YOOXD0\/Ejj1yOEy+Gcduu0VXo9TTULrjdmEIo+Ojced7nYhet\/SpxjZNNSQZ2hNYiQ\/Bx6vZ4fTPenze3S1QJHESKjbfk+PHT85XTX2Yfb0\/w2+6savBQ+3LlCs1LQDEIadg+WUThfH0eT6zk\/u+qcYIFvOepufQzxEAy282PF4Qb6vY7xnSPd1GyK0NbNDKafOqjeGNQjpGiuWuMDz\/XwV8tqI4aXvzHc51+AEPNQk9YM4UjHywMcZJj071ZZQNMMwH9DbavywhBeNfYWjgMjbLmzsyiaRLjSxQeceG+htz+E\/dgwaZSHdUrNegc0Np09PpqBSET9yv5FJgh33NRGyPb4pEGEIjnQ3wrKNZsh\/USY5STmoaIThEUzXwNwt99p1yRPsaInCFXjOixe+wqIZ1DDlRtZMcKNKsBcgVgzhKsF61Sa\/eBHABpAVnuII9PNzwjAi66z+hkqYDE2JYgD+QawNWnu1GgLwFq5AVZ1qECR9Sotc\/brhVNIFiflYaC0\/Rq\/YAoS6tQMGFkUIbZKlKpldqMXIVzXUDL4VochxHQCcm8LTYvo9xXgyBusG\/CbphBKVhShiwavkU\/b1vZzPylMIZT3Ca9fo2Rs0p6jJhPTOVHSeQCdVykZA3VmvVkaoaTTPPj3qoUiTmKqwcbgnkZYvUMhTouCdlpmiQTbVjVlFCaJ3gyhRPkozQh5BQ8RwINbM+EVJoWkDOFVfCJq+hbWYbLxeUh8BksDrR26HMLq3D0HTM+vUTOk4rcuQAjcfzzC6qYty39q8aIaAJExU\/80sMjiER4KjPik3C+0mp+C7PU9DPQZg0mOTlK7Jl5+YoBBtutLQwgJRiOpIU7cbCip7BJvNWlKgfsSt5rFmGimv4obPzOpsLwVXuuH+rE\/VYS4dYWZBjlJPm4ipUXBC6\/\/F1\/yGvKwP70+wluu\/pCsF+zJMCmfGgj7ntLpUlhDZyczylbWvmetGApPJCSWtMZ41nKnbXkWc\/VPVzHzygadznCih\/lKQ7Q189eyAON0Tg6hRdxRED6vAV5YhKYcIPoy2+6x8p3QSxWYqO\/B5zBC3LYtV4+f7juLv4mO9Mc5KcP\/foTRVuxxQ789kyjBotPDJ91ZKmrK1FET0H0+M9VTYZOah4B5tW2hqX0e4h2zU5T3mliA0Otaw0FlemxCI82Uiyw+iO0TO6dpyDY4fr6Tj10n7FwnfquR0Ap4etCx8YUoOqwW\/ex1f+N+jrsrMxV0EFeiJpRGmIQvHGHraDrGWeQkSneV0ZQE7z14JuexvzHHO4\/+dBrh3Jrb5tRZLH1BCYl8i50KhOkKqjTCSTKmwtIAeoR6jDBv6tikDvL5WXEit4A1rE9O+l5jOZLjAoSkwg\/TQqxfjicXsBO46XWbjIzim25eImpYRB0GkHVbY4gh0du5s9PMwIPAL+gT9bTcHqL5Nem4IE4QZRDOguueJVTUzwITiBwfyYvKTPa1qZoILnDEd6SjuuYnYYgVq6TrJpPNIKpUwnco5YFyWtY2sdoT8rgMGMANkCy4zvr5oWz12wfPyRcjhKKDiNRirZkgnamSgR0nWDzCK7YK42YE7LJ\/fXq0Y0aEYFxJnCbFBil8S1xTTRvhgVvDM70vV0g9pGdHd7PwEnjpmYS+zx9AqBRKefr72IebOv0s00qY5yGJhiTL1HW1c9lgEk34HF9kZWmm5n2AmcJfU\/Vlx8L+pYRwAtJufBvP+1HReWsUbRSLQvI4lZ4O9H3xCA04L6DgzWcRXgOs3ntODEX8IAh256zBulI7gQ4\/PIXQNtIhh9OTBQhJ4TpbyYqsRPSLvfU02Ghmm05KAcfDiZkz+nINvfMdywfpPaKQnOWMM3rQdxtfx2hOCZSZ1qLIjMgFcPNd5zf00uLID9ziFTXZylP3WNHFpcS9bzM9gPI1\/YLTHxZCBkLmvOmlz8eiBs9Dt26KG07NIkhq5Pt5OAKEM6+4hgLuDtS\/RAESPq5dXXMyvX261swsAWTQgl2f6CQdYQyDZFxO10\/OEYRIXvu655nwZp92pnMyPjSM6b36FBZygch8Qvf3tuwd2KmLt0D\/PJO09TSrAy8e4UOw7ROepCNqdQKf50SnH0LKwLWYCHmEdZuPYNXREeUTik9DEkUTYXrjHD+ozmEYkFucDTQbC4RFH2KEo17+8zK7QfK2DrX2rG76LAoDvu6xJSLxuWui5bcj2PbX03\/BNf2omix0itrbFCAUpH6vshfhdLha3r\/04Zr1+zgFd7FzXYzQFiTs8G4n\/P0ZFJquUpQ2S2XzzorpZolJPA8RgG7Wsrk9obElXznFnyP+9NB+LYToPWdFrIKH+L8wswokCP+xgMuobpF7esGvY5ViY0R4IFkZDzFl2hjc4sV+e6JIa3sd0qGdevIA\/N\/CPAMxQnJxZipu4p\/DiF5SHBeXIfT20iWmdTb4kDRPKErXKpBSci1vSFGEeIvs01\/X5SFM++rqSfy2JFOkREota5xunt1nb2kKPIvmntU6xxOCRXpI0l46COOd0vOOkkZvpQhtXtuwPkcHDzhdGgid1jvzmT9nQxIhdOJoT3y95+zOZWHmYoTkpugJgjmosdN3Tn9J4oj6ELngWkGAKo+Qc7wPOvvVwypPJyzjoWVTiPRxbPU6gUTsz3jfpIsQxu\/pyUOpR9Goq7ucduaPCTW1y9M9yuYhvvOcxDuZBsUL1569tiGowUOHS8cNFJ60PG0Od36gJWJaqmkwIpzgQmR\/QRmHESYRlR2DWDod8e8cugdHrz\/qB\/QGj\/sgUfj3mdbDPc1Vq4eoQIjNt4AKEDsKBTvFE3PrzKYiHkfP46YIdipTbMDtD12PzjN3ZVt\/\/cBzHMhbIaPbZt4fRoPA91235\/Uch5Q85RDCok2SPkI0IuppGlBhwL772M+JRjje0TFEc+s67u87Ux\/7sabh+nwMAzppQixR3dMQCcOO7VGv69uhVD9cR49jNxSuRuW965QREgE\/LN1gOejTf9+jp5+TDHFyuN1uj\/iG+3UyGk3o0M8h2hI5ifvr\/DhwWoFTELZoyT4s8x6gqMB00UZItvK\/h6uVpJuM3GQepgeVj\/uTyP92zRW0syww9qdyqHbOIF9eVVOxq6RUROvStuKG6SfZGmORD1Q5qIewfIU1SuhzuntWR4D9oUWnCpSQBkJRrltjRD5o0yF5Es5e55O1ePgifKkI7PnveOiO4kie0lN0EDaf0s4+h+WCcCpXmY168\/CT6Ivw8+mL8PPpi\/Dz6Yvw8+mL8PPpi\/Dz6Yvw8+k\/UgzVgM3rSG4AAAAASUVORK5CYII="}'

```

```javascript
const url = new URL("http://34.87.16.238/api/users");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "Cuongdc123",
    "activity_area": "hanoi",
    "brand_name": "vingroup",
    "image": "iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAhFBMVEX\/\/\/8AAAD8\/PwEBAT5+fnx8fH29va0tLTp6elGRkb09PSSkpLk5OSdnZ3GxsbY2Nirq6suLi5tbW0pKSnS0tJVVVV9fX3Jycm3t7fe3t6Hh4dfX19zc3OXl5e9vb2oqKhNTU1DQ0OJiYkUFBQ1NTU0NDRcXFwhISFoaGgPDw8iIiI8PDxlT7X8AAAQwUlEQVR4nO1diZqiOBAO4RAV8Nb2vro9xvd\/v80FEgiQhCC6nzW7PT3dgPmpSqVSV4D1fyfQ9gAapy\/Cz6cvws+nL8LPpy\/Cz6cvws+nL8LPpy\/CGmTb9K\/4m9JrmxvGG\/DQzn1jlJrkIfePSXd228wpbW6zw+hceK1Zag4hGfS5O9v0h9Ol63mOAyEElCB0HM8NBj\/bzeUwaWwIhJqU0sswGrgxKI7SP\/SWUWd+rn6aLhlCaHN\/WZN1PxJCK6ZBuHlknmaGjPKQjOz+WE19Rw0eJX8Qdq9WrIQlNLAUmZbS236gAw7guUlQduZ3syMyifB6GdJp9\/wij+\/5tRfdsLyaElVzCK\/bARkixH+gIkByF4DxfX6na2xcdREyi+U8n6ohqiT\/9EueT6hNhIRG2yCeRwbJ7RwoxHqDq4XQJpOl2+kB1WlXSfRx0bg+xto8PER4ZUAMdExihITQ38H6XFPp1ET4S\/EBpiqMImSMnK7rDVEXIXmth51x6cxjRebOxiIGgK3FzBoIJ6HbOD62+OzQAnnXlFYdhHTmrxA+50UQAdxfJffSJhASYVlP6QL9CiklisxdaWpVTSkNmd1ifBHMI4Txp+xGWnKqhtAm893auE3jEoPt00E0iZBAPO+19kYmaHFUh6jIQ\/T\/zG\/AQpMiLK\/zpnloWdvXTL8CgBBEV8UBqyKM6A6pPYQgODaGEEnHzW9+eaiAif7fKq0b0gjxI+ctyWcW5P6uMBnlEVrWELQ1BdPw8OdPR9IAFaR0siCf0DpC8sWdmUf4N2ifgYDCw396F5MIsR1zgIZ3gLVpYxShtXbbVqI5cvpyi7+clK7fQ0AzFEqNXQrhGDJHxTsReuV7Uwhv8Rx8K4h4SEMDCNFCv24bSwkNq+diBUIE8Oa1DaOM9pUQqxBas7cSzTz1K1hYKaUz771mX5YgmNdD+Oe3DaGcoAOcCuumBCGW79b28yp01ESIt0s\/72aqCQntiUu2i6U83IM3WwMLaKDJQ+vU+l5JjiD40UJo\/fboHHxnkPHYTooISYDg35ur0Sc5EHhrrBiFk1HMQzxxd2\/NPJ4c4FskOiUvpba1YVHKTyCs8HdFOUZiKUXGWu8T1glGhBdFU7FI0wywdH8SD0HvITcP2UXDz2EgIwimSWxMgofHDxJRRpBsMwRcFCBEV5lOcHoBoanoHkWBcCEPt87HqNEUUTmV4SH6IdmWfBYRvTi28hhzCNEFi7ZHq03+X56JAoTjtsdZg4bVCNEFQdvD1CcI83mp+Xl4+riF4kkONt6qEN79D1SjKTpUIgw\/mIVYnS6z2WEcQvTzR+uR+jqExW8TZ\/YKERLXzOcCJBQU85D81HQq7IsJkmWfs9wyCMOP2TEJieRKLso0zeNNfTNJHpbU6x9bBTxEP+83PFJdouhk61QWhQgtq52sympC2IKOJ+m+hXBWoEtta974UDUJgp+ztZJUgRB0Cufh4m3V6OJsWRdPVgt61wKE3WZHqUdEPe6Ipt9L39QvQNhpcKDaRNLYqI9pI6dLqemWbIVTCCfvuVSQpBJSwDaXnkQwtWCkEM7BW1ps7iZOJw0l74BE19h5hFGjA9WlH7KnJX7QqRwDiHGQm4cYcNNjlaVUwWzQ+WXjs3E4E+AKOTkX2SY3D8kD3oIgW9gdt3P7SziBhuupFODuMjy0rTfysBEA7n6WjIzSkPxyEcntDfwHz0MkA933sdgQguEog886eF4w6HetP2nzm92d8PBtfIho\/M4q16XB+ptfiKXyK4kwEdNE07yHkJJIYFCWpz6V3MG6PA+t99hWUC3ijwqS8ZhClXzWjechziFtn0h5czApCFfjJXEkn04fZhDK2guNEmahW9gWA5fNDeTNrkUG4btsnLxZWUFzCKTzJyCYcAgnbTug0Od7g+jnVNpw6KLyQHDhEB4aGrj8gKB\/OdPZVkj3pZKghRzCfvtCStPvylKat2quzgGHUHaVaYyQkvmtyNjuumrOan+SRth6zBBWlxYoJbtiy+iWQjhrfb3HIypOZ8bMnSg\/c5VCOG99d48nybSUhUPlZ+5TCN\/B151xc2aZeOwpP3GZQvgWmZZucW8oWzngQMIAKYQ+aF9MK+q0lqqPQ3gYwtZdNA41xIISeDZlgip1sQUYI2yTg7QF2qV8OVTkIaFVIqVH44NWIbofCiuaz6irUqpMbYKw3ZgTmTLl9aBo37TVePIu4WEI2hRTzMEfNtuK6LjUaSW2SBD+mB+2HLEmhLgPRDn9atnNg2sspS368zFAr6rAziKbe3VaTmIetudnw7I3PUqUnesoGuwWpgjP7SU9Q+BjlV7VqeTRj3QUhXdgCP\/pNlU1QMNfFhwspWNPax7CGUP49+rdIWuKCPxQtgnLUE\/ZXyxqtf2+LvibavAGl3PaoVQG4cTV8kGsGcJjC\/vfaUiak8p20Xvoqfsbk9IXh5285WL+p9YOOXD0\/Ejj1yOEy+Gcduu0VXo9TTULrjdmEIo+Ojced7nYhet\/SpxjZNNSQZ2hNYiQ\/Bx6vZ4fTPenze3S1QJHESKjbfk+PHT85XTX2Yfb0\/w2+6savBQ+3LlCs1LQDEIadg+WUThfH0eT6zk\/u+qcYIFvOepufQzxEAy282PF4Qb6vY7xnSPd1GyK0NbNDKafOqjeGNQjpGiuWuMDz\/XwV8tqI4aXvzHc51+AEPNQk9YM4UjHywMcZJj071ZZQNMMwH9DbavywhBeNfYWjgMjbLmzsyiaRLjSxQeceG+htz+E\/dgwaZSHdUrNegc0Np09PpqBSET9yv5FJgh33NRGyPb4pEGEIjnQ3wrKNZsh\/USY5STmoaIThEUzXwNwt99p1yRPsaInCFXjOixe+wqIZ1DDlRtZMcKNKsBcgVgzhKsF61Sa\/eBHABpAVnuII9PNzwjAi66z+hkqYDE2JYgD+QawNWnu1GgLwFq5AVZ1qECR9Sotc\/brhVNIFiflYaC0\/Rq\/YAoS6tQMGFkUIbZKlKpldqMXIVzXUDL4VochxHQCcm8LTYvo9xXgyBusG\/CbphBKVhShiwavkU\/b1vZzPylMIZT3Ca9fo2Rs0p6jJhPTOVHSeQCdVykZA3VmvVkaoaTTPPj3qoUiTmKqwcbgnkZYvUMhTouCdlpmiQTbVjVlFCaJ3gyhRPkozQh5BQ8RwINbM+EVJoWkDOFVfCJq+hbWYbLxeUh8BksDrR26HMLq3D0HTM+vUTOk4rcuQAjcfzzC6qYty39q8aIaAJExU\/80sMjiER4KjPik3C+0mp+C7PU9DPQZg0mOTlK7Jl5+YoBBtutLQwgJRiOpIU7cbCip7BJvNWlKgfsSt5rFmGimv4obPzOpsLwVXuuH+rE\/VYS4dYWZBjlJPm4ipUXBC6\/\/F1\/yGvKwP70+wluu\/pCsF+zJMCmfGgj7ntLpUlhDZyczylbWvmetGApPJCSWtMZ41nKnbXkWc\/VPVzHzygadznCih\/lKQ7Q189eyAON0Tg6hRdxRED6vAV5YhKYcIPoy2+6x8p3QSxWYqO\/B5zBC3LYtV4+f7juLv4mO9Mc5KcP\/foTRVuxxQ789kyjBotPDJ91ZKmrK1FET0H0+M9VTYZOah4B5tW2hqX0e4h2zU5T3mliA0Otaw0FlemxCI82Uiyw+iO0TO6dpyDY4fr6Tj10n7FwnfquR0Ap4etCx8YUoOqwW\/ex1f+N+jrsrMxV0EFeiJpRGmIQvHGHraDrGWeQkSneV0ZQE7z14JuexvzHHO4\/+dBrh3Jrb5tRZLH1BCYl8i50KhOkKqjTCSTKmwtIAeoR6jDBv6tikDvL5WXEit4A1rE9O+l5jOZLjAoSkwg\/TQqxfjicXsBO46XWbjIzim25eImpYRB0GkHVbY4gh0du5s9PMwIPAL+gT9bTcHqL5Nem4IE4QZRDOguueJVTUzwITiBwfyYvKTPa1qZoILnDEd6SjuuYnYYgVq6TrJpPNIKpUwnco5YFyWtY2sdoT8rgMGMANkCy4zvr5oWz12wfPyRcjhKKDiNRirZkgnamSgR0nWDzCK7YK42YE7LJ\/fXq0Y0aEYFxJnCbFBil8S1xTTRvhgVvDM70vV0g9pGdHd7PwEnjpmYS+zx9AqBRKefr72IebOv0s00qY5yGJhiTL1HW1c9lgEk34HF9kZWmm5n2AmcJfU\/Vlx8L+pYRwAtJufBvP+1HReWsUbRSLQvI4lZ4O9H3xCA04L6DgzWcRXgOs3ntODEX8IAh256zBulI7gQ4\/PIXQNtIhh9OTBQhJ4TpbyYqsRPSLvfU02Ghmm05KAcfDiZkz+nINvfMdywfpPaKQnOWMM3rQdxtfx2hOCZSZ1qLIjMgFcPNd5zf00uLID9ziFTXZylP3WNHFpcS9bzM9gPI1\/YLTHxZCBkLmvOmlz8eiBs9Dt26KG07NIkhq5Pt5OAKEM6+4hgLuDtS\/RAESPq5dXXMyvX261swsAWTQgl2f6CQdYQyDZFxO10\/OEYRIXvu655nwZp92pnMyPjSM6b36FBZygch8Qvf3tuwd2KmLt0D\/PJO09TSrAy8e4UOw7ROepCNqdQKf50SnH0LKwLWYCHmEdZuPYNXREeUTik9DEkUTYXrjHD+ozmEYkFucDTQbC4RFH2KEo17+8zK7QfK2DrX2rG76LAoDvu6xJSLxuWui5bcj2PbX03\/BNf2omix0itrbFCAUpH6vshfhdLha3r\/04Zr1+zgFd7FzXYzQFiTs8G4n\/P0ZFJquUpQ2S2XzzorpZolJPA8RgG7Wsrk9obElXznFnyP+9NB+LYToPWdFrIKH+L8wswokCP+xgMuobpF7esGvY5ViY0R4IFkZDzFl2hjc4sV+e6JIa3sd0qGdevIA\/N\/CPAMxQnJxZipu4p\/DiF5SHBeXIfT20iWmdTb4kDRPKErXKpBSci1vSFGEeIvs01\/X5SFM++rqSfy2JFOkREota5xunt1nb2kKPIvmntU6xxOCRXpI0l46COOd0vOOkkZvpQhtXtuwPkcHDzhdGgid1jvzmT9nQxIhdOJoT3y95+zOZWHmYoTkpugJgjmosdN3Tn9J4oj6ELngWkGAKo+Qc7wPOvvVwypPJyzjoWVTiPRxbPU6gUTsz3jfpIsQxu\/pyUOpR9Goq7ucduaPCTW1y9M9yuYhvvOcxDuZBsUL1569tiGowUOHS8cNFJ60PG0Od36gJWJaqmkwIpzgQmR\/QRmHESYRlR2DWDod8e8cugdHrz\/qB\/QGj\/sgUfj3mdbDPc1Vq4eoQIjNt4AKEDsKBTvFE3PrzKYiHkfP46YIdipTbMDtD12PzjN3ZVt\/\/cBzHMhbIaPbZt4fRoPA91235\/Uch5Q85RDCok2SPkI0IuppGlBhwL772M+JRjje0TFEc+s67u87Ux\/7sabh+nwMAzppQixR3dMQCcOO7VGv69uhVD9cR49jNxSuRuW965QREgE\/LN1gOejTf9+jp5+TDHFyuN1uj\/iG+3UyGk3o0M8h2hI5ifvr\/DhwWoFTELZoyT4s8x6gqMB00UZItvK\/h6uVpJuM3GQepgeVj\/uTyP92zRW0syww9qdyqHbOIF9eVVOxq6RUROvStuKG6SfZGmORD1Q5qIewfIU1SuhzuntWR4D9oUWnCpSQBkJRrltjRD5o0yF5Es5e55O1ePgifKkI7PnveOiO4kie0lN0EDaf0s4+h+WCcCpXmY168\/CT6Ivw8+mL8PPpi\/Dz6Yvw8+mL8PPpi\/Dz6Yvw8+k\/UgzVgM3rSG4AAAAASUVORK5CYII="
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
    "status": true,
    "user": {
        "name": "Cuongdc123",
        "email": "cuongdc@gmail.com",
        "id": "1",
        "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
    }
}
```

### HTTP Request
`POST api/users`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | option update user name of auth user.
    activity_area | string |  optional  | option update user name of auth user.
    brand_name | string |  optional  | option update user name of auth user.
    image | string(base64_endcode) |  optional  | option data formart mustbe base64_endcode of image file.

<!-- END_12e37982cc5398c7100e59625ebb5514 -->

#Videos


<!-- START_56006d51a57b20bfa0cc331ac6b5d51b -->
## API for user upload video

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://34.87.16.238/api/video" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"title":"video1","file":"\"video file\"","thumbnail_image":"iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAhFBMVEX\/\/\/8AAAD8\/PwEBAT5+fnx8fH29va0tLTp6elGRkb09PSSkpLk5OSdnZ3GxsbY2Nirq6suLi5tbW0pKSnS0tJVVVV9fX3Jycm3t7fe3t6Hh4dfX19zc3OXl5e9vb2oqKhNTU1DQ0OJiYkUFBQ1NTU0NDRcXFwhISFoaGgPDw8iIiI8PDxlT7X8AAAQwUlEQVR4nO1diZqiOBAO4RAV8Nb2vro9xvd\/v80FEgiQhCC6nzW7PT3dgPmpSqVSV4D1fyfQ9gAapy\/Cz6cvws+nL8LPpy\/Cz6cvws+nL8LPpy\/CGmTb9K\/4m9JrmxvGG\/DQzn1jlJrkIfePSXd228wpbW6zw+hceK1Zag4hGfS5O9v0h9Ol63mOAyEElCB0HM8NBj\/bzeUwaWwIhJqU0sswGrgxKI7SP\/SWUWd+rn6aLhlCaHN\/WZN1PxJCK6ZBuHlknmaGjPKQjOz+WE19Rw0eJX8Qdq9WrIQlNLAUmZbS236gAw7guUlQduZ3syMyifB6GdJp9\/wij+\/5tRfdsLyaElVzCK\/bARkixH+gIkByF4DxfX6na2xcdREyi+U8n6ohqiT\/9EueT6hNhIRG2yCeRwbJ7RwoxHqDq4XQJpOl2+kB1WlXSfRx0bg+xto8PER4ZUAMdExihITQ38H6XFPp1ET4S\/EBpiqMImSMnK7rDVEXIXmth51x6cxjRebOxiIGgK3FzBoIJ6HbOD62+OzQAnnXlFYdhHTmrxA+50UQAdxfJffSJhASYVlP6QL9CiklisxdaWpVTSkNmd1ifBHMI4Txp+xGWnKqhtAm893auE3jEoPt00E0iZBAPO+19kYmaHFUh6jIQ\/T\/zG\/AQpMiLK\/zpnloWdvXTL8CgBBEV8UBqyKM6A6pPYQgODaGEEnHzW9+eaiAif7fKq0b0gjxI+ctyWcW5P6uMBnlEVrWELQ1BdPw8OdPR9IAFaR0siCf0DpC8sWdmUf4N2ifgYDCw396F5MIsR1zgIZ3gLVpYxShtXbbVqI5cvpyi7+clK7fQ0AzFEqNXQrhGDJHxTsReuV7Uwhv8Rx8K4h4SEMDCNFCv24bSwkNq+diBUIE8Oa1DaOM9pUQqxBas7cSzTz1K1hYKaUz771mX5YgmNdD+Oe3DaGcoAOcCuumBCGW79b28yp01ESIt0s\/72aqCQntiUu2i6U83IM3WwMLaKDJQ+vU+l5JjiD40UJo\/fboHHxnkPHYTooISYDg35ur0Sc5EHhrrBiFk1HMQzxxd2\/NPJ4c4FskOiUvpba1YVHKTyCs8HdFOUZiKUXGWu8T1glGhBdFU7FI0wywdH8SD0HvITcP2UXDz2EgIwimSWxMgofHDxJRRpBsMwRcFCBEV5lOcHoBoanoHkWBcCEPt87HqNEUUTmV4SH6IdmWfBYRvTi28hhzCNEFi7ZHq03+X56JAoTjtsdZg4bVCNEFQdvD1CcI83mp+Xl4+riF4kkONt6qEN79D1SjKTpUIgw\/mIVYnS6z2WEcQvTzR+uR+jqExW8TZ\/YKERLXzOcCJBQU85D81HQq7IsJkmWfs9wyCMOP2TEJieRKLso0zeNNfTNJHpbU6x9bBTxEP+83PFJdouhk61QWhQgtq52sympC2IKOJ+m+hXBWoEtta974UDUJgp+ztZJUgRB0Cufh4m3V6OJsWRdPVgt61wKE3WZHqUdEPe6Ipt9L39QvQNhpcKDaRNLYqI9pI6dLqemWbIVTCCfvuVSQpBJSwDaXnkQwtWCkEM7BW1ps7iZOJw0l74BE19h5hFGjA9WlH7KnJX7QqRwDiHGQm4cYcNNjlaVUwWzQ+WXjs3E4E+AKOTkX2SY3D8kD3oIgW9gdt3P7SziBhuupFODuMjy0rTfysBEA7n6WjIzSkPxyEcntDfwHz0MkA933sdgQguEog886eF4w6HetP2nzm92d8PBtfIho\/M4q16XB+ptfiKXyK4kwEdNE07yHkJJIYFCWpz6V3MG6PA+t99hWUC3ijwqS8ZhClXzWjechziFtn0h5czApCFfjJXEkn04fZhDK2guNEmahW9gWA5fNDeTNrkUG4btsnLxZWUFzCKTzJyCYcAgnbTug0Od7g+jnVNpw6KLyQHDhEB4aGrj8gKB\/OdPZVkj3pZKghRzCfvtCStPvylKat2quzgGHUHaVaYyQkvmtyNjuumrOan+SRth6zBBWlxYoJbtiy+iWQjhrfb3HIypOZ8bMnSg\/c5VCOG99d48nybSUhUPlZ+5TCN\/B151xc2aZeOwpP3GZQvgWmZZucW8oWzngQMIAKYQ+aF9MK+q0lqqPQ3gYwtZdNA41xIISeDZlgip1sQUYI2yTg7QF2qV8OVTkIaFVIqVH44NWIbofCiuaz6irUqpMbYKw3ZgTmTLl9aBo37TVePIu4WEI2hRTzMEfNtuK6LjUaSW2SBD+mB+2HLEmhLgPRDn9atnNg2sspS368zFAr6rAziKbe3VaTmIetudnw7I3PUqUnesoGuwWpgjP7SU9Q+BjlV7VqeTRj3QUhXdgCP\/pNlU1QMNfFhwspWNPax7CGUP49+rdIWuKCPxQtgnLUE\/ZXyxqtf2+LvibavAGl3PaoVQG4cTV8kGsGcJjC\/vfaUiak8p20Xvoqfsbk9IXh5285WL+p9YOOXD0\/Ejj1yOEy+Gcduu0VXo9TTULrjdmEIo+Ojced7nYhet\/SpxjZNNSQZ2hNYiQ\/Bx6vZ4fTPenze3S1QJHESKjbfk+PHT85XTX2Yfb0\/w2+6savBQ+3LlCs1LQDEIadg+WUThfH0eT6zk\/u+qcYIFvOepufQzxEAy282PF4Qb6vY7xnSPd1GyK0NbNDKafOqjeGNQjpGiuWuMDz\/XwV8tqI4aXvzHc51+AEPNQk9YM4UjHywMcZJj071ZZQNMMwH9DbavywhBeNfYWjgMjbLmzsyiaRLjSxQeceG+htz+E\/dgwaZSHdUrNegc0Np09PpqBSET9yv5FJgh33NRGyPb4pEGEIjnQ3wrKNZsh\/USY5STmoaIThEUzXwNwt99p1yRPsaInCFXjOixe+wqIZ1DDlRtZMcKNKsBcgVgzhKsF61Sa\/eBHABpAVnuII9PNzwjAi66z+hkqYDE2JYgD+QawNWnu1GgLwFq5AVZ1qECR9Sotc\/brhVNIFiflYaC0\/Rq\/YAoS6tQMGFkUIbZKlKpldqMXIVzXUDL4VochxHQCcm8LTYvo9xXgyBusG\/CbphBKVhShiwavkU\/b1vZzPylMIZT3Ca9fo2Rs0p6jJhPTOVHSeQCdVykZA3VmvVkaoaTTPPj3qoUiTmKqwcbgnkZYvUMhTouCdlpmiQTbVjVlFCaJ3gyhRPkozQh5BQ8RwINbM+EVJoWkDOFVfCJq+hbWYbLxeUh8BksDrR26HMLq3D0HTM+vUTOk4rcuQAjcfzzC6qYty39q8aIaAJExU\/80sMjiER4KjPik3C+0mp+C7PU9DPQZg0mOTlK7Jl5+YoBBtutLQwgJRiOpIU7cbCip7BJvNWlKgfsSt5rFmGimv4obPzOpsLwVXuuH+rE\/VYS4dYWZBjlJPm4ipUXBC6\/\/F1\/yGvKwP70+wluu\/pCsF+zJMCmfGgj7ntLpUlhDZyczylbWvmetGApPJCSWtMZ41nKnbXkWc\/VPVzHzygadznCih\/lKQ7Q189eyAON0Tg6hRdxRED6vAV5YhKYcIPoy2+6x8p3QSxWYqO\/B5zBC3LYtV4+f7juLv4mO9Mc5KcP\/foTRVuxxQ789kyjBotPDJ91ZKmrK1FET0H0+M9VTYZOah4B5tW2hqX0e4h2zU5T3mliA0Otaw0FlemxCI82Uiyw+iO0TO6dpyDY4fr6Tj10n7FwnfquR0Ap4etCx8YUoOqwW\/ex1f+N+jrsrMxV0EFeiJpRGmIQvHGHraDrGWeQkSneV0ZQE7z14JuexvzHHO4\/+dBrh3Jrb5tRZLH1BCYl8i50KhOkKqjTCSTKmwtIAeoR6jDBv6tikDvL5WXEit4A1rE9O+l5jOZLjAoSkwg\/TQqxfjicXsBO46XWbjIzim25eImpYRB0GkHVbY4gh0du5s9PMwIPAL+gT9bTcHqL5Nem4IE4QZRDOguueJVTUzwITiBwfyYvKTPa1qZoILnDEd6SjuuYnYYgVq6TrJpPNIKpUwnco5YFyWtY2sdoT8rgMGMANkCy4zvr5oWz12wfPyRcjhKKDiNRirZkgnamSgR0nWDzCK7YK42YE7LJ\/fXq0Y0aEYFxJnCbFBil8S1xTTRvhgVvDM70vV0g9pGdHd7PwEnjpmYS+zx9AqBRKefr72IebOv0s00qY5yGJhiTL1HW1c9lgEk34HF9kZWmm5n2AmcJfU\/Vlx8L+pYRwAtJufBvP+1HReWsUbRSLQvI4lZ4O9H3xCA04L6DgzWcRXgOs3ntODEX8IAh256zBulI7gQ4\/PIXQNtIhh9OTBQhJ4TpbyYqsRPSLvfU02Ghmm05KAcfDiZkz+nINvfMdywfpPaKQnOWMM3rQdxtfx2hOCZSZ1qLIjMgFcPNd5zf00uLID9ziFTXZylP3WNHFpcS9bzM9gPI1\/YLTHxZCBkLmvOmlz8eiBs9Dt26KG07NIkhq5Pt5OAKEM6+4hgLuDtS\/RAESPq5dXXMyvX261swsAWTQgl2f6CQdYQyDZFxO10\/OEYRIXvu655nwZp92pnMyPjSM6b36FBZygch8Qvf3tuwd2KmLt0D\/PJO09TSrAy8e4UOw7ROepCNqdQKf50SnH0LKwLWYCHmEdZuPYNXREeUTik9DEkUTYXrjHD+ozmEYkFucDTQbC4RFH2KEo17+8zK7QfK2DrX2rG76LAoDvu6xJSLxuWui5bcj2PbX03\/BNf2omix0itrbFCAUpH6vshfhdLha3r\/04Zr1+zgFd7FzXYzQFiTs8G4n\/P0ZFJquUpQ2S2XzzorpZolJPA8RgG7Wsrk9obElXznFnyP+9NB+LYToPWdFrIKH+L8wswokCP+xgMuobpF7esGvY5ViY0R4IFkZDzFl2hjc4sV+e6JIa3sd0qGdevIA\/N\/CPAMxQnJxZipu4p\/DiF5SHBeXIfT20iWmdTb4kDRPKErXKpBSci1vSFGEeIvs01\/X5SFM++rqSfy2JFOkREota5xunt1nb2kKPIvmntU6xxOCRXpI0l46COOd0vOOkkZvpQhtXtuwPkcHDzhdGgid1jvzmT9nQxIhdOJoT3y95+zOZWHmYoTkpugJgjmosdN3Tn9J4oj6ELngWkGAKo+Qc7wPOvvVwypPJyzjoWVTiPRxbPU6gUTsz3jfpIsQxu\/pyUOpR9Goq7ucduaPCTW1y9M9yuYhvvOcxDuZBsUL1569tiGowUOHS8cNFJ60PG0Od36gJWJaqmkwIpzgQmR\/QRmHESYRlR2DWDod8e8cugdHrz\/qB\/QGj\/sgUfj3mdbDPc1Vq4eoQIjNt4AKEDsKBTvFE3PrzKYiHkfP46YIdipTbMDtD12PzjN3ZVt\/\/cBzHMhbIaPbZt4fRoPA91235\/Uch5Q85RDCok2SPkI0IuppGlBhwL772M+JRjje0TFEc+s67u87Ux\/7sabh+nwMAzppQixR3dMQCcOO7VGv69uhVD9cR49jNxSuRuW965QREgE\/LN1gOejTf9+jp5+TDHFyuN1uj\/iG+3UyGk3o0M8h2hI5ifvr\/DhwWoFTELZoyT4s8x6gqMB00UZItvK\/h6uVpJuM3GQepgeVj\/uTyP92zRW0syww9qdyqHbOIF9eVVOxq6RUROvStuKG6SfZGmORD1Q5qIewfIU1SuhzuntWR4D9oUWnCpSQBkJRrltjRD5o0yF5Es5e55O1ePgifKkI7PnveOiO4kie0lN0EDaf0s4+h+WCcCpXmY168\/CT6Ivw8+mL8PPpi\/Dz6Yvw8+mL8PPpi\/Dz6Yvw8+k\/UgzVgM3rSG4AAAAASUVORK5CYII=","type":0,"name":"mucsic_video","artist":"Cuongdc123"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/video");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "video1",
    "file": "\"video file\"",
    "thumbnail_image": "iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAhFBMVEX\/\/\/8AAAD8\/PwEBAT5+fnx8fH29va0tLTp6elGRkb09PSSkpLk5OSdnZ3GxsbY2Nirq6suLi5tbW0pKSnS0tJVVVV9fX3Jycm3t7fe3t6Hh4dfX19zc3OXl5e9vb2oqKhNTU1DQ0OJiYkUFBQ1NTU0NDRcXFwhISFoaGgPDw8iIiI8PDxlT7X8AAAQwUlEQVR4nO1diZqiOBAO4RAV8Nb2vro9xvd\/v80FEgiQhCC6nzW7PT3dgPmpSqVSV4D1fyfQ9gAapy\/Cz6cvws+nL8LPpy\/Cz6cvws+nL8LPpy\/CGmTb9K\/4m9JrmxvGG\/DQzn1jlJrkIfePSXd228wpbW6zw+hceK1Zag4hGfS5O9v0h9Ol63mOAyEElCB0HM8NBj\/bzeUwaWwIhJqU0sswGrgxKI7SP\/SWUWd+rn6aLhlCaHN\/WZN1PxJCK6ZBuHlknmaGjPKQjOz+WE19Rw0eJX8Qdq9WrIQlNLAUmZbS236gAw7guUlQduZ3syMyifB6GdJp9\/wij+\/5tRfdsLyaElVzCK\/bARkixH+gIkByF4DxfX6na2xcdREyi+U8n6ohqiT\/9EueT6hNhIRG2yCeRwbJ7RwoxHqDq4XQJpOl2+kB1WlXSfRx0bg+xto8PER4ZUAMdExihITQ38H6XFPp1ET4S\/EBpiqMImSMnK7rDVEXIXmth51x6cxjRebOxiIGgK3FzBoIJ6HbOD62+OzQAnnXlFYdhHTmrxA+50UQAdxfJffSJhASYVlP6QL9CiklisxdaWpVTSkNmd1ifBHMI4Txp+xGWnKqhtAm893auE3jEoPt00E0iZBAPO+19kYmaHFUh6jIQ\/T\/zG\/AQpMiLK\/zpnloWdvXTL8CgBBEV8UBqyKM6A6pPYQgODaGEEnHzW9+eaiAif7fKq0b0gjxI+ctyWcW5P6uMBnlEVrWELQ1BdPw8OdPR9IAFaR0siCf0DpC8sWdmUf4N2ifgYDCw396F5MIsR1zgIZ3gLVpYxShtXbbVqI5cvpyi7+clK7fQ0AzFEqNXQrhGDJHxTsReuV7Uwhv8Rx8K4h4SEMDCNFCv24bSwkNq+diBUIE8Oa1DaOM9pUQqxBas7cSzTz1K1hYKaUz771mX5YgmNdD+Oe3DaGcoAOcCuumBCGW79b28yp01ESIt0s\/72aqCQntiUu2i6U83IM3WwMLaKDJQ+vU+l5JjiD40UJo\/fboHHxnkPHYTooISYDg35ur0Sc5EHhrrBiFk1HMQzxxd2\/NPJ4c4FskOiUvpba1YVHKTyCs8HdFOUZiKUXGWu8T1glGhBdFU7FI0wywdH8SD0HvITcP2UXDz2EgIwimSWxMgofHDxJRRpBsMwRcFCBEV5lOcHoBoanoHkWBcCEPt87HqNEUUTmV4SH6IdmWfBYRvTi28hhzCNEFi7ZHq03+X56JAoTjtsdZg4bVCNEFQdvD1CcI83mp+Xl4+riF4kkONt6qEN79D1SjKTpUIgw\/mIVYnS6z2WEcQvTzR+uR+jqExW8TZ\/YKERLXzOcCJBQU85D81HQq7IsJkmWfs9wyCMOP2TEJieRKLso0zeNNfTNJHpbU6x9bBTxEP+83PFJdouhk61QWhQgtq52sympC2IKOJ+m+hXBWoEtta974UDUJgp+ztZJUgRB0Cufh4m3V6OJsWRdPVgt61wKE3WZHqUdEPe6Ipt9L39QvQNhpcKDaRNLYqI9pI6dLqemWbIVTCCfvuVSQpBJSwDaXnkQwtWCkEM7BW1ps7iZOJw0l74BE19h5hFGjA9WlH7KnJX7QqRwDiHGQm4cYcNNjlaVUwWzQ+WXjs3E4E+AKOTkX2SY3D8kD3oIgW9gdt3P7SziBhuupFODuMjy0rTfysBEA7n6WjIzSkPxyEcntDfwHz0MkA933sdgQguEog886eF4w6HetP2nzm92d8PBtfIho\/M4q16XB+ptfiKXyK4kwEdNE07yHkJJIYFCWpz6V3MG6PA+t99hWUC3ijwqS8ZhClXzWjechziFtn0h5czApCFfjJXEkn04fZhDK2guNEmahW9gWA5fNDeTNrkUG4btsnLxZWUFzCKTzJyCYcAgnbTug0Od7g+jnVNpw6KLyQHDhEB4aGrj8gKB\/OdPZVkj3pZKghRzCfvtCStPvylKat2quzgGHUHaVaYyQkvmtyNjuumrOan+SRth6zBBWlxYoJbtiy+iWQjhrfb3HIypOZ8bMnSg\/c5VCOG99d48nybSUhUPlZ+5TCN\/B151xc2aZeOwpP3GZQvgWmZZucW8oWzngQMIAKYQ+aF9MK+q0lqqPQ3gYwtZdNA41xIISeDZlgip1sQUYI2yTg7QF2qV8OVTkIaFVIqVH44NWIbofCiuaz6irUqpMbYKw3ZgTmTLl9aBo37TVePIu4WEI2hRTzMEfNtuK6LjUaSW2SBD+mB+2HLEmhLgPRDn9atnNg2sspS368zFAr6rAziKbe3VaTmIetudnw7I3PUqUnesoGuwWpgjP7SU9Q+BjlV7VqeTRj3QUhXdgCP\/pNlU1QMNfFhwspWNPax7CGUP49+rdIWuKCPxQtgnLUE\/ZXyxqtf2+LvibavAGl3PaoVQG4cTV8kGsGcJjC\/vfaUiak8p20Xvoqfsbk9IXh5285WL+p9YOOXD0\/Ejj1yOEy+Gcduu0VXo9TTULrjdmEIo+Ojced7nYhet\/SpxjZNNSQZ2hNYiQ\/Bx6vZ4fTPenze3S1QJHESKjbfk+PHT85XTX2Yfb0\/w2+6savBQ+3LlCs1LQDEIadg+WUThfH0eT6zk\/u+qcYIFvOepufQzxEAy282PF4Qb6vY7xnSPd1GyK0NbNDKafOqjeGNQjpGiuWuMDz\/XwV8tqI4aXvzHc51+AEPNQk9YM4UjHywMcZJj071ZZQNMMwH9DbavywhBeNfYWjgMjbLmzsyiaRLjSxQeceG+htz+E\/dgwaZSHdUrNegc0Np09PpqBSET9yv5FJgh33NRGyPb4pEGEIjnQ3wrKNZsh\/USY5STmoaIThEUzXwNwt99p1yRPsaInCFXjOixe+wqIZ1DDlRtZMcKNKsBcgVgzhKsF61Sa\/eBHABpAVnuII9PNzwjAi66z+hkqYDE2JYgD+QawNWnu1GgLwFq5AVZ1qECR9Sotc\/brhVNIFiflYaC0\/Rq\/YAoS6tQMGFkUIbZKlKpldqMXIVzXUDL4VochxHQCcm8LTYvo9xXgyBusG\/CbphBKVhShiwavkU\/b1vZzPylMIZT3Ca9fo2Rs0p6jJhPTOVHSeQCdVykZA3VmvVkaoaTTPPj3qoUiTmKqwcbgnkZYvUMhTouCdlpmiQTbVjVlFCaJ3gyhRPkozQh5BQ8RwINbM+EVJoWkDOFVfCJq+hbWYbLxeUh8BksDrR26HMLq3D0HTM+vUTOk4rcuQAjcfzzC6qYty39q8aIaAJExU\/80sMjiER4KjPik3C+0mp+C7PU9DPQZg0mOTlK7Jl5+YoBBtutLQwgJRiOpIU7cbCip7BJvNWlKgfsSt5rFmGimv4obPzOpsLwVXuuH+rE\/VYS4dYWZBjlJPm4ipUXBC6\/\/F1\/yGvKwP70+wluu\/pCsF+zJMCmfGgj7ntLpUlhDZyczylbWvmetGApPJCSWtMZ41nKnbXkWc\/VPVzHzygadznCih\/lKQ7Q189eyAON0Tg6hRdxRED6vAV5YhKYcIPoy2+6x8p3QSxWYqO\/B5zBC3LYtV4+f7juLv4mO9Mc5KcP\/foTRVuxxQ789kyjBotPDJ91ZKmrK1FET0H0+M9VTYZOah4B5tW2hqX0e4h2zU5T3mliA0Otaw0FlemxCI82Uiyw+iO0TO6dpyDY4fr6Tj10n7FwnfquR0Ap4etCx8YUoOqwW\/ex1f+N+jrsrMxV0EFeiJpRGmIQvHGHraDrGWeQkSneV0ZQE7z14JuexvzHHO4\/+dBrh3Jrb5tRZLH1BCYl8i50KhOkKqjTCSTKmwtIAeoR6jDBv6tikDvL5WXEit4A1rE9O+l5jOZLjAoSkwg\/TQqxfjicXsBO46XWbjIzim25eImpYRB0GkHVbY4gh0du5s9PMwIPAL+gT9bTcHqL5Nem4IE4QZRDOguueJVTUzwITiBwfyYvKTPa1qZoILnDEd6SjuuYnYYgVq6TrJpPNIKpUwnco5YFyWtY2sdoT8rgMGMANkCy4zvr5oWz12wfPyRcjhKKDiNRirZkgnamSgR0nWDzCK7YK42YE7LJ\/fXq0Y0aEYFxJnCbFBil8S1xTTRvhgVvDM70vV0g9pGdHd7PwEnjpmYS+zx9AqBRKefr72IebOv0s00qY5yGJhiTL1HW1c9lgEk34HF9kZWmm5n2AmcJfU\/Vlx8L+pYRwAtJufBvP+1HReWsUbRSLQvI4lZ4O9H3xCA04L6DgzWcRXgOs3ntODEX8IAh256zBulI7gQ4\/PIXQNtIhh9OTBQhJ4TpbyYqsRPSLvfU02Ghmm05KAcfDiZkz+nINvfMdywfpPaKQnOWMM3rQdxtfx2hOCZSZ1qLIjMgFcPNd5zf00uLID9ziFTXZylP3WNHFpcS9bzM9gPI1\/YLTHxZCBkLmvOmlz8eiBs9Dt26KG07NIkhq5Pt5OAKEM6+4hgLuDtS\/RAESPq5dXXMyvX261swsAWTQgl2f6CQdYQyDZFxO10\/OEYRIXvu655nwZp92pnMyPjSM6b36FBZygch8Qvf3tuwd2KmLt0D\/PJO09TSrAy8e4UOw7ROepCNqdQKf50SnH0LKwLWYCHmEdZuPYNXREeUTik9DEkUTYXrjHD+ozmEYkFucDTQbC4RFH2KEo17+8zK7QfK2DrX2rG76LAoDvu6xJSLxuWui5bcj2PbX03\/BNf2omix0itrbFCAUpH6vshfhdLha3r\/04Zr1+zgFd7FzXYzQFiTs8G4n\/P0ZFJquUpQ2S2XzzorpZolJPA8RgG7Wsrk9obElXznFnyP+9NB+LYToPWdFrIKH+L8wswokCP+xgMuobpF7esGvY5ViY0R4IFkZDzFl2hjc4sV+e6JIa3sd0qGdevIA\/N\/CPAMxQnJxZipu4p\/DiF5SHBeXIfT20iWmdTb4kDRPKErXKpBSci1vSFGEeIvs01\/X5SFM++rqSfy2JFOkREota5xunt1nb2kKPIvmntU6xxOCRXpI0l46COOd0vOOkkZvpQhtXtuwPkcHDzhdGgid1jvzmT9nQxIhdOJoT3y95+zOZWHmYoTkpugJgjmosdN3Tn9J4oj6ELngWkGAKo+Qc7wPOvvVwypPJyzjoWVTiPRxbPU6gUTsz3jfpIsQxu\/pyUOpR9Goq7ucduaPCTW1y9M9yuYhvvOcxDuZBsUL1569tiGowUOHS8cNFJ60PG0Od36gJWJaqmkwIpzgQmR\/QRmHESYRlR2DWDod8e8cugdHrz\/qB\/QGj\/sgUfj3mdbDPc1Vq4eoQIjNt4AKEDsKBTvFE3PrzKYiHkfP46YIdipTbMDtD12PzjN3ZVt\/\/cBzHMhbIaPbZt4fRoPA91235\/Uch5Q85RDCok2SPkI0IuppGlBhwL772M+JRjje0TFEc+s67u87Ux\/7sabh+nwMAzppQixR3dMQCcOO7VGv69uhVD9cR49jNxSuRuW965QREgE\/LN1gOejTf9+jp5+TDHFyuN1uj\/iG+3UyGk3o0M8h2hI5ifvr\/DhwWoFTELZoyT4s8x6gqMB00UZItvK\/h6uVpJuM3GQepgeVj\/uTyP92zRW0syww9qdyqHbOIF9eVVOxq6RUROvStuKG6SfZGmORD1Q5qIewfIU1SuhzuntWR4D9oUWnCpSQBkJRrltjRD5o0yF5Es5e55O1ePgifKkI7PnveOiO4kie0lN0EDaf0s4+h+WCcCpXmY168\/CT6Ivw8+mL8PPpi\/Dz6Yvw8+mL8PPpi\/Dz6Yvw8+k\/UgzVgM3rSG4AAAAASUVORK5CYII=",
    "type": 0,
    "name": "mucsic_video",
    "artist": "Cuongdc123"
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
    "status": true,
    "video": {
        "id": "1",
        "name": "video1",
        "artist": "video1 artist",
        "type": "1",
        "view_count": 0,
        "thumbnail_url": "http:\/\/34.87.16.238\/avatars\/image_1573625594.png",
        "video_url": "http:\/\/videos\/url\/video1",
        "created_at": "2019-01-01 01:00:00",
        "updated_at": "2019-01-01 01:00:00",
        "user": {
            "name": "Cuongdc123",
            "id": "1",
            "profile_picture_url": "https:\/\/lh3.googleusercontent.com\/--jvQFiFavr0\/AAAAAAAAAAI\/AAAAAAAAAAA\/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID\/s32-c\/photo.jpg"
        }
    }
}
```

### HTTP Request
`POST api/video`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | the title  of video max 100.
    file | file |  required  | this data is video file for upload.
    thumbnail_image | string |  required  | data formart mustbe base64_endcode of image file.
    type | integer |  required  | type of video must in [1,2,3]: 1: このサイトで依頼・購入, 2: 自作, 3: 他で依頼・購入 .
    name | string |  optional  | option name of this video max 100.
    artist | string |  optional  | option the artist of video max 50.

<!-- END_56006d51a57b20bfa0cc331ac6b5d51b -->

<!-- START_163aba6e8558a53b9c4ee0dfa18a20e9 -->
## API for get list videos

> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/videos?page=1&type=2&user_id=2&search=abc" \
    -H "Content-Type: application/json" \
    -d '{"device_id":"1"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/videos");

    let params = {
            "page": "1",
            "type": "2",
            "user_id": "2",
            "search": "abc",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "device_id": "1"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": false,
    "errors": {
        "code": -100,
        "msg": "device_id of action is required"
    }
}
```

### HTTP Request
`GET api/videos`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    device_id | string |  required  | The  id of device.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    page |  optional  | int option this field use to filter what page client want to get ( default 10 video for 1 page).
    type |  optional  | int option this field use to filter type of video.
    user_id |  optional  | int option this field use to filter list video upload by an user.
    search |  optional  | string option this field use to filter tilte of video.

<!-- END_163aba6e8558a53b9c4ee0dfa18a20e9 -->

<!-- START_28a4b4bf1d94d0f56e1c50ed3d82ae2d -->
## API for get video detail.

> Example request:

```bash
curl -X GET -G "http://34.87.16.238/api/video/1" \
    -H "Content-Type: application/json" \
    -d '{"device_id":"1"}'

```

```javascript
const url = new URL("http://34.87.16.238/api/video/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "device_id": "1"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": false,
    "errors": {
        "code": -100,
        "msg": "device_id of action is required"
    }
}
```

### HTTP Request
`GET api/video/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    device_id | string |  required  | The  id of device.

<!-- END_28a4b4bf1d94d0f56e1c50ed3d82ae2d -->


