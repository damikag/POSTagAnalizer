<?php


class Table
{
    public static function getTagTable($itemList){
        $_tag=new Tag();
        $total=0;
        $counts=[];
        for ($i=0;$i<count($itemList);$i++){
            $tmp=$_tag->getWordTagCount($_POST['word'],$itemList[$i]);
            $total+=$tmp;
            $counts[$i]=$tmp;
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
            $res.="<td><a href='#'class='text-white' onclick='loadTagIDs(".$word.",".'"'.$itemList[$i].'"'.");return false;'>".$itemList[$i]."</a></td>";
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
                        <th>Ind</th>
                        <th>Line No</th>                   
                    </tr>";

        for ($i=0;$i<count($itemList);$i++){
            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td>".$itemList[$i]."</td>";
            $res.="</tr>";
        }
        $res.="</table>";
        return $res;
    }

}