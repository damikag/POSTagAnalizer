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
        $word='"'.$word.'"';
        $res.="<table class=\"table table-dark\"  style=\"width:50%\">";
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
    public static function getTagIDTable($itemList){
        $res="";
        $res.="<table class=\"table table-dark\"  style=\"width:50%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Line No</th>   
                        <th>File Name</th>  
                    </tr>";

        for ($i=0;$i<count($itemList);$i++){
            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td>".number_format($itemList[$i][0])."</td>";
            $res.="<td>".$itemList[$i][1]."</td>";
            $res.="</tr>";
        }
        $res.="</table>";
        return $res;
    }

    public static function getWordTable($wordList){
        $res="";
        $res.="<table class=\"table table-dark\"  style=\"width:50%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Word</th>                      
                    </tr>";

        for ($i=0;$i<count($wordList);$i++){
            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td>".$wordList[$i]."</td>";
            $res.="</tr>";
        }
        $res.="</table>";
        return $res;
    }
}