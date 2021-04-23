<!-- activity self -->
<?php
    //load data
    $conn = dbConnect('read');
    $activitySelfArr=getActivities($conn," and promalgotor_id='".$_SESSION["user_id"]."'","order by activity_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRow(activitySelf,num){
        var sScript;
        sScript='<div id="contentActivitySelf'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        activitySelf.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addActivitySelf(activitySelf,id,author,name,content,time,needNum){
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
        activitySelf.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>已发起活动</h3>
			<br>
			<p class="submit-btn"><input type="button" name="cannelBtn" value="发起活动" tabindex="5" onClick="showActivity()"></p>
		</div>
		<div class="team-bottom" id="contentActivitySelf">
		  <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconActivitySelf" name="barconActivitySelf" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;   
            if(count($activitySelfArr) > 0){
                foreach($activitySelfArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRow(contentActivitySelf,$row);";  
                        echo "\n";
                    }
                    echo "addActivitySelf(contentActivitySelf$row,'".$arr['activity_id']."','".
                        trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."','".$arr['activity_starttime'].'~'.$arr['activity_endtime']."','".$arr['activity_neednum']."');";
                }
                echo "\n";
            }
            while(($num%4 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRow(contentActivitySelf,$row);";  
                    echo "\n";
                }
                echo "addActivitySelf(contentActivitySelf$row,'','','无活动','内容为空','','')";
                echo "\n";
            }
        ?>
		var numActivitySelf=<?php echo $num/4;?>;
    	if(numActivitySelf>0){
    		goPageList(1,1,numActivitySelf,"ActivitySelf");
    	}
        </script>
	</div>
</div>