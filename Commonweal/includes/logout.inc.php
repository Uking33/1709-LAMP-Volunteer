<?php 
    if(!isset($_SESSION)) session_start();
    switch($_SESSION['user_type']){
        case 1:
            unset($_SESSION['all_users']);
            break;
        case 2:
            unset($_SESSION['user_name']);
            unset($_SESSION['user_sex']);
            unset($_SESSION['user_birth']);
            unset($_SESSION['user_qualifications']);
            unset($_SESSION['user_province']);
            unset($_SESSION['user_city']);
            unset($_SESSION['user_district']);
            unset($_SESSION['user_ad2']);
            unset($_SESSION['user_phone']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_work']);
            unset($_SESSION['user_info']);
            break;
        case 3:
            unset($_SESSION['user_name']);
            unset($_SESSION['user_province']);
            unset($_SESSION['user_city']);
            unset($_SESSION['user_district']);
            unset($_SESSION['user_ad2']);
            unset($_SESSION['user_phone']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_info']);
            unset($_SESSION['file_id']);
            break;
        case 4:
            unset($_SESSION['user_name']);
            unset($_SESSION['user_sex']);
            unset($_SESSION['user_birth']);
            unset($_SESSION['user_province']);
            unset($_SESSION['user_city']);
            unset($_SESSION['user_district']);
            unset($_SESSION['user_ad2']);
            unset($_SESSION['user_phone']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_work']);
            unset($_SESSION['user_info']);
            unset($_SESSION['file_id']);
            break;
    }
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['user_accounts']);
    unset($_SESSION['user_passwords']);;
    unset($_SESSION['user_checked']);;
    unset($_SESSION['user_check_id']);
    unset($_SESSION['user_addition']);
    
    echo "<script language='JavaScript' type='text/javascript'>
          	window.location.href='../home.php';
        </script>";
?>