<!-- edit -->
<?php require_once ('./includes/provinceLoad.inc.php');?>
<script language="JavaScript" type="text/javascript">
	function typeChange(t='-1'){
		var type;
		if(t=='-1')
			type = document.getElementById('edit_type').value;
		else
			type = t;		
		document.getElementById('edit2').style="display:none";
		document.getElementById('edit3').style="display:none";
		document.getElementById('edit4').style="display:none";
		switch(type){
		case '1':
			document.getElementById('editForm').style="width:320px; margin:-240px 0 0 -165px;";
			document.getElementById('editBase').style="width: 100%;";
			break;
		case '2':
			document.getElementById('editForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('editBase').style="width: 33%; float: left;";
			document.getElementById('edit2').style="display:block; width: 66%; float: right;";
	        break;
		case '3':
			document.getElementById('editForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('editBase').style="width: 33%; float: left;";
			document.getElementById('edit3').style="display:block; width: 66%; float: right;";
	        break;
		case '4':
			document.getElementById('editForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('editBase').style="width: 33%; float: left;";
			document.getElementById('edit4').style="display:block; width: 66%; float: right;"
		    break;
		}
	} function showEdit(){
        document.getElementById('edit').style.display = 'block';
    	var str;
        var type = document.getElementById('edit_type').value;
        str = './info.php?id='+getQueryString('id')+'&back=home.php&editWinStat=edit_password0';
        history.pushState({},null,str);
    	try{document.getElementById(getQueryString('editWinStat')).focus();}catch(e){}
    }
    function closeEdit(){
        document.getElementById('edit').style.display = 'none';
    	history.pushState({},null,'./info.php?id='+getQueryString('id')+'&back=home.php');
    }
</script>
<div id="edit" class="win_box1">
    <form id="editForm" name="editForm" class="win_box2" action="./check/check_edit.php" method="post" enctype="multipart/form-data" 
    style="width:320px; margin:-240px 0 0 -165px;">
	    <p align="center" class="win_bar"><label style="font-size:30px;">完善信息</label></p>
	    <div id="editBase" class="win_box3">
        	<p>
        	    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_SESSION['user_id'];?>"></label>
                <label>用户类型:<br>
                <select name="edit_type" id="edit_type" class="win_select" tabindex="1">
                    <?php if($tag=='manage' || ($tag=='info' && $_SESSION['user_type']=='1')){?><option value="1" selected=true>管理员</option><?php }?>
                    <?php if($tag=='info' && $_SESSION['user_type']=='2'){?><option value="2" selected=true">义工</option><?php }?>
                    <?php if($tag=='info' && $_SESSION['user_type']=='3'){?><option value="3" selected=true">赞助商</option><?php }?>
                    <?php if($tag=='info' && $_SESSION['user_type']=='4'){?><option value="4" selected=true>求助者</option><?php }?>
                </select></label>
        	</p>
        	<p>
        		<label>用户名：<br/>
        		<input type="hidden" name="edit_user" id="edit_user" value="<?php echo $_SESSION['user_accounts'];?>" <?php limitText('A&N&_')?>/></label>
        		<input type="text" class="win_input" value="<?php echo $_SESSION['user_accounts'];?>" size="20" disabled="disabled" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>原始密码（*）：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="edit_password0"id="edit_password0" class="win_input" value="" size="20" tabindex="3" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>密码：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="edit_password1"id="edit_password1" class="win_input" value="" size="20" tabindex="3" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>重复密码：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="edit_password2"id="edit_password2" class="win_input" value="" size="20" tabindex="4" <?php limitText('A&N&_')?>/></label>
        	</p>
            <p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="editBtn" value="修改" tabindex="101" />
        		<input style="padding: 2px 10px;" type="button" name="closeBtn" value="关闭" tabindex="103" onClick="closeEdit()" />
        	</p>
        </div>
        <?php 
            include("./includes/edit2.inc.php");
            include("./includes/edit3.inc.php");
            include("./includes/edit4.inc.php");
        ?>
        <script language="JavaScript" type="text/javascript">typeChange();</script>
    </form>
</div>
<?php 
    //editWinStat
    if(isset($_SESSION['editWinStat'])){
        $str = $_SESSION['editWinStat'];
        unset($_SESSION['editWinStat']);?>
        <script type='text/javascript'>
            history.pushState({},null,'./home.php?editWinStat=<?php echo $str;?>');
            document.getElementById('edit').style.display = 'block';
            try{document.getElementById(getQueryString('editWinStat')).focus();}catch(e){}
			var sltCity,sltDistrict,v1,v2;
			//2
			sltCity=document.getElementById('edit2_city');
			sltDistrict=document.getElementById('edit2_district');
			v1 = '<?php echo $_SESSION['editCity2'];?>';
			v2 = '<?php echo $_SESSION['editDistrict2'];?>';
			<?php unset($_SESSION['editCity2']);?>  
			<?php unset($_SESSION['editDistrict2']);?>  
            changeProvince2();
            if(v1!='0'){
            	for (var i=0; i<sltCity.length; i++) {  
                    if (sltCity[i].value==v1) {
                        sltCity[i].selected=true;  
                        break;
                    }
            	}
            	changeCity2();
            }
            if(v2!='0'){
            	for (var i=0; i<sltDistrict.length; i++) {  
                    if (sltDistrict[i].value==v2) {
                    	sltDistrict[i].selected=true;  
                        break;
                    }
            	}
            }
			//3
			sltCity=document.getElementById('edit3_city');
			sltDistrict=document.getElementById('edit3_district');
			v1 = '<?php echo $_SESSION['editCity3'];?>';
			v2 = '<?php echo $_SESSION['editDistrict3'];?>';
			<?php unset($_SESSION['editCity3']);?>  
			<?php unset($_SESSION['editDistrict3']);?>  
            changeProvince3();
            if(v1!='0'){
            	for (var i=0; i<sltCity.length; i++) {  
                    if (sltCity[i].value==v1) {
                        sltCity[i].selected=true;  
                        break;
                    }
            	}
            	changeCity3();
            }
            if(v2!='0'){
            	for (var i=0; i<sltDistrict.length; i++) {  
                    if (sltDistrict[i].value==v2) {
                    	sltDistrict[i].selected=true;  
                        break;
                    }
            	}
            }
			//4
			sltCity=document.getElementById('edit4_city');
			sltDistrict=document.getElementById('edit4_district');
			v1 = '<?php echo $_SESSION['editCity4'];?>';
			v2 = '<?php echo $_SESSION['editDistrict4'];?>';
			<?php unset($_SESSION['editCity4']);?>  
			<?php unset($_SESSION['editDistrict4']);?>  
            changeProvince4();
            if(v1!='0'){
            	for (var i=0; i<sltCity.length; i++) {  
                    if (sltCity[i].value==v1) {
                        sltCity[i].selected=true;  
                        break;
                    }
            	}
            	changeCity4();
            }
            if(v2!='0'){
            	for (var i=0; i<sltDistrict.length; i++) {  
                    if (sltDistrict[i].value==v2) {
                    	sltDistrict[i].selected=true;  
                        break;
                    }
            	}
            }
        </script>
        <?php 
    }
    else{
        if (checkParameter('editWinStat')){
            echo "<script type='text/javascript'>
                   document.getElementById('edit').style.display = 'block';
        	       try{document.getElementById(getQueryString('editWinStat')).focus();}catch(e){}
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                   document.getElementById('edit').style.display = 'none';
                </script>";
        }
    }
?>