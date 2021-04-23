<?php 
    //file
    function createFile($str){//create file
        $dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/files/".$str);
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
    }
    function moveTest($file_path,$save_name){//cut the test
        $file_path=iconv("UTF-8","gb2312", $file_path);
        $save_name=iconv("UTF-8","gb2312", $save_name);
        $save_path = $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/tests/".$save_name;
        if (file_exists($save_path)){
            echo"<script type='text/javascript'>
                    alert('文件已上传过');
                    </script>";
            return false;
        }
        else
        {
            move_uploaded_file($file_path,$save_path);
        }
    }
    function moveFile($file_path,$save_name){//cut the file
        $file_path=iconv("UTF-8","gb2312", $file_path);
        $save_name=iconv("UTF-8","gb2312", $save_name);
        $save_path = $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/files/".$save_name;
        if (file_exists($save_path)){
            echo"<script type='text/javascript'>
                    alert('文件已上传过，请联系管理员');
                    </script>";
            return false;
        }
        else
        {
            move_uploaded_file($file_path,$save_path);
        }
    }
    function cleanFile($dirName){
        $dirName = $_SERVER['DOCUMENT_ROOT']."/Commonweal/data/files/".$dirName;
        if(file_exists($dirName) && $handle=opendir($dirName)){
            while(false!==($item = readdir($handle))){
                if($item!= "." && $item != ".."){
                    if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                        delFile($dirName.'/'.$item);
                    }
                    else{
                        if(unlink($dirName.'/'.$item)){
                            return true;
                        }
                    }
                }
            }
            closedir( $handle);
        }
        return false;
    }
    
    function getFile($conn,$file_id){//get info file
        $result = getRow($conn, 'file', "where file_id='$file_id'");
        $Arr=array();
        foreach ($result as $row){
            $Arr["file_id"] = $file_id;
            $Arr["user_id"] = $row["user_id"];
            $Arr["user_type"] = $row["user_type"];
            $Arr["file_name"] = $row["file_name"];
            $Arr["file_type"] = $row["file_type"];
            $Arr["file_path"] = $row["file_path"];
        }
        return $Arr;
    }
    function getTxt($conn,$file_path){//get txt file
        $path=$_SERVER['DOCUMENT_ROOT']."/Commonweal/data/tests/".$file_path;
        $myfile = fopen($path, "r") or die("Unable to open file!");
        $context = fread($myfile,filesize($path));
        fclose($myfile);
        return characet($context);
    }
?>