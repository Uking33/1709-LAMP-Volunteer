<?php
    if(!isset($_SESSION)) session_start();
    function back($str){
        $_SESSION['loginWinStat'] = $str;
        echo "<script type='text/javascript'>history.back();</script>";
    }
    $login_user=$_POST['login_user'];
    $login_password=$_POST['login_password'];
	$login_codeNum=$_POST['login_codeNum'];
    if (count($_POST) > 0) {
       $_POST = array();
    }
	//check
    if($login_user == ""){
        echo"<script type='text/javascript'>
                alert('请输入用户名');
            </script>";
        back('login_user');
        return;
    }  
    if($login_password == ""){
        echo"<script type='text/javascript'>
                alert('请输入密码');
            </script>";
        back('login_password');
        return;
    }
    
    if(strlen($login_user) < 6){
        echo"<script type='text/javascript'>
                alert('用户名要有6个以上的字符');
            </script>";
        back('login_user');
        return;
    }  
    if(strlen($login_password) < 6){
        echo"<script type='text/javascript'>
                alert('密码要有6个以上的字符');
            </script>";
        back('login_password');
        return;
    }
    if($login_codeNum != $_SESSION["codeNum"]){
        echo"<script type='text/javascript'>
                alert('验证码错误');
            </script>";
        back('login_password');
        return;
    }
	
	//db check
    require_once('../sql/connection.php');
    $conn = dbConnect('read');
    switch(loginCheck($conn,$login_user,$login_password)){
        case 1:
            $_SESSION['user_accounts']=$login_user;
            loginGet($conn,$login_user);
            echo"<script type='text/javascript'>
                    alert('登录成功');
  	                location.href = '../home.php';
                </script>";
            $conn->close();
            break;
        case 0:
            echo"<script type='text/javascript'>
                    alert('密码错误');
                </script>";
            $conn->close();
            back('login_password');
            break;
        case -1: 
            echo"<script type='text/javascript'>
                    alert('找不到帐号');
                </script>";
            $conn->close();
            back('login_user');
            break;
    }
?>  