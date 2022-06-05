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


CREATE TABLE TBLSTAFF (
    STAFFID                         INT(11) NOT NULL,
    EMAIL                           VARCHAR(100),
    FIRSTNAME                       VARCHAR(50),
    LASTNAME                        VARCHAR(50),
    FACEBOOK                        VARCHAR(255),
    LINKEDIN                        VARCHAR(255),
    PHONENUMBER                     VARCHAR(30),
    SKYPE                           VARCHAR(50),
    PASSWORD                        VARCHAR(250),
    DATECREATED                     DATE,
    PROFILE_IMAGE                   VARCHAR(300),
    LAST_IP                         VARCHAR(40),
    LAST_LOGIN                      DATE,
    LAST_ACTIVITY                   DATE,
    LAST_PASSWORD_CHANGE            DATE,
    NEW_PASS_KEY                    VARCHAR(32),
    NEW_PASS_KEY_REQUESTED          DATE,
    ADMIN                           INT(11),
    ROLE                            INT(11),
    ACTIVE                          INT(11),
    DEFAULT_LANGUAGE                VARCHAR(40),
    DIRECTION                       VARCHAR(3),
    MEDIA_PATH_SLUG                 VARCHAR(300),
    IS_NOT_STAFF                    INT(11),
    HOURLY_RATE                     DECIMAL(15,2),
    TWO_FACTOR_AUTH_ENABLED         VARCHAR(1),
    TWO_FACTOR_AUTH_CODE            VARCHAR(100),
    TWO_FACTOR_AUTH_CODE_REQUESTED  DATE,
    EMAIL_SIGNATURE                 BLOB segment 4096, subtype TEXT,
    LAST_LOGIN_TIME                 TIMESTAMP ,
    LAST_ACTIVITY_TIME              TIMESTAMP,
    LAST_ACTIVE_TIME                TIMESTAMP
    ); 

--
-- Índices de tabela TBLSTAFF
--
ALTER TABLE TBLSTAFF
  ADD PRIMARY KEY (STAFFID);

--
-- TBLPAPERPERMISSIONS
--
CREATE TABLE TBLPAPERPERMISSIONS (
    PAPERPERMISSIONID INTEGER NOT NULL,
    PAPERID INTEGER NOT NULL,
    CAN_VIEW VARCHAR(1) DEFAULT '0',
    CAN_VIEW_OWN VARCHAR(1) DEFAULT '0',
    CAN_EDIT VARCHAR(1) DEFAULT '0',
    CAN_CREATE VARCHAR(1) DEFAULT '0',
    CAN_DELETE VARCHAR(1) DEFAULT '0'
);

--
ALTER TABLE TBLPAPERPERMISSIONS
  ADD PRIMARY KEY (PAPERPERMISSIONID);
  
-- PAPER --  
CREATE TABLE TBLPAPER (
    PAPERID INTEGER NOT NULL,
    NAME VARCHAR(150) NOT NULL
);

ALTER TABLE TBLPAPER
  ADD PRIMARY KEY (PAPERID);
  
-- TBLUSERKEY: login via key --
CREATE TABLE TBLUSERKEY (
  USERKEYID INT NOT NULL,
  STAFFID INTEGER,
  TOKEN_ID VARCHAR(100),
  KEYVALUE VARCHAR(8),
  ACTIVE INTEGER
);

CREATE TABLE TBLUSERKEYHISTORY (
  USERKEYHISTORYID INTEGER,
  USERKEY_ID INTEGER,
  ENDPOINT VARCHAR(255),
  DESCRIPTION VARCHAR(512),
  LASTUSED TIMESTAMP 
);  
  
