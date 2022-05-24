-- FIREBIRD compatible database create --

CREATE TABLE TBLUSER (
    ID                              INTEGER Not Null,
    STAFFID                         INTEGER,
    NAME                            VARCHAR(255),
    EMAIL                           VARCHAR(255),
    EMAIL_VERIFIED_AT               TIMESTAMP,
    PASSWORD                        VARCHAR(255),
    REMEMBER_TOKEN                  VARCHAR(100),
    CREATED_AT                      TIMESTAMP,
    UPDATED_AT                      TIMESTAMP
);

CREATE TABLE TBLUSERTOKEN (
    ID                              VARCHAR(100) Not Null,
    USER_ID                         INTEGER,
    CLIENT_ID                       INTEGER, 
    NAME                            VARCHAR(255),
    SCOPES                          BLOB segment 4096, subtype TEXT, 
    TOKEN                           VARCHAR(512),
    REFRESH_TOKEN                   VARCHAR(512),
    REVOKED                         INTEGER,
    CREATED_AT                      TIMESTAMP,
    UPDATED_AT                      TIMESTAMP,
    EXPIRES_AT_DATE                 DATE,
    EXPIRES_AT_TIME                 TIME
);

 
