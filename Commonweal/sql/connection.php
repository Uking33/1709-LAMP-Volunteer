<?php
    //init
    if(!isset($_SESSION)) session_start();
    //create db
    function dbCreate(){
        $conn = dbConnect("write");
        //create user
        $sql = "create table if not exists user(user_id integer auto_increment primary key,user_type tinyint,user_accounts varchar(20), user_passwords varchar(20),checked varchar(1),check_id integer)";
        $conn->query($sql) or die(mysqli_error($conn));
        $sql = "create table if not exists user_details(user_id integer,user_type tinyint,name varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,sex tinyint,birth date,qualifications tinyint,
                province varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,city varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,district varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,ad2 varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                phone varchar(60),email varchar(300),work varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,info varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,file_id integer)";
        $conn->query($sql) or die(mysqli_error($conn));
        $sql = "create table if not exists level(user_id integer, test_id integer, test_level tinyint, joinTimes integer)";
        $conn->query($sql) or die(mysqli_error($conn));
        
        //create files
        $sql = "create table if not exists file(file_id integer auto_increment primary key,user_id integer,user_type tinyint, file_type varchar(20),file_name varchar(255),file_path varchar(255))";
        $conn->query($sql) or die(mysqli_error($conn));

        $dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT']."/Commonweal/data");
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/files");
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/tests");
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        
        //create activity
        $sql = "create table if not exists activity(activity_id integer auto_increment primary key,promalgotor_id integer,activity_name varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,activity_type tinyint,
            activity_content text(3000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,activity_starttime date,activity_endtime date,activity_neednum integer,activity_check varchar(1))";
        $conn->query($sql) or die(mysqli_error($conn));
        $sql = "create table if not exists activity_joined(id integer auto_increment primary key,activity_id integer,user_id integer,user_name varchar(60),join_time datetime,join_stat varchar(1))";
        $conn->query($sql) or die(mysqli_error($conn));

        //create test
        $sql = "create table if not exists test(test_id integer auto_increment primary key,test_name varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,test_level tinyint,
            file_id integer)";
        $conn->query($sql) or die(mysqli_error($conn));
        
        //create statistics hours
        $sql = "create table if not exists statistics(id integer auto_increment primary key,time datetime,count integer)";
        $conn->query($sql) or die(mysqli_error($conn));
        
        //init system
        if(!findItemByOne($conn, 'user', 'user_accounts', 'system')){
            $sql = "insert into user (user_id,user_type,user_accounts,user_passwords,checked,check_id) values ('0','1','system','123456','1','0')" ;
            $result = $conn->query($sql) or die(mysqli_error($conn));
        }
    }
    //connect db
    function dbConnect($usertype){
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'CommonwealUser';
        if ($usertype != 'read' && $usertype != 'write' && $usertype != 'r&w') {
            exit('Unrecognized connection type');
        }
        //create database
        $conn=new mysqli($host, $user, $pwd) or die ('Cannot connect');// or die ('Cannot open database');
        $sql="CREATE DATABASE IF NOT EXISTS $db default character set utf8 COLLATE utf8_general_ci";
        if ($conn->query($sql) === TRUE){
            $sql="GRANT ALL PRIVILEGES ON $db.* to $user@$host identified by '$pwd'";
            if (!$conn->query($sql))
                echo "Error GRANT database: " . $conn->error;
        }
        else {
            echo $sql;
            echo "Error creating database: " . $conn->error;
        }
        mysqli_close($conn);
        //connect
        $conn=new mysqli($host, $user, $pwd, $db) or die ('Cannot open database');
        return $conn;
    }
    //find
    function findItemByOne($conn, $table, $key, $value){
        $sql = "SELECT * FROM $table where $key='$value'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->num_rows;
        if($num!=0)
            return true;
        else
            return false;
    }
    function findItemByMany($conn, $table, $Arr, $tag){
        $sql = "SELECT * FROM $table where ";
        foreach($Arr as $key=>$value){
            $sql .= $key."='".$value."' ".$tag;
        }
        if(sizeof($Arr)>1)
            $sql = substr($sql,0,strlen($sql)-strlen($tag));
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->num_rows;
        if($num!=0)
            return true;
        else
            return false;
    }
    //insert
    function insertRow($conn, $table,$idname, $Arr){
        $sql = "insert into $table(";
        foreach($Arr as $key=>$value){
            $sql .= $key.",";
        }
        if(sizeof($Arr)>1)
            $sql = substr($sql,0,strlen($sql)-1);
        $sql .= ") values (";
        foreach($Arr as $value){
            $sql .= "'".$value."',";
        }
        if(sizeof($Arr)>1)
            $sql = substr($sql,0,strlen($sql)-1);
        $sql .= ")";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        if($result){
            $result = getMaxID($conn, $table, $idname);
            if($result>=0){
                return $result;
            }
            else
                return -1;
        }
        else
            return -1;
    }
    //get
    function getRow($conn, $table, $add='', $context='*'){
        $sql="SELECT $context FROM $table $add";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->num_rows;
        if($num>=0)
            return $result;
        else
            return array();
    }
    function getCount($conn,$db,$add=''){//get count
        $sql = "SELECT * FROM $db $add";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->num_rows;
        if($num>=0)
            return $num;
        else
            return -1;
    }
    function getMaxID($conn,$table,$idName){//get max id
        $sql = "SELECT max($idName) FROM $table";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->num_rows;
        if($num!=0){
            foreach ($result as $row){
                return (int)$row["max($idName)"];
            }
        }
        else
            return -1;
    }
    //update
    function updateItemCol($conn,$table,$key,$value,$add){
        $sql = "update $table set $key='$value' $add";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    function updateItemCols($conn,$table,$Arr,$add){
        $sql = "update $table set ";
        foreach($Arr as $key=>$value){
            $sql .= $key."='".$value."',";
        }
        if(sizeof($Arr)>1)
            $sql = substr($sql,0,strlen($sql)-1);
        $sql .= " $add";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        return $result;
    }
    //delete
    function deleteItem($conn,$table,$key,$value){
        $sql = "delete from $table where $key='$value'";
        return $conn->query($sql) or die(mysqli_error($conn));
    }
    //tool
    function trID($user_id,$type){
        return sprintf('%02s', (string)$type).sprintf('%08s', (string)$user_id);
    }

    //---api---
    require_once('connection_user.inc.php');
    require_once('connection_activity.inc.php');
    require_once('connection_statistics.inc.php');
    require_once('connection_file.inc.php');
    require_once('connection_test.inc.php');
?>
