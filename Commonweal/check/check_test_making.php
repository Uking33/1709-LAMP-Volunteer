<?php
    require_once('../sql/connection.php');
    require_once ('../includes/getdata.inc.php');
    if(isset($_POST['tested'])){
        //load data
        if(isset($_POST['id'])){
            $test_id = $_POST['id'];
            $conn = dbConnect('read');
            $Arr = getTestDetail($conn,$test_id);
            $Arr = addTestContext($conn,$Arr);
        }
        //check
        $num = $_POST['testnum'];
        for($i=1;$i<=$num;$i++){
            if (!isset($_POST['item_'.$i])){
                echo "<script type='text/javascript'>alert('请把试卷填完')</script>";
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
                return;
            }
        }
        //answer
        $sum = 0;
        $i = 0;
        foreach ($Arr['test_context'] as $item){
            $i++;
            if ($_POST['item_'.$i]==$item['key'])
                $sum++;
        }
        $grade = floor($sum/$num*100);
        if($grade>=90){
            upLevel($conn,$_SESSION['user_id'],$Arr['test_id'],$Arr['test_level']);
            $conn->close();
            echo "<script type='text/javascript'>alert('已提交,分数为$grade,考核成功')</script>";
            echo"<script type='text/javascript'>
                    location.href='../test_details.php?id=$test_id&back=test.php';
                </script>";
        }
        else{
            $conn->close();
            echo "<script type='text/javascript'>alert('已提交,分数为$grade,没过90分，考核失败')</script>";
            echo"<script type='text/javascript'>
                    location.href='../test.php';
                </script>";
        }
    }
?>  