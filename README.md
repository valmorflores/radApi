
This is a Api tool for accelerate integrations building.

🚧 radApi is under development 🚧

> test, use and change this. Thanks!

## Install
- Get and install codeigniter 4
- Copy files to app folder
- Install Firebird connection files (if you need firebird database support)
- Create database Firebird.sql, MySql.sql or other
- Configure database $default variable (Config/Database.php)
- Configure Config/Filters.php
- For security os access options, change configurations in Filters/FilterBasicAuth.php

## Examples 

### For login, if use authentication

http://localhost:89/dev/radApi/public/v1/user/login?email=user@email.com&password=1234

### MySQl Database.php ###

    public $default = [
        'DSN'      => 'mysqli:host=localhost;dbname=pls_base',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '10101010',
        'database' => 'pls_base',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => '',
    ];


### Firebird Database.php ###


    public $default = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => 'SYSDBA',
            'password' => 'masterkey',
            'database' => '/dados/base_cosems_teste1.gdb',
            'DBDriver' => 'Firebird',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => '',
        ];




### List of tables, from database

http://localhost:89/dev/radApi/public/v1/tables

Result:
``
{
    "status": 200,
    "error": null,
    "data": [
        "TBLACTIVITYLOG",
        "TBLCLIENTS",
        "TBLTODOITEMS",
        "TBLLEADS",
        "TBLLEADSINTEGRATION",
        "TBLLEADACTIVITYLOG",
        "TBLLEADSEMAILINTEGRATIONEMAILS",
        "TBLREGIONS",
        "TBLREGIONSREPRESENTATIVE",
        "TBLAREAS",
        "TBLTHEMES",
        "TBLVERSION",
        "TBLUSER",
        "TBLUSERTOKEN",
        "TBLUSERKEY",
        "TBLUSERKEYHISTORY"
    ],
    "messages": {
        "success": "List of tables"
    }
}
``


http://localhost:89/dev/radApi/public/v1/tables/search/ACTIVITY

Result: 

``
{

    "parameter_partial_table_name": "ACTIVITY",
    "status": 200,
    "error": null,
    "data": [
        "TBLACTIVITYLOG",
        "TBLPROJECTACTIVITY",
        "TBLACTIVITYREPORT",
        "TBLACTIVITYREPORTMEMBERS",
        "TBLACTIVITYREPORTACTIVITY",
        "TBLACTIVITYREPORTDISCUSSIONS",
        "TBLACTIVITYREPORTFILES",
        "TBLPINNEDACTIVITYREPORT",
        "TBLACTIVITYREPORTNOTES",
        "TBLACTIVITYREPORTSETTINGS",
        "TBLACTIVITYREPORTCATEGORY",
        "TBLACTIVITYREPORTCOMPETENCE",
        "TBLLEADACTIVITYLOG",
        "TBLACTIVITYREPORTCLIENTS"
    ],
    "messages": {
        "success": "Search in tables with information"
    }

}
``


### List of all fieldname from one table

http://localhost:89/dev/radApi/public/v1/tables/fieldnames/TBLACTIVITYLOG

Result:
{

    "parameter_table_name": "TBLACTIVITYLOG",
    "status": 200,
    "error": null,
    "data": [
        "ID",
        "DESCRIPTION",
        "DATE",
        "STAFFID",
        "TIME"
    ],
    "messages": {
        "success": "Field names list"
    }

}

### List of field details from one table

http://localhost:89/dev/radApi/public/v1/tables/fields/TBLACTIVITYLOG

Result:
{

    "parameter_table_name": "TBLACTIVITYLOG",
    "status": 200,
    "error": null,
    "data": [
        {
            "name": "ID",
            "type": "INTEGER",
            "size": "4",
            "default": ""
        },
        {
            "name": "DESCRIPTION",
            "type": "BLOB",
            "size": "8",
            "default": ""
        },
        {
            "name": "DATE",
            "type": "DATE",
            "size": "4",
            "default": ""
        },
        {
            "name": "STAFFID",
            "type": "VARCHAR",
            "size": "100",
            "default": ""
        },
        {
            "name": "TIME",
            "type": "VARCHAR",
            "size": "8",
            "default": ""
        }
    ],
    "messages": {
        "success": "Structure from table"
    }

}

### Keys and indexes from table

http://localhost:89/dev/radApi/public/v1/tables/keys/TBLSTAFF

Result:

{

    "parameter_table_name": "TBLSTAFF",
    "status": 200,
    "error": null,
    "data": [
        {
            "0": "name",
            "1": "TBLSTAFF",
            "index_name": "IDX_PRIMARY",
            "index_id": "1",
            "foreign_key": ""
        }
    ],
    "messages": {
        "success": "Keys from table"
    }

}

### Data from table (with offset and limit)

http://localhost:89/dev/radApi/public/v1/tables/data/TBLSTAFFS/0/1

Result:

