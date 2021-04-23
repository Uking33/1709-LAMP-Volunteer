<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince2(){
        var sltProvince=document.getElementById("register2_province");
        var sltCity=document.getElementById("register2_city");
        var sltDistrict=document.getElementById("register2_district");
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
    function changeCity2(){
        var sltProvince=document.getElementById("register2_province");
        var sltCity=document.getElementById("register2_city");
        var sltDistrict=document.getElementById("register2_district");
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
    function changeYear2(){
        var sltYear=document.getElementById("register2_birth_year");
        var sltMonth=document.getElementById("register2_birth_month");
        var sltday=document.getElementById("register2_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth2(){
        var sltYear=document.getElementById("register2_birth_year");
        var sltMonth=document.getElementById("register2_birth_month");
        var sltday=document.getElementById("register2_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
</script>
<div id="register2" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>姓名:<br>
            <input name="register2_name" id="register2_name"  maxlength="20" type="text" class="win_input" placeholder="请输入真实姓名" value="<?php if(isset($register2_name)) echo $register2_name;?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>性别:<br>
            <div class="win_radio">
            <label><input name="register2_sex" type="radio" value=1 <?php if(isset($register2_sex) && $register2_sex==1) echo 'checked="true"'?> tabindex="12"/> 男</label> 
            <label><input name="register2_sex" type="radio" value=2 <?php if(isset($register2_sex) && $register2_sex==2) echo 'checked="true"'?> tabindex="13"/> 女</label> 
            <label><input name="register2_sex" type="radio" value=0 <?php if((isset($register2_sex) && $register2_sex==0)||(!isset($sex))) echo 'checked="true"'?> tabindex="14"/> 保密</label> 
            </div></label>
        </p>
        <p>
            <label>学历:<br>
            <select name="register2_qualifications" id="register2_qualifications" class="win_select" tabindex="15">
                <option value=0 <?php if(isset($register2_qualifications) && $register2_qualifications==0) echo 'selected="true"'?>>-请选择-</option>
                <option value=1 <?php if(isset($register2_qualifications) && $register2_qualifications==1) echo 'selected="true"'?>>博士</option>
                <option value=2 <?php if(isset($register2_qualifications) && $register2_qualifications==2) echo 'selected="true"'?>>硕士</option>
                <option value=3 <?php if(isset($register2_qualifications) && $register2_qualifications==3) echo 'selected="true"'?>>本科</option>
                <option value=4 <?php if(isset($register2_qualifications) && $register2_qualifications==4) echo 'selected="true"'?>>大专</option>
                <option value=5 <?php if(isset($register2_qualifications) && $register2_qualifications==5) echo 'selected="true"'?>>高中</option>
                <option value=6 <?php if(isset($register2_qualifications) && $register2_qualifications==6) echo 'selected="true"'?>>初中</option>
                <option value=7 <?php if(isset($register2_qualifications) && $register2_qualifications==7) echo 'selected="true"'?>>小学</option>
            </select>
            </label>
        </p>
        <p>
            <label for="birth">生日:<br>
            <select name="register2_birth_year" id="register2_birth_year" style='width:36%' onChange="changeYear2()" class="win_select" tabindex="16">
                <?php
                    if(isset($register2_birth)){
                        $date=$register2_birth;
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
            <select name="register2_birth_month" id="register2_birth_month" style='width:26%' onChange="changeMonth2()" class="win_select" tabindex="17"> 
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
            <select name="register2_birth_day" id="register2_birth_day" style='width:26%' class="win_select" tabindex="18">
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
            <select name="register2_province" id="register2_province" style='width:30%' onChange="changeProvince2()" class="win_select" tabindex="19">
                <option value="0">省份</option> 
                <?php
                    if(!isset($register2_province) || $register2_province=='0')
                        $p1='';
                    else
                        $p1=$register2_province;                            
                    if(!isset($register2_city))
                        $p2='';
                    else
                        $p2=$register2_city;  
                    if(!isset($register2_district))
                        $p3='';
                    else
                        $p3=$register2_district;  
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
            <select name="register2_city" id="register2_city" style='width:30%' onChange="changeCity2()" class="win_select" tabindex="20">
                <option value="0">城市</option>
                <?php
                    if($p1!="" && $p2==""){
                        for($i=1;$i<count($provinceArr[$i1]);$i++){
                            echo "<option value='".$provinceArr[$i1][$i][0]."'>"
                                .$provinceArr[$i1][$i][0]."</option>";
                        }
                    }
                    elseif($p2!=""){
                        for($i=1;$i<count($provinceArr[$i1]);$i++){
                            echo "<option value='".$provinceArr[$i1][$i][0]."'";
                            if($p2==$provinceArr[$i1][$i][0]){
                                echo " selected='selected'";
                                $i2=$i;
                            }
                            echo ">".$provinceArr[$i1][$i][0]."</option>";
                        }
                    }
                ?>
            </select>
            <select name="register2_district" id="register2_district" style='width:30%' class="win_select" tabindex="21"> 
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
    </div>
    <div style="width: 50%; float: right; padding-left:10px;">
        <p>
            <label>电话:
            <input name="register2_phone" id="register2_phone" type="text" maxlength="20" class="win_input" placeholder="请输入你的联系方式"
             value="<?php if(isset($register2_phone)) echo $register2_phone;?>" tabindex="22">
            </label>
        </p>
        <p>
            <label>邮箱:
            <input name="register2_email" id="register2_email" type="text" maxlength="100" class="win_input" placeholder="请输入你的邮箱地址"
             value="<?php if(isset($register2_email)) echo $register2_email;?>" tabindex="23">           
            </label>
        </p>
        <p>
            <label>工作:
            <input name="register2_work" id="register2_work" type="text" maxlength="100" class="win_input" placeholder="请输入你的工作内容"
             value="<?php if(isset($register2_work)) echo $register2_work;?>" tabindex="24">
            </label>
        </p>
        <p>
            <label>简介:
            <input name="register2_info" id="register2_info" type="text" maxlength="1000" class="win_input" placeholder="请输入你的个人介绍"
             value="<?php if(isset($register2_info)) echo $register2_info;?>" tabindex="25">        
            </label>
        </p>
        <p>
            <label>地址:
            <input name="register2_ad2" id="register2_ad2" type="text" maxlength="100" class="win_input" placeholder="请输入你的详细地址"
             value="<?php if(isset($register2_ad2)) echo $register2_ad2;?>" tabindex="26">
            </label>
        </p>
    </div>
    
    
</div>