<!-- test publish -->
<script language="JavaScript" type="text/javascript">
    function showTest(){
        document.getElementById('test').style.display = 'block';
        history.pushState({},null,'./test.php?testWinStat=test_name');
        try{document.getElementById(getQueryString('testWinStat')).focus();}catch(e){}
    }
    function closeTest(){
        document.getElementById('test').style.display = 'none';
        history.pushState({},null,'./test.php');
    }
    function uploadFileTest(){
        var file=document.getElementById("test_file");
		if(file.value!='')
			document.getElementById("test_file_tip").innerHTML=file.value;
		else
			document.getElementById("test_file_tip").innerHTML='请上传题目文件（.txt）';
    }
</script>
<div id="test" class="win_box1" >
	<div class="win_box2" style="margin:-200px 0 0 -165px;">
	    <p align="center" class="win_bar"><label style="font-size:30px;">上传考核题目 </label></p>
        <form name="testPublishForm" class="win_box3" action="./check/check_test.php" method="post" enctype="multipart/form-data" >
            <input name="test_type" id="test_type" type="text" style="display:none" value='2'/>
        	<p style="padding: 5px 0px;">
        		<label>套题名称：<br/>
        		<input type="text" placeholder="请输入套题名称" maxlength="20" name="test_name" id="test_name" class="win_input" value="<?php if(isset($test_name)) echo $test_name;?>"
        		 size="20" tabindex="1"/></label>
        	</p>        	
        	<p>
                <label>套题等级：<br>
                <select name="test_level" id="test_level" class="win_select" onchange="" tabindex="2">
                    <option value="0" <?php if(!isset($test_level)) echo "selected=true";?>>请选择</option>
                    <option value="1" <?php if(isset($test_level) && $test_level==1) echo "selected=true";?>>Level-1</option>
                    <option value="2" <?php if(isset($test_level) && $test_level==2) echo "selected=true";?>>Level-2</option>
                    <option value="3" <?php if(isset($test_level) && $test_level==3) echo "selected=true";?>>Level-3</option>
                    <option value="4" <?php if(isset($test_level) && $test_level==4) echo "selected=true";?>>Level-4</option>
                    <option value="5" <?php if(isset($test_level) && $test_level==5) echo "selected=true";?>>Level-5</option>
                </select></label>
        	</p>
            <p>
                <label>套题文件:<br>
                <div class="win_file" tabindex="3">
                    <p id="test_file_tip" algin="center">请上传题目文件（.txt）</p>
                    <input name="test_file" id="test_file" type="file" onchange="uploadFileTest();">
                </div></label>
            <p>
        	<p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="publishBtn" value="上传" tabindex="11" />
        		<input style="padding: 2px 10px;" type="button" name="cannelBtn" value="取消" tabindex="12" onClick="closeTest()" />
        	</p>
        </form>
    </div>
</div>
<?php 
    //testWinStat
    if(isset($_SESSION['testWinStat'])){
        $str = $_SESSION['testWinStat'];
        unset($_SESSION['testWinStat']);
        echo "<script type='text/javascript'>
        history.pushState({},null,'./test.php?testWinStat=$str');
        document.getElementById('test').style.display = 'block';
        try{document.getElementById(getQueryString('testWinStat')).focus();}catch(e){}
        </script>";
    }
    else{
        if (checkParameter('testWinStat')){
            echo "<script type='text/javascript'>
                   document.getElementById('test').style.display = 'block';
        	       try{document.getElementById(getQueryString('testWinStat')).focus();}catch(e){}
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                    document.getElementById('test').style.display = 'none';
                </script>";
        }
    }
?>