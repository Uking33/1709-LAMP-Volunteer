<!-- norify news -->
<?php
    //load data
    $conn = dbConnect('read');    
    $norifyNewsArr=getNorifies($conn,"", "order by activity_id desc LIMIT 4");
    $conn->close();
?>
<script language="JavaScript" type="text/javascript">
	//api
    function addNorifyNews(id,author,name,content){
        var sScript;
        sScript='<div class="boxItem team-left wow bounceIn animated" data-wow-delay=".5s" style="visibility: visible; -webkit-animation-delay: .5s;">';
        if(author!=""){
            <?php if(isset($_SESSION['user_type'])){?>
            sScript+='<a href="./norify_details.php?id='+id+'&back=norify.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
			<?php }else{?>
			sScript+='<a href="./norify_details.php?id='+id+'&back=home.php"><label class="textCenter">'+CutString(content,60,true)+'</label>';
			<?php }?>
            sScript+='<div class="captn"><h4>'+name+'</h4><p>'+author+'</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>'+author+'</p></div>';
		}
		else{
            sScript+='<a href="javascript:void(0)"><label class="textCenter">'+CutString(content,60,true)+'</label>';
            sScript+='<div class="captn"><h4>'+name+'</h4><p>&nbsp;</p></div>';
            sScript+='<div class="team-text"><h5>'+name+'</h5><p>&nbsp;</p></div>';
		}
        sScript+='</a></div>';
        norifyNews.insertAdjacentHTML("beforeEnd",sScript);            
	}
</script>
	
<div class="team">
	<div class="container">
		<div class="team-top heading">
			<h3>最新通知</h3>
		</div>
		<div class="team-bottom" id="norifyNews">
		  <div class="clearfix"></div>
		</div>
		<script type='text/javascript'>
        <?php
            //load label
            if(count($norifyNewsArr) > 0){
                foreach($norifyNewsArr as $arr){
                    echo "addNorifyNews('".$arr['activity_id']."','".
                   trPromalgotor($arr['promalgotor_id'])."','".$arr['activity_name']."','".textDelEnter($arr['activity_content'])."');";
                }
                echo "\n";
            }
            if(count($norifyNewsArr) < 4){
                $num = 4-count($norifyNewsArr);
                for($i=0;$i<$num;$i++){
                    echo "addNorifyNews('','','无通知','内容为空')";
                    echo "\n";
                }
            }
        ?>
        </script>
	</div>
</div>