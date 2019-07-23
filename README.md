# POS Tag Analyzer
This is a small toot that can be used to analyze word tags.
### Installation
* Configure xampp or any other local server.
* ###### Installing xampp
    * [Download](https://www.apachefriends.org/index.html) xampp
    * Follow onsite instructions.
* Clone this repository to htdocs folder
    Windows: ```C:\xampp\htdocs\```
    Linux: ```~/lampp/htdocs```
*  Open
    ```POSTagAnalizer/Website/config/config.php ```
        Change PROOT variable to ```[path to /Website]``` relative to ```htdocs```.

#### Pre-processing the Corpus
Before loading the corpus into Database some pre-processing should be done. Corpus might be in several files and need to be merged into one file. After successfully merging, corpus need to be pre-processed.
    Follow the bellow instructions to merge and pre-process.
    
First merge each parts of the Corpus into ```Corpus.txt```. 
   Go to ```Preprocessing``` folder in ```htdocs```
    Open terminal/command promote from there and run the command given bellow. <br />
        ```python merge.py [path to file] [ path to/ location to Corpus.txt]```
 <br />
  Eg:-
  
    Windows:  python merge.py 'C:\Users\(User_Name)\Documents\corpus_part1.txt''C:\Users\(User_Name)\Documents\'
    Linux: python merge.py '/home/user/Documents/corpus_part1.txt' '/home/user/Documents/'

   The terminal/command prompt will guide through the process. It will display the success or failure of merging process. If formatting errors are detected merging will fail. Detected errors are written to ```junk.txt```. Open junk.txt from Notepad++. It will give you the mis-formatted line numbers. Open the corpus file that you tried to merge and correct those errors shown in junk.txt. Then re-attempt merging by running above command again.
   
   After successfully merging each and every part of the corpus into Corpus.txt run the following command for pre-processing.
   
   Run 
   ```python preprocess.py '[path to /Corpus.txt]' '[location to save the pre-processed outcomes]'``` <br />
   to pre-process the corpus. If errors are detected correct them before proceed. Error lines will be written to ```newJunk.txt```. Open newJunk.txt with Notepad++ and correct all formatting errors shown.
    (NOTE: ```merge.py ``` should be run before above command.)
    
Eg:- 
 <br />   
 
    Windows:  python preprocessing.py C:\Users\(User_Name)\Documents\Corpus.txt''C:\Users\(User_Name)\Documents\'
    Linux: python preprocessing.py '/home/user/Documents/Corpus.txt' '/home/user/Documents/'

#### Setup  Database
* Start xampp. 
In Window search for xampp GUI app and click Start. 
  In linux open terminal and run ```sudo /opt/lampp/lampp start```
* Open a browser and go to ```http://localhost/phpmyadmin/```
* Run the following SQL query in the console.
```sh
CREATE DATABASE POSTag CHARACTER SET utf8 COLLATE utf8_bin
```
Now you have created the database ```POSTag```.
* Execute following queries to create tables and insert data.

```sh
CREATE TABLE `POSTag`.`AllWords` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tag` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Line_number` INT(255) NOT NULL ,  `Filename` VARCHAR(500) NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;

LOAD DATA INFILE '[path to /newCorpus.txt]' INTO TABLE AllWords FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tag,Line_number,Filename);

CREATE TABLE `POSTag`.`Tags` ( `Tag` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`Tag`)) ENGINE = InnoDB;

INSERT INTO Tags SELECT DISTINCT Tag FROM AllWords;

CREATE TABLE `POSTag`.`WordList` ( `ID` INT(255) NOT NULL AUTO_INCREMENT ,  `Word` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Tags` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,  `Counts` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,    PRIMARY KEY  (`ID`)) ENGINE = InnoDB;

LOAD DATA INFILE '[path to /uniqueWords.txt]' INTO TABLE WordList FIELDS TERMINATED BY ' ' LINES TERMINATED BY '\n' (Word,Tags,Counts);


```

#### Run

* Start xampp
In Window search for xampp GUI app and click Start. 
  In linux open terminal and run ```sudo /opt/lampp/lampp start```

* Open a browser and go to ```http://localhost/PROOT/```
Here PROOT should be replace with the path at you set to PROOT variable in config.php
Eg:- ```http://localhost/POSTagAnalizer/POSTagAnalizer/Website/```
