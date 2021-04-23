<!-- 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>
<head>
    <?php header("Content-Type: text/html; charset=UTF-8");?>
    <title>数媒公益--登录 </title> 
    
    <script language="JavaScript" type="text/javascript">
        function back(){
        	window.history.back();
        }
        function next(url){
          	window.location.href=url;
        }
    	function ReCodeNum(){
    		setTimeout(function(){document.getElementById('codePic').setAttribute('src','./includes/code_num.php');},500);
        }
    </script>
    <?php
        if (isset($_POST['loginBtn'])) {
            require ('./includes/check_login.php');
        }
    ?>
</head>  
<body>
<div class="container">
    <form id="loginForm" method="post" action="">
        <div id="content">
                <h2 class="form-signin-heading">请登录</h2>
                    <label for="type">用户类型:</label>
                    <select name="type" id="type">
                        <option value="0" <?php if(!isset($type)) echo "checked=true";?>>-请选择-</option>
                        <option value="1" <?php if(isset($type) && $type==1) echo "checked=true";?>>管理员</option>
                        <option value="2" <?php if(isset($type) && $type==2) echo "checked=true";?>>义工</option>
                        <option value="3" <?php if(isset($type) && $type==3) echo "checked=true";?>>赞助商</option>
                        <option value="4" <?php if(isset($type) && $type==4) echo "checked=true";?>>求助者</option>
                    </select>
                <br>
                    <label for="inputEmail">用户名:</label>
                    <input name="user" id="user" type="text" placeholder="用户名" value="<?php if(isset($user)) echo $user;?>">
                <br>
                    <label for="password">密码:</label>
                    <input name="password" id="password" type="password" placeholder="密码">
                <br> 
                    <label for="codeNum">验证码</label>
                    <input name="codeNum" id="codeNum" type="text" maxlength="4" placeholder="验证码"/>
                    <img  width="50px" src="./code_num.php" id="codePic" name="codePic" align="absmiddle"/>
                    <a id="reCode" href="javascript:ReCodeNum();">看不清</a>
                <br><br>
        </div>
            <input name="loginBtn" type="submit" value="登录">
            <a id="register" href="./register2.php">注册</a>
            <a href="./home.php">返回主页</a>
    </form>
    </div>
</body>  
</html>


     
    <p id="login_nav">
    <a href="<?php echo $blogurl; ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">忘记密码？</a>
    </p>
 
<p id="backtoblog"><a href="#" class="lbAction" rel="deactivate">关闭</a></p>
 
 -->
 
<div id="login">
    <form name="loginForm" id="loginForm" action="<?php echo $blogurl; ?>/wp-login.php" method="post">
    	
        <h3 class="form-signin-heading" align="center">登录</h3>
            <label for="type">用户类型:</label>
            <select name="type" id="type">
                <option value="0" <?php if(!isset($type)) echo "checked=true";?>>-请选择-</option>
                <option value="1" <?php if(isset($type) && $type==1) echo "checked=true";?>>管理员</option>
                <option value="2" <?php if(isset($type) && $type==2) echo "checked=true";?>>义工</option>
                <option value="3" <?php if(isset($type) && $type==3) echo "checked=true";?>>赞助商</option>
                <option value="4" <?php if(isset($type) && $type==4) echo "checked=true";?>>求助者</option>
            </select>
        <br>
            <label for="user">用户名:</label>
            <input class="win_input" name="user" id="user" type="text" placeholder="用户名" value="<?php if(isset($user)) echo $user;?>" size="20" tabindex="10">
        <br>
            <label for="password">密码:</label>
            <input class="win_input" name="password" id="password" type="password" placeholder="密码" size="20" tabindex="20">
        <br> 
            <label for="codeNum">验证码</label>
            <input class="win_input" name="codeNum" id="codeNum" type="text" maxlength="4" placeholder="验证码"/>
            <img width="20px" src="./include/code_num.php" id="codePic" name="codePic" align="absmiddle"/>
            <a id="reCode" href="javascript:ReCodeNum();">看不清</a>
        <br><br>
        
    	<p class="submit-btn">
    		<input style="padding: 2px 10px;" type="submit" name="wp-submit" id="wp-submit" value="登录" tabindex="100" />
    		<input type="hidden" name="redirect_to" value="<?php echo $postlink; ?>" />
    		<input type="hidden" name="testcookie" value="1" />
    	</p>
    	
    	<p class="button">
    		<input style="padding: 2px 10px;" type="button" value="注册" tabindex="100" />
    	</p>
    	<p class="button">
    		<input style="padding: 2px 10px;" type="button" value="关闭" tabindex="100" />
    	</p>
    </form>
</div>

<script type="text/javascript">
try{document.getElementById('user_login').focus();}catch(e){}
</script>