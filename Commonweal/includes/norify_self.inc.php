<!-- norify self -->
<?php
    //load data
    $conn = dbConnect('read');
    $id=$_SESSION["user_id"];
    $norifySelfArr=getNorifies($conn," and promalgotor_id='$id'","order by activity_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addgmUser(){
    	showRegister();
    }
    function addRowNorifySelf(norifySelf,num){
        var sScript;
        sScript='<div id="contentNorifySelf'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        norifySelf.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addNorifySelf(norifySelf,id,author,name,content){
        var sScript;
        sScript='<div class="boxItem team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(author!=""){
            sScript+='<a href="./norify_details.php?id='+id+'&back=norify.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>'+author+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+author+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        norifySelf.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>已发通知</h3>
			<br>
			<p class="submit-btn"><input type="button" name="cannelBtn" value="发布通知" tabindex="5" onClick="showNorify()"></p>
		</div>
		<div class="team-bottom" id="contentNorifySelf">
		  <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconNorifySelf" name="barconNorifySelf" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;
            if(count($norifySelfArr) > 0){
                foreach($norifySelfArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRowNorifySelf(contentNorifySelf,$row);";  
                        echo "\n";
                    }
                    echo "addNorifySelf(contentNorifySelf$row,'".$arr['activity_id']."','".
                        trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."');";
                }
                echo "\n";
            }
            while(($num%4 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRowNorifySelf(contentNorifySelf,$row);";  
                    echo "\n";
                }
                echo "addNorifySelf(contentNorifySelf$row,'','','无通知','内容为空')";
                echo "\n";
            }
        ?>
		var numNorifySelf=<?php echo $num/4;?>;
    	if(numNorifySelf>0){
    		goPageList(1,1,numNorifySelf,"NorifySelf");
    	}
        </script>
	</div>
</div>