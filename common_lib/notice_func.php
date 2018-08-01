<?php
function latest_article($table, $loop, $char_limit)
{
    include 'common.php';
    
    $sql = "select * from $table order by num desc limit $loop";
    $result = mysqli_query($con, $sql);
    
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
    <div class='notice_list'><ul><li><a href='./customer/notice_view.php?table=$table&num=$num' id='notice_link'>$subject</a></li></ul></div>
     </tr> ";
    }
    mysqli_close($con);
}

?>