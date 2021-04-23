<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_POST['norify_type']) && $_POST['norify_type']==1){
        function back($str){
            $_SESSION['norifyWinStat'] = $str;
            echo "<script type='text/javascript'>history.back();</script>";
        }
        //check
        $norify_type=$_POST['norify_type'];
        $norify_name=$_POST['norify_name'];  
        $norify_content=$_POST['norify_content'];
        if($norify_name == ""){
            echo"<script type='text/javascript'>
                alert('请输入通知名称');
            </script>";
            back('norify_name');
            return;
        }
        if($norify_content == ""){
            echo"<script type='text/javascript'>
                alert('请输入通知内容');
            </script>";
            back('norify_content');
            return;
        }
        if(strlen($norify_content) < 20){
            echo"<script type='text/javascript'>
                alert('通知内容不能少于20个字符');
            </script>";
            back('norify_content');
            return;
        }
        //publish
        require_once('../sql/connection.php');
        if(publishNorify($_SESSION['user_id'],$norify_name,$norify_content))
            echo"<script type='text/javascript'>
                    history.back();
                    history.back();
					closeNorify();
                </script>";
    }
    if(isset($_POST['activity_type']) && $_POST['activity_type']==2){
        function back($str){
            $_SESSION['activityWinStat'] = $str;
            echo "<script type='text/javascript'>history.back();</script>";
        }
        //check
        $activity_type=$_POST['activity_type'];
        $activity_name=$_POST['activity_name'];

        $activity_starttime=(string)$_POST['activity_starttime_year'].sprintf('%02s', (string)$_POST['activity_starttime_month'])
                .sprintf('%02s', (string)$_POST['activity_starttime_day']);
        $activity_endtime=(string)$_POST['activity_endtime_year'].sprintf('%02s', (string)$_POST['activity_endtime_month'])
                .sprintf('%02s', (string)$_POST['activity_endtime_day']);
        $activity_neednum=$_POST['activity_neednum'];
        $activity_content=$_POST['activity_content'];
        if($activity_name == ""){
            echo"<script type='text/javascript'>
                alert('请输入活动名称');
            </script>";
            back('activity_name');
            return;
        }
        if(intval($activity_starttime) > intval($activity_endtime)){
            echo"<script type='text/javascript'>
                alert('请输入正确的活动时间');
            </script>";
            back('activity_endtime_year');
            return;
        }
        if($activity_neednum == ""){
            echo"<script type='text/javascript'>
                alert('请输入活动人数');
            </script>";
            back('activity_neednum');
            return;
        }
        if($activity_content == ""){
            echo"<script type='text/javascript'>
                alert('请输入活动内容');
            </script>";
            back('activity_content');
            return;
        }
        if(strlen($activity_content) <= 10){
            echo"<script type='text/javascript'>
                alert('活动内容不能少于10个字符');
            </script>";
            back('activity_content');
            return;
        }
        //publish
        require_once('../sql/connection.php');
        if(publishActivity($_SESSION['user_id'],$activity_name,$activity_content,$activity_starttime,$activity_endtime,$activity_neednum))
            echo"<script type='text/javascript'>
                    history.back();
                    history.back();
					closeActivity();
                </script>";
    }
?>  