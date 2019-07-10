# POS Tag Analiser
This is a small toot that can be used to analyze word tags.
## Installation
#### Setup server

Configuring xampp 
   * Clone the repo to htdocs folder
   * Set access privileges to all users 
   * Open
    ```
            POSTagAnalizer/Website/config/config.php
    ```
        Set PROOT to /Website relative to htdocs

#### Setup  Database

* Create database:
	name: POSTag
	
```sh
CREATE DATABASE POSTag CHARACTER SET utf8 COLLATE utf8_bin
```
* Execute following queries to create the tags and enter data(corpus)
* Note: Data file should contain data in the format [word][space][tag] in each line. Otherwise pre-processing should be done.
```sh
CREATE TABLE `POSTag`.`AllWords` ( `ID` INT(255) NOT NULL AUTO_INCREMENT , `Word` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `Tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

LOAD DATA INFILE '[path to corpus]' INTO TABLE AllWords FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tag)

CREATE TABLE `POSTag`.`Tags` ( `Tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`Tag`)) ENGINE = InnoDB;

INSERT INTO Tags SELECT DISTINCT Tag FROM AllWords

CREATE TABLE `POSTag`.`WordList` ( `ID` INT NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;


INSERT INTO WordList (Word) SELECT DISTINCT Word FROM AllWords

```

#### Run

* Start server
* Goto url set to PROOT variable
