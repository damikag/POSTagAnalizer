<?php


class Helper
{
    public static function getPageList($word,$tag,$noOfResults,$results_per_page){
        $res="<div style='padding: 10px;'><h6>Select a page</h6><div style=\"height:100px; overflow-x:auto;\" class=\"table-wrapper-scroll-y my-custom-scrollbar\">";


        if($word=='\'\''){
            $word="&#39&#39";
            $word='"'.$word.'"';
        }
        elseif ($word=='\''){
            $word="&#39";
            $word='"'.$word.'"';
        }
        elseif ($word=="\""){
            $word='&quot';
            $word='&#39'.$word.'&#39';
        }
        else{
            $word='"'.$word.'"';
        }

        for($i=1;$i<=ceil($noOfResults/$results_per_page);$i++){
            $res.="<a href='#' onclick='loadTagIDs(".$word.",".'"'.$tag.'"'.",".$i.");return false;'>".$i." </a>";

        }
        $res.="</div></div>";
        return $res;
    }

    public static function getWordPageList($tag,$noOfResults,$results_per_page){
        $res="<div style='padding: 10px;'><h6>Select a page</h6><div style=\"height:100px; overflow-x:auto;\" class=\"table-wrapper-scroll-y my-custom-scrollbar\">";

        for($i=1;$i<=ceil($noOfResults/$results_per_page);$i++){
            $res.="<a href='#' onclick='loadTagWordsFull(".'"'.$tag.'"'.",".$i.");return false;'>".$i." </a>";
        }
        $res.="</div></div>";
        return $res;
    }
}