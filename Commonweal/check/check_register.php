<?php
    if(!isset($_SESSION)) session_start();    
    
    $register_user=$_POST['register_user'];  
    $register_type=$_POST['register_type'];
    $register_password1=$_POST['register_password1'];
    $register_password2=$_POST['register_password2'];
    $register_codeNum=$_POST['register_codeNum'];
    function back($str, $type){
        $_SESSION['registerWinStat'] = $str;
        $_SESSION['registerWinType'] = (string)($type);
        $_SESSION['registerCity2'] = (isset($_POST['register2_city']))?$_POST['register2_city']:'0';
        $_SESSION['registerCity3'] = (isset($_POST['register3_city']))?$_POST['register3_city']:'0';
        $_SESSION['registerCity4'] = (isset($_POST['register4_city']))?$_POST['register4_city']:'0';
        $_SESSION['registerDistrict2'] = (isset($_POST['register2_district']))?$_POST['register2_district']:'0';
        $_SESSION['registerDistrict3'] = (isset($_POST['register3_district']))?$_POST['register3_district']:'0';
        $_SESSION['registerDistrict4'] = (isset($_POST['register4_district']))?$_POST['register4_district']:'0';
        
        echo "<script type='text/javascript'>
            history.back();
            </script>";
    }
    //base
    if($register_user == ""){
        echo"<script type='text/javascript'>
                alert('请输入用户名');
            </script>";
        back('register_user',$register_type);
        return;
    } 
    if(strlen($register_user)<6){
        echo"<script type='text/javascript'>
                alert('用户名必须大于6位');
            </script>";
        back('register_user',$register_type);
        return;
    }
    if($register_password1 == "" || $register_password2 == ""){
        echo"<script type='text/javascript'>
                alert('请输入密码');
            </script>";
        back('register_password1',$register_type);
        return;
    }
    if(strlen($register_password1)<6 || strlen($register_password1)<6){
        echo"<script type='text/javascript'>
                alert('密码必须大于6位');
            </script>";
        back('register_password1',$register_type);
        return;
    }
    if($register_password1 != $register_password2){
        echo"<script type='text/javascript'>
                alert('密码不一致');
            </script>"; 
        back('register_password1',$register_type);
        return;
    }
    if($register_codeNum != $_SESSION["codeNum"]){
        echo"<script type='text/javascript'>
                alert('验证码错误');
            </script>";
        back('register_password1',$register_type);
        return;
    }
    //details
    $file="";$file_name="";$file_type="";$file_path="";
    switch($register_type){
        case "2":{
            $register2_name=$_POST['register2_name'];
            $register2_sex=$_POST['register2_sex'];
            $register2_qualifications=$_POST['register2_qualifications'];
            $register2_birth=(string)$_POST['register2_birth_year'].sprintf('%02s', (string)$_POST['register2_birth_month'])
                    .sprintf('%02s', (string)$_POST['register2_birth_day']);
            $register2_province=$_POST['register2_province'];
            $register2_city=$_POST['register2_city'];
            $register2_district=$_POST['register2_district'];
            $register2_ad2=$_POST['register2_ad2'];
            $register2_phone=$_POST['register2_phone'];
            $register2_email=$_POST['register2_email'];
            $register2_work=$_POST['register2_work'];
            $register2_info=$_POST['register2_info'];
            if(!($register2_province=="0" && $register2_city=="0" && $register2_district=="0") &&
                !($register2_province!="0" && $register2_city!="0" && $register2_district!="0")){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整或不填');
                </script>";
                back('register2_province',$register_type);
                return;
            }
            break;
        }
        case "3":{
            $register3_name=$_POST['register3_name'];
            $register3_province=$_POST['register3_province'];
            $register3_city=$_POST['register3_city'];
            $register3_district=$_POST['register3_district'];
            $register3_ad2=$_POST['register3_ad2'];
            $register3_phone=$_POST['register3_phone'];
            $register3_email=$_POST['register3_email'];
            $register3_info=$_POST['register3_info'];

            if(!($register3_province=="0" && $register3_city=="0" && $register3_district=="0") &&
                !($register3_province!="0" && $register3_city!="0" && $register3_district!="0")){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整或不填');
                </script>";
                back('register3_province',$register_type);
                return;
            }            

            $file = $_FILES['register3_file'];
            if(!empty($file['tmp_name'])){
                $file_name=strstr($file['name'], '.', TRUE);
                $file_type=$file['type'];
                $file_path=$file['tmp_name'];
                switch ($file_type) {
                    case 'application/x-zip-compressed':
                        $file_type='rar';
                        break;
                    case 'application/octet-stream':
                        $file_type='zip';
                        break;
                    default:
                        echo"<script type='text/javascript'>
                            alert('请上传rar格式或者zip格式');
                        </script>";
                        back('register3_file',3);
                        return;
                }
                if($file['size'] > 1024*1024*20){
                    echo"<script type='text/javascript'>
                        alert('请上传文件大小请不要超过20M');
                     </script>";
                    back('register3_file',3);
                    return;
                }
            }
            break;
        }
        case "4":{
            $register4_name=$_POST['register4_name'];
            $register4_sex=$_POST['register4_sex'];
            $register4_birth=(string)$_POST['register4_birth_year'].sprintf('%02s', (string)$_POST['register4_birth_month'])
                    .sprintf('%02s', (string)$_POST['register4_birth_day']);
            $register4_province=$_POST['register4_province'];
            $register4_city=$_POST['register4_city'];
            $register4_district=$_POST['register4_district'];
            $register4_ad2=$_POST['register4_ad2'];
            $register4_phone=$_POST['register4_phone'];
            $register4_email=$_POST['register4_email'];
            $register4_info=$_POST['register4_info'];
        
            if(!($register4_province=="0" && $register4_city=="0" && $register4_district=="0") &&
                !($register4_province!="0" && $register4_city!="0" && $register4_district!="0")){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整或不填');
                </script>";
                back('register4_province',$register_type);
                return;
            }
            
            $file = $_FILES['register4_file'];
            if(!empty($file['tmp_name'])){
                $file_name=strstr($file['name'], '.', TRUE);
                $file_type=$file['type'];
                $file_path=$file['tmp_name'];
                switch ($file_type) {
                    case 'application/x-zip-compressed':
                        $file_type='rar';
                        break;
                    case 'application/octet-stream':
                        $file_type='zip';
                        break;
                    default:
                        echo"<script type='text/javascript'>
                            alert('请上传rar格式或者zip格式');
                        </script>";
                        back('register4_file',4);
                        return;
                }
                if($file['size'] > 1024*1024*20){
                    echo"<script type='text/javascript'>
                        alert('请上传文件大小请不要超过20M');
                     </script>";
                    back('register4_file',4);
                    return;
                }
            }
            break;
        }
    }

    //register
    require_once('../sql/connection.php');
    $conn = dbConnect('r&w');
    if(findItemByOne($conn, 'user', 'user_accounts', $register_user)){
        echo"<script type='text/javascript'>
                alert('帐号已存在');
            </script>";
        $conn->close();
        back('register_user',$register_type);
        return;
    }
    switch($register_type){
        case "1":{
            registerUser1($conn, $register_user, $register_password1, $register_type);
            $conn->close();
            echo"<script type='text/javascript'>
                        location.href = '../manage.php';
                    </script>";
            break;
        }
        case "2":{
            if(registerUser2($conn, $register_user, $register_password1,$register_type,
                $register2_name,$register2_sex,$register2_qualifications,$register2_birth,$register2_province,$register2_city,$register2_district,$register2_ad2,
                $register2_phone,$register2_email,$register2_work,$register2_info)){
                $_SESSION['user_accounts']=$register_user;
                loginGet($conn,$register_user);
                $conn->close();
                echo"<script type='text/javascript'>
                        location.href = '../home.php';
                    </script>";
            }
            else{
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
        case "3":{
            if(registerUser3($conn, $register_user, $register_password1,$register_type,
                $register3_name,$register3_province,$register3_city,$register3_district,$register3_ad2,
                $register3_phone,$register3_email,$register3_info,
                $file,$file_name,$file_type,$file_path)){
                $_SESSION['user_accounts']=$register_user;
                loginGet($conn,$register_user);
                $conn->close();
                echo"<script type='text/javascript'>
                        location.href = '../home.php';
                    </script>";
            }
            else{
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
        case "4":{
            if(registerUser4($conn, $register_user, $register_password1,$register_type,
                $register4_name,$register4_sex,$register4_birth,$register4_province,$register4_city,$register4_district,$register4_ad2,
                $register4_phone,$register4_email,$register4_info,
                $file,$file_name,$file_type,$file_path)){
                $_SESSION['user_accounts']=$register_user;
                loginGet($conn,$register_user);
                $conn->close();
                echo"<script type='text/javascript'>
                        location.href = '../home.php';
                    </script>";
            }
            else{
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
    }
?>  