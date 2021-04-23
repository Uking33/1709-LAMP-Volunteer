<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince4(){
        var sltProvince=document.getElementById("edit4_province");
        var sltCity=document.getElementById("edit4_city");
        var sltDistrict=document.getElementById("edit4_district");
        //get
        var cities=provinceJsArr[sltProvince.selectedIndex]; 
        //clear
        sltCity.length=1;
        sltDistrict.length=1;
        //fill
        for(var i=1;i<cities.length;i++){  
        	sltCity[i]=new Option(cities[i][0],cities[i][0]);  
        }
    }
    function changeCity4(){
        var sltProvince=document.getElementById("edit4_province");
        var sltCity=document.getElementById("edit4_city");
        var sltDistrict=document.getElementById("edit4_district");
        //get
        var districts=provinceJsArr[sltProvince.selectedIndex][sltCity.selectedIndex]; 
        //clear
        sltDistrict.length=1;
        //fill
        for(var i=1;i<districts.length;i++){
        	sltDistrict[i]=new Option(districts[i],districts[i]);  
        }
    }
	//birth
    function changeYear4(){
        var sltYear=document.getElementById("edit4_birth_year");
        var sltMonth=document.getElementById("edit4_birth_month");
        var sltday=document.getElementById("edit4_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth4(){
        var sltYear=document.getElementById("edit4_birth_year");
        var sltMonth=document.getElementById("edit4_birth_month");
        var sltday=document.getElementById("edit4_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
    function uploadFile4(){
        var file=document.getElementById("edit4_file");
		if(file.value!='')
			document.getElementById("edit4_file_tip").innerHTML=file.value;
		else
			document.getElementById("edit4_file_tip").innerHTML='请上传相关文件的压缩包';
    }
</script>
<div id="edit4" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>姓名（*）:<br>
            <input name="edit4_name" id="edit4_name" type="text" maxlength="20" class="win_input" placeholder="请输入真实姓名" value="<?php if(isset($edit4_name)) echo $edit4_name; else echo $_SESSION['user_name'];?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>性别（*）:<br>
            <div class="win_radio">
            <label><input name="edit4_sex" type="radio" value=1 <?php if((isset($edit4_sex) && $edit4_sex==1)||(!isset($edit4_sex) && $_SESSION['user_sex']==1)) echo 'checked="true"'?> tabindex="12"/> 男</label> 
            <label><input name="edit4_sex" type="radio" value=2 <?php if((isset($edit4_sex) && $edit4_sex==2)||(!isset($edit4_sex) && $_SESSION['user_sex']==2)) echo 'checked="true"'?> tabindex="13"/> 女</label> 
            <label><input name="edit4_sex" type="radio" value=0 <?php if((isset($edit4_sex) && $edit4_sex==0)||(!isset($edit4_sex) && $_SESSION['user_sex']==0)) echo 'checked="true"'?> tabindex="14"/> 保密</label> 
            </div></label>
        </p>
        <p>
            <label for="birth">生日（*）:<br>
            <select name="edit4_birth_year" id="edit4_birth_year" style='width:36%' onChange="changeYear4()" class="win_select" tabindex="15">
                <?php
                    if(isset($edit4_birth)){
                        $date=$edit4_birth;
                    }
                    else{
                        $date=$_SESSION['user_birth'];
                    }
                    if(strlen($date)==8){
                        $year=substr($date,0,4);
                        for ($i=date('Y');$i>=date('Y')-100;$i--){
                            echo "<option value=\"$i\"";
                            if((int)$year==$i)
                                echo " selected=\"selected\"";
                            echo ">$i</option>";
                        }
                    }
                    else{
                        for ($i=date('Y');$i>=date('Y')-100;$i--)
                            echo "<option value=\"$i\">$i</option>";
                    }
                ?>
            </select>
            <select name="edit4_birth_month" id="edit4_birth_month" style='width:26%' onChange="changeMonth4()" class="win_select" tabindex="16"> 
                <?php 
                    if(strlen($date)==8){
                        $month=substr($date,4,2);
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
            <select name="edit4_birth_day" id="edit4_birth_day" style='width:26%' class="win_select" tabindex="17">
                <?php
                    if(strlen($date)==8){
                        $day=substr($date,6,2);
                        $dayMax=cal_days_in_month(CAL_GREGORIAN, (int)substr($date,4,2), (int)substr($date,0,4));
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
            <label>地区（*）:<br>
            <select name="edit4_province" id="edit4_province" style='width:30%' onChange="changeProvince4()" class="win_select" tabindex="18">
                <option value="0">省份</option> 
                <?php
                    if(!isset($edit4_province) || $edit4_province=='0')
                        $p1=$_SESSION['user_province'];
                    else
                        $p1=$edit4_province;
                    if(!isset($edit4_city))
                        $p2=$_SESSION['user_city'];
                    else
                        $p2=$edit4_city;
                    if(!isset($edit4_district))
                        $p3=$_SESSION['user_district'];
                    else
                        $p3=$edit4_district;
                    if($p1!=""){
                        for($i=1;$i<count($provinceArr);$i++){
                            echo "<option value=\"".$provinceArr[$i][0]."\"";
                            if($p1==$provinceArr[$i][0]){
                                echo " selected=\"selected\"";
                                $i1=$i;
                            }
                            echo ">".$provinceArr[$i][0]."</option>";
                        }
                    }
                    else{
                        for($i=1;$i<count($provinceArr);$i++)
                            echo "<option value=\"".$provinceArr[$i][0]."\">".$provinceArr[$i][0]."</option>";
                    }
                ?>
            </select> 
            <select name="edit4_city" id="edit4_city" style='width:30%' onChange="changeCity4()" class="win_select" tabindex="19">
                <option value="0">城市</option>
                <?php
                    if($p1!="" && $p2==""){
                        for($i=1;$i<count($provinceArr[$i1]);$i++){
                            echo "<option value=\"".$provinceArr[$i1][$i][0]."\">"
                                .$provinceArr[$i1][$i][0]."</option>";
                        }
                    }
                    elseif($p2!=""){
                        for($i=1;$i<count($provinceArr[$i1]);$i++){
                            echo "<option value=\"".$provinceArr[$i1][$i][0]."\"";
                            if($p2==$provinceArr[$i1][$i][0]){
                                echo " selected=\"selected\"";
                                $i2=$i;
                            }
                            echo ">".$provinceArr[$i1][$i][0]."</option>";
                        }
                    }
                ?>
            </select>
            <select name="edit4_district" id="edit4_district" style='width:30%' class="win_select" tabindex="20"> 
                <option value="0">地区</option> 
                <?php
                    if($p2!="" && $p3==""){
                        for($i=1;$i<count($provinceArr[$i1][$i2]);$i++){
                            echo "<option value=\"".$provinceArr[$i1][$i2][$i]."\">"
                                .$provinceArr[$i1][$i2][$i]."</option>";
                        }
                    }
                    elseif($p3!=""){
                        for($i=1;$i<count($provinceArr[$i1][$i2]);$i++){
                            echo "<option value=\"".$provinceArr[$i1][$i2][$i]."\"";
                            if($p3==$provinceArr[$i1][$i2][$i]){
                                echo " selected=\"selected\"";
                                $i3=$i;
                            }
                            echo ">".$provinceArr[$i1][$i2][$i]."</option>";
                        }
                    }
                ?>
            </select> 
            </label>
        </p>
        <p>
            <label>地址（*）:
            <input name="edit4_ad2" id="edit4_ad2" type="text" maxlength="100" class="win_input" placeholder="请输入你的详细地址"
             value="<?php if(isset($edit4_ad2)) echo $edit4_ad2; else echo $_SESSION['user_ad2'];?>" tabindex="21">
            </label>
        </p>
    </div>
    <div style="width: 50%; float: right; padding-left:10px;">
        <p>
            <label>电话（*）:
            <input name="edit4_phone" id="edit4_phone" type="text" maxlength="20" class="win_input" placeholder="请输入你的联系方式"
             value="<?php if(isset($edit4_phone)) echo $edit4_phone; else echo $_SESSION['user_phone'];?>" tabindex="22">
            </label>
        </p>
        <p>
            <label>邮箱（*）:
            <input name="edit4_email" id="edit4_email" type="text" maxlength="100" class="win_input" placeholder="请输入你的邮箱地址"
             value="<?php if(isset($edit4_email)) echo $edit4_email; else echo $_SESSION['user_email'];?>" tabindex="23">           
            </label>
        </p>
        <p>
            <label>原因（*）:
            <input name="edit4_info" id="edit4_info" type="text" maxlength="1000" class="win_input" placeholder="请输入你的求助原因"
             value="<?php if(isset($edit4_info)) echo $edit4_info; else echo $_SESSION['user_info'];?>" tabindex="24">        
            </label>
        </p>
        <p>
            <label>相关文件:<br>
            <div tabindex="15" class="win_file">
                <?php 
                $tip = $fileArr['file_name'].'.'.$fileArr["file_type"];?>
                <p id="edit4_file_tip" algin="center"><?php if($tip==".") echo '请上传相关文件的压缩包'; else echo $tip;?></p>
                <input name="edit4_file" id="edit4_file" type="file" value="" onchange="uploadFile4();">
            </div></label>
        <p>
    </div>   
</div>