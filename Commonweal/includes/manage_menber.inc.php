<!-- manage menber -->
<?php
    //load data
    $conn = dbConnect('read');
    $allArr2=getAllUser($conn," where (user_type!='1')");
    $conn -> close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addRow2(num,id,account,checked,check_id){
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
        	sScript=sScript+"正常";
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
        sScript=sScript+"<td align='center'>"+(check_id=="0100000000"?"空":check_id)+"</td>";
        sScript=sScript+"<td align='center'>";
        sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='showw"+id+"' value='查看'>";
		switch(checked){
			case '0':{
        		sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='check"+id+"' value='审核'></td>";
				break;
			}
			case '1':{
        		sScript=sScript+"<input type='submit' name='cover"+id+"' value='封号'></td>";
        		break;
			}
			case '2':{
				sScript=sScript+"<input style='margin: 0 3px;' type='submit' name='check"+id+"' value='审核'></td>";
        		break;
			}
			case '3':{
        		sScript=sScript+"<input type='submit' name='uncov"+id+"' value='解封'></td>";
        		break;
			}
		}
        sScript=sScript+"</tr>";
        content2.insertAdjacentHTML("beforeEnd",sScript);            
	}
</script>

<div class="about">
	<div class="about-top heading" style="width:60%;margin-left:20%">
		<h2>用户列表</h2>
	</div>
    <div class="about-bottom" style="width:60%;margin-left:20%">
        <form id="manageMenberForm" method="post" action="./check/check_manage.php">
            <?php if(count($allArr2)>0){?>
            <table frame="box" border="1" col="4" cellspacing="0" cellpadding="5" style="width:100%;"
            class="table table-bordered manageTable">
                <thead>
                    <tr>
                        <th style="width:20%;">ID</th>
                        <th style="width:20%;">帐号</th>
                        <th style="width:10%;">审核</th>
                        <th style="width:20%;">审核人</th>
                        <th style="width:30%;">操作</th>    
                    </tr>
                </thead>
                <tbody id="content2">
                </tbody>
            </table>
            <?php }
            else{?>
                <div style="text-align: center;">
                    <h2>赞无用户</h2>
                </div>
            <?php }?>
        </form>
        <div id="btns2">
            <div id="barcon2" name="barcon2" class="barcon"></div>
        </div>
        <?php
            //load label
            foreach($allArr2 as $arr){
                echo "\n<script type='text/javascript'>addRow2('".sprintf('%02s', (string)$arr['user_type']).sprintf('%08s', (string)$arr['user_id'])."','".
                $arr['user_id']."','".$arr['user_accounts']."','".$arr['checked']."','".sprintf('%02s', '1').sprintf('%08s', (string)$arr['check_id'])."');</script>";
            }
            echo "\n";
        ?>
        <script language="JavaScript" type="text/javascript">
    		var numInfo2=<?php echo count($allArr2);?>;
        	if(numInfo2>0){
        		goPage(1,10,numInfo2,false,"2");
        	}
        </script>
    </div>
</div>