<!-- activity news -->
<?php
    //load data
    $conn = dbConnect('read');
    $nowDate=date("Y-m-d");
    $activityNewsArr=getActivities($conn," and activity_check='1' and activity_endtime>='$nowDate'", "order by activity_id desc LIMIT 4");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addActivityNews(id,author,name,content,time,needNum){
        var sScript;
        sScript='<div class="boxItem team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(author!=''){
            <?php if(isset($_SESSION['user_type'])){?>
            sScript+='<a href="./activity_details.php?id='+id+'&back=activity.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            <?php }else{?>
            sScript+='<a href="./activity_details.php?id='+id+'&back=home.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            <?php }?>
            sScript+='<div class="captn"><h4 style="font-size:17px">'+time+'</h4><p>人数:'+needNum+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+author+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        activityNews.insertAdjacentHTML("beforeEnd",sScript);            
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>最新活动</h3>
		</div>
		<div class="team-bottom" id="activityNews">		
		    <div class="clearfix"></div>
		</div>
		<script type='text/javascript'>
        <?php
            //load label
            if(count($activityNewsArr) > 0){
                foreach($activityNewsArr as $arr){
                    echo "addActivityNews('".$arr['activity_id']."','".
                        trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."','".$arr['activity_starttime'].'~'.$arr['activity_endtime']."','".$arr['activity_neednum']."');";
                }
                echo "\n";
            }
            if(count($activityNewsArr) < 4){
                $num = 4-count($activityNewsArr);
                for($i=0;$i<$num;$i++){
                    echo "addActivityNews('','','无活动','内容为空','','')";
                    echo "\n";
                }
            }
        ?>
        </script>
	</div>
</div>