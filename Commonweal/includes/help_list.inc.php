<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<!-- help list -->
<?php
    //load data
    $conn = dbConnect('read');
    $helpListArr=getUserList($conn," where (user_type='4' and checked='1') order by user_id desc");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRowHelpList(helpList,num){
        var sScript;
        sScript='<div id="contentHelpList'+num+'" class="team-bottom"></div>';
        sScript+='<div class="clearfix"></div>';
        helpList.insertAdjacentHTML("beforeEnd",sScript);
    }
    function addHelpList(helpList,id,name,context){
        var sScript;
        sScript='<div class="boxItem team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(context!=''){
            sScript+='<a href="./info.php?id='+id+'&back=home.php"><label class="textCenter">'+context+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>'+id+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+id+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">无求助者</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        helpList.insertAdjacentHTML("beforeEnd",sScript);
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>求助者列表</h3>
		</div>
		<div class="team-bottom" id="contentHelpList">
		  <div class="clearfix"></div>
		</div>
        <div class="team-bottom">
            <div id="barconHelpList" name="barconHelpList" class="barcon"></div>
        </div>
		<div class="clearfix"></div>
		<script type='text/javascript'>
        <?php
            //load label
            $num = 0;
            $row = 0;   
            if(count($helpListArr) > 0){
                foreach($helpListArr as $arr){
                    $num++;
                    if(($num-1)%4==0){       
                        $row++;
                        echo "addRowHelpList(contentHelpList,$row);";  
                        echo "\n";
                    }
                    echo "addHelpList(contentHelpList$row,'".$arr['user_id']."','"
                        .$arr['user_name']."','".$arr['user_info']."');";
                }
                echo "\n";
            }
            while(($num%4 != 0) || $num==0){
                $num++;
                if(($num-1)%4==0){       
                    $row++;
                    echo "addRowHelpList(contentHelpList,$row);";  
                    echo "\n";
                }
                echo "addHelpList(contentHelpList$row,'-1','无求助者','');";
                echo "\n";
            }
        ?>
		var numHelpList=<?php echo $num/4;?>;
    	if(numHelpList>0){
    		goPageList(1,1,numHelpList,"HelpList");
    	}
        </script>
	</div>
</div>