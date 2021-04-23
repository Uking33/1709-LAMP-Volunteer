<!-- manage gm -->
<?php
    //load data
    $conn = dbConnect('read');    
    $allArr3=getAllUser($conn," where user_type='1'");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addgmUser(){
    	showRegister();
    }
    function addRow3(num,id,account,checked,check_id){
        var sScript;
        sScript="<tr>";
        sScript=sScript+"<td align='center' style='padding:10px;'>"+num+"</td>";
        sScript=sScript+"<td align='center'>"+account+"</td>";
        sScript=sScript+"<td align='center'>";
        switch(checked){
        case '1':
        	sScript=sScript+"正常";
        	break;
        case '3':
        	sScript=sScript+"已封号";
            break;
        case '4':
        	sScript=sScript+"已解决";
            break;
        }
        sScript=sScript+"</td>";
        sScript=sScript+"<td align='center'>";
		if(id==1){
    		sScript=sScript+"<input type='button' name='addgm' value='添加管理员' style='width:100px' onClick='addgmUser()'></td>";
		}
		else{
	        sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
            switch(checked){
    		case '1':{
        		sScript=sScript+"<input type='submit' name='cover"+id+"' value='封号'></td>";
        		break;
    		}
    		case '3':{
        		sScript=sScript+"<input type='submit' name='uncov"+id+"' value='解封'></td>";
        		break;
    		}
    	}
		}
        sScript=sScript+"</tr>";
        content3.insertAdjacentHTML("beforeEnd",sScript);            
	}
</script>
<div id="about">
	<div class="about-top heading" style="width:60%;margin-left:20%">
		<h2>管理员列表</h2>
	</div>
	<div class="about-bottom" style="width:60%;margin-left:20%">
        <form id="manageGmForm" method="post" action="./check/check_manage.php">
            <?php if(count($allArr3)>0){?>
            <table frame="box" border="1" col="4" cellspacing="0" cellpadding="5" style="width:100%;"
            class="table table-bordered manageTable">
                <thead style="text-align: center;">
                    <tr>
                        <th style="width:20%;">ID</th>
                        <th style="width:20%;">帐号</th>
                        <th style="width:20%;">审查</th>
                        <th style="width:40%;">操作</th>    
                    </tr>
                  <tbody id="content3">
                  </tbody>
                </thead>
            </table>
            <?php }?>
        </form>
        <div id="btns3">
            <div id="barcon3" name="barcon3" class="barcon"></div>
        </div>
        <?php
            //load label
            foreach($allArr3 as $arr){
                echo "\n<script type='text/javascript'>addRow3('".sprintf('%02s', (string)$arr['user_type']).sprintf('%08s', (string)$arr['user_id'])."','".
                $arr['user_id']."','".$arr['user_accounts']."','".$arr['checked']."','".sprintf('%02s', '1').sprintf('%08s', (string)$arr['check_id'])."');</script>";
            }
            echo "\n";
        ?>
        <script language="JavaScript" type="text/javascript">
    		var numInfo3=<?php echo count($allArr3);?>;
        	if(numInfo3>0){
        		goPage(1,10,numInfo3,false,"3");
        	}
        </script>
    </div>
</div>