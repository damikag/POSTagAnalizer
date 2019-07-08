<?php


class Table
{
    public static function getTagTable($itemList){
        $_tag=new Tag();
        $res="";
        $word=$_POST["word"];
        $word='"'.$word.'"';
        $res.="<table class=\"table table-dark\"  style=\"width:50%\">";
        $res.="<tr>
                        <th>No</th>
                        <th>Tag</th>
                        <th>Count</th>
                        
                        


                    </tr>";
        for ($i=0;$i<count($itemList);$i++){
            $res.="<tr><td>".($i+1)."</td>";
            $res.="<td><a href='#'class='text-white' onclick='loadTagIDs(".$word.",".'"'.$itemList[$i].'"'.");return false;'>".$itemList[$i]."</a></td>";
            $res.="<td>".$_tag->getWordTagCount($_POST['word'],$itemList[$i])."</td></tr>";
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