<!-- test list -->
<?php
    //load data
    $conn = dbConnect('read');
    $testListArr=getTests($conn,"order by test_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRowTestList(testList,num){
        var sScript;
        sScript='<div id="contentTestList'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        testList.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addTestList(testList,id,name,level,author){
        var sScript;
        sScript='<div class="col-md-3 team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(author!='&nbsp'){
            sScript+='<a href="./test_details.php?id='+id+'&back=test.php"><label class="textCenter">此考核为'+level+'考核，在义工做满n次活动后，可以参与考核并参与评级。评级越高，活动举办方可能会越优先录用你。</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>'+level+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+author+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">无内容</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        testList.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>全部考核题目</h3>
			<br>
			<p class="submit-btn"><input type="button" name="cannelBtn" value="上传考核题目" tabindex="5" onClick="showTest()"></p>
		</div>
		<div class="team-bottom" id="contentTestList">
		  <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconTestList" name="barconTestList" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;   
            if(count($testListArr) > 0){
                foreach($testListArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRowTestList(contentTestList,$row);";  
                        echo "\n";
                    }
                    echo "addTestList(contentTestList$row,'".$arr['test_id']."','"
                        .$arr['test_name']."','level ".$arr['test_level']."','".trPromalgotor($arr['user_id'])."');";
                }
                echo "\n";
            }
            while(($num%8 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRowTestList(contentTestList,$row);";  
                    echo "\n";
                }
                echo "addTestList(contentTestList$row,'-1','无考核题目','&nbsp','&nbsp');";
                echo "\n";
            }
        ?>
		var numTestList=<?php echo $num/4;?>;
    	if(numTestList>0){
    		goPageList(1,2,numTestList,"TestList");
    	}
        </script>
	</div>
</div>