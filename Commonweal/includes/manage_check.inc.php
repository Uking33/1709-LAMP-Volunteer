<!-- manage check -->
<?php 
    //load data
    $conn = dbConnect('read');
    $allArr1=getAllUser($conn," where (checked='0' and user_type!='1')");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
    function addRow1(num,id,account,checked,check_id){
        var sScript;
        sScript="<tr>";
        sScript=sScript+"<td align='center' style='padding:10px;'>"+num+"</td>";
        sScript=sScript+"<td align='center'>"+account+"</td>";
        sScript=sScript+"<td align='center'>";
        switch(checked){
        case '0':
        	sScript=sScript+"未审核";
        	break;
        case '1':
        	sScript=sScript+"已通过审核";
        	break;
        case '2':
        	sScript=sScript+"未通过审核";
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
        sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
        sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='check"+id+"' value='通过'>";
        sScript=sScript+"<input type='submit' name='passs"+id+"' value='不通过'></td>";
        sScript=sScript+"</tr>";
        content1.insertAdjacentHTML("beforeEnd",sScript);            
    }
</script>

<div class="about">
	<div class="about-top heading" style="width:60%;margin-left:20%">
		<h2>用户审核</h2>
	</div>
	<div class="about-bottom" style="width:60%;margin-left:20%">
        <form id="manageCheckForm" method="post" action="./check/check_manage.php">
            <?php if(count($allArr1)>0){?>
            <table frame="box" border="1" col="4" cellspacing="0" cellpadding="5" 
             class="table table-bordered manageTable" >
                <thead>
                    <tr>
                        <th style="width:20%;">ID</th>
                        <th style="width:20%;">帐号</th>
                        <th style="width:20%;">状态</th>  
                        <th style="width:40%;">审核</th>    
                    </tr>
                  <tbody id="content1">
                  </tbody>
                </thead>
            </table>
            <?php }
            else{?>
                <div style="text-align: center;">
                    <h2>赞无用户需要审核</h2>
                </div>
            <?php }?>
        </form>
        <div id="btns1">
            <div id="barcon1" name="barcon1" class="barcon"></div>
        </div>
        <?php
            //load label
            foreach($allArr1 as $arr){
                echo "\n<script type='text/javascript'>addRow1('".sprintf('%02s', (string)$arr['user_type']).sprintf('%08s', (string)$arr['user_id'])."','".
                $arr['user_id']."','".$arr['user_accounts']."','".$arr['checked']."','".sprintf('%02s', '1').sprintf('%08s', (string)$arr['check_id'])."');</script>";
            }
            echo "\n";
        ?>
        <script language="JavaScript" type="text/javascript">
    		var numInfo1=<?php echo count($allArr1);?>;
        	if(numInfo1>0){
        		goPage(1,10,numInfo1,false,"1");
        	}
        </script>
    </div>
</div>