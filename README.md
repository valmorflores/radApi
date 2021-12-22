
This is a Api tool for accelerate integrations building.

> 

**Install**
- Get and install codeigniter 4
- Copy files to app folder
- Install Firebird connection files (if you need firebird database support)
- Configure database $default variable (Config/Database.php)

**Try run (Example)**

*List of tables, from database*

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

- CodeIgniter 4: https://github.com/codeigniter4/CodeIgniter4
- Firebird connection: https://github.com/leirags/CI4-PDO-Firebird

