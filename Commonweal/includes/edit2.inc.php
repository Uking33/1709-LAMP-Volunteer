<script type="text/javascript">
    //---area---
	var provinceJsArr=<?php echo urldecode($provinceJsonArr);?>; 
    function changeProvince2(){
        var sltProvince=document.getElementById("edit2_province");
        var sltCity=document.getElementById("edit2_city");
        var sltDistrict=document.getElementById("edit2_district");
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
        var sltProvince=document.getElementById("edit2_province");
        var sltCity=document.getElementById("edit2_city");
        var sltDistrict=document.getElementById("edit2_district");
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
        var sltYear=document.getElementById("edit2_birth_year");
        var sltMonth=document.getElementById("edit2_birth_month");
        var sltday=document.getElementById("edit2_birth_day");
        sltMonth.value = 1; 
        sltday.length=0;
        for(var i=1;i<=31;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }        
    function changeMonth2(){
        var sltYear=document.getElementById("edit2_birth_year");
        var sltMonth=document.getElementById("edit2_birth_month");
        var sltday=document.getElementById("edit2_birth_day");
        sltday.length=0;
        var day = new Date(sltYear[sltYear.selectedIndex].text, sltMonth[sltMonth.selectedIndex].text, 0); 
        var daycount = day.getDate();
        for(var i=1;i<=daycount;i++){
        	sltday[i-1]=new Option(i,i);  
        }
    }
</script>
<div id="edit2" style="display:none; width: 66%; float: right;" class="win_box3">
    <div style="width: 50%; float: left; padding-right:10px;">
        <p>
            <label>?????????*???:<br>
            <input name="edit2_name" id="edit2_name"  maxlength="20" type="text" class="win_input" placeholder="?????????????????????" value="<?php if(isset($edit2_name)) echo $edit2_name; else echo $_SESSION['user_name'];?>" tabindex="11">
            </label>
        </p>
        <p>
            <label>?????????*???:<br>
            <div class="win_radio">
            <label><input name="edit2_sex" type="radio" value=1 <?php if((isset($edit2_sex) && $edit2_sex==1)||(!isset($edit2_sex) && $_SESSION['user_sex']==1)) echo 'checked="true"'?> tabindex="12"/> ???</label> 
            <label><input name="edit2_sex" type="radio" value=2 <?php if((isset($edit2_sex) && $edit2_sex==2)||(!isset($edit2_sex) && $_SESSION['user_sex']==2)) echo 'checked="true"'?> tabindex="13"/> ???</label> 
            <label><input name="edit2_sex" type="radio" value=0 <?php if((isset($edit2_sex) && $edit2_sex==0)||(!isset($edit2_sex) && $_SESSION['user_sex']==0)) echo 'checked="true"'?> tabindex="14"/> ??????</label> 
            </div></label>
        </p>
        <p>
            <label>?????????*???:<br>
            <select name="edit2_qualifications" id="edit2_qualifications" class="win_select" tabindex="15">
                <option value=0 <?php if((isset($edit2_qualifications) && $edit2_qualifications==0) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==0)) echo 'selected="true"'?>>-?????????-</option>
                <option value=1 <?php if((isset($edit2_qualifications) && $edit2_qualifications==1) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==1)) echo 'selected="true"'?>>??????</option>
                <option value=2 <?php if((isset($edit2_qualifications) && $edit2_qualifications==2) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==2)) echo 'selected="true"'?>>??????</option>
                <option value=3 <?php if((isset($edit2_qualifications) && $edit2_qualifications==3) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==3)) echo 'selected="true"'?>>??????</option>
                <option value=4 <?php if((isset($edit2_qualifications) && $edit2_qualifications==4) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==4)) echo 'selected="true"'?>>??????</option>
                <option value=5 <?php if((isset($edit2_qualifications) && $edit2_qualifications==5) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==5)) echo 'selected="true"'?>>??????</option>
                <option value=6 <?php if((isset($edit2_qualifications) && $edit2_qualifications==6) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==6)) echo 'selected="true"'?>>??????</option>
                <option value=7 <?php if((isset($edit2_qualifications) && $edit2_qualifications==7) || (!isset($edit2_qualifications) && $_SESSION['user_qualifications']==7)) echo 'selected="true"'?>>??????</option>
            </select>
            </label>
        </p>
        <p>
            <label for="birth">?????????*???:<br>
            <select name="edit2_birth_year" id="edit2_birth_year" style='width:36%' onChange="changeYear2()" class="win_select" tabindex="16">
                <?php
                    if(isset($edit2_birth)){
                        $date=$edit2_birth;
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
            <select name="edit2_birth_month" id="edit2_birth_month" style='width:26%' onChange="changeMonth2()" class="win_select" tabindex="17"> 
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
            <select name="edit2_birth_day" id="edit2_birth_day" style='width:26%' class="win_select" tabindex="18">
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
            <label>?????????*???:<br>
            <select name="edit2_province" id="edit2_province" style='width:30%' onChange="changeProvince2()" class="win_select" tabindex="19">
                <option value="0">??????</option> 
                <?php
                    if(!isset($edit2_province) || $edit2_province=='0')
                        $p1=$_SESSION['user_province'];
                    else
                        $p1=$edit2_province;                            
                    if(!isset($edit2_city))
                        $p2=$_SESSION['user_city'];
                    else
                        $p2=$edit2_city;  
                    if(!isset($edit2_district))
                        $p3=$_SESSION['user_district'];
                    else
                        $p3=$edit2_district;  
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
            <select name="edit2_city" id="edit2_city" style='width:30%' onChange="changeCity2()" class="win_select" tabindex="20">
                <option value="0">??????</option>
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
            <select name="edit2_district" id="edit2_district" style='width:30%' class="win_select" tabindex="21"> 
                <option value="0">??????</option> 
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
            <label>?????????*???:
            <input name="edit2_phone" id="edit2_phone" type="text" maxlength="20" class="win_input" placeholder="???????????????????????????"
             value="<?php if(isset($edit2_phone)) echo $edit2_phone; else echo $_SESSION['user_phone'];?>" tabindex="22">
            </label>
        </p>
        <p>
            <label>?????????*???:
            <input name="edit2_email" id="edit2_email" type="text" maxlength="100" class="win_input" placeholder="???????????????????????????"
             value="<?php if(isset($edit2_email)) echo $edit2_email; else echo $_SESSION['user_email'];?>" tabindex="23">           
            </label>
        </p>
        <p>
            <label>?????????*???:
            <input name="edit2_work" id="edit2_work" type="text" maxlength="100" class="win_input" placeholder="???????????????????????????"
             value="<?php if(isset($edit2_work)) echo $edit2_work; else echo $_SESSION['user_work'];?>" tabindex="24">
            </label>
        </p>
        <p>
            <label>?????????*???:
            <input name="edit2_info" id="edit2_info" type="text" maxlength="1000" class="win_input" placeholder="???????????????????????????"
             value="<?php if(isset($edit2_info)) echo $edit2_info; else echo $_SESSION['user_info'];?>" tabindex="25">        
            </label>
        </p>
        <p>
            <label>?????????*???:
            <input name="edit2_ad2" id="edit2_ad2" type="text" maxlength="100" class="win_input" placeholder="???????????????????????????"
             value="<?php if(isset($edit2_ad2)) echo $edit2_ad2; else echo $_SESSION['user_ad2'];?>" tabindex="26">
            </label>
        </p>
    </div>
    
    
</div>