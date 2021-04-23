<?php 
    //test
    function testCheck($conn, $test_name){//check test
        return $result = findItemByOne($conn, 'test', 'test_name', $test_name);
    }
    function addTest($conn, $user_id, $test_name, $test_level,$file,$file_name,$file_type,$file_path){//addtest
        //file move
        $save_path = $file_name.'.'.$file_type;
        moveTest($file_path, $save_path);
        //file sql
        $Arr=array();
        $Arr['user_id']=$user_id;
        $Arr['user_type']='1';
        $Arr['file_name']=$file_name;
        $Arr['file_type']=$file_type;
        $Arr['file_path']=$save_path;
        $fileID = insertRow($conn,"file","file_id",$Arr);
        if($fileID<0){
            echo"<script type='text/javascript'>
                    alert('上传失败。');
                </script>";
            return false;
        }
        //details
        $Arr=array();
        $Arr['test_name']=$test_name;
        $Arr['test_level']=$test_level;
        $Arr['file_id']=$fileID;
        $num = insertRow($conn,"test","test_id",$Arr);
        if($num>=0){
            echo"<script type='text/javascript'>
                alert('上传成功。文件的编号为：".trID($num,0)."。');
            </script>";
            return true;
        }
        else{    
            echo"<script type='text/javascript'>
                        alert('上传失败。');
                    </script>";
            return false;
        }
    }
    function getTests($conn,$add=""){//get test list
        $result =getRow($conn, 'test', $add);
        $Arr=array();
        if($result!=array()){
            foreach ($result as $row){
                $arr=array();
                $arr["test_id"] = $row["test_id"];
                $arr["test_name"] = $row["test_name"];
                $arr["test_level"] = $row["test_level"];
                $file_id = $row["file_id"];

                $result2 =getRow($conn, 'file', " where file_id='$file_id'");
                if($result2==array()){
                    continue;
                }
                foreach ($result2 as $row){
                    $arr["file_id"] = $row["file_id"];
                    $arr["user_id"] = $row["user_id"];
                    $arr["user_type"] = $row["user_type"];
                    $arr["file_name"] = $row["file_name"];
                    $arr["file_type"] = $row["file_type"];
                    $arr["file_path"] = $row["file_path"];
                }
                array_push($Arr,$arr);
            }
        }
        return $Arr;
    }
    function getTestDetail($conn,$test_id){//get test details
        $result =getRow($conn, 'test', " where test_id='$test_id'");
        $arr=array();
        if($result!=array()){
            foreach ($result as $row){
                $arr=array();
                $arr["test_id"] = $row["test_id"];
                $arr["test_name"] = $row["test_name"];
                $arr["test_level"] = $row["test_level"];
                $file_id = $row["file_id"];        
                $result2 =getRow($conn, 'file', " where file_id='$file_id'");
                if($result2==array()){
                    continue;
                }
                foreach ($result2 as $row){
                    $arr["file_id"] = $row["file_id"];
                    $arr["user_id"] = $row["user_id"];
                    $arr["user_type"] = $row["user_type"];
                    $arr["file_name"] = $row["file_name"];
                    $arr["file_type"] = $row["file_type"];
                    $arr["file_path"] = $row["file_path"];
                }
            }
        }
        return $arr;
    }
    function addTestContext($conn,$Arr){//apart test
        $context = getTxt($conn,$Arr["file_path"]);
        $items = array();
        $arr = explode('@',$context);
        foreach ($arr as $a){
            $item = array();
            $item['key'] = getNeedBetween($a, '（' , '）' );
            $item['A'] = getNeedBetween($a, 'A、' , 'B' );
            $item['B'] = getNeedBetween($a, 'B、' , 'C' );
            $item['C'] = getNeedBetween($a, 'C、' , 'D' );
            
            $item['D'] = strstr($a, 'D、');
            $item['D'] = substr($item['D'],4,strlen($item['D'])-4);
            
            $rep = "（".$item['key']."）";
            $item['context'] = str_replace($rep, "（）", $a);;
            $item['context'] = getNeedBetween($item['context'], '' , 'A');
            
            array_push($items,$item);
        }
        $Arr['test_context'] = $items;
        return $Arr;
    }
    function delTest($conn,$test_id){//delete test
        return deleteItem($conn,'test','test_id',$test_id);
    }
    //testing
    function upLevel($conn,$user_id,$test_id,$test_level){
        $Arr = array();
        $Arr['test_id']=$test_id;
        $Arr['test_level']=$test_level;
        $r=updateItemCols($conn, "level", $Arr," where (user_id='$user_id' and test_level<'$test_level')");
        return $r;
    }
    function addJoinTimes($conn,$user_id){
        $sql = "update level set joinTimes=joinTimes+'1' where (user_id='$user_id')";
        $r = $conn->query($sql) or die(mysqli_error($conn));
        return $r;
    }
    function minusJoinTimes($conn,$user_id){
        $sql = "update level set joinTimes=joinTimes-'1' where (user_id='$user_id')";
        $r = $conn->query($sql) or die(mysqli_error($conn));
        return $r;
    }
?>