<?php


class Table
{
    public static function getTagTable($itemList){
        $total=0;
        $tagList = explode(',', $itemList[0]);
        $counts=array_map('intval', explode(',', $itemList[1]));

        for ($i=0;$i<count($itemList);$i++){
            $total+=$counts[$i];
        }

        $res="";
        $word=$_POST["word"];
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



        $res.="<table class=\"table table-dark\"  style=\"width:100%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Tag</th>
                        <th>Count</th>
                        <th>Percentage</th>
                        
                        


                    </tr>";
        for ($i=0;$i<count($itemList);$i++){
            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td><a href='#'class='text-white' onclick='loadTagIDs(".$word.",".'"'.$tagList[$i].'"'.");return false;'>".$tagList[$i]."</a></td>";
            $res.="<td>".$counts[$i]."</td>";
            $res.="<td>".round($counts[$i]*100/$total,2)." %</td></tr>";
        }
        $res.="</table>";
        return $res;
    }
    public static function getTagIDTable($itemList,$IDstart){
        $res="";
        $res.="<div style=\"height:400px; overflow-x:auto;\" class=\"table-wrapper-scroll-y my-custom-scrollbar\">";
        $res.="<table class=\"table table-dark\"  style=\"width:100%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Line No</th>   
                        <th>File Name</th>  
                    </tr>";

        for ($i=0;$i<count($itemList);$i++){
            $res.="<tr><td>".($IDstart+$i+1)."</td>";
            $res.="<td>".number_format($itemList[$i][0])."</td>";
            $res.="<td>".$itemList[$i][1]."</td>";
            $res.="</tr>";
        }
        $res.="</table>";
        $res.="</div>";
        return $res;
    }

    public static function getWordTable($tag,$wordList){
        $res="";
        $res.="<div style=\"height:400px; overflow-x:auto;\" class=\"table-wrapper-scroll-y my-custom-scrollbar\">";
        $res.="<table class=\"table table-dark\"  style=\"width:100%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Word</th>                      
                    </tr>";

        for ($i=0;$i<count($wordList);$i++){

            $word=$wordList[$i];
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

            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td><a href='#'class='text-white' onclick='loadTagIDs(".$word.",".'"'.$tag.'"'.");return false;'>".$wordList[$i]."</a></td>";

            $res.="</tr>";
        }
        $res.="</table>";
        $res.="</div>";
        return $res;
    }

    public static function getWordTableFull($tag,$wordList){
        $res="";
        $res.="<div style=\"height:400px; overflow-x:auto;\" class=\"table-wrapper-scroll-y my-custom-scrollbar\">";
        $res.="<table class=\"table table-dark\"  style=\"width:100%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Word</th>                      
                    </tr>";

        for ($i=0;$i<count($wordList);$i++){

            $word=$wordList[$i];
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

            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td><a href='#'class='text-white' onclick='loadTagIDsFull(".$word.",".'"'.$tag.'"'.");return false;'>".$wordList[$i]."</a></td>";

            $res.="</tr>";
        }
        $res.="</table>";
        $res.="</div>";
        return $res;
    }
}