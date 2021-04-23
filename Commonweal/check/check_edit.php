<?php
    if(!isset($_SESSION)) session_start();    
    
    $edit_id=$_POST['edit_id'];  
    $edit_user=$_POST['edit_user'];
    $edit_type=$_POST['edit_type'];
    $edit_password0=$_POST['edit_password0'];
    $edit_password1=$_POST['edit_password1'];
    $edit_password2=$_POST['edit_password2'];
    function back($str){
        $_SESSION['editWinStat'] = $str;
        $_SESSION['editCity2'] = (isset($_POST['edit2_city']))?$_POST['edit2_city']:'0';
        $_SESSION['editCity3'] = (isset($_POST['edit3_city']))?$_POST['edit3_city']:'0';
        $_SESSION['editCity4'] = (isset($_POST['edit4_city']))?$_POST['edit4_city']:'0';
        $_SESSION['editDistrict2'] = (isset($_POST['edit2_district']))?$_POST['edit2_district']:'0';
        $_SESSION['editDistrict3'] = (isset($_POST['edit3_district']))?$_POST['edit3_district']:'0';
        $_SESSION['editDistrict4'] = (isset($_POST['edit4_district']))?$_POST['edit4_district']:'0';
        
        echo "<script type='text/javascript'>
            history.back();
            </script>";
    }
    //base
    if($edit_password0 == ""){
        echo"<script type='text/javascript'>
                alert('请输入原始密码');
            </script>";
        back('edit_password0');
        return;
    }
    if(($edit_password1!=""&&$edit_password2=="") || ($edit_password1==""&&$edit_password2!="")){
        echo"<script type='text/javascript'>
                alert('新密码要填齐');
            </script>";
        back('edit_password0');
        return;
    }
    if(strlen($edit_password0)<6 || ($edit_password1!="" && strlen($edit_password1)<6 ) || ($edit_password2!="" && strlen($edit_password2)<6 )){
        echo"<script type='text/javascript'>
                alert('密码必须大于6位');
            </script>";
        back('edit_password0');
        return;
    }
    if($edit_password1 != $edit_password2){
        echo"<script type='text/javascript'>
                alert('密码不一致');
            </script>"; 
        back('edit_password0');
        return;
    }
    //details
    $file="";$file_name="";$file_type="";$file_path="";
    switch($edit_type){
        case "2":{
            $edit2_name=$_POST['edit2_name'];
            $edit2_sex=$_POST['edit2_sex'];
            $edit2_qualifications=$_POST['edit2_qualifications'];
            $edit2_birth=(string)$_POST['edit2_birth_year'].sprintf('%02s', (string)$_POST['edit2_birth_month'])
                    .sprintf('%02s', (string)$_POST['edit2_birth_day']);
            $edit2_province=$_POST['edit2_province'];
            $edit2_city=$_POST['edit2_city'];
            $edit2_district=$_POST['edit2_district'];
            $edit2_ad2=$_POST['edit2_ad2'];
            $edit2_phone=$_POST['edit2_phone'];
            $edit2_email=$_POST['edit2_email'];
            $edit2_work=$_POST['edit2_work'];
            $edit2_info=$_POST['edit2_info'];
            if($edit2_name == ""){
                echo"<script type='text/javascript'>
                    alert('请输入真实姓名');
                </script>";
                back('edit2_name');
                return;
            }
            if($edit2_qualifications==0){
                echo"<script type='text/javascript'>
                    alert('请把学历信息填写完整');
                </script>";
                back('edit2_qualifications');
                return;
            }
            if($edit2_province=="0" || $edit2_city=="0" || $edit2_district=="0"){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整');
                </script>";
                back('edit2_province');
                return;
            }
            if($edit2_ad2==""){
                echo"<script type='text/javascript'>
                    alert('请输入地址信息');
                </script>";
                back('edit2_ad2');
                return;
            }
            if($edit2_phone==""){
                echo"<script type='text/javascript'>
                    alert('请输入联系电话');
                </script>";
                back('edit2_phone');
                return;
            }
            if($edit2_email==""){
                echo"<script type='text/javascript'>
                    alert('请输入邮箱地址');
                </script>";
                back('edit2_email');
                return;
            }
            if($edit2_work==""){
                echo"<script type='text/javascript'>
                    alert('请输入工作内容');
                </script>";
                back('edit2_work');
                return;
            }
            if($edit2_info==""){
                echo"<script type='text/javascript'>
                    alert('请输入个人介绍');
                </script>";
                back('edit2_info');
                return;
            }
            break;
        }
        case "3":{
            $edit3_name=$_POST['edit3_name'];
            $edit3_province=$_POST['edit3_province'];
            $edit3_city=$_POST['edit3_city'];
            $edit3_district=$_POST['edit3_district'];
            $edit3_ad2=$_POST['edit3_ad2'];
            $edit3_phone=$_POST['edit3_phone'];
            $edit3_email=$_POST['edit3_email'];
            $edit3_info=$_POST['edit3_info'];
            
            if($edit3_name == ""){
                echo"<script type='text/javascript'>
                    alert('请输入真实姓名');
                </script>";
                back('edit3_name');
                return;
            }
            if($edit3_province=="0" || $edit3_city=="0" || $edit3_district=="0"){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整');
                </script>";
                back('edit3_province');
                return;
            }
            if($edit3_ad2==""){
                echo"<script type='text/javascript'>
                    alert('请输入地址信息');
                </script>";
                back('edit3_ad2');
                return;
            }
            if($edit3_phone==""){
                echo"<script type='text/javascript'>
                    alert('请输入联系电话');
                </script>";
                back('edit3_phone');
                return;
            }
            if($edit3_email==""){
                echo"<script type='text/javascript'>
                    alert('请输入邮箱地址');
                </script>";
                back('edit3_email');
                return;
            }
            if($edit3_info==""){
                echo"<script type='text/javascript'>
                    alert('请输入公司简介');
                </script>";
                back('edit3_info');
                return;
            }

            $file = $_FILES['edit3_file'];
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
                        back('edit3_file');
                        return;
                }
                if($file['size'] > 1024*1024*20){
                    echo"<script type='text/javascript'>
                        alert('请上传文件大小请不要超过20M');
                     </script>";
                    back('edit3_file');
                    return;
                }
            }
            break;
        }
        case "4":{
            $edit4_name=$_POST['edit4_name'];
            $edit4_sex=$_POST['edit4_sex'];
            $edit4_birth=(string)$_POST['edit4_birth_year'].sprintf('%02s', (string)$_POST['edit4_birth_month'])
                    .sprintf('%02s', (string)$_POST['edit4_birth_day']);
            $edit4_province=$_POST['edit4_province'];
            $edit4_city=$_POST['edit4_city'];
            $edit4_district=$_POST['edit4_district'];
            $edit4_ad2=$_POST['edit4_ad2'];
            $edit4_phone=$_POST['edit4_phone'];
            $edit4_email=$_POST['edit4_email'];
            $edit4_info=$_POST['edit4_info'];
            if($edit4_name == ""){
                echo"<script type='text/javascript'>
                    alert('请输入真实姓名');
                </script>";
                back('edit4_name');
                return;
            }
            if($edit4_province=="0" || $edit4_city=="0" || $edit4_district=="0"){
                echo"<script type='text/javascript'>
                    alert('请把地区信息填写完整');
                </script>";
                back('edit4_province');
                return;
            }
            if($edit4_ad2==""){
                echo"<script type='text/javascript'>
                    alert('请输入地址信息');
                </script>";
                back('edit4_ad2');
                return;
            }
            if($edit4_phone==""){
                echo"<script type='text/javascript'>
                    alert('请输入联系电话');
                </script>";
                back('edit4_phone');
                return;
            }
            if($edit4_email==""){
                echo"<script type='text/javascript'>
                    alert('请输入邮箱地址');
                </script>";
                back('edit4_email');
                return;
            }
            if($edit4_info==""){
                echo"<script type='text/javascript'>
                    alert('请输入求助原因');
                </script>";
                back('edit4_info');
                return;
            }

            $file = $_FILES['edit4_file'];
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
                        back('edit4_file');
                        return;
                }
                if($file['size'] > 1024*1024*20){
                    echo"<script type='text/javascript'>
                        alert('请上传文件大小请不要超过20M');
                     </script>";
                    back('edit4_file');
                    return;
                }
            }
            break;
        }
    }

    //edit
    require_once('../sql/connection.php');
    $conn = dbConnect('r&w');
    $result = loginCheck($conn,$edit_user,$edit_password0);
    if($result == '-1'){
        echo"<script type='text/javascript'>
                        alert('系统出错，请联系管理员');
                     </script>";
        back('$edit_password0');
        return;
    }
    if($result == '0'){
        echo"<script type='text/javascript'>
                        alert('原始密码错误');
                     </script>";
        back('$edit_password0');
        return;
    }
    switch($edit_type){
        case "1":{
            if($edit_password1==""){
                $conn->close();
                echo"<script type='text/javascript'>
                    alert('请不要调戏系统');
                    location.href = '../info.php?id=$edit_id&back=home.php';
                    </script>";
                break;
            }
            if(editUser1($conn, $edit_id, $edit_password1)){
                $conn->close();
                echo"<script type='text/javascript'>
                location.href = '../info.php?id=$edit_id&back=home.php';
                </script>";
            }
            else{
                $conn->close();
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
        case "2":{
            if($edit_password1!="")
                $password = $edit_password1;
            else
                $password = $edit_password0;
            if(editUser2($conn, $edit_id, $password,
                $edit2_name,$edit2_sex,$edit2_qualifications,$edit2_birth,$edit2_province,$edit2_city,$edit2_district,$edit2_ad2,
                $edit2_phone,$edit2_email,$edit2_work,$edit2_info)){
                loginGet($conn,$edit_user);
                $conn->close();
                echo"<script type='text/javascript'>
                location.href = '../info.php?id=$edit_id&back=home.php';
                </script>";
            }
            else{
                $conn->close();
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
        case "3":{
            if($edit_password1!="")
                $password = $edit_password1;
            else
                $password = $edit_password0;
            if(editUser3($conn, $edit_id, $password, $edit_type,
                $edit3_name,$edit3_province,$edit3_city,$edit3_district,$edit3_ad2,
                $edit3_phone,$edit3_email,$edit3_info,
                $file,$file_name,$file_type,$file_path)){
                loginGet($conn,$edit_user);
                $conn->close();
                echo"<script type='text/javascript'>
                location.href = '../info.php?id=$edit_id&back=home.php';
                </script>";
            }
            else{
                $conn->close();
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
        case "4":{
            if($edit_password1!="")
                $password = $edit_password1;
            else
                $password = $edit_password0;
            if(editUser4($conn, $edit_id, $password, $edit_type,
                $edit4_name,$edit4_sex,$edit4_birth,$edit4_province,$edit4_city,$edit4_district,$edit4_ad2,
                $edit4_phone,$edit4_email,$edit4_info,
                $file,$file_name,$file_type,$file_path)){
                loginGet($conn,$edit_user);
                $conn->close();
                echo"<script type='text/javascript'>
                location.href = '../info.php?id=$edit_id&back=home.php';
                </script>";
            }
            else{
                $conn->close();
                echo"<script type='text/javascript'>
                        history.back();
                    </script>";
            }
            break;
        }
    }
?>  