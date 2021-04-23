<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <title>考核详情</title>
    <script type="text/javascript" src=".\javascript\page.js"></script>
</head>

<body>
<?php
    include('./includes/menu.inc.php');
    //load data
    if(checkParameter("id")){
        $test_id = getParameter("id");
        $conn = dbConnect('read');
        $Arr = getTestDetail($conn,$test_id);
        $Arr = addTestContext($conn,$Arr);
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
</script>
<!-- test details -->
    <div class="about">
		<div class="container">
		    <?php $num=0;?>
			<div class="about-top heading" style="width:80%;margin-left:10%">
				<h2><?php echo $Arr['test_name'];?></h2>
				<h3>&nbsp;</h3>
				<h4 style='color: #8E8E8E; width:80%;margin-left:10%;isplay: inline-block;overflow: hidden;text-overflow:ellipsis;'>考核难度：<?php echo $Arr['test_level'];?></h2>
			</div>
			<form action="./check/check_test_making.php" method="post">
			<input name="id" value="<?php echo $test_id;?>" type="hidden">
		    <div class="about-bottom" style="width:80%;margin-left:10%;margin-top:50px;">
				<div style="background: #8E8E8E; width:80%; height:2px; margin-left:10%;margin-top:30px;"></div>
				<div>
				<?php 
				    foreach ($Arr['test_context'] as $item){
				        $num++;
				        $context = $item['context'];
				        $chose = "<input type='radio' name='item_$num' value='A'>A.".$item['A']."<br>";
				        $chose .= "<input type='radio' name='item_$num' value='B'>B.".$item['B']."<br>";
				        $chose .= "<input type='radio' name='item_$num' value='C'>C.".$item['C']."<br>";
				        $chose .= "<input type='radio' name='item_$num' value='D'>D.".$item['D']."<br>";
				        echo "<br>
                            <div style='width:80%;margin-left:10%;isplay: inline-block; margin-top:50px;'>
				            <h2 style='color: #8E8E8E;'>$context</h2>
							<h2 style='color: #8E8E8E;'>$chose</h2>
							</div>";
				    }
				?>
				</div>
				<div style="background: #8E8E8E; width:80%; height:2px; margin-left:10%;margin-top:30px;margin-bottom:50px;"></div>
			</div>
            <input type='hidden' name='testnum' value='<?php echo $num;?>'>;
            <table class="tableBar"><tr><td>
                <input name='tested' type='submit' value='提交'>
                <input name='back' type='button' value='返回' onclick='testDetailsBack()'>
		    </td></tr></table></form>
		</div>
	</div>
    <?php include('./includes/footer.inc.php'); ?>
</body>
</html>