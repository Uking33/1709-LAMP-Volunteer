<!-- activity joined list -->
<?php
    //load data
    $conn = dbConnect('read');
    $jListArr=getJoininList($conn,getParameter('id'));
    $conn -> close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRowJList(num,id,name,stat,time){
        var sScript;
        sScript="<tr>";
        sScript=sScript+"<td align='center' style='padding:10px;'>"+num+"</td>";
        if(name!='')
        	sScript=sScript+"<td align='center'>"+name+"</td>";
		else
        	sScript=sScript+"<td align='center'>未填写</td>";
        sScript=sScript+"<td align='center'>"+time+"</td>";
        sScript=sScript+"<td align='center'>";
        switch(stat){
        case '0':
        	sScript=sScript+"已报名";
        	break;
        case '1':
        	sScript=sScript+"已参加";
        	break;
        case '2':
        	sScript=sScript+"未参加";
            break;
        }
        sScript=sScript+"</td>";
        sScript=sScript+"<td align='center'>";
		<?php switch($Arr['activity_check']){
			case 1:{?>
            sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
    		if(stat=='0' || stat=='2') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='sjoin"+id+"' value='参加'>";
    		if(stat=='0') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ujoin"+id+"' value='未参加'>";
    		if(stat=='1') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ctoun"+id+"' value='未参加'>";
        <?php
			break; 
			}
			case 2:{
		?>
            sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
    		if(stat=='0' || stat=='2') sScript=sScript+"<input style='margin: 0 3px;' type='button' name='sjoin"+id+"' value='参加' onClick='alert(\"请先打开活动，再进行操作。\")'>";
    		if(stat=='0') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ujoin"+id+"' value='未参加' onClick='alert(\"请先打开活动，再进行操作。\")>";
    		if(stat=='1') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ctoun"+id+"' value='未参加' onClick='alert(\"请先打开活动，再进行操作。\")>";
		<?php
			break; 
			}
			case 3:{
		?>
			sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
    		if(stat=='0' || stat=='2') sScript=sScript+"<input style='margin: 0 3px;' type='button' name='sjoin"+id+"' value='参加' onClick='alert(\"活动被查封，不能进行操作。\")'>";
    		if(stat=='0') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ujoin"+id+"' value='未参加' onClick='alert(\"活动被查封，不能进行操作。\")>";
    		if(stat=='1') sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='ctoun"+id+"' value='未参加' onClick='alert(\"活动被查封，不能进行操作。\")>";
		<?php
			break; 
			}
		}?>
		sScript=sScript+"</td>";
		sScript=sScript+"</tr>";
        contentJList.insertAdjacentHTML("beforeEnd",sScript);            
	}
</script>

<div class="about-top heading">
	<h2>报名列表</h2>
</div>
<div class="about-bottom">
    <form id="manageMenberForm" method="post" action="./check/check_activity_details.php">
        <?php if(count($jListArr)>0){?>
        <table frame="box" border="1" col="4" cellspacing="0" cellpadding="5" style="width:100%;"
        class="table table-bordered manageTable">
            <thead>
                <tr>
                    <th style="width:20%;">ID</th>
                    <th style="width:20%;">姓名</th>
                    <th style="width:20%;">报名时间</th>
                    <th style="width:10%;">状态</th>    
                    <th style="width:30%;">操作</th>    
                </tr>
            </thead>
            <tbody id="contentJList">
            </tbody>
        </table>
        <?php }
        else{?>
            <div style="text-align: center;">
                <h2>暂无人报名</h2>
            </div>
        <?php }?>
    </form>
    <div id="btnsJList">
        <div id="barconJList" name="barconJList" class="barcon"></div>
    </div>
    <div style="background: #8E8E8E; height:2px; margin-top:50px; margin-bottom:50px;"></div>
	<script type='text/javascript'>
    <?php
        //load label
        foreach($jListArr as $arr){
            echo "\naddRowJList('".trID($arr['user_id'],2)."','".
                getParameter('id').'|'.$arr['user_id']."','".$arr['user_name']."','".$arr['join_stat']."','".$arr['join_time']."');";
        	echo "\n";
		}
    ?>
		var numJList=<?php echo count($jListArr);?>;
    	if(numJList>0){
    		goPage(1,10,numJList,false,"JList");
    	}
    </script>
</div>