<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince3(){
        var sltProvince=document.getElementById("edit3_province");
        var sltCity=document.getElementById("edit3_city");
        var sltDistrict=document.getElementById("edit3_district");
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
        var sltProvince=document.getElementById("edit3_province");
        var sltCity=document.getElementById("edit3_city");
        var sltDistrict=document.getElementById("edit3_district");
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
        var sltYear=document.getElementById("edit3_birth_year");
        var sltMonth=document.getElementById("edit3_birth_month");
        var sltday=document.getElementById("edit3_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth3(){
        var sltYear=document.getElementById("edit3_birth_year");
        var sltMonth=document.getElementById("edit3_birth_month");
        var sltday=document.getElementById("edit3_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }

    function uploadFile3(){
        var file=document.getElementById("edit3_file");
		if(file.value!='')
			document.getElementById("edit3_file_tip").innerHTML=file.value;
		else
			document.getElementById("edit3_file_tip").innerHTML='请上传相关文件的压缩包';
    }
</script>
<div id="edit3" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>名称（*）:<br>
            <input name="edit3_name" id="edit3_name" type="text" maxlength="20" class="win_input" placeholder="请输入公司的注册名称" value="<?php if(isset($edit3_name)) echo $edit3_name; else echo $_SESSION['user_name'];?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>地区（*）:<br>
            <select name="edit3_province" id="edit3_province" style='width:30%' onChange="changeProvince3()" class="win_select" tabindex="12">
                <option value="0">省份</option> 
                <?php
                    if(!isset($edit3_province))
                        $p1=$_SESSION['user_province'];
                    else
                        $p1=$province;                            
                    if(!isset($edit3_city))
                        $p2=$_SESSION['user_city'];
                    else
                        $p2=$city;  
                    if(!isset($edit3_district))
                        $p3=$_SESSION['user_district'];
                    else
                        $p3=$edit3_district;  
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
            <select name="edit3_city" id="edit3_city" style='width:30%' onChange="changeCity3()" class="win_select" tabindex="13">
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
            <select name="edit3_district" id="edit3_district" style='width:30%' class="win_select" tabindex="14"> 
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
            <input name="edit3_ad2" id="edit3_ad2" type="text" maxlength="100" class="win_input" placeholder="请输入公司的详细地址" tabindex="15"
             value="<?php if(isset($edit3_ad2)) echo $edit3_ad2; else echo $_SESSION['user_ad2'];?>">
            </label>
        </p>
        <p>
            <label>相关文件:<br>
            <div tabindex="15" class="win_file">
                <?php 
                $tip = $fileArr['file_name'].'.'.$fileArr["file_type"];?>
                <p id="edit3_file_tip" algin="center"><?php if($tip==".") echo '请上传相关文件的压缩包'; else echo $tip;?></p>
                <input name="edit3_file" id="edit3_file" type="file" value="" onchange="uploadFile3();">
            </div></label>
        <p>
    </div>
    <div style="width: 50%; float: right; padding-left:10px;">
        <p>
            <label>电话（*）:
            <input name="edit3_phone" id="edit3_phone" type="text" maxlength="20" class="win_input" placeholder="请输入公司的联系方式"
             value="<?php if(isset($edit3_phone)) echo $edit3_phone; else echo $_SESSION['user_phone'];?>" tabindex="16">
            </label>
        </p>
        <p>
            <label>邮箱（*）:
            <input name="edit3_email" id="edit3_email" type="text" maxlength="100" class="win_input" placeholder="请输入公司的邮箱地址"
             value="<?php if(isset($edit3_email)) echo $edit3_email; else echo $_SESSION['user_email'];?>" tabindex="17">           
            </label>
        </p>
        <p>
            <label>简介（*）:
            <textarea name="edit3_info" id="edit3_info" maxlength="1000" rows="5" class="win_textarea" placeholder="请输入公司的简介"
              tabindex="18"><?php if(isset($edit3_info)) echo $edit3_info; else echo $_SESSION['user_info'];?></textarea>
            </label>
        </p>
    </div>
</div>