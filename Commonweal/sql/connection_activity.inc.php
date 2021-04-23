<?php 
    //activity 1通知 2活动
    function publishNorify($promalgotor_id,$activity_name,$activity_content){
        $conn = dbConnect('write');
        $Arr=array();
        $Arr['promalgotor_id']=$promalgotor_id;
        $Arr['activity_name']=$activity_name;
        $Arr['activity_content']=$activity_content;
        $Arr['activity_type']=1;
        $num = insertRow($conn,"activity","activity_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                alert('通知发布失败，请重试或联系管理员。');
            </script>";
            return false;
        }
        $conn->close();
        echo"<script type='text/javascript'>
                alert('通知发布成功。通知的编号为：".trID($num,$Arr['activity_type'])."。');
            </script>";
        return true;
    }
    function publishActivity($promalgotor_id,$activity_name,$activity_content,
        $activity_starttime,$activity_endtime,$activity_neednum){  
        //activity_check 1 0      
        $conn = dbConnect('r&w');
        $Arr=array();
        $Arr['promalgotor_id']=$promalgotor_id;
        $Arr['activity_name']=$activity_name;
        $Arr['activity_content']=$activity_content;
        $Arr['activity_type']=2;
        $Arr['activity_content']=$activity_content;
        $Arr['activity_starttime']=$activity_starttime;
        $Arr['activity_endtime']=$activity_endtime;
        $Arr['activity_neednum']=$activity_neednum;
        $Arr['activity_check']=1;
        $num = insertRow($conn,"activity","activity_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                alert('活动发起失败，请重试或联系管理员。');
            </script>";
            return false;
        }
        $conn->close();
        echo"<script type='text/javascript'>
                alert('活动发布成功。活动的编号为：".trID($num,$Arr['activity_type'])."。');
            </script>";
        return true;

        if(findItemfindItemByMany($conn,"activity", $Arr,'or')){
        
        }
        else{
        
        }
        $sql = "create table if not exists activity(activity_id integer primary key,promalgotor_id integer,activity_name varchar(255),activity_type tinyint,
            activity_content text,activity_starttime datetime,activity_endtime datetime,activity_neednum integer)";
        
    }
    function getNorifies($conn,$add="",$lastAdd=""){//get norify list
        $result = getRow($conn,"activity"," where (activity_type='1'$add) $lastAdd");
        $num = $result->num_rows;
        $Arr=array();
        if($num>=1){
            foreach ($result as $row){
                $arr=array();
                $arr['activity_id']=$row['activity_id'];
                $arr['promalgotor_id']=$row['promalgotor_id'];
                $arr['activity_name']=$row['activity_name'];
                $arr['activity_type']=$row['activity_type'];
                $arr['activity_content']=$row['activity_content'];
                
                array_push($Arr,$arr);
            }
        }
        else{
            return array();
        }
        return $Arr;
    }
    function getActivities($conn,$add="",$lastAdd=""){//get activity list
        $result = getRow($conn,"activity"," where (activity_type='2'$add) $lastAdd");
        $num = $result->num_rows;
        $Arr=array();
        if($num>=1){
            foreach ($result as $row){
                $arr=array();
                $arr["activity_id"] = $row["activity_id"];
                $arr["promalgotor_id"] = $row["promalgotor_id"];
                $arr["activity_name"] = $row["activity_name"];
                $arr["activity_type"] = $row["activity_type"];
                $arr["activity_content"] = $row["activity_content"];
                $arr["activity_starttime"] = $row["activity_starttime"];
                $arr["activity_endtime"] = $row["activity_endtime"];
                $arr["activity_neednum"] = $row["activity_neednum"];

                array_push($Arr,$arr);
            }
        }
        else{
            return array();
        }
        return $Arr;
    }
    function getNorifyDetail($conn,$activity_id){//get norify details
        $result = getRow($conn,"activity"," where activity_id='$activity_id'");
        $Arr=array();
        foreach ($result as $row){
            $Arr["activity_id"] = $row["activity_id"];
            $Arr["promalgotor_id"] = $row["promalgotor_id"];
            $Arr["activity_name"] = $row["activity_name"];
            $Arr["activity_type"] = $row["activity_type"];
            $Arr["activity_content"] = $row["activity_content"];
        }
        return $Arr;
    }
    function getActivityDetail($conn,$activity_id){//get activity details
        $result = getRow($conn,"activity"," where activity_id='$activity_id'");
        $Arr=array();
        foreach ($result as $row){
            $Arr["activity_id"] = $row["activity_id"];
            $Arr["promalgotor_id"] = $row["promalgotor_id"];
            $Arr["activity_name"] = $row["activity_name"];
            $Arr["activity_type"] = $row["activity_type"];
            $Arr["activity_content"] = $row["activity_content"];
            $Arr["activity_starttime"] = $row["activity_starttime"];
            $Arr["activity_endtime"] = $row["activity_endtime"];
            $Arr["activity_neednum"] = $row["activity_neednum"];
            $Arr["activity_check"] = $row["activity_check"];
        }
        return $Arr;
    }
    function checkIsEnd($activity_id){
        $conn = dbConnect('write');
        date_default_timezone_set('PRC');
        $dateNow=date("Y-m-d");
        $result = getRow($conn,"activity"," where activity_id='$activity_id' and activity_endtime<'$dateNow'");
        if($result->num_rows>0){
            return ture;
        }
        else{
            return false;
        }
        $conn->close();
    }
    //manage join in
    //0已报名 1已参加 2未参加
    function getJoininList($conn,$id){//get joined in list
        $result = getRow($conn,"activity_joined"," where activity_id='$id'");
        $Arr=array();
        foreach ($result as $row){
            $arr=array();
            $arr["user_id"] = $row["user_id"];
            $arr["user_name"] = $row["user_name"];
            $arr["join_stat"] = $row["join_stat"];
            $arr["join_time"] = $row["join_time"];
            array_push($Arr,$arr);
        }
        return $Arr;
    }
    function getJoinin($conn,$activity_id,$user_id){//get joined in item
        $result = getRow($conn,"activity_joined"," where activity_id='$activity_id' and user_id='$user_id'");
        $Arr=array();
        foreach ($result as $row){
            $arr=array();
            $arr["user_id"] = $row["user_id"];
            $arr["user_name"] = $row["user_name"];
            $arr["join_stat"] = $row["join_stat"];
            $arr["join_time"] = $row["join_time"];
            array_push($Arr,$arr);
        }
        return $Arr;
    }
    function JoininStat($activity_id,$user_id){//joined in
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"activity_joined",'join_stat',1," where activity_id='$activity_id' and user_id='$user_id'");
        $r2=addJoinTimes($conn,$user_id);
        $conn->close();
        return $r1 & $r2;
    }
    function UnJoininStat($activity_id,$user_id){//didn't joined in
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"activity_joined",'join_stat',2," where activity_id='$activity_id' and user_id='$user_id'");
        $conn->close();
        return $r1;
    }
    function ChangeUnJoininStat($activity_id,$user_id){//change to didn't joined in
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"activity_joined",'join_stat',2," where activity_id='$activity_id' and user_id='$user_id'");
        $r2=minusJoinTimes($conn,$user_id);
        $conn->close();
        return $r1 & $r2;
    }
    function checkJoininActivity($activity_id,$user_id){//check whether join in
        $conn = dbConnect('read');
        $Arr=array();
        $Arr['activity_id']=$activity_id;
        $Arr['user_id']=$user_id;
        $r = findItemByMany($conn, "activity_joined", $Arr, " and ");
        $conn->close();
        return $r;
    }
    function joininActivity($activity_id,$user_id,$user_name){//join in activity
        $conn = dbConnect('write');
        $Arr=array();
        $Arr['activity_id']=$activity_id;
        $Arr['user_id']=$user_id;
        $Arr['user_name']=$user_name;
        $Arr['join_stat']='0';
        date_default_timezone_set('PRC');
        $Arr['join_time']=date("Y-m-d H:i:s");
        $r = insertRow($conn,"activity_joined","activity_id",$Arr);
        $conn->close();
        return $r>=0;
    }
    //manage activity
    //1正常 2关闭 3查封
    function closeActivity($id){
        $conn = dbConnect('write');
        $r=updateItemCol($conn,"activity",'activity_check',2," where activity_id='$id'");
        $conn->close();
        return $r;
    }
    function openActivity($id){
        $conn = dbConnect('write');
        $r=updateItemCol($conn,"activity",'activity_check',1," where activity_id='$id'");
        $conn->close();
        return $r;
    }
    function coverActivity($id){
        $conn = dbConnect('write');
        $r=updateItemCol($conn,"activity",'activity_check',3," where activity_id='$id'");
        $conn->close();
        return $r;
    }
    function uncoverActivity($id){
        $conn = dbConnect('write');
        $r=updateItemCol($conn,"activity",'activity_check',1," where activity_id='$id'");
        $conn->close();
        return $r;
    }
?>