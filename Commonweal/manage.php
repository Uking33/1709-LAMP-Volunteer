<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>
<head>
    <?php header("Content-Type: text/html; charset=UTF-8");?>
    <title>管理</title> 
    <script type="text/javascript" src=".\javascript\page.js"></script>
</head>   
<body>
    <div>
        <?php include('./includes/menu.inc.php');?>
        <!-- manage -->
        <!-- statistics -->
    	<div class="about">
    		<div class="container">
    			<div class="about-top heading" style="width:80%;margin-left:10%">
    				<h2>网站信息</h2>
    			</div>
                <?php $Arr = getVisit();?> 
    			<div class="about-bottom" style="width:80%;margin-left:10%">
    				<div class="col-md-5 about-left" style="float:left;"> 
    					<img height="300px" src="images/manage_statistics.png" alt="" />
    				</div>
    				<div class="col-md-7 about-right" style="float:right; left:100px;">
    					<h2 style="color: #8E8E8E;">浏&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;览&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：
    					<?php echo $Arr['visitSum'];?></h2>
    					<h2 style="color: #8E8E8E;">注册人数-管理员：<?php echo $Arr['type1'];?></h2>
    					<h2 style="color: #8E8E8E;">注册人数-义&nbsp;&nbsp;&nbsp;&nbsp;工：<?php echo $Arr['type2'];?></h2>
    					<h2 style="color: #8E8E8E;">注册人数-赞助商：<?php echo $Arr['type3'];?></h2>
    					<h2 style="color: #8E8E8E;">注册人数-求助者：<?php echo $Arr['type4'];?></h2>
    				</div>
    				<div class="clearfix"> </div>
    			</div>	
    		</div>
    	</div>
    	<?php include('./includes/manage_check.inc.php');?>
    	<?php include('./includes/manage_menber.inc.php');?>
    	<?php if($_SESSION['user_accounts']=='system') include('./includes/manage_gm.inc.php');?>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</body>  
</html>
