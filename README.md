
This is a Api tool for accelerate integrations building.
> test, use and change this. Thanks!

## Install
- Get and install codeigniter 4
- Copy files to app folder
- Install Firebird connection files (if you need firebird database support)
- Configure database $default variable (Config/Database.php)

## Examples 

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

> Information, parameters: tables/data-by/table/field/id
> http://localhost:89/dev/radApi/public/v1/tables/data-by/TBLSTAFF/STAFFID/2


## Congratulations

- CodeIgniter 4: https://github.com/codeigniter4/CodeIgniter4
- Firebird connection: https://github.com/leirags/CI4-PDO-Firebird

