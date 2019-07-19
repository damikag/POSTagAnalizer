# POS Tag Analiser
This is a small toot that can be used to analyze word tags.
## Installation

#### Pre-processing the Corpus


   * First merge each parts of the Corpus into ```Corpus.txt```. 
   
        ```python merge.ph [file name] [OPTIONAL: path to working directory]```
   * If format erros are detected, correct them before next steps.
   
   * Run ```python preprocess.py Corpus.txt [OPTIONAL Working directory]``` to pre-process the corpus. If errors detected correct them before procead.
    (NOTE: ```merge.py ```should be run before the previous script.)
   

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

LOAD DATA INFILE '[path to /newCorpus.txt]' INTO TABLE AllWords FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tag)

CREATE TABLE `POSTag`.`Tags` ( `Tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`Tag`)) ENGINE = InnoDB;

INSERT INTO Tags SELECT DISTINCT Tag FROM AllWords

CREATE TABLE `POSTag`.`WordList` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tags` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Counts` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;

LOAD DATA INFILE '[path to /uniqueWords.txt]' INTO TABLE WordList FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tags,Counts)

```

#### Run

* Start server
* Goto url set to PROOT variable
