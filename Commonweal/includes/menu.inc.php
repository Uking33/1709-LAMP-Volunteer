<!-- menu -->
<!-- menu pre -->
<?php
    require_once('./sql/connection.php');
    require_once ('./includes/getdata.inc.php');
    //session_unset();
    function helloWord1(){
        date_default_timezone_set('PRC');
        //week
        $week=date('l');
        switch($week){
            case 'Monday':
                $week = '星期一';
                break;
            case 'Tuesday':
                $week = '星期二';
                break;
            case 'Wednesday':
                $week = '星期三';
                break;
            case 'Thursday':
                $week = '星期四';
                break;
            case 'Friday':
                $week = '星期五';
                break;
            case 'Saturday':
                $week = '星期六';
                break;
            case 'Sunday':
                $week = '星期天';
                break;
        }
        $welcome=date("Y")."年".date("n")."月".date("d")."日  $week,";
        //time
        $time=date('G');
        if($time>=0 && $time<6){
            $time="半夜好,夜猫子，要注意身体哦！";
        }
        elseif($time>=6 && $time<8){
            $time="早上好,早起的鸟儿有虫吃！";
        }
        elseif($time>=8 && $time<12){
            $time="早上好,今天的阳光真灿烂啊！";
        }
        elseif($time>=12 && $time<14){
            $time="中午好,午休时间。保持睡眠哦！";
        }
        elseif($time>=14 && $time<18){
            $time="下午好,祝您下午工作愉快！";
        }
        elseif($time>=18 && $time<22){
            $time="晚上好,忙碌了一天，该放松啦！";
        }
        elseif($time>=22 && $time<24){
            $time="晚上好,您应该休息了！";
        }
        $welcome.=$time;
        return $welcome;
    }
    function helloWord2(){
        if(!isset($_SESSION['user_accounts'])){
            return;
        }
        switch($_SESSION['user_type']){
            case 1:
                $username='管理员';
                break;
            case 2:
                $username='义工';
                break;
            case 3:
                $username='赞助商';
                break;
            case 4:
                $username='求助者';
                break;
        }
        $conn = dbConnect('read');
        getUserDetails($conn,$_SESSION['user_id']);
        $username.=sprintf('%02s', (string)$_SESSION['user_type']).sprintf('%08s', (string)$_SESSION['user_id']);;
        return $username;
    }
    function cut_str($str,$sign,$number){
        $array=explode($sign, $str);
        $length=count($array);
        if($number<0){
            $new_array=array_reverse($array);
            $abs_number=abs($number);
            if($abs_number>$length){
                return 'error';
            }else{
                return $new_array[$abs_number-1];
            }
        }else{
            if($number>=$length){
                return 'error';
            }else{
                return $array[$number];
            }
        }
    }
    function getTag(){
        $tag = $_SERVER['PHP_SELF'];
        $tag = cut_str($tag,'/',2);
        $tag = substr($tag,0,strpos($tag, '.'));
        return $tag;
    }
    $tag = getTag();    
?>
<script language="JavaScript" type="text/javascript">
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });
</script>
<link href="<?php echo getPath('css/bootstrap.css')?>" rel='stylesheet' type='text/css' />
<link href="<?php echo getPath('css/style.css')?>" rel='stylesheet' type='text/css' />
<link href="<?php echo getPath('css/box.css')?>" rel='stylesheet' type="text/css" />
<link href="<?php echo getPath('css/table.css')?>" rel='stylesheet' type="text/css" />
<link href="<?php echo getPath('css/message.css')?>" rel='stylesheet' type="text/css" />
<style>
    #container{
    	min-width:1000px;
    }
    .container{
    	padding: 0px 50px;
    }
    .boxItem{
        width:23%;
        float:left;
    	margin-left:1%;
    	margin-right:1%;
    }
</style>
<!-- menu window -->
<?php
    if(!isset($_SESSION['user_accounts']) && ($tag=='home'))
        include("./includes/login.inc.php");
    if((!isset($_SESSION['user_accounts']) &&
        $tag=='home') || $tag=='manage')
        include("./includes/register.inc.php");
    if(!isset($_SESSION['user_accounts']) &&
        ($tag=='info'
        || $tag=='norify_details'
        || $tag=='activity_details')){
        echo "
        <script language='JavaScript' type='text/javascript'>
        function showLogin(){
            location.href = './home.php?loginWinStat=login_user';
        }
        function showRegister(){
            location.href = './home.php?registerWinStat=login_user';
        }</script>";
    }
    if(isset($_SESSION['user_type'])){
        if($tag=='norify' && $_SESSION["user_type"] == '1') include('./includes/norify_publish.inc.php');
        if($tag=='activity' && ($_SESSION["user_type"] == '1' || $_SESSION["user_type"] == '3')) include('./includes/activity_publish.inc.php');
        if($tag=='test' && $_SESSION["user_type"] == '1') include('./includes/test_publish.inc.php');
    }
?>
<!-- menu head -->
<div class="head" id="home">
	<div class="container">
		<div class="head-top">
			<div class="col-md-6 h-left" style="width:50%; float:left;">
				<p><?php echo helloWord1();?></p>
			</div>
			<div class="col-md-6 h-right" style="width:20%; float:right;">
				<ul>
                <?php 
		            echo "<p style='color:#FFFFFF;'>".helloWord2()."</p>";
                ?>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>
