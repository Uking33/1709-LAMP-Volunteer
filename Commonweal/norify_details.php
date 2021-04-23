<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <title>通知详情</title>
    <script type="text/javascript" src=".\javascript\page.js"></script>
</head>
<body>
    <div id="container">
<?php
    include('./includes/menu.inc.php');
    //load data
    if(checkParameter("id")){
        $activity_id = getParameter("id");
        $conn = dbConnect('read');
        $Arr = getNorifyDetail($conn,$activity_id);
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
	function norifyDetailsBack(){
		var str='./';
		str+="<?php if(isCode(getParameter('back'))) echo urlUncode(getParameter('back'));else echo getParameter('back');?>";
		window.location.href = str;
	}
</script>
<!-- norify details -->
    <div class="about">
		<div class="container">
			<div class="about-top heading">
				<h2><?php echo $Arr['activity_name'];?></h2>
				<h3>&nbsp;</h3>
				<h4 style="color: #8E8E8E;"><a href="info.php?id=<?php echo substr($Arr['promalgotor_id'],strlen($Arr['promalgotor_id'])-8,8);?>&back=norify_details.php?id@<?php echo $Arr['activity_id'];?>!back@<?php echo getParameter('back')?>">发布者：<?php echo $Arr['promalgotor_id'];?></a></h4>	
			</div>
		    <div class="about-bottom" style="margin-top:50px;">
				<div style="background: #8E8E8E; height:2px; margin-top:30px;"></div>
				<div style="word-break:break-all; color: #8E8E8E; display:inline-block;">
					<h2><?php echo $Arr['activity_content'];?></h2>
				</div>
				<div style="background: #8E8E8E; height:2px; margin-top:10px;margin-bottom:50px;"></div>
			</div>			
            <table class="tableBar"><tr><td>
                <input name='back' type='button' value='返回' onclick='norifyDetailsBack()'>
		    </td></tr></table>
		</div>
	</div>
    <?php include('./includes/footer.inc.php'); ?>
    </div>
</body>
</html>