{

    "parameter_table_name": null,
    "status": 200,
    "error": null,
    "data": [
        {
            "STAFFID": 1,
            "EMAIL": "valmorflores@gmail.com",
            "FIRSTNAME": "VALMOR",
            "LASTNAME": "FLORES",
            "FACEBOOK": null,
            "LINKEDIN": null,
            "PHONENUMBER": null,
            "SKYPE": null,
            "PASSWORD": "$2a$08$IQOa.Z.WBXmflhC/CkFuKuLvHCbiTdoEFDQ6PuZwXBD4bMru5GB8i",
            "DATECREATED": "2001-01-01",
            "PROFILE_IMAGE": null,
            "LAST_IP": "127.0.0.1",
            "LAST_LOGIN": "2021-12-22",
            "LAST_ACTIVITY": "2021-12-22",
            "LAST_PASSWORD_CHANGE": null,
            "NEW_PASS_KEY": null,
            "NEW_PASS_KEY_REQUESTED": null,
            "ADMIN": 1,
            "ROLE": null,
            "ACTIVE": 1,
            "DEFAULT_LANGUAGE": null,
            "DIRECTION": null,
            "MEDIA_PATH_SLUG": null,
            "IS_NOT_STAFF": 0,
            "HOURLY_RATE": "0.00",
            "TWO_FACTOR_AUTH_ENABLED": "0",
            "TWO_FACTOR_AUTH_CODE": null,
            "TWO_FACTOR_AUTH_CODE_REQUESTED": null,
            "EMAIL_SIGNATURE": null,
            "LAST_LOGIN_TIME": "09:39:43",
            "LAST_ACTIVITY_TIME": "10:04:50",
            "IS_DELETED": 0,
            "LAST_ACTIVE_TIME": 1640173142
        }
    ],
    "messages": {
        "success": "Keys from table"
    }

}

### Data from table (with field key)

> Information, parameters: 
> - tables/data-by/table/field/id
> - http://localhost:89/dev/radApi/public/v1/tables/data-by/TBLSTAFF/STAFFID/2


### Post data to table

> Post with incremental ID, called ROLEID
> [POST] http://localhost:89/dev/radApi/public/v1/tables/data/TBLROLES?autoinc=ROLEID

> Can send more data from url:
> [POST] http://localhost:89/dev/radApi/public/v1/tables/data/TBLROLES?autoinc=ROLEID&NAME=Information&field=MoreData

### DELETE data to table
> [DELETE] http://localhost:89/dev/radApi/public/v1/tables/data/delete/TBLUSER/ID/2

Result:

{

    "parameter_table_name": "TBLUSER",
    "status": 200,
    "error": null,
    "data": [
        {
           
        }
    ],
    "messages": {
        "success": "Data deleted"
    }

}


### PUT data on table
### fill key with field name from your table
> [PUT] http://localhost:89/dev/radApi/public/v1/tables/data/TBLUSER?key=ID&ID=4&NAME=test8&PASSWORD=6655

Result:
{
"parameter_table_name": "TBLUSER",
"status": 200,
"error": null,
"data": {
"ID": "4",
"NAME": "test8",
"PASSWORD": "6655"
},
"messages": {
"success": "Saved data!"
}
}
### Count records from Table
> [GET] http://localhost:89/dev/radApi/public/v1/tables/count/TBLUSER

Result:

{

    "parameter_table_name": "TBLUSER",
    "parameter_offset": "0",
    "parameter_records": "0",
	"status": 200,
    "error": null,
    "data": [{6}],
    "messages": {
        "success": "There are 6 records in this table"
    }

}

### Process 

Run process defined in TBLPREPROC with post parameters

> [POST] http://localhost:89/dev/radApi/public/v1/process/{nameofprocess}/{listOfParamters}

Note: Parameter start whitout /?, like /?parameter1=1, use like this: /parameter1=1

Examples:

> [POST] http://localhost:89/dev/radApi/public/v1/process/buy/idProduct=1&idClient=1&idRoom=2&qty=200000&price=1&idBook=0

> TBLPREPROC (SCRIPT_SQL = 'INSERT INTO table_book (
idProduct,idClient,idRoom,qty,price,idBook,buySell ) VALUES (
:idProduct:, :idClient:, :idRoom:, :qty:, :price:, :idBook:, 'B'
);

Fields are changed for parameters values. 
If the process script doesn´t have parameters, send 0 like this
> [POST] http://localhost:89/dev/radApi/public/v1/process/nameofprocess/0


## User administration

Can user add and delete  

> [POST] http://localhost:89/dev/radApi/public/v1/user/?name=name&email=email@email.com&password=123  
> 

For delete is need id and email 

> [DELETE] http://localhost:89/dev/radApi/public/v1/user/?email=email@email.com&id=123  
> 

For get user data is need email

> [GET] http://localhost:89/dev/radApi/public/v1/user/?email=email@email.com&id=123  
> 

