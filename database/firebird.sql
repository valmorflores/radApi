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

---MYSQL--
CREATE TABLE `TBLSTAFF` (
  `STAFFID` int(11) NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIRSTNAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LASTNAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FACEBOOK` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LINKEDIN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONENUMBER` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SKYPE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATECREATED` date DEFAULT NULL,
  `PROFILE_IMAGE` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_IP` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_LOGIN` date DEFAULT NULL,
  `LAST_ACTIVITY` date DEFAULT NULL,
  `LAST_PASSWORD_CHANGE` date DEFAULT NULL,
  `NEW_PASS_KEY` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NEW_PASS_KEY_REQUESTED` date DEFAULT NULL,
  `ADMIN` int(11) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL,
  `ACTIVE` int(11) DEFAULT NULL,
  `DEFAULT_LANGUAGE` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DIRECTION` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MEDIA_PATH_SLUG` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IS_NOT_STAFF` int(11) DEFAULT NULL,
  `HOURLY_RATE` decimal(15,2) DEFAULT NULL,
  `TWO_FACTOR_AUTH_ENABLED` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TWO_FACTOR_AUTH_CODE` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TWO_FACTOR_AUTH_CODE_REQUESTED` date DEFAULT NULL,
  `EMAIL_SIGNATURE` text COLLATE utf8_unicode_ci,
  `LAST_LOGIN_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LAST_ACTIVITY_TIME` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LAST_ACTIVE_TIME` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `TBLSTAFF`
--
ALTER TABLE `TBLSTAFF`
  ADD PRIMARY KEY (`STAFFID`);
