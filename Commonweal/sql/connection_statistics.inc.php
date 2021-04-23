<?php 
    //statistics
    function visit(){//record visit statistics 
        $conn = dbConnect("write");
        date_default_timezone_set('PRC');
        $time = date("Y-m-d H").":00:00";
        if(findItemByOne($conn,"statistics","time",$time)){
            $result = getRow($conn,"statistics"," where time='$time'");
            foreach ($result as $row){
                $count = $row["count"];
            }
            updateItemCol($conn,"statistics","count",$count+1," where time='$time'");
        }
        else{
            $Arr=array();
            $Arr["time"]=$time;
            $Arr["count"]=1;
            insertRow($conn,"statistics","id",$Arr);
        }
        $conn->close();
    }
    function getVisit(){//get visit statistics
        $conn = dbConnect("read");
        $Arr=array();
        //visitSum
        $result = getRow($conn,"statistics");
        $visitSum = 0;
        foreach ($result as $row){
            $visitSum += (int)$row["count"];
        }
        $Arr["visitSum"]=$visitSum;
        //registerSum
        $result = getCount($conn,"user"," where user_type='1'");
        if ($result >= 0) $Arr['type1'] = $result;
        else $Arr['type1'] = 'error';
        $result = getCount($conn,"user"," where user_type='2'");
        if ($result >= 0) $Arr['type2'] = $result;
        else $Arr['type2'] = 'error';
        $result = getCount($conn,"user"," where user_type='3'");
        if ($result >= 0) $Arr['type3'] = $result;
        else $Arr['type3'] = 'error';
        $result = getCount($conn,"user"," where user_type='4'");
        if ($result >= 0) $Arr['type4'] = $result;
        else $Arr['type4'] = 'error';
        $conn->close();
        return $Arr;
    }
?>