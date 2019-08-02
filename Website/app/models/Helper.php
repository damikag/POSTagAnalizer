<?php


class Helper
{
    public static function getPageList($word,$tag,$noOfResults,$results_per_page){
        $res="<div><h6>Select a page</h6>";

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
            $res.="<a href='#'class='text-white' onclick='loadTagIDs(".$word.",".'"'.$tag.'"'.",".$i.");return false;'>".$i." </a>";

        }
        $res.="</div>";
        return $res;
    }
}