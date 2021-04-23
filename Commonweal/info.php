<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <title>信息</title>
    <script type="text/javascript" src=".\javascript\page.js"></script>
</head>

<body>
    <div id="container">
<?php
    include('./includes/menu.inc.php');
    //load data
    if(!checkParameter('id'))
        exit;
    $conn = dbConnect('read');    
    $infoArr=getUserDetails($conn,getParameter('id'));
    if(isset($infoArr['user_file_id']) && $infoArr['user_file_id']>0){
        $fileArr=getFile($conn,$infoArr['user_file_id']);
    }
    else{
        $fileArr = array();
        $fileArr["file_id"] = -1;
        $fileArr["user_id"] = $infoArr["user_id"];
        $fileArr["user_type"] = $infoArr["user_type"];
        $fileArr["file_name"] = "";
        $fileArr["file_type"] = "";
        $fileArr["file_path"] = "";
    }
    $conn->close();
    //window
    if(isset($_SESSION['user_type']))
        if($tag=='info' &&  checkParameter('id') && $_SESSION["user_id"] == getParameter('id')) include('./includes/edit.inc.php');
?>
<!-- script function -->
<script language="JavaScript" type="text/javascript">
	//api
    function addRow(name,type,value){
        var sScript;
        switch(type){
        	case 'words':
                sScript="<tr>";
                sScript=sScript+"<td>"+name+"</td>"
                value = transferValue(name,value);
                if(value.length>40 && name!='相关文件')
            		sScript=sScript+"<td title='"+value+"'>"+CutString(value,40,true)+"</td>";
                else
                	sScript=sScript+"<td>"+value+"</td>";
                sScript=sScript+"</tr>";
                content.insertAdjacentHTML("beforeEnd",sScript);
            	break;
        }
	}
	function transferValue(str,value){
		var s='';
		switch(str){
			case "义工等级":
    			return 'level '+value;
			case "活动次数":
    			return value+'次';
			case '帐号类型':
		        switch(value){
    	            case '0':
    	            	s='终极管理员';
            			break;
    	            case '1':
    	            	s='管理员';
            			break;
    	            case '2':
    	            	s='义工';
            			break;
    	            case '3':
    	            	s='赞助商';
            			break;
    	            case '4':
    	            	s='求助者';
            			break;
    	        }
    			return s;
			case '审核':
	            switch(value){
	            case '0':
	            	s="未审核";
	            	break;
	            case '1':
	            	s="正常";
	            	break;
	            case '2':
	            	s="未通过审核";
	                break;
	            case '3':
	            	s="已封号";
	                break;
	            case '4':
	            	s="已解决";
	                break;
	            }
				return s;
			case '性别':
    			switch (value){
        			case '0':
            			s='保密';
            			break;
        			case '1':
            			s='男';
            			break;
        			case '2':
            			s='女';
            			break;
    			}
    			return s;
			case '学历':
    			switch (value){
        			case '0':
            			s='未填写';
            			break;
        			case '1':
            			s='博士';
            			break;
        			case '2':
            			s='硕士';
            			break;
        			case '3':
            			s='本科';
            			break;
        			case '4':
            			s='大专';
            			break;
        			case '5':
            			s='高中';
            			break;
        			case '6':
            			s='初中';
            			break;
        			case '7':
            			s='小学';
            			break;
    			}
    			return s;
			case '生日':
				return value.substr(0,4)+"年"+value.substr(5,2)+"月"+value.substr(8,2)+"日";
			case '地区':
			case '公司地区':
				if(value=='000')
					return '未填写';
			default:
				return value==''?'未填写':value;
		}
	}
	function edit(){
		history.replaceState(null,'修改个人信息','edit.php');
      	window.location.href=window.location.href;
	}
	function infoBack(){
		var str='./';
		str+="<?php if(isCode(getParameter('back'))) echo urlUncode(getParameter('back'));else echo getParameter('back');?>";
		window.location.href = str;
	}
	<?php if(isset($infoArr['user_file_id'])){?>
	function openFile(){
		var filename = '<?php echo "/Commonweal/data/files/".trID($infoArr['user_id'],$infoArr['user_type'])."/".$fileArr['file_name'].".".$fileArr['file_type']?>';
		window.open(filename);
	}
	<?php }?>
