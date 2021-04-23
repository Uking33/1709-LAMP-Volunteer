<!-- norify list -->
<?php
    //load data
    $conn = dbConnect('read');    
    $norifyListArr=getNorifies($conn,"","order by activity_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRowNorifyList(norifyList,num){
        var sScript;
        sScript='<div id="contentNorifyList'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        norifyList.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addNorifyList(norifyList,id,author,name,content){
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
        norifyList.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>全部通知</h3>
		</div>
		<div class="team-bottom" id="contentNorifyList">
		  <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconNorifyList" name="barconNorifyList" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;
            if(count($norifyListArr) > 0){
                foreach($norifyListArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRowNorifyList(contentNorifyList,$row);";  
                        echo "\n";
                    }
                    echo "addNorifyList(contentNorifyList$row,'".$arr['activity_id']."','".
                        trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."');";
                }
                echo "\n";
            }
            while(($num%8 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRowNorifyList(contentNorifyList,$row);";  
                    echo "\n";
                }
                echo "addNorifyList(contentNorifyList$row,'','','无通知','内容为空')";
                echo "\n";
            }
        ?>
		var numNorifyList=<?php echo $num/4;?>;
    	if(numNorifyList>0){
    		goPageList(1,2,numNorifyList,"NorifyList");
    	}
        </script>
	</div>
</div>