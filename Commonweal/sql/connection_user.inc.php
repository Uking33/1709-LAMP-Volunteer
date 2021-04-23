<?php
    //User
    //login
    function loginCheck($conn, $user, $passwords){//login check
        $result = getRow($conn, 'user', "where user_accounts='$user'",'user_passwords');
        if($result == array())
            return -1;
        $num = $result->num_rows;
        if($num==1){
            foreach ($result as $row){
                if($row['user_passwords'] == $passwords)
                    return 1;
                else
                    return 0; 
            }
        }
        else
            return -1;
    }
    function loginGet($conn, $user){//login get info
        $result = getRow($conn, 'user', "where user_accounts='$user'");
        $num = $result->num_rows;
        if($num==1){
            foreach ($result as $row){
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['user_type']=$row['user_type'];
                $_SESSION['user_accounts']=$row['user_accounts'];
                $_SESSION['user_passwords']=$row['user_passwords'];
                $_SESSION['user_checked']=$row['checked'];
                $_SESSION['user_check_id']=$row['check_id'];
            }
            if($_SESSION['user_type']==2 || $_SESSION['user_type']==3 || $_SESSION['user_type']==4){
                $t_id=$_SESSION['user_id'];
                $sql = "SELECT * FROM user_details where user_id='$t_id'";
                $result = $conn->query($sql) or die(mysqli_error($conn));
                $num = $result->num_rows;
                if($num==1){
                    foreach ($result as $row){
                        switch($_SESSION['user_type']){
                            case 2:
                                $_SESSION['user_name']=$row['name'];
                                $_SESSION['user_sex']=$row['sex'];
                                $_SESSION['user_birth']=$row['birth'];
                                $_SESSION['user_qualifications']=$row['qualifications'];
                                $_SESSION['user_province']=$row['province'];
                                $_SESSION['user_city']=$row['city'];
                                $_SESSION['user_district']=$row['district'];
                                $_SESSION['user_ad2']=$row['ad2'];
                                $_SESSION['user_phone']=$row['phone'];
                                $_SESSION['user_email']=$row['email'];
                                $_SESSION['user_work']=$row['work'];
                                $_SESSION['user_info']=$row['info'];
                                break;
                            case 3:
                                $_SESSION['user_name']=$row['name'];
                                $_SESSION['user_province']=$row['province'];
                                $_SESSION['user_city']=$row['city'];
                                $_SESSION['user_district']=$row['district'];
                                $_SESSION['user_ad2']=$row['ad2'];
                                $_SESSION['user_phone']=$row['phone'];
                                $_SESSION['user_email']=$row['email'];
                                $_SESSION['user_info']=$row['info'];
                                $_SESSION['user_file_id']=$row['file_id'];
                                break;
                            case 4:
                                $_SESSION['user_name']=$row['name'];
                                $_SESSION['user_sex']=$row['sex'];
                                $_SESSION['user_birth']=$row['birth'];
                                $_SESSION['user_province']=$row['province'];
                                $_SESSION['user_city']=$row['city'];
                                $_SESSION['user_district']=$row['district'];
                                $_SESSION['user_ad2']=$row['ad2'];
                                $_SESSION['user_phone']=$row['phone'];
                                $_SESSION['user_email']=$row['email'];
                                $_SESSION['user_work']=$row['work'];
                                $_SESSION['user_info']=$row['info'];
                                $_SESSION['user_file_id']=$row['file_id'];
                                break;
                        }
                    }
                }
            }

            if($_SESSION['user_type']==2){
                $result = getRow($conn, 'level', " where user_id='$id'");
                $num = $result->num_rows;
                if($num>0){
                    foreach ($result as $row){
                        $_SESSION['user_test_id']=$row['test_id'];
                        $_SESSION['user_test_level']=$row['test_level'];
                        $_SESSION['user_joinTimes']=$row['joinTimes'];
                    }
                }
                else return false;
            }
            return true;
        }
        else return false;
    }
    //get
    function getAllUser($conn,$add=""){//get base user list
        $result = getRow($conn, 'user', $add);
        $num = $result->num_rows;
        $Arr=array();
        if($num>=1){
            foreach ($result as $row){
                $arr=array();
                $arr['user_id']=$row['user_id'];
                $arr['user_type']=$row['user_type'];
                $arr['user_accounts']=$row['user_accounts'];
                $arr['user_passwords']=$row['user_passwords'];
                $arr['checked']=$row['checked'];
                $arr['check_id']=$row['check_id'];            
                array_push($Arr,$arr);
            }
        }
        else {
            return array();
        }
        return $Arr;
    }
    function getUserList($conn,$add=""){//get user list
        $result = getRow($conn, 'user', $add);
        $num = $result->num_rows;
        $Arr=array();
        if($num>=1){
            foreach ($result as $row){
                $arr=array();
                $arr['user_id']=$row['user_id'];
                $arr['user_type']=$row['user_type'];
                $arr['user_accounts']=$row['user_accounts'];
                $arr['user_passwords']=$row['user_passwords'];
                $arr['checked']=$row['checked'];
                $arr['check_id']=$row['check_id']; 
                $id = $arr['user_id'];
                if($arr['user_type'] != 1){
                    $sql = "SELECT * FROM user_details where user_id='$id'";
                    $result = $conn->query($sql) or die(mysqli_error($conn));
                    $num = $result->num_rows;
                    if($num==1){
                        foreach ($result as $row){
                            $arr['user_name']=$row['name'];
                            $arr['user_info']=$row['info'];
                        }
                    }         
                }
                array_push($Arr,$arr);
            }
        }
        else {
            return array();
        }
        return $Arr;
    }
    function getUserDetails($conn,$id){
        $arr=array();
        $result = getRow($conn, 'user', " where user_id='$id'");
        $num = $result->num_rows;
        if($num==1){
            foreach ($result as $row){
                $arr['user_id']=$row['user_id'];
                $arr['user_type']=$row['user_type'];
                $arr['user_accounts']=$row['user_accounts'];
                $arr['user_passwords']=$row['user_passwords'];
                $arr['user_checked']=$row['checked'];
                $arr['user_check_id']=$row['check_id'];
            }
            if($arr['user_type']=='2' || $arr['user_type']=='3' || $arr['user_type']=='4'){
                $result = getRow($conn, 'user_details', " where user_id='$id'");
                $num = $result->num_rows;
                if($num==1){
                    switch($arr['user_type']){
                        case '2':
                            foreach ($result as $row){
                                $arr['user_name']=$row['name'];
                                $arr['user_sex']=$row['sex'];
                                $arr['user_birth']=$row['birth'];
                                $arr['user_qualifications']=$row['qualifications'];
                                $arr['user_province']=$row['province'];
                                $arr['user_city']=$row['city'];
                                $arr['user_district']=$row['district'];
                                $arr['user_ad2']=$row['ad2'];
                                $arr['user_phone']=$row['phone'];
                                $arr['user_email']=$row['email'];
                                $arr['user_work']=$row['work'];
                                $arr['user_info']=$row['info'];
                            }
                            break;
                        case '3':
                            foreach ($result as $row){
                                $arr['user_name']=$row['name'];
                                $arr['user_province']=$row['province'];
                                $arr['user_city']=$row['city'];
                                $arr['user_district']=$row['district'];
                                $arr['user_ad2']=$row['ad2'];
                                $arr['user_phone']=$row['phone'];
                                $arr['user_email']=$row['email'];
                                $arr['user_info']=$row['info'];
                                $arr['user_file_id']=$row['file_id'];
                            }
                            break;
                        case '4':
                            foreach ($result as $row){
                                $arr['user_name']=$row['name'];
                                $arr['user_sex']=$row['sex'];
                                $arr['user_birth']=$row['birth'];
                                $arr['user_province']=$row['province'];
                                $arr['user_city']=$row['city'];
                                $arr['user_district']=$row['district'];
                                $arr['user_ad2']=$row['ad2'];
                                $arr['user_phone']=$row['phone'];
                                $arr['user_email']=$row['email'];
                                $arr['user_work']=$row['work'];
                                $arr['user_info']=$row['info'];
                                $arr['user_file_id']=$row['file_id'];
                            }
                            break;
                    }
                }
                else return array();
                if($arr['user_type']==2){
                    $result = getRow($conn, 'level', " where user_id='$id'");
                    $num = $result->num_rows;
                    if($num>0){
                        foreach ($result as $row){
                            $arr['user_test_id']=$row['test_id'];
                            $arr['user_test_level']=$row['test_level'];
                            $arr['user_joinTimes']=$row['joinTimes'];
                        }
                    }
                    else return array();
				}
            }
            return $arr;
        }
        else return array();
    }
    
    //register
    function registerUser1($conn,$user,$passwords,$type){
        $Arr=array();
        $Arr['user_type']=$type;
        $Arr['user_accounts']=$user;
        $Arr['user_passwords']=$passwords;
        $Arr['checked']=1;
        $Arr['check_id']='';
        $num = insertRow($conn,"user","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";   
            return false;  
        }
        echo"<script type='text/javascript'>
                    alert('注册成功。管理员的编号为：".trID($num,1)."。帐号：".$user."，密码：".$passwords."');
                </script>";
        return true;
    }
    function registerUser2($conn,$user,$passwords,$type,
        $name,$sex,$qualifications,$birth,$province,$city,$district,$ad2,
        $phone,$email,$work,$info){
        $Arr=array();
        $Arr['user_type']=$type;
        $Arr['user_accounts']=$user;
        $Arr['user_passwords']=$passwords;
        $Arr['checked']=0;
        $Arr['check_id']='';
        $num = insertRow($conn,"user","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        $Arr=array();
        $Arr['user_id']=$num;
        $Arr['user_type']=$type;
        $Arr['name']=$name;
        $Arr['sex']=$sex;
        $Arr['birth']=$birth;
        $Arr['qualifications']=$qualifications;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['work']=$work;
        $Arr['info']=$info;
        $num = insertRow($conn,"user_details","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        $Arr=array();
        $Arr['user_id']=$num;
        $Arr['test_id']="";
        $Arr['test_level']="0";
        $Arr['joinTimes']=0;
        $num = insertRow($conn,"level","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('注册成功。你的编号为：".trID($num,2)."。若没完成信息，请尽快到信息栏完善信息；若完善信息，请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;
    }
    function registerUser3($conn,$user,$passwords,$type,
        $name,$province,$city,$district,$ad2,
        $phone,$email,$info,
        $file,$file_name,$file_type,$file_path){
        $Arr=array();
        $Arr['user_type']=$type;
        $Arr['user_accounts']=$user;
        $Arr['user_passwords']=$passwords;
        $Arr['checked']=0;
        $Arr['check_id']='';
        $num = insertRow($conn,"user","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        //file dir
        createFile(trID($num,'3'));
        if(!empty($file['tmp_name'])){
            //file move
            $save_path = trID($num,'3')."/".$file_name.'.'.$file_type;
            moveFile($file_path, $save_path);
            //file sql            
            $Arr=array();
            $Arr['user_id']=$num;
            $Arr['user_type']=$type;
            $Arr['file_name']=$file_name;
            $Arr['file_type']=$file_type;
            $Arr['file_path']=$save_path;
            $fileID = insertRow($conn,"file","file_id",$Arr);
            if($fileID<0){
                echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
                return false;
            }
        }
        //details
        $Arr=array();
        $Arr['user_id']=$num;
        $Arr['user_type']=$type;
        $Arr['name']=$name;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['info']=$info;
        if(!empty($file['tmp_name'])) $Arr['file_id']=$fileID; else $Arr['file_id']=-1;
        $num = insertRow($conn,"user_details","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('注册成功。你的编号为：".trID($num,3)."。若没完成信息，请尽快到信息栏完善信息；若完善信息，请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;
    }
    function registerUser4($conn,$user,$passwords,$type,
        $name,$sex,$birth,$province,$city,$district,$ad2,
        $phone,$email,$info,
        $file,$file_name,$file_type,$file_path){
        $Arr=array();
        $Arr['user_type']=$type;
        $Arr['user_accounts']=$user;
        $Arr['user_passwords']=$passwords;
        $Arr['checked']=0;
        $Arr['check_id']='';
        $num = insertRow($conn,"user","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        //file dir
        createFile(trID($num,'4'));
        //file move
        if(!empty($file['tmp_name'])){
            $save_path = trID($num,'4')."/".$file_name.'.'.$file_type;
            moveFile($file_path,$save_path);
            //file sql
            $Arr=array();
            $Arr['user_id']=$num;
            $Arr['user_type']=$type;
            $Arr['file_name']=$file_name;
            $Arr['file_type']=$file_type;
            $Arr['file_path']=$save_path;
            $fileID = insertRow($conn,"file","file_id",$Arr);
            if($fileID<0){
                echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
                return false;
            }
        }
        //details
        $Arr=array();
        $Arr['user_id']=$num;
        $Arr['user_type']=$type;
        $Arr['name']=$name;
        $Arr['sex']=$sex;
        $Arr['birth']=$birth;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['info']=$info;
        if(!empty($file['tmp_name'])) $Arr['file_id']=$fileID; else $Arr['file_id']=-1;
        $num = insertRow($conn,"user_details","user_id",$Arr);
        if($num<0){
            echo"<script type='text/javascript'>
                        alert('注册失败。请联系管理员或稍后重试。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('注册成功。你的编号为：".trID($num,4)."。若没完成信息，请尽快到信息栏完善信息；若完善信息，请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;
    }
    

    //edit
    function editUser1($conn,$user_id,$passwords){
        $result = updateItemCol($conn,"user",'user_passwords',$passwords," where user_id='$user_id'");
        if($result){
            echo"<script type='text/javascript'>
                        alert('修改密码成功。');
                    </script>";
            $_SESSION['user_passwords']=$passwords;
            return true;
        }
        else{
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
    }
    function editUser2($conn,$user_id,$passwords,
        $name,$sex,$qualifications,$birth,$province,$city,$district,$ad2,
        $phone,$email,$work,$info){
        $result = updateItemCol($conn,"user",'user_passwords',$passwords," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        $Arr=array();
        $Arr['name']=$name;
        $Arr['sex']=$sex;
        $Arr['birth']=$birth;
        $Arr['qualifications']=$qualifications;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['work']=$work;
        $Arr['info']=$info;
        $result = updateItemCols($conn,"user_details",$Arr," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        
        $result = updateItemCols($conn,"user_details",$Arr," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('修改成功。请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;
    }
    function editUser3($conn,$user_id,$passwords,$type,
        $name,$province,$city,$district,$ad2,
        $phone,$email,$info,
        $file,$file_name,$file_type,$file_path){
        $result = updateItemCol($conn,"user",'user_passwords',$passwords," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        if(!empty($file['tmp_name'])){
			$fileID = -1;
			//file clean
			$result = getRow($conn,'user_details'," where user_id='$user_id'",'file_id');
            $num = $result->num_rows;
            if(!$result){
                echo"<script type='text/javascript'>
                            alert('修改失败。');
                        </script>";
                return false;
            }
            foreach ($result as $row){
                $fileID=$row['file_id'];
			}
			if($fileID>0){	
    			$result = deleteItem($conn,'file','file_id',$fileID);
                if(!$result){
                    echo"<script type='text/javascript'>
                                alert('修改失败。');
                            </script>";
                    return false;
                }
    			$result = cleanFile(trID($user_id,'3'));
			}
            //file move
            $save_path = trID($user_id,'3')."/".$file_name.'.'.$file_type;
            moveFile($file_path, $save_path);
            //file sql
            $Arr=array();
            $Arr['user_id']=$num;
            $Arr['user_type']=$type;
            $Arr['file_name']=$file_name;
            $Arr['file_type']=$file_type;
            $Arr['file_path']=$save_path;
            $fileID = insertRow($conn,"file","file_id",$Arr);
            if($fileID<0){
                echo"<script type='text/javascript'>
                            alert('修改失败。');
                        </script>";
                return false;
            }
        }
        //details
        $Arr=array();
        $Arr['user_id']=$user_id;
        $Arr['user_type']=$type;
        $Arr['name']=$name;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['info']=$info;
        if(!empty($file['tmp_name'])) $Arr['file_id']=$fileID; else $Arr['file_id']=-1;
        $result = updateItemCols($conn,"user_details",$Arr," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('修改成功。请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;           
    }
    function editUser4($conn,$user_id,$passwords,$type,
        $name,$sex,$birth,$province,$city,$district,$ad2,
        $phone,$email,$info,
        $file,$file_name,$file_type,$file_path){
        $result = updateItemCol($conn,"user",'user_passwords',$passwords," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        if(!empty($file['tmp_name'])){
			$fileID = -1;
			//file clean
			$result = getRow($conn,'user_details'," where user_id='$user_id'",'file_id');
            $num = $result->num_rows;
            if(!$result){
                echo"<script type='text/javascript'>
                            alert('修改失败。');
                        </script>";
                return false;
            }
            foreach ($result as $row){
                $fileID=$row['file_id'];
			}
			if($fileID>0){	
    			$result = deleteItem($conn,'file','file_id',$fileID);
                if(!$result){
                    echo"<script type='text/javascript'>
                                alert('修改失败。');
                            </script>";
                    return false;
                }
    			$result = cleanFile(trID($user_id,'4'));
			}
            //file move
            $save_path = trID($user_id,'4')."/".$file_name.'.'.$file_type;
            moveFile($file_path, $save_path);
            //file sql
            $Arr=array();
            $Arr['user_id']=$num;
            $Arr['user_type']=$type;
            $Arr['file_name']=$file_name;
            $Arr['file_type']=$file_type;
            $Arr['file_path']=$save_path;
            $fileID = insertRow($conn,"file","file_id",$Arr);
            if($fileID<0){
                echo"<script type='text/javascript'>
                            alert('修改失败。');
                        </script>";
                return false;
            }
        }
        //details
        $Arr=array();
        $Arr['user_id']=$user_id;
        $Arr['user_type']=$type;
        $Arr['name']=$name;
        $Arr['sex']=$sex;
        $Arr['birth']=$birth;
        $Arr['province']=$province;
        $Arr['city']=$city;
        $Arr['district']=$district;
        $Arr['ad2']=$ad2;
        $Arr['phone']=$phone;
        $Arr['email']=$email;
        $Arr['info']=$info;
        if(!empty($file['tmp_name'])) $Arr['file_id']=$fileID; else $Arr['file_id']=-1;
        $result = updateItemCols($conn,"user_details",$Arr," where user_id='$user_id'");
        if(!$result){
            echo"<script type='text/javascript'>
                        alert('修改失败。');
                    </script>";
            return false;
        }
        echo"<script type='text/javascript'>
            alert('修改成功。请等待管理员的审核，管理员会在24小时内进行审核。');
        </script>";
        return true;    
    }
    
    //manage user check
    function checkUser($id){
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"user",'checked',1," where user_id='$id'");
        $r2=updateItemCol($conn,"user",'check_id',$_SESSION['user_id']," where user_id='$id'");
        $conn->close();
        return $r1 & $r2;
    }
    function passUser($id){
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"user",'checked',2," where user_id='$id'");
        $r2=updateItemCol($conn,"user",'check_id',$_SESSION['user_id']," where user_id='$id'");
        $conn->close();
        return $r1 & $r2;
    }
    function coverUser($id){
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"user",'checked',3," where user_id='$id'");
        $r2=updateItemCol($conn,"user",'check_id',$_SESSION['user_id']," where user_id='$id'");
        $conn->close();
        return $r1 & $r2;
    }
    function uncoverUser($id){
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"user",'checked',1," where user_id='$id'");
        $r2=updateItemCol($conn,"user",'check_id',$_SESSION['user_id']," where user_id='$id'");
        $conn->close();
        return $r1 & $r2;
    }
    function closeUser($id){
        $conn = dbConnect('write');
        $r=updateItemCol($conn,"user",'checked',4," where user_id='$id'");
        $conn->close();
        return $r;
    }
    function opennUser($id){
        $conn = dbConnect('write');
        $r1=updateItemCol($conn,"user",'checked',0," where user_id='$id'");
        $r2=updateItemCol($conn,"user",'check_id',''," where user_id='$id'");
        $conn->close();
        return $r1 & $r2;
    }
?>