</script>
<!-- info -->
<div class="about">
    <div class="container">
    	<div class="pages-top heading">
    		<h2><?php
        		switch($infoArr['user_type']){
        		    case '1':
        		        if($infoArr['user_accounts']=='system')
        		          $s='终极管理员';
    		            else
        		          $s='管理员';
        		        break;
        		    case '2':
        		        $s='义工';
        		        break;
        		    case '3':
        		        $s='赞助商';
        		        break;
        		    case '4':
        		        $s='求助者';
        		        break;
        		}
        		if($infoArr['user_type']==1)
        		    echo $s."帐号";
        		else{
        		    $s2 = "";
        		    if($infoArr['user_type']==4 && $infoArr['user_checked']==4)
        		        $s2 = '（已解决）';
        		    echo $infoArr['user_name'].'（'.$s.'）'.$s2;
        		}
    		?></h2>
    	</div>
    	<div class="typo-bottom">
    		<div class="headdings">
				<div class="bs-example">
					<table class="table manageTable">
                        <thead style="text-align: center;" style="width: 95%; margin:0 auto;text-align: center;">
                            <tr>
                                <th style="text-align: center; width:40%;"><label style="font-size:20px;">个人信息</label></th>
                                <th style="text-align: center; width:60%;">
                                <label style="font-size:20px;">ID:<?php echo trID($infoArr['user_id'],$infoArr['user_type']);?></label>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="content">
                        </tbody>
					</table>
				</div>
    		</div>
            <div id="btns">
                <table class="tableBar">
                    <?php 
                        echo "<tr><td>&nbsp;</td></tr>";
                        echo "<tr><td align='center'>";
                        echo "<form id='infoForm' method='post' action='./check/check_manage.php'>"; 

                        if(isset($_SESSION['user_id']) && $_SESSION["user_id"] == getParameter('id')){
                            echo "<input name='edit' type='button' value='修改' onclick='showEdit()'>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){                           
                            switch ($infoArr['user_type']){
                                case 1:{
                                    if($infoArr['user_accounts']!='system'){
                                        switch($infoArr['user_checked']){
                                            case '1':{
                                                echo "<input name='cover".$infoArr['user_id']."' type='submit' value='查封管理员'>"; 
                                                break;
                                            }
                                            case '3':
                                            default:{
                                                echo "<input name='uncov".$infoArr['user_id']."' type='submit' value='解封管理员'>";
                                                break;
                                            }
                                        }            
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    }
                                    echo "<input name='back' type='button' value='返回' onclick='infoBack()'>";
                                    break;
                                }
                                case 2:
                                case 3:
                                case 4:{
                                    if(checkParameter('back') && substr(getParameter('back'),0,10)=='manage.php'){
                                        switch($infoArr['user_checked']){
                                            case '0':{
                                                echo "<input name='check".$infoArr['user_id']."' type='submit' value='通过审核'>";
                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                echo "<input name='passs".$infoArr['user_id']."' type='submit' value='不通过审核'>";
                                                break;
                                            }
                                            case '1':{
                                                echo "<input name='cover".$infoArr['user_id']."' type='submit' value='封号'>";
                                                break;
                                            }
                                            case '2':{
                                                echo "<input name='check".$infoArr['user_id']."' type='submit' value='通过审核'>";
                                                break;
                                            }
                                            case '3':{
                                                echo "<input name='uncov".$infoArr['user_id']."' type='submit' value='解封'>";
                                                break;
                                            }
                                        }
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    }
                                    echo "<input name='back' type='button' value='返回' onclick='infoBack()'>";
                                    break;
                                }
                                    
                            }
                        }
                        elseif(isset($_SESSION['user_type']) && $_SESSION['user_type']==4){
                            switch ($_SESSION['user_checked']){
                                case 0:
                                case 1:
                                    echo "<input name='close".$infoArr['user_id']."' type='submit' value='关闭求助'>";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    break;
                                case 4:
                                    echo "<input name='openn".$infoArr['user_id']."' type='submit' value='恢复求助'>";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    break;
                            }
                            
                            echo "<input name='back' type='button' value='返回' onclick='infoBack()'>";
                        }
                        else{
                            echo "<input name='back' type='button' value='返回' onclick='infoBack()'>";
                        }
                        echo "</form></td></tr>";
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
        function add($showName,$value){
            echo "\n    <script language='JavaScript' type='text/javascript'>addRow('"
                    .$showName."','words','".$value
                    ."');</script>";
        }
        //load label
        switch($infoArr["user_type"]){
            case 1:{
                add("帐号名",$infoArr["user_accounts"]);
                add("帐号类型",$infoArr["user_accounts"]=='system'?'0':$infoArr["user_type"]);
                add("审核",$infoArr["user_checked"]);
                break;
            }
            case 2:{
                add("帐号名",$infoArr["user_accounts"]);
                add("帐号类型",$infoArr["user_type"]);
                add("审核",$infoArr["user_checked"]);
                add("义工等级",$infoArr["user_test_level"]);
                add("活动次数",$infoArr["user_joinTimes"]);
                add("姓名",$infoArr["user_name"]);
                add("性别",$infoArr["user_sex"]);
                add("生日",$infoArr["user_birth"]);
                add("学历",$infoArr["user_qualifications"]);
                add("地区",$infoArr["user_province"].$infoArr["user_city"].$infoArr["user_district"]);
                add("地址",$infoArr["user_ad2"]);
                add("电话",$infoArr["user_phone"]);
                add("邮箱",$infoArr["user_email"]);
                add("工作",$infoArr["user_work"]);
                add("简介",$infoArr["user_info"]);
                break;
            }
            case 3:{
                add("帐号名",$infoArr["user_accounts"]);
                add("帐号类型",$infoArr["user_type"]);
                add("审核",$infoArr["user_checked"]);
                add("公司名称",$infoArr["user_name"]);
                add("公司地区",$infoArr["user_province"].$infoArr["user_city"].$infoArr["user_district"]);
                add("公司地址",$infoArr["user_ad2"]);
                add("公司电话",$infoArr["user_phone"]);
                add("公司邮箱",$infoArr["user_email"]);
                add("公司简介",$infoArr["user_info"]);
                if((isset($_SESSION['user_type']) && $_SESSION['user_type']==1)
                    || (isset($_SESSION['user_id']) && $_SESSION['user_id']==$infoArr['user_id'])){
                    $str='<input type="button" style="width:auto" value="'.$fileArr['file_name'].'.'.$fileArr["file_type"].'" onClick="openFile()">';
                    if($str=='<input type="button" style="width:auto" value="." onClick="openFile()">') $str='<input type="button" style="width:auto" value="无文件">';
                    add("相关文件",$str); 
                }
                break;
            }
            case 4:{
                add("帐号名",$infoArr["user_accounts"]);
                add("帐号类型",$infoArr["user_type"]);
                add("审核",$infoArr["user_checked"]);
                add("姓名",$infoArr["user_name"]);
                add("性别",$infoArr["user_sex"]);
                add("生日",$infoArr["user_birth"]);
                add("地区",$infoArr["user_province"].$infoArr["user_city"].$infoArr["user_district"]);
                add("地址",$infoArr["user_ad2"]);
                add("电话",$infoArr["user_phone"]);
                add("邮箱",$infoArr["user_email"]);
                add("原因",$infoArr["user_info"]);
                if((isset($_SESSION['user_type']) && $_SESSION['user_type']==1)
                    || (isset($_SESSION['user_id']) && $_SESSION['user_id']==$infoArr['user_id'])){
                    $str='<input type="button" style="width:auto" value="'.$fileArr['file_name'].'.'.$fileArr["file_type"].'" onClick="openFile()">';
                    if($str=='<input type="button" style="width:auto" value="." onClick="openFile()">') $str='<input type="button" style="width:auto" value="无文件">';
                    add("相关文件",$str); 
                }
                break;
            }
        }
    ?>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
    </div>
</body>
</html>