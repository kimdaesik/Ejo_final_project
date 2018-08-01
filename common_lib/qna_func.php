<?php
function latest_article1($table, $loop, $char_limit)
{
    include 'common.php';
    
    $sql = "select * from $table where depth='D' order by hit desc limit $loop";
    $result = mysqli_query($con, $sql) ;
    while ($row = mysqli_fetch_array($result))
    {
        $num = $row[num];
        $len_subject = strlen($row[subject]);
        $subject = $row[subject];
        
        if ($len_subject > $char_limit)
        {
            $subject = mb_substr($row[subject], 0, $char_limit, 'euc-kr');
            $subject = $subject."...";
        }
        
        echo "<tr>
    <div class='qna_list'><ul><li><a href='./qna/qna_view.php?table=$table&num=$num' id='qna_link'> $subject</a></li></ul></div>
     </tr> ";
    }
    mysqli_close($con);
}

?>