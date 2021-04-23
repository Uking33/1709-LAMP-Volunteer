<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <title>活动详情</title>
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
        $Arr = getActivityDetail($conn,$activity_id);
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
	function transferValue(str,value){
		$s='';
		switch(str){
			default:
				return value==''?'未填写':value;
		}
	}
	function activityDetailsBack(){
		var str='./';
		str+="<?php if(isCode(getParameter('back'))) echo urlUncode(getParameter('back'));else echo getParameter('back');?>";
		window.location.href = str;
	}
</script>
<!-- activity details -->
    <div class="about">
		<div class="container">
			<div class="about-top heading">
				<h2>
				<?php
				    echo $Arr['activity_name'];
				    switch ($Arr['activity_check']){
				        case 1:
				            break;
				        case 2:
				        case 3:
				            echo '（已关闭）';
				            break;
				    }
			    ?>
			    </h2>
				<h4>&nbsp;</h4>
				<h4 style="color: #8E8E8E;"><a href="info.php?id=<?php echo $Arr['promalgotor_id'];?>&back=activity_details.php?id@<?php echo $Arr['activity_id'];?>!back@<?php echo getParameter('back')?>">发布者：<?php echo trPromalgotor($Arr['promalgotor_id']);?></a></h4>	
			    <h4 style="color: #8E8E8E;">活动时间：<?php echo $Arr['activity_starttime']."~".$Arr['activity_starttime'];?></h4>
			    <h4 style="color: #8E8E8E;">需要人数：<?php echo $Arr['activity_neednum'];?>人</h4>
			</div>
			<div class="about-bottom" style="margin-top:50px;">
		        <div style="background: #8E8E8E; height:2px; margin-left:0;margin-top:30px;"></div>
		        <div style="color: #8E8E8E; display:inline-block;word-break: break-all;">
					<h2><?php echo $Arr['activity_content'];?></h2>
				</div>
				<div style="background: #8E8E8E; height:2px; margin-top:10px;margin-bottom:50px;"></div>
			</div>
			
			<?php
			     if(isset($_SESSION['user_id']) && $Arr['promalgotor_id']==$_SESSION['user_id']){
			         include('./includes/activity_joined_list.inc.php');
			     }
			?>
			<form action="./check/check_activity_details.php" method="post">
			<table class="tableBar"><tr><td>
                <?php
                    if(isset($_SESSION['user_type']))
                        switch($_SESSION['user_type']){
                            case '1':{?>
                            <?php if($Arr['activity_check']==1 || $Arr['activity_check']==2){?>
                                <input name='cover<?php echo $Arr['activity_id'];?>' type='submit' value='查封'>
                            <?php }if($Arr['activity_check']==3){?> 
                                <input name='uncov<?php echo $Arr['activity_id'];?>' type='submit' value='解封'>
                            <?php 
                                }
                                break;
                            }
                            case '2':{?>
                            <?php if($Arr['activity_check']==1){
                                if(checkJoininActivity($Arr['activity_id'],$_SESSION['user_id'])){
                                ?>
                                <input style='disabled:tru;' type='button' value='已报名'>  
                            <?php }else{?>                             
                                <input name='joinn<?php echo $Arr['activity_id'].'|'.$_SESSION['user_id'].'|'.$_SESSION['user_name'];?>' type='submit' value='报名'>
                            <?php
                                    }
                                }
                                break;
                            }
                            case '3':{?>
                            <?php if($Arr['activity_check']==3){?>
                                <input style='disabled:tru;' type='button' value='已查封'>  
                            <?php }if($Arr['activity_check']==2){?>             
                                <input name='openn<?php echo $Arr['activity_id'];?>' type='submit' value='恢复'>  
                            <?php }if($Arr['activity_check']==1){?>                   
                                <input name='close<?php echo $Arr['activity_id'];?>' type='submit' value='关闭'>                                
                            <?php 
                                }
                                break;
                            }
                        }
                ?>
                <input name='back' type='button' value='返回' onclick='activityDetailsBack()'>
		    </td></tr></table></form>
		</div>
	</div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>