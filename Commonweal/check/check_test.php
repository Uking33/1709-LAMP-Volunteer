<?php
    if(!isset($_SESSION)) session_start();    
    $test_name=$_POST['test_name'];  
    $test_level=$_POST['test_level'];
    function back($str){
        $_SESSION['testWinStat'] = $str;
        echo "<script type='text/javascript'>history.back();</script>";
    }
    //details
    $file="";$filename="";$filetype="";$file_path="";
    
    if($test_name == ""){
        echo"<script type='text/javascript'>
            alert('请输入套题名称');
        </script>";
        back('test_name');
        return;
    }
    if($test_level=="0"){
        echo"<script type='text/javascript'>
            alert('请输入套题等级');
        </script>";
        back('test_level');
        return;
    }

    $file = $_FILES['test_file'];
    if($file==""){
        echo"<script type='text/javascript'>
                alert('请上传题目文件');
            </script>";
        back('test_file');
        return;
    }
    else {
        $file_name=strstr($file['name'], '.', TRUE);
        $file_type=$file['type'];
        $file_path=$file['tmp_name'];
        switch ($file_type) {
            case 'text/plain':
                $file_type='txt';
                break;
            default:
                echo"<script type='text/javascript'>
                    alert('请上传txt格式');
                </script>";
                back('test_file');
                return;
        }
        if($file['size'] > 1024*1024*20){
            echo"<script type='text/javascript'>
                alert('请上传文件大小请不要超过20M');
             </script>";
            back('test_file');
            return;
        }
    }

    //upload
    require_once('../sql/connection.php');
    $conn = dbConnect('r&w');
    if(testCheck($conn, $test_name)){
        echo"<script type='text/javascript'>
                alert('题目已上传');
            </script>";
        $conn->close();
        back('test_file');
        return;
    }
    if(addTest($conn, $_SESSION['user_id'], $test_name, $test_level,
        $file,$file_name,$file_type,$file_path)){        
        $conn->close();
        echo"<script type='text/javascript'>
                location.href = '../test.php';
            </script>";
    }
    else{
        echo"<script type='text/javascript'>
                history.back();
            </script>";
    }
?>  