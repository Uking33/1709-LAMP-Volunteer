<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince4(){
        var sltProvince=document.getElementById("register4_province");
        var sltCity=document.getElementById("register4_city");
        var sltDistrict=document.getElementById("register4_district");
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
        var sltProvince=document.getElementById("register4_province");
        var sltCity=document.getElementById("register4_city");
        var sltDistrict=document.getElementById("register4_district");
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
        var sltYear=document.getElementById("register4_birth_year");
        var sltMonth=document.getElementById("register4_birth_month");
        var sltday=document.getElementById("register4_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth4(){
        var sltYear=document.getElementById("register4_birth_year");
        var sltMonth=document.getElementById("register4_birth_month");
        var sltday=document.getElementById("register4_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
    function uploadFile4(){
        var file=document.getElementById("register4_file");
		if(file.value!='')
			document.getElementById("register4_file_tip").innerHTML=file.value;
		else
			document.getElementById("register4_file_tip").innerHTML='请上传相关文件的压缩包';
    }
</script>
<div id="register4" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>姓名:<br>
            <input name="register4_name" id="register4_name" type="text" maxlength="20" class="win_input" placeholder="请输入真实姓名" value="<?php if(isset($register4_name)) echo $register4_name;?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>性别:<br>
            <div class="win_radio">
            <label><input name="register4_sex" type="radio" value=1 <?php if(isset($register4_sex) && $register4_sex==1) echo 'checked="true"'?> tabindex="12"/> 男</label> 
            <label><input name="register4_sex" type="radio" value=2 <?php if(isset($register4_sex) && $register4_sex==2) echo 'checked="true"'?> tabindex="13"/> 女</label> 
            <label><input name="register4_sex" type="radio" value=0 <?php if((isset($register4_sex) && $register4_sex==0)||(!isset($sex))) echo 'checked="true"'?> tabindex="14"/> 保密</label> 
            </div></label>
        </p>
        <p>
            <label for="birth">生日:<br>
            <select name="register4_birth_year" id="register4_birth_year" style='width:36%' onChange="changeYear4()" class="win_select" tabindex="15">
                <?php
                    if(isset($register4_birth)){
                        $date=$register4_birth;
                    }
                    else{
                        $date="20170101";
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
            <select name="register4_birth_month" id="register4_birth_month" style='width:26%' onChange="changeMonth4()" class="win_select" tabindex="16"> 
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
            <select name="register4_birth_day" id="register4_birth_day" style='width:26%' class="win_select" tabindex="17">
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
            <label>地区:<br>
            <select name="register4_province" id="register4_province" style='width:30%' onChange="changeProvince4()" class="win_select" tabindex="18">
                <option value="0">省份</option> 
                <?php
                    if(!isset($register4_province))
                        $p1='';
                    else
                        $p1=$register4_province;                            
                    if(!isset($register4_city))
                        $p2='';
                    else
                        $p2=$register4_city;  
                    if(!isset($register4_district))
                        $p3='';
                    else
                        $p3=$register4_district;  
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
            <select name="register4_city" id="register4_city" style='width:30%' onChange="changeCity4()" class="win_select" tabindex="19">
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
            <select name="register4_district" id="register4_district" style='width:30%' class="win_select" tabindex="20"> 
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
            <label>地址:
            <input name="register4_ad2" id="register4_ad2" type="text" maxlength="100" class="win_input" placeholder="请输入你的详细地址"
             value="<?php if(isset($register4_ad2)) echo $register4_ad2;?>" tabindex="21">
            </label>
        </p>
    </div>
    <div style="width: 50%; float: right; padding-left:10px;">
        <p>
            <label>电话:
            <input name="register4_phone" id="register4_phone" type="text" maxlength="20" class="win_input" placeholder="请输入你的联系方式"
             value="<?php if(isset($register4_phone)) echo $register4_phone;?>" tabindex="22">
            </label>
        </p>
        <p>
            <label>邮箱:
            <input name="register4_email" id="register4_email" type="text" maxlength="100" class="win_input" placeholder="请输入你的邮箱地址"
             value="<?php if(isset($register4_email)) echo $register4_email;?>" tabindex="23">           
            </label>
        </p>
        <p>
            <label>原因:
            <input name="register4_info" id="register4_info" type="text" maxlength="1000" class="win_input" placeholder="请输入你的求助原因"
             value="<?php if(isset($register4_info)) echo $register4_info;?>" tabindex="24">        
            </label>
        </p>
        <p>
            <label>相关文件:<br>
            <div class="win_file" tabindex="25">
                <p id="register4_file_tip" algin="center"">请上传相关文件的压缩包</p>
                <input name="register4_file" id="register4_file" type="file" onchange="uploadFile4();">
            </div></label>
        <p>
    </div>   
</div>