<!-- register -->
<?php require_once ('./includes/provinceLoad.inc.php');?>
<script language="JavaScript" type="text/javascript">
	function ReCodeNum(){
		setTimeout(function(){document.getElementById('register_codePic').setAttribute('src','./includes/code_num.inc.php');},500);
    }
	ReCodeNum();
	function typeChange(t='-1'){
		var type;
		if(t=='-1')
			type = document.getElementById('register_type').value;
		else
			type = t;		
		document.getElementById('register2').style="display:none";
		document.getElementById('register3').style="display:none";
		document.getElementById('register4').style="display:none";
		switch(type){
		case '0':
			document.getElementById('registerForm').style="width:320px; margin:-250px 0 0 -165px;";
			document.getElementById('registerBase').style="width: 100%;";
	        history.pushState({},null,'./home.php?registerWinStat=register_user');
			break;
		case '1':
			document.getElementById('registerForm').style="width:320px; margin:-240px 0 0 -165px;";
			document.getElementById('registerBase').style="width: 100%;";
	        <?php if($tag=='home'){?>
			history.pushState({},null,'./home.php?registerWinStat=register_user&registerWinType=1');
	        <?php }?>
	        <?php if($tag=='manage'){?>
			history.pushState({},null,'./manage.php?registerWinStat=register_user&registerWinType=1');
			<?php }?>
			break;
		case '2':
			document.getElementById('registerForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('registerBase').style="width: 33%; float: left;";
			document.getElementById('register2').style="display:block; width: 66%; float: right;";
	        history.pushState({},null,'./home.php?registerWinStat=register_user&registerWinType=2');
			break;
		case '3':
			document.getElementById('registerForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('registerBase').style="width: 33%; float: left;";
			document.getElementById('register3').style="display:block; width: 66%; float: right;";
	        history.pushState({},null,'./home.php?registerWinStat=register_user&registerWinType=3');
			break;
		case '4':
			document.getElementById('registerForm').style="width:960px; margin:-240px 0 0 -485px;";
			document.getElementById('registerBase').style="width: 33%; float: left;";
			document.getElementById('register4').style="display:block; width: 66%; float: right;"
		    history.pushState({},null,'./home.php?registerWinStat=register_user&registerWinType=4');
			break;
		}
	} function showRegister(){
        document.getElementById('register').style.display = 'block';
    	<?php if($tag=='home'){?>
        	var str;
            var type = document.getElementById('register_type').value;
            if(type=='1' || type=='2' || type=='3' || type=='4')
            	str = './home.php?registerWinStat=register_user&registerWinType='+type;
            else
                str = './home.php?registerWinStat=register_user';
            history.pushState({},null,str);
        	try{document.getElementById(getQueryString('registerWinStat')).focus();}catch(e){}
        <?php }?>
    	<?php if($tag=='manage'){?>
            var str;
            str = './manage.php?registerWinStat=register_user&registerWinType=1';
            history.pushState({},null,str);
        	try{document.getElementById(getQueryString('registerWinStat')).focus();}catch(e){}
    	<?php }?>
        
    }
    function closeRegister(){
        document.getElementById('register').style.display = 'none';
        <?php if($tag=='home'){?>
        	history.pushState({},null,'./home.php');
    	<?php }?>
    	<?php if($tag=='manage'){?>
        	history.pushState({},null,'./manage.php');
    	<?php }?>
    }
</script>
<div id="register" class="win_box1">
    <form id="registerForm" name="registerForm" class="win_box2" action="./check/check_register.php" method="post" enctype="multipart/form-data" 
    style="width:320px; margin:-240px 0 0 -165px;">
	    <p align="center" class="win_bar"><label style="font-size:30px;">注册</label></p>
	    <div id="registerBase" class="win_box3">
        	<p>
                <label>用户类型:<br>
                <?php if(checkParameter('registerWinType')) $register_type=(int)(getParameter('registerWinType'));?>
                <select name="register_type" id="register_type" class="win_select" onchange="typeChange()" tabindex="1">
                    <?php if($tag=='home'){?><option value="0" <?php if(!isset($register_type)) echo "selected=true";?>>-请选择-</option><?php }?>
                    <?php if($tag=='manage'){?><option value="1" <?php if(isset($register_type) && $register_type==1) echo "selected=true";?>>管理员</option><?php }?>
                    <?php if($tag=='home'){?><option value="2" <?php if(isset($register_type) && $register_type==2) echo "selected=true";?>>义工</option><?php }?>
                    <?php if($tag=='home'){?><option value="3" <?php if(isset($register_type) && $register_type==3) echo "selected=true";?>>赞助商</option><?php }?>
                    <?php if($tag=='home'){?><option value="4" <?php if(isset($register_type) && $register_type==4) echo "selected=true";?>>求助者</option><?php }?>
                </select></label>
        	</p>
        	<p>
        		<label>用户名（*）：<br/>
        		<input type="text" placeholder="请输入6-16位用户名" maxlength="16" name="register_user" id="register_user" class="win_input" value="<?php if(isset($register_user)) echo $register_user;?>" size="20" tabindex="2" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>密码（*）：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="register_password1"id="register_password1" class="win_input" value="" size="20" tabindex="3" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>重复密码（*）：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="register_password2"id="register_password2" class="win_input" value="" size="20" tabindex="4" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>验证码（*）：<br/>
        		<input type="text" placeholder="请输入4位验证码"  maxlength="4" name="register_codeNum" id="register_codeNum" class="win_input" value="" size="20" tabindex="5" <?php limitText('N')?>/></label>
        	</p>
            <p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="registerBtn" value="注册" tabindex="101" />
        		<?php if($tag=='home'){?><input style="padding: 2px 10px;" type="button" name="loginBtn" value="登录" tabindex="102" onClick="closeRegister();showLogin();" /><?php }?>
        		<input style="padding: 2px 10px;" type="button" name="closeBtn" value="关闭" tabindex="103" onClick="closeRegister()" />
                <label style="float:right; margin-top:12px; cursor:pointer"><img src="./includes/code_num.inc.php" width="80px" id="register_codePic" name="register_codePic" title="点击更换验证码" align="absmiddle" onclick='ReCodeNum()'/></label>
        	</p>
        </div>
        <?php 
            include("./includes/register2.inc.php");
            include("./includes/register3.inc.php");
            include("./includes/register4.inc.php");
        ?>
        <?php if(isset($register_type)){?>
            <script language="JavaScript" type="text/javascript">typeChange();</script>
        <?php }?>
    </form>
</div>
<?php 
    //registerWinStat
    if(isset($_SESSION['registerWinStat'])){
        $str = $_SESSION['registerWinStat'];
        $type = $_SESSION['registerWinType'];
        unset($_SESSION['registerWinStat']);
        unset($_SESSION['registerWinType']);
        switch($tag){
            case 'home':{?>
                <script type='text/javascript'>
                    history.pushState({},null,'./home.php?registerWinStat=<?php echo $str;?>&registerWinType=<?php echo $type;?>');
                    document.getElementById('register').style.display = 'block';
                    try{document.getElementById(getQueryString('registerWinStat')).focus();}catch(e){}
					var sltCity,sltDistrict,v1,v2;
					//2
        			sltCity=document.getElementById('register2_city');
        			sltDistrict=document.getElementById('register2_district');
        			v1 = '<?php echo $_SESSION['registerCity2'];?>';
        			v2 = '<?php echo $_SESSION['registerDistrict2'];?>';
        			<?php unset($_SESSION['registerCity2']);?>  
        			<?php unset($_SESSION['registerDistrict2']);?>  
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
        			sltCity=document.getElementById('register3_city');
        			sltDistrict=document.getElementById('register3_district');
        			v1 = '<?php echo $_SESSION['registerCity3'];?>';
        			v2 = '<?php echo $_SESSION['registerDistrict3'];?>';
        			<?php unset($_SESSION['registerCity3']);?>  
        			<?php unset($_SESSION['registerDistrict3']);?>  
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
        			sltCity=document.getElementById('register4_city');
        			sltDistrict=document.getElementById('register4_district');
        			v1 = '<?php echo $_SESSION['registerCity4'];?>';
        			v2 = '<?php echo $_SESSION['registerDistrict4'];?>';
        			<?php unset($_SESSION['registerCity4']);?>  
        			<?php unset($_SESSION['registerDistrict4']);?>  
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
                <?php break;
            }
            case 'manage':{
                echo "<script type='text/javascript'>
                history.pushState({},null,'./manage.php?registerWinStat=$str&registerWinType=$type');
                document.getElementById('register').style.display = 'block';
                try{document.getElementById(getQueryString('registerWinStat')).focus();}catch(e){}
                </script>";
                break;
            }
        }
    }
    else{
        if (checkParameter('registerWinStat')){
            echo "<script type='text/javascript'>
                   document.getElementById('register').style.display = 'block';
        	       try{document.getElementById(getQueryString('registerWinStat')).focus();}catch(e){}
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                   document.getElementById('register').style.display = 'none';
                </script>";
        }
    }
?>