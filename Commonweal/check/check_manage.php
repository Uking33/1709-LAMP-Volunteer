<?php
    require_once('../sql/connection.php');
    $type="";
    $id="";
    foreach ($_POST as $key=>$value) {
        $str=substr($key,0,5);
        if($str=='openn' || $str=='close' || $str=='showw' || $str=='check' || $str=='cover' || $str=='uncov' || $str=='passs'){
            $type=substr($key,0,5);
            $id=substr($key,5);
            break;
        }
    }
    switch($type){
        case 'openn':{
            if(opennUser($id)){
                $_SESSION['user_checked'] = 0;
                echo "<script type='text/javascript'>window.history.back();alert('已恢复求助，请等待重新审核。');window.location.href=window.location.href;</script>";
            }
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'close':{
            if(closeUser($id)){
                $_SESSION['user_checked'] = 4;
                echo "<script type='text/javascript'>window.history.back();alert('已关闭求助成功');window.location.href=window.location.href;</script>";
            }
            else{
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            }
            break;
        }
        case 'showw':{
            showUser($id);
            break;
        }
        case 'check':{
            if(checkUser($id))
                echo "<script type='text/javascript'>window.history.back();alert('审核通过');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'cover':{
            if(coverUser($id))
                echo "<script type='text/javascript'>window.history.back();alert('已封号');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'uncov':{
            if(uncoverUser($id))
                echo "<script type='text/javascript'>window.history.back();alert('已解封');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'passs':{
            if(passUser($id))
                echo "<script type='text/javascript'>window.history.back();alert('已拒绝');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
    }
    function showUser($id){
        echo "<script type='text/javascript'>window.location.href='../info.php?id=$id&back=manage.php'</script>";
    }
?>  