</div>
<!-- menu header -->
<div class="header">
	<div class="container">
		<div class="header-main">
			<div class="logo">
				<a href="home.php"><h1>公益活动管理系统</h1></a>
			</div>
			<div class="head-right">	   		
				<div class="top-nav">			
                    <ul>
						<li><a href="home.php" class="<?php if($tag=='home' || !isset($_SESSION['user_id'])) echo 'active'?>"><span class="glyphicon glyphicon-home"></span>首页</a></li>
        <?php 
        if(isset($_SESSION['user_accounts'])){
            switch($_SESSION['user_type']){
                case 1:
                    ?>
                        <li><a href='norify.php' class="<?php if($tag=='norify' || $tag=='norify_details') echo 'active';?>"><span class="glyphicon glyphicon-envelope"></span>通知</a></li>
                        <li><a href='activity.php' class="<?php if($tag=='activity' || $tag=='activity_details') echo 'active';?>"><span class="glyphicon glyphicon-flag"></span>活动</a></li>
                        <li><a href='study.php' class="<?php if($tag=='study') echo 'active';?>"><span class="glyphicon glyphicon-book"></span>培训</a></li>
                        <li><a href='test.php' class="<?php if($tag=='test' || $tag=='test_details' || $tag=='test_making') echo 'active';?>"><span class="glyphicon glyphicon-pencil"></span>考核</a></li>
                        <li><a href='manage.php' class="<?php if($tag=='manage') echo 'active';?>"><span class="glyphicon glyphicon-list"></span>管理</a></li>
                        <li><a href='info.php?id=<?php echo $_SESSION['user_id'];?>&back=home.php' class="<?php if($tag=='info') echo 'active';?>"><span class="glyphicon glyphicon-info-sign"></span>信息</a></li>
                        <li><a href='./includes/logout.inc.php'><span class="glyphicon glyphicon-user"></span>注销</a></li>
						<div class="clearfix"> </div> 
                    </ul>
                    <?php 
                break;
                case 2:
                    ?>
                        <li><a href='norify.php' class="<?php if($tag=='norify' || $tag=='norify_details') echo 'active';?>"><span class="glyphicon glyphicon-envelope"></span>通知</a></li>
                        <li><a href='activity.php' class="<?php if($tag=='activity' || $tag=='activity_details') echo 'active';?>"><span class="glyphicon glyphicon-flag"></span>活动</a></li>
                        <li><a href='study.php' class="<?php if($tag=='study') echo 'active';?>"><span class="glyphicon glyphicon-book"></span>培训</a></li>
                        <li><a href='test.php' class="<?php if($tag=='test' || $tag=='test_details' || $tag=='test_making') echo 'active';?>"><span class="glyphicon glyphicon-pencil"></span>考核</a></li>
                        <li><a href='info.php?id=<?php echo $_SESSION['user_id'];?>&back=home.php' class="<?php if($tag=='info') echo 'active';?>"><span class="glyphicon glyphicon-info-sign"></span>信息</a></li>
                        <li><a href='./includes/logout.inc.php'><span class="glyphicon glyphicon-user"></span>注销</a></li>                        
                    </ul>
                    <?php
                break;
                case 3:
                    ?>
                        <li><a href='norify.php' class="<?php if($tag=='norify' || $tag=='norify_details') echo 'active';?>"><span class="glyphicon glyphicon-envelope"></span>通知</a></li>
                        <li><a href='activity.php' class="<?php if($tag=='activity' || $tag=='activity_details') echo 'active';?>"><span class="glyphicon glyphicon-flag"></span>活动</a></li>
                        <li><a href='info.php?id=<?php echo $_SESSION['user_id'];?>&back=home.php' class="<?php if($tag=='info') echo 'active';?>"><span class="glyphicon glyphicon-info-sign"></span>信息</a></li>
                        <li><a href='./includes/logout.inc.php'><span class="glyphicon glyphicon-user"></span>注销</a></li>  
                    </ul>
                    <?php
                break;
                case 4:
                    ?>
                        <li><a href='norify.php' class="<?php if($tag=='norify' || $tag=='norify_details') echo 'active';?>"><span class="glyphicon glyphicon-envelope"></span>通知</a></li>
                        <li><a href='activity.php' class="<?php if($tag=='activity' || $tag=='activity_details') echo 'active';?>"><span class="glyphicon glyphicon-flag"></span>活动</a></li>
                        <li><a href='info.php?id=<?php echo $_SESSION['user_id'];?>&back=home.php' class="<?php if($tag=='info') echo 'active';?>"><span class="glyphicon glyphicon-info-sign"></span>信息</a></li>
                        <li><a href='./includes/logout.inc.php'><span class="glyphicon glyphicon-user"></span>注销</a></li>  
                    </ul>
                    <?php
                break;
            }
        }
        else{
                ?>
                        <li><a href="javascript:showLogin();"><span class="glyphicon glyphicon-check"></span>登陆</a></li>  
                        <li><a href='javascript:showRegister();'><span class="glyphicon glyphicon-edit"></span>注册</a></li>  
                    </ul>
                <?php
        }?>
				</div>
			</div>
		</div>	
	</div>
</div>