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
* Change permission of ```preprocessing.py```,```sorter.py``` and ```merge.py```to allow executing as a programme.
* Note: python2 should be installed.
#### Run

* Start xampp
In Window search for xampp GUI app and click Start. 
  In linux open terminal and run ```sudo /opt/lampp/lampp start```

* Open a browser and go to ```http://localhost/PROOT/```
Here PROOT should be replace with the path at you set to PROOT variable in config.php
Eg:- ```http://localhost/POSTagAnalizer/POSTagAnalizer/Website/```