## Get user data by token ##
> [GET] http://localhost:89/dev/radApi/public/v1/user/by-token/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiIxIiwiaXNzIjoiVGhlX2NsYWltIiwiYXVkIjoiVGhlX0F1ZCIsImlhdCI6MTY1NzA1Mjk0NiwibmJmIjoxNjU3MDUyOTU2LCJleHAiOjE2NTcwNTY1NDYsImRhdGEiOiJ2YWxtb3JmbG9yZXNAZ21haWwuY29tIn0.-b6yf9IcM3LpFF7QaFahLEtVGjpD3YDjzgFS_z4-944

You can use this for get user information and token validate. If this has empty or error results, like unknow token or is invalid token. 

If ok, results like this:

{
    "status": 200,
    "error": null,
    "data": [
        {
            "ID": "1",
            "USER_ID": "1",
            "CLIENT_ID": "0",
            "NAME": "valor",
            "SCOPES": null,
            "TOKEN": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiIxIiwiaXNzIjoiVGhlX2NsYWltIiwiYXVkIjoiVGhlX0F1ZCIsImlhdCI6MTY1NzA1Mjk0NiwibmJmIjoxNjU3MDUyOTU2LCJleHAiOjE2NTcwNTY1NDYsImRhdGEiOiJ2YWxtb3JmbG9yZXNAZ21haWwuY29tIn0.-b6yf9IcM3LpFF7QaFahLEtVGjpD3YDjzgFS_z4-944",
            "REFRESH_TOKEN": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiIxIiwiaXNzIjoiVGhlX2NsYWltIiwiYXVkIjoiVGhlX0F1ZCIsImlhdCI6MTY1NzA1Mjk0NiwibmJmIjoxNjU3MDUyOTU2LCJleHAiOjE2NTcwNTY1NDYsImRhdGEiOiJ2YWxtb3JmbG9yZXNAZ21haWwuY29tIn0.-b6yf9IcM3LpFF7QaFahLEtVGjpD3YDjzgFS_z4-944",
            "REVOKED": "0",
            "CREATED_AT": "2022-07-05 17:29:06",
            "UPDATED_AT": "2022-07-05 17:29:06",
            "EXPIRES_AT_DATE": "0000-00-00",
            "EXPIRES_AT_TIME": null,
            "STAFFID": "1",
            "EMAIL": "valmorflores@gmail.com",
            "EMAIL_VERIFIED_AT": "2022-06-27 11:18:33",
            "REMEMBER_TOKEN": null,
            "DELETED_AT": null,
            "ACTIVATED_AT": "2022-06-27 10:32:15"
        }
    ],
    "messages": {
        "success": "Successful get user record"
    }
}



## Auxiliar documents

### Boas práticas (útil para o desenvolvimento)

Documentação em artigo escrito por "Tárcio Zemel" extraído em maio/2022 do seguinte link https://desenvolvimentoparaweb.com/miscelanea/api-restful-melhores-praticas-parte-1/

Filtragem

Para filtragem, usa-se um parâmetro de consulta exclusivo para cada campo que implementa a filtragem. Por exemplo, ao solicitar uma lista de bilhetes a partir do endpoint /tickets, pode-se querer limitar o resultado para apenas aqueles no estado “aberto” (open). Isto poderia ser conseguido com um pedido GET /tickets?state=open, no qual state é um parâmetro de consulta que implementa um filtro.
Ordenação

Similarmente à filtragem, um parâmetro genérico sort pode ser usado para descrever regras de ordenação, permitindo requisitos complexos de ordenação deixando este parâmetro em classificações em que cada campo é separado por vírgula, cada um com um possível unário negativo para indicar ordem descendente. Por exemplo:

    GET /tickets?sort=-priority Retorna uma lista de bilhetes em ordem descendente de prioridade
    GET /tickets?sort=-priority,created_at Retorna uma lista de bilhetes em ordem descendente de prioridade com uma prioridade específica de bilhetes antigos primeiro

Busca

Às vezes filtros básicos não são suficientes e é necessário o poder de buscar textos completos (full text search) — talvez você já esteja usando ElasticSearch ou alguma outra tecnologia de busca baseada em Lucene. Quando pesquisa de texto completo é usado como um mecanismo de recuperação de instâncias de recursos para um tipo específico de recurso, ela pode ser exposta na API como um parâmetro de consulta no nó de extremidade do recurso. Considerando q, as consultas de pesquisa devem ser passados diretamente para o motor de busca e o retorno da API deve ser no mesmo formato, como resultado normal em lista.

Combinando tudo isso, é possível construir queries como:

    GET /tickets?sort=-updated_at Retorna bilhetes recém-atualizados
    GET /tickets?state=closed&sort=-updated_at Retorna bilhetes recém-fechados
    GET /tickets?q=return&state=open&sort=-priority,created_at Retorna bilhetes abertos de alta prioridade que contenham o termo “return”

## Congratulations

- CodeIgniter 4: https://github.com/codeigniter4/CodeIgniter4
- Firebird connection: https://github.com/leirags/CI4-PDO-Firebird
- Tárcio Zemel (artigo: Melhores práticas para uma API RESTful pragmática (parte 1))

