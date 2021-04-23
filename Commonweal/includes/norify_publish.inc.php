<!-- norify publish -->
<script language="JavaScript" type="text/javascript">
    function showNorify(){
        document.getElementById('norify').style.display = 'block';
        history.pushState({},null,'./norify.php?norifyWinStat=norify_name');
        try{document.getElementById(getQueryString('norifyWinStat')).focus();}catch(e){}
    }
    function closeNorify(){
        document.getElementById('norify').style.display = 'none';
        history.pushState({},null,'./norify.php');
    }
</script>
<div id="norify" class="win_box1">
	<div class="win_box2" style="margin:-192px 0 0 -165px;">
	    <p align="center" class="win_bar"><label style="font-size:30px;">发布通知 </label></p>
        <form name="norifyPublishForm" class="win_box3" action="./check/check_activity.php" method="post">
            <input name="norify_type" id="norify_type" type="text" style="display:none" value='1'/>
        	<p style="padding: 5px 0px;">
        		<label>通知名称：<br/>
        		<input type="text" placeholder="请输入通知的名称" maxlength="20" name="norify_name" id="norify_name" class="win_input" value="<?php if(isset($norify_name)) echo $norify_name;?>"
        		 size="20" tabindex="1"/></label>
        	</p>
            <p>
                <label>通知内容:
                <textarea maxlength="1000" name="norify_content" id="norify_content" rows="5" class="win_textarea" placeholder="请输入通知的内容"
                 value="<?php if(isset($norify_content)) echo $norify_content;?>" tabindex="2"></textarea>
                </label>
            </p>
        	<p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="publishBtn" value="发布" tabindex="3" />
        		<input style="padding: 2px 10px;" type="button" name="cannelBtn" value="取消" tabindex="4" onClick="closeNorify()" />
        	</p>
        </form>
    </div>
</div>
<?php 
    //norifyWinStat
    if(isset($_SESSION['norifyWinStat'])){
        $str = $_SESSION['norifyWinStat'];
        unset($_SESSION['norifyWinStat']);
        echo "<script type='text/javascript'>
        history.pushState({},null,'./norify.php?norifyWinStat=$str');
        document.getElementById('norify').style.display = 'block';
        try{document.getElementById(getQueryString('norifyWinStat')).focus();}catch(e){}
        </script>";
    }
    else{
        if (checkParameter('norifyWinStat')){
            echo "<script type='text/javascript'>
                   document.getElementById('norify').style.display = 'block';
        	       try{document.getElementById(getQueryString('norifyWinStat')).focus();}catch(e){}
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                    document.getElementById('norify').style.display = 'none';
                </script>";
        }
    }
?>