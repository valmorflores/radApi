
This is a Api tool for accelerate integrations building.

**Install**
Get and install codeigniter
Copy files to app folder
Install Firebird connection files (if you need firebird database support)
Configure database $default variable (Config/Database.php)

**Try run (Example)**

*List of tables, from database*

http://localhost:89/dev/radApi/public/v1/tables

Result:
``
{<br>
    "status": 200,<br>
    "error": null,<br>
    "data": [<br>
        "TBLACTIVITYLOG",<br>
        "TBLCLIENTS",<br>
        "TBLTODOITEMS",<br>
        "TBLLEADS",<br>
        "TBLLEADSINTEGRATION",<br>
        "TBLLEADACTIVITYLOG",<br>
        "TBLLEADSEMAILINTEGRATIONEMAILS",<br>
        "TBLREGIONS",<br>
        "TBLREGIONSREPRESENTATIVE",<br>
        "TBLAREAS",<br>
        "TBLTHEMES",<br>
        "TBLVERSION",<br>
        "TBLUSER",<br>
        "TBLUSERTOKEN",<br>
        "TBLUSERKEY",<br>
        "TBLUSERKEYHISTORY"<br>
    ],<br>
    "messages": {<br>
        "success": "List of tables"<br>
    }<br>
}<br>
``

*List of all fieldname from one table*

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

*List of field details from one table*

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
        "success": "Dados"
    }

}


**Congratulations**

  CodeIgniter 4: https://github.com/codeigniter4/CodeIgniter4
  Firebird connection: https://github.com/leirags/CI4-PDO-Firebird

