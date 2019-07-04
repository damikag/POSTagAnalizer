<?php

/**
 * check($_POST,[
 *   'username' =>[
 *      'display' => "Username",
 *      'required' => true
 *    ],
 * 
 * items is the input array
 * username is a item
 * display is a rule
 * Username is a rule_value
 *  
 */

class Validate {
    private $_passed = false,
            $_errors=[],
            $_db = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()) {
        $this->_errors = [];                                                                     //clear out the errors of the last validation
        foreach($items as $item => $rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];
            foreach($rules as $rule => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));
                if($rule === 'required' && empty($value)) {
                    echo($value);
                    $this->addError(["{$display} is required", $item]);
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min' :
                            if(strlen($value) < $rule_value) {
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
                            }
                            break;

                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
                            }
                            break;

                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $matchDisplay = $items[$rule_value]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match.",$item]);
                            }
                            break;

                        case 'unique':
                            $check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?",[$value]);
                            if($check->count()) {
                                $this->addError(["{$display} already exists, Please choose another {$display}", $item]);
                            }
                            break;
                        
                        case 'unique_update':
                            $t = explode(',',$rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->_db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?",[$id,$value]);
                            if($query->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
                            }
                            break;

                        case 'is_numeric':
                            if(!is_numeric($value)) {
                                $this->addError(["{$display} has to be a number. Please use a numberic value", $item]);
                            }
                        
                        case 'valid_email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address.", $item]);
                            }
                            break;
						
						case 'valid_url':
							if(!filter_var($value, FILTER_VALIDATE_URL)) {
                                $this->addError(["{$display} must be a valid website. \n Please add https:// before to the website link if you have not add it!", $item]);
                            }
                            break;
                    }

                }
            }
        }
//        dnd($this);
        if(empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    public function imageFileValidate(){
        $target_dir = ROOT.'/img/Promotions/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"],".tmp").".".strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $image=basename($target_file);

        if(empty($_FILES["fileToUpload"]["tmp_name"])){
            $this->addError("Image file is required.");
            return false;
        }

        // Check if image file is a actual image or fake image
        if(isset($_POST["addpromo-submit"])) {
            //echo($_FILES["fileToUpload"]["tmp_name"]."sdf");
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $this->addError("File is not an image.");
                $uploadOk = 0;            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $this->addError("Sorry, file already exists.");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $this->addError("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $this->addError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return false;
        }
        return true;
    }

    public function addError($error) {
        $this->_errors[] = $error;
        if(empty($this->_errors)) {
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed; 
    }

    public function displayErrors() {
        $html = '<ul class = "bg-danger">';
        foreach($this->_errors as $error) {
            if(is_array($error)) {
                $html .= '<li class= "text-danger">'.$error[0].'</li>';
                $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");});</script>' ;
            } else {
                $html .= '<li class="text-danger">'.$error.'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }

}