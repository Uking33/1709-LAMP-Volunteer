<!-- activity publish -->
<script language="JavaScript" type="text/javascript">
    function showActivity(){
        <?php if($_SESSION['user_checked']!='1'){?>
			alert('帐号未审核或被查封,不能发起活动');
			return;
        <?php }?>
        document.getElementById('activity').style.display = 'block';
        history.pushState({},null,'./activity.php?activityWinStat=activity_name');
        try{document.getElementById(getQueryString('activityWinStat')).focus();}catch(e){}
    }
    function closeActivity(){
        document.getElementById('activity').style.display = 'none';
        history.pushState({},null,'./activity.php');
    }
    //date
    function changeYear1(){
        var sltYear=document.getElementById("activity_starttime_year");
        var sltMonth=document.getElementById("activity_starttime_month");
        var sltday=document.getElementById("activity_starttime_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth1(){
        var sltYear=document.getElementById("activity_starttime_year");
        var sltMonth=document.getElementById("activity_starttime_month");
        var sltday=document.getElementById("activity_starttime_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
    function changeYear2(){
        var sltYear=document.getElementById("activity_endtime_year");
        var sltMonth=document.getElementById("activity_endtime_month");
        var sltday=document.getElementById("activity_endtime_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth2(){
        var sltYear=document.getElementById("activity_endtime_year");
        var sltMonth=document.getElementById("activity_endtime_month");
        var sltday=document.getElementById("activity_endtime_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
</script>
<div id="activity" class="win_box1" >
	<div class="win_box2" style="margin:-310px 0 0 -165px;">
	    <p align="center" class="win_bar"><label style="font-size:30px;">发布活动 </label></p>
        <form name="activityPublishForm" class="win_box3" action="./check/check_activity.php" method="post">
            <input name="activity_type" id="activity_type" type="text" style="display:none" value='2'/>
        	<p style="padding: 5px 0px;">
        		<label>活动名称：<br/>
        		<input type="text" placeholder="请输入活动名称" maxlength="20" name="activity_name" id="activity_name" class="win_input" value="<?php if(isset($activity_name)) echo $activity_name;?>"
        		 size="20" tabindex="1"/></label>
        	</p>
            <p>
                <label>起始时间:<br>
                <select name="activity_starttime_year" id="activity_starttime_year" style='width:36%' onChange="changeYear1()" class="win_select" tabindex="3">
                    <?php
                        if(isset($activity_starttime)){
                            $activity_starttime_date=$activity_starttime;
                        }
                        else{
                            $activity_starttime_date=((string)date('Y'))."0101";
                        }
                        if(strlen($activity_starttime_date)==8){
                            $year=substr($activity_starttime_date,0,4);
                            for ($i=date('Y')+1;$i>=date('Y')-100;$i--){
                                echo "<option value=\"$i\"";
                                if((int)$year==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=date('Y')+1;$i>=date('Y')-100;$i--)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select>
                <select name="activity_starttime_month" id="activity_starttime_month" style='width:26%' onChange="changeMonth1()" class="win_select" tabindex="4"> 
                    <?php 
                        if(strlen($activity_starttime_date)==8){
                            $month=substr($activity_starttime_date,4,2);
                            for ($i=1;$i<=12;$i++){
                                echo "<option value=\"$i\"";
                                if((int)$month==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=1;$i<=12;$i++)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select> 
                <select name="activity_starttime_day" id="activity_starttime_day" style='width:26%' class="win_select" tabindex="5">
                    <?php
                        if(strlen($activity_starttime_date)==8){
                            $day=substr($activity_starttime_date,6,2);
                            $dayMax=cal_days_in_month(CAL_GREGORIAN, (int)substr($activity_starttime_date,4,2), (int)substr($activity_starttime_date,0,4));
                            for ($i=1;$i<=$dayMax;$i++){
                                echo "<option value=\"$i\"";
                                if((int)$day==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=1;$i<=31;$i++)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select> 
                </label>
            </p>
            
            <p>
                <label>结束时间:<br>
                <select name="activity_endtime_year" id="activity_endtime_year" style='width:36%' onChange="changeYear2()" class="win_select" tabindex="6">
                    <?php
                        if(isset($activity_endtime)){
                            $activity_endtime_date=$activity_endtime;
                        }
                        else{
                            $activity_endtime_date=date('Y')."0101";
                        }
                        if(strlen($activity_endtime_date)==8){
                            $year=substr($activity_endtime_date,0,4);
                            for ($i=date('Y')+1;$i>=date('Y')-100;$i--){
                                echo "<option value=\"$i\"";
                                if((int)$year==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=date('Y')+1;$i>=date('Y')-100;$i--)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select>
                <select name="activity_endtime_month" id="activity_endtime_month" style='width:26%' onChange="changeMonth2()" class="win_select" tabindex="7"> 
                    <?php 
                        if(strlen($activity_endtime_date)==8){
                            $month=substr($activity_endtime_date,4,2);
                            for ($i=1;$i<=12;$i++){
                                echo "<option value=\"$i\"";
                                if((int)$month==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=1;$i<=12;$i++)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select> 
                <select name="activity_endtime_day" id="activity_endtime_day" style='width:26%' class="win_select" tabindex="8">
                    <?php
                        if(strlen($activity_endtime_date)==8){
                            $day=substr($activity_endtime_date,6,2);
                            $dayMax=cal_days_in_month(CAL_GREGORIAN, (int)substr($activity_starttime_date,4,2), (int)substr($activity_starttime_date,0,4));
                            for ($i=1;$i<=$dayMax;$i++){
                                echo "<option value=\"$i\"";
                                if((int)$day==$i)
                                    echo " selected=\"selected\"";
                                echo ">$i</option>";
                            }
                        }
                        else{
                            for ($i=1;$i<=31;$i++)
                                echo "<option value=\"$i\">$i</option>";
                        }
                    ?>
                </select> 
                </label>
            </p>
            <p>
        		<label>需求人数：<br/>
        		<input type="text" placeholder="请输入活动所需人数" maxlength="5" name="activity_neednum" id="activity_neednum" class="win_input" value="<?php if(isset($activity_neednum)) echo $activity_neednum;?>"
        		 size="20" tabindex="9" <?php limitText('N')?>/></label>
        	</p>
            <p>
                <label>活动内容:
                <textarea maxlength="1000" name="activity_content" id="activity_content" rows="5" class="win_textarea" placeholder="请输入活动的内容"
                 value="<?php if(isset($activity_content)) echo $activity_content;?>" tabindex="10"></textarea>
                </label>
            </p>
            <p>
                <label>若活动被封,可能导致封号</label>
            </p>
        	<p class="submit-btn">
        		<input style="padding: 2px 10px;" type="submit" name="publishBtn" value="发布" tabindex="11" />
        		<input style="padding: 2px 10px;" type="button" name="cannelBtn" value="取消" tabindex="12" onClick="closeActivity()" />
        	</p>
        </form>
    </div>
</div>
<?php 
    //activityWinStat
    if(isset($_SESSION['activityWinStat'])){
        $str = $_SESSION['activityWinStat'];
        unset($_SESSION['activityWinStat']);
        echo "<script type='text/javascript'>
        history.pushState({},null,'./activity.php?activityWinStat=$str');
        document.getElementById('activity').style.display = 'block';
        try{document.getElementById(getQueryString('activityWinStat')).focus();}catch(e){}
        </script>";
    }
    else{
        if (checkParameter('activityWinStat')){
            echo "<script type='text/javascript'>
                   document.getElementById('activity').style.display = 'block';
        	       try{document.getElementById(getQueryString('activityWinStat')).focus();}catch(e){}
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                    document.getElementById('activity').style.display = 'none';
                </script>";
        }
    }
?>