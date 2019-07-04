<?php
    
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT',dirname(__FILE__));
        // load configration and helper functions
        require_once(ROOT . DS . 'config' . DS . 'config.php');
        require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');
    
        // Autoload classes
        function autoload($className) {
            if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')) {
                require_once(ROOT . DS . 'core' . DS . $className . '.php');
            }elseif(file_exists(ROOT . DS . 'app' .DS . 'controllers' . DS . $className . '.php')) {
                require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
            }elseif(file_exists(ROOT . DS . 'app' .DS . 'models' . DS . $className . '.php')) {
                require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
            }
        }

    spl_autoload_register('autoload');
    session_start();
    
    // $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));

    // dnd(Session::get(CURRENT_USER_SESSION_NAME));

    // $db = DB::getInstance();
    // $columns = $db->get_columns('promotion');
    // dnd($columns);
    

    // $user = new Users(1);
    // $username = 'username';
    // // dnd($user->{$username});
    // $new = $user->findById(3);
    // dnd($new);
    // $p = new Customer(currentUser()->username);
    // $k =$p->getNotifications();
    // dnd($k);
    // $u = currentUser()->acls();
    // dnd($u);
    // $user = new Users('ruchin1');
    // $ruchin = $user->findByUsername('pizzahut');
    // dnd($user);
    // dnd(currentDate());
    // dnd('2018-05-24'>'2019-04-25');
    // $db = DB::getInstance();
    // $params = array('search'=>'pizza hut');
    // $today = currentDate();
    // $db->query("SELECT * FROM promotion WHERE (catagory LIKE ? OR pr_username LIKE ? OR title LIKE ?) AND state = ? AND end_date > ? ORDER BY start_date DESC", [$params['search'],$params['search'],$params['search'],"Approved",$today]);
        // $db->query("SELECT * FROM promotion WHERE pr_username = ? AND end_date > ? ORDER BY start_date DESC",array('Food',currentDate()));
    // dnd($db->results());
    // $temp = $db->results()[0]->lname;
    // dnd($temp);
    // $user = new Users(1);
    // dnd($user->fname);
    // "SELECT * FROM promotion WHERE pr_username => ? AND end_date > ? ORDER BY start_date
    // SELECT * FROM promotion WHERE (catagory = ? OR pr_username = ? OR title = ?) AND end_date > ? ORDER BY start_date

    $db = DB::getInstance();
//    $db->update('users',12,array(
//        'acl' => '["Promoter"]'
//    ));

    // dnd(password_hash('password', PASSWORD_DEFAULT));

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : [];
    if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
        Users::loginUserFromCookie();
    }

    // Route the request
    Router::route($url); 