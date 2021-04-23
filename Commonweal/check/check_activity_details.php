<?php
    require_once('../sql/connection.php');
    $type="";
    $id="";
    $id2="";
    foreach ($_POST as $key=>$value) {
        $str=substr($key,0,5);
        if($str=='showw' || $str=='sjoin' || $str=='ujoin' || $str=='ctoun' || 
            $str=='cover' || $str=='uncov' || $str=='openn' || $str=='close' || $str='joinn'){
            $type=substr($key,0,5);
            $id=substr($key,5);
            break;
        }
    }
    switch($type){
        case 'showw':{
            $my_arr = explode('|',$id,2);
            $id1 = $my_arr[0];
            $id2 = $my_arr[1];
            echo "<script type='text/javascript'>window.location.href='../info.php?id=$id2&back=activity_details.php?id@$id1!back@activity.php'</script>";
            break;
        }
        case 'sjoin':{
            $my_arr = explode('|',$id,2);
            $id1 = $my_arr[0];
            $id2 = $my_arr[1];
            if(JoininStat($id1,$id2))
                echo "<script type='text/javascript'>window.history.back();alert('操作成功');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'ujoin':{
            $my_arr = explode('|',$id,2);
            $id1 = $my_arr[0];
            $id2 = $my_arr[1];
            if(UnJoininStat($id1,$id2))
                echo "<script type='text/javascript'>window.history.back();alert('操作成功');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'ctoun':{
            $my_arr = explode('|',$id,2);
            $id1 = $my_arr[0];
            $id2 = $my_arr[1];
            if(ChangeUnJoininStat($id1,$id2))
                echo "<script type='text/javascript'>window.history.back();alert('操作成功');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'cover':{
            if(coverActivity($id))
                echo "<script type='text/javascript'>window.history.back();alert('已查封活动');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'uncov':{
            if(uncoverActivity($id))
                echo "<script type='text/javascript'>window.history.back();alert('已恢复活动');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'openn':{
            if(openActivity($id))
                echo "<script type='text/javascript'>window.history.back();alert('已打开活动');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'close':{
            if(closeActivity($id))
                echo "<script type='text/javascript'>window.history.back();alert('已关闭活动');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
        case 'joinn':{
            if($_SESSION['user_checked']!='1'){
                echo "<script type='text/javascript'>window.history.back();alert('帐号未审核或被查封,不能参与活动');</script>";
                break;
            }
            $my_arr = explode('|',$id,3);
            $id1 = $my_arr[0];
            $id2 = $my_arr[1];
            $id3 = $my_arr[2];
            if(checkIsEnd($id1)){
                echo "<script type='text/javascript'>window.history.back();alert('活动已结束,不能参与活动');</script>";
                break;
            }
            if(joininActivity($id1,$id2,$id3))
                echo "<script type='text/javascript'>window.history.back();alert('已报名成功，请等待主办方联系你');window.location.href=window.location.href;</script>";
            else
                echo "<script type='text/javascript'>window.history.back();alert('操作失败');window.location.href=window.location.href;</script>";
            break;
        }
    }
?>