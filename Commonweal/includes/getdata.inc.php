<?php
    //get php/url data
    //transfer string
    if(!isset($_SESSION)) session_start();
    //transfer
    function urlCode($str){
        $order = '&';
        $replace = '!';
        $text=str_replace($order, $replace, $str);
        $order = '=';
        $replace = '@';
        $text=str_replace($order, $replace, $text);
        return $text;
    }
    function urlUncode($str){
        $order = '!';
        $replace = '&';

        $text=str_replace($order, $replace, $str);
        $order = '@';
        $replace = '=';
        $text=str_replace($order, $replace, $text);
        return $text;
    }
    function isCode($str){
        return strpos($str,'!');            
    }
    function tr($str){//transfer
        return mb_convert_encoding ($str,'UTF-8','GB2312');
    }
    function checkParameter($str){
        return isset($_GET[$str]);
    }
    function limitText($type){
        $str = '';
		switch($type){
		case 'A':
			$str = '/[^\a-\z\A-\Z]/g';
			break;
		case 'N':
			$str = '/\D/g';
			break;
		case 'A&N':
			$str = '/[\W]/g';
			break;
		case 'A&N&_':
			$str = '/[^//\w]/g';
			break;
		}
		echo "onblur=\"this.value=this.value.replace($str,'')\" onafterpaste=\"this.value=this.value.replace($str,'')\"";
    }
    function textDelEnter($text)    
    {
        $order = array("\r\n", "\n", "\r");
        $replace = '';
        $text=str_replace($order, $replace, $text);
        return $text;
    }
    function trPromalgotor($promalgotor_id){
        $conn = dbConnect('read');
        $arr = getUserDetails($conn,$promalgotor_id);
        $conn -> close();
        $a = $arr['user_type'];
        if($arr['user_type'] == '1'){
            $str = '管理员 '.$promalgotor_id;
            return $str;
        }
        else
            return $arr['user_name'];
    }
    function characet($data){//transfer to utf8
        if(!empty($data)){
            $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
            if( $fileType != 'UTF-8'){
                $data = mb_convert_encoding($data ,'utf-8' , $fileType);
            }
        }
        return $data;
    }
    function getNeedBetween($srcstr,$str1,$str2){
        $i=strrpos($srcstr,$str1);
        $j=strrpos($srcstr,$str2);
        $b=substr($srcstr,$i+strlen($str1),$j-$i-strlen($str1));
        return $b;
    }
    
    //load data
    function getPath($str=''){
        return '/Commonweal/'.$str;
    }
    function getParameter($str){
        return $_GET[$str];
    }
    function getWords($name){
        if(array_key_exists($name, $_SESSION['user_info']))
            return $_SESSION['user_info'][$name];
        else
            return "";
    }
?>
<Script language="javascript">
    function getQueryString(name) {
    	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)
       		return unescape(r[2]);
        return null;
    }
    function CutString(str, len, hasDot) {
        var newLength = 0;
        var newStr = "";
        var chineseRegex = /[^\x00-\xff]/g;
        var singleChar = "";
        var strLength = str.replace(chineseRegex, "**").length;
        for (var i = 0; i < strLength; i++) {
            singleChar = str.charAt(i).toString();
            if (singleChar.match(chineseRegex) != null) {
                newLength += 2;
            }
            else {
                newLength++;
            }
            if (newLength > len) {
                break;
            }
            newStr += singleChar;
        }


        if (hasDot && strLength > len) {
            newStr += "...";
        }
        return newStr;
    }
</Script>