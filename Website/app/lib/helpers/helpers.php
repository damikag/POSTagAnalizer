<?php

/**
 * dump and die 
 * use to debug
 * organized the structure of things we want to dump
 */

function dnd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function test($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function sanitize($dirty) {
    return htmlentities($dirty,ENT_QUOTES, 'UTF-8' );
}


function posted_values($post) {
    $clean_ary = [];
    foreach($post as $key=>$value) {
        $clean_ary[$key] = sanitize($value);
    }
    return $clean_ary;
}

function currentPage() {
    $currentPage = $_SERVER['REQUEST_URI'];
    if($currentPage == PROOT || $currentPage == PROOT.'home/index') {
        $currentPage = PROOT. 'home';
    }
    return $currentPage;
}

function currentDate() {
    return date('Y-m-d');
}

function mergeArray($ary1=[],$ary2=[]) {
    return array_merge($ary1,$ary2);
}

function backtrace() {
    echo '<pre>';
    var_dump(debug_print_backtrace());
    echo '</pre>';
    die();
}

