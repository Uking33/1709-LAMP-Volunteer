<!-- activity list new -->
<?php
    //load data
    $conn = dbConnect('read');   
    $nowDate=date("Y-m-d"); 
    $activityListNewArr=getActivities($conn," and activity_check='1' and activity_starttime>'$nowDate'","order by activity_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRow(activityListNew,num){
        var sScript;
        sScript='<div id="contentActivityListNew'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        activityListNew.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addActivityListNew(activityListNew,id,author,name,content,time,needNum){
        var sScript;
        sScript='<div class="boxItem team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(author!=''){
            sScript+='<a href="./activity_details.php?id='+id+'&back=activity.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4 style="font-size:17px">'+time+'</h4><p>人数:'+needNum+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+author+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        activityListNew.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>未开始活动</h3>
		</div>
		<div class="team-bottom" id="contentActivityListNew">
		    <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconActivityListNew" name="barconActivityListNew" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;
            if(count($activityListNewArr) > 0){
                foreach($activityListNewArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRow(contentActivityListNew,$row);";  
                        echo "\n";
                    }
                    echo "addActivityListNew(contentActivityListNew$row,'".$arr['activity_id']."','".
                        trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."','".$arr['activity_starttime'].'~'.$arr['activity_endtime']."','".$arr['activity_neednum']."');";
                }
                echo "\n";
            }
            while(($num%4 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRow(contentActivityListNew,$row);";  
                    echo "\n";
                }
                echo "addActivityListNew(contentActivityListNew$row,'','','无活动','内容为空','','')";
                echo "\n";
            }
        ?>
		var numActivityListNew=<?php echo $num/4;?>;
    	if(numActivityListNew>0){
    		goPageList(1,1,numActivityListNew,"ActivityListNew");
    	}
        </script>
	</div>
</div>