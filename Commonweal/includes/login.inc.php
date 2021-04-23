<!-- login -->
<script language="JavaScript" type="text/javascript">
	function ReCodeNum1(){
		setTimeout(function(){document.getElementById('login_codePic').setAttribute('src','./includes/code_num.inc.php');},500);
    }
	ReCodeNum1();
    function showLogin(){
        document.getElementById('login').style.display = 'block';
        history.pushState({},null,'./home.php?loginWinStat=login_user');
        try{document.getElementById(getQueryString('loginWinStat')).focus();}catch(e){}
     }
     function closeLogin(){
        document.getElementById('login').style.display = 'none';
        history.pushState({},null,'./home.php');
     }
</script>
<div id="login" class="win_box1">
	<div class="win_box2" style="width:320px; margin:-173px 0 0 -165px">
	    <p align="center" class="win_bar"><label style="font-size:30px;">登陆</label></p>
        <form name="loginform" class="win_box3" action="./check/check_login.php" method="post">
        	<p style="padding: 5px 0px;">
        		<label>用户名：<br/>
        		<input type="text" placeholder="请输入6-16位用户名" maxlength="16" name="login_user" id="login_user" class="win_input" value="<?php if(isset($login_user)) echo $login_user;?>"
        		 size="20" tabindex="2" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>密码：<br/>
        		<input type="password" placeholder="请输入6-16位密码"  maxlength="16" name="login_password"id="login_password" class="win_input" value=""
        		 size="20" tabindex="3" <?php limitText('A&N&_')?>/></label>
        	</p>
        	<p>
        		<label>验证码：<br/>
        		<input type="text" placeholder="请输入4位验证码"  maxlength="4" name="login_codeNum" id="login_codeNum" class="win_input" value=""
        		 size="20" tabindex="4" <?php limitText('N')?>/></label>
        	</p>
        	<p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="loginBtn" value="登录" tabindex="5" />
        		<input style="padding: 2px 10px;" type="button" name="registerBtn" value="注册" tabindex="6" onClick="closeLogin();showRegister();" />
        		<input style="padding: 2px 10px;" type="button" name="closeBtn" value="关闭" tabindex="7" onClick="closeLogin()" />
                <label style="float:right; margin-top:12px; cursor:pointer"><img src="./includes/code_num.inc.php" width="80px" id="login_codePic" name="login_codePic" title="点击更换验证码" align="absmiddle" onclick='ReCodeNum1()'/></label>
        	</p>
        </form>
    </div>
</div>
<?php 
    //loginWinStat
    if(isset($_SESSION['loginWinStat'])){
        $str = $_SESSION['loginWinStat'];
        unset($_SESSION['loginWinStat']);
        echo "<script type='text/javascript'>
        history.pushState({},null,'./home.php?loginWinStat=$str');
        document.getElementById('login').style.display = 'block';
        try{document.getElementById(getQueryString('loginWinStat')).focus();}catch(e){}
        </script>";
    }
    else{
        if (checkParameter('loginWinStat')){
            echo "<script type='text/javascript'>
                       document.getElementById('login').style.display = 'block';
            	       try{document.getElementById(getQueryString('loginWinStat')).focus();}catch(e){}
                    </script>";
        }
        else{
            echo "<script type='text/javascript'>
                        document.getElementById('login').style.display = 'none';
                    </script>";
        }
    }
?>