<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <title>考核详情</title>
    <script type="text/javascript" src=".\javascript\page.js"></script>
</head>

<body>
<?php
    include('./includes/menu.inc.php');
    //post
    if(count($_POST)>0) {
        if(isset($_POST['testing'])){
            if($_SESSION['user_checked']!='1'){
                echo "<script type='text/javascript'>alert('帐号未审核或被查封,不能参加考核');</script>";
            }
            else{
                $id = getParameter("id");
                echo "<script>location.href = 'test_making.php?id=$id&back=test_details.php?id@$id!back@test.php'</script>";
            }
        }
        if(isset($_POST['deltest'])){
            $conn = dbConnect('read');
            if(deleteItem($conn,getParameter("id")))
                echo "<script type='text/javascript'>alert('已删除')</script>";
            else 
                echo "<script type='text/javascript'>alert('删除失败')</script>";
            $conn->close();
        }
    }
    //load data
    if(checkParameter("id")){
        $test_id = getParameter("id");
        $conn = dbConnect('read');
        $Arr = getTestDetail($conn,$test_id);
        $conn->close();
    }
    else{
        echo"<script type='text/javascript'>
                history.back();
            </script>";
        exit;
    }
?>
<!-- script function -->
<script language="JavaScript" type="text/javascript">
	//api
	function testDetailsBack(){
		var str='./';
		str+="<?php if(isCode(getParameter('back'))) echo urlUncode(getParameter('back'));else echo getParameter('back');?>";
		window.location.href = str;
	}
	function openTestTxt(){
		var filename = '<?php echo "/Commonweal/data/tests/".$Arr['file_name'].".".$Arr['file_type']?>';
		window.open(filename);
	}
</script>
<!-- test details -->
    <div class="about">
		<div class="container">
			<div class="about-top heading" style="width:80%;margin-left:10%">
				<h2><?php echo $Arr['test_name'];?></h2>
				<h3>&nbsp;</h3>
				<h4 style="color: #8E8E8E;"><a href="info.php?id=<?php echo substr($Arr['user_id'],strlen($Arr['user_id'])-8,8);?>&back=test_details.php?id@<?php echo $Arr['test_id'];?>!back@<?php echo getParameter('back')?>"><?php echo trPromalgotor($Arr['user_id']);?></a></h4>	
			</div>
		    <div class="about-bottom" style="width:80%;margin-left:10%;margin-top:50px;">
				<div style="background: #8E8E8E; width:80%; height:2px; margin-left:10%;margin-top:30px;"></div>
				<div>
					<h2 style="text-align:center; color: #8E8E8E; width:80%;margin-left:10%;isplay: inline-block;overflow: hidden;text-overflow:ellipsis;">考核名称：<?php echo $Arr['test_name'];?></h2>
					<h2 style="text-align:center; color: #8E8E8E; width:80%;margin-left:10%;isplay: inline-block;overflow: hidden;text-overflow:ellipsis;">考核难度：<?php echo $Arr['test_level'];?></h2>
				</div>
				<div style="background: #8E8E8E; width:80%; height:2px; margin-left:10%;margin-top:30px;margin-bottom:50px;"></div>
			</div>
			<form action="" method="post">
            <table class="tableBar"><tr><td>
                <?php if($_SESSION['user_type']=='2'){?><input name='testing' type='submit' value='进行考试'><?php }?>
                <?php if($_SESSION['user_type']=='1'){?><input name='showtest' type='button' value='查看' onClick="openTestTxt()"><?php }?>
                <?php if($_SESSION['user_type']=='1'){?><input name='deltest' type='submit' value='删除'><?php }?>
                <input name='back' type='button' value='返回' onclick='testDetailsBack()'>
		    </td></tr></table></form>
		</div>
	</div>
    <?php include('./includes/footer.inc.php'); ?>
</body>
</html>