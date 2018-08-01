<div id="qna"><img src="./common_img/qna_1_1.png" class="main_img_size"><div id="more2"><a href="./qna/qna_list.php"><img src="./common_img/more.png"></a></div><hr class="img_bottom">
            
            <?php 
                  $qna_hit= "select * from qna where depth='D' order by hit DESC"; 
                  $result=mysqli_query($con, $qna_hit);
            for($i=1; $i<7; $i++){
                  $row=mysqli_fetch_array($result);                 
                  
                  $subject = $row['subject'];
                  $num=$row['num'];
            ?>
            
            <table>
               <tr><td>* <?php mysqli_data_seek($result, $i);?><a href='./qna/qna_view.php?table=<?= $table?>&num=<?= $num?>&page=<?= $page?>' id='subject_click'><?=$subject?></a></td></tr>
            <?php 
            }
            ?>
            </table>
            
            </div>