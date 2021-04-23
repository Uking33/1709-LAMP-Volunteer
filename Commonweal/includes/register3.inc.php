<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince3(){
        var sltProvince=document.getElementById("register3_province");
        var sltCity=document.getElementById("register3_city");
        var sltDistrict=document.getElementById("register3_district");
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
    function changeCity3(){
        var sltProvince=document.getElementById("register3_province");
        var sltCity=document.getElementById("register3_city");
        var sltDistrict=document.getElementById("register3_district");
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
    function changeYear3(){
        var sltYear=document.getElementById("register3_birth_year");
        var sltMonth=document.getElementById("register3_birth_month");
        var sltday=document.getElementById("register3_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth3(){
        var sltYear=document.getElementById("register3_birth_year");
        var sltMonth=document.getElementById("register3_birth_month");
        var sltday=document.getElementById("register3_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }

    function uploadFile3(){
        var file=document.getElementById("register3_file");
		if(file.value!='')
			document.getElementById("register3_file_tip").innerHTML=file.value;
		else
			document.getElementById("register3_file_tip").innerHTML='请上传相关文件的压缩包';
    }
</script>
<div id="register3" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>名称:<br>
            <input name="register3_name" id="register3_name" type="text" maxlength="20" class="win_input" placeholder="请输入公司的注册名称" value="<?php if(isset($register3_name)) echo $register3_name;?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>地区:<br>
            <select name="register3_province" id="register3_province" style='width:30%' onChange="changeProvince3()" class="win_select" tabindex="12">
                <option value="0">省份</option> 
                <?php
                    if(!isset($register3_province))
                        $p1='';
                    else
                        $p1=$province;                            
                    if(!isset($register3_city))
                        $p2='';
                    else
                        $p2=$city;  
                    if(!isset($register3_district))
                        $p3='';
                    else
                        $p3=$register3_district;  
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
            <select name="register3_city" id="register3_city" style='width:30%' onChange="changeCity3()" class="win_select" tabindex="13">
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
            <select name="register3_district" id="register3_district" style='width:30%' class="win_select" tabindex="14"> 
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
            <input name="register3_ad2" id="register3_ad2" type="text" maxlength="100" class="win_input" placeholder="请输入公司的详细地址" tabindex="15"
             value="<?php if(isset($register3_ad2)) echo $register3_ad2;?>">
            </label>
        </p>
        <p>
            <label>相关文件:<br>
            <div class="win_file" tabindex="15">
                <p id="register3_file_tip" algin="center"">请上传相关文件的压缩包</p>
                <input name="register3_file" id="register3_file" type="file" onchange="uploadFile3();">
            </div></label>
        <p>
    </div>
    <div style="width: 50%; float: right; padding-left:10px;">
        <p>
            <label>电话:
            <input name="register3_phone" id="register3_phone" type="text" maxlength="20" class="win_input" placeholder="请输入公司的联系方式"
             value="<?php if(isset($register3_phone)) echo $register3_phone;?>" tabindex="16">
            </label>
        </p>
        <p>
            <label>邮箱:
            <input name="register3_email" id="register3_email" type="text" maxlength="100" class="win_input" placeholder="请输入公司的邮箱地址"
             value="<?php if(isset($register3_email)) echo $register3_email;?>" tabindex="17">           
            </label>
        </p>
        <p>
            <label>简介:
            <textarea name="register3_info" id="register3_info" maxlength="1000" rows="5" class="win_textarea" placeholder="请输入公司的简介"
             value="<?php if(isset($register3_info)) echo $register3_info;?>" tabindex="18"></textarea>
            </label>
        </p>
    </div>
</div>