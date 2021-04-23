<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <?php
        header("Content-Type: text/html; charset=UTF-8");
        function ellipsis($str, $length){
            if(strlen($str)<=$length)
                return $str;
            else
                return mb_substr($str,0,$length,'utf-8')."...";
        }
    ?>
    <title>活动</title>
    <script type="text/javascript" src=".\javascript\page_list.js"></script>
</head>  
<body>
    <!-- activity -->
    <div id="container" >
    <?php include('./includes/menu.inc.php'); ?>
        <?php if($_SESSION["user_type"] == '1' || $_SESSION["user_type"] == '3') include('./includes/activity_self.inc.php'); ?>
        <?php if($_SESSION["user_type"] == '1') include('./includes/activity_list_check.inc.php'); ?>
        <?php include('./includes/activity_news.inc.php'); ?>
        <?php include('./includes/activity_list_ing.inc.php'); ?>
        <?php include('./includes/activity_list_new.inc.php'); ?>
        <?php include('./includes/activity_list_end.inc.php'); ?>
    <?php include('./includes/footer.inc.php'); ?>
    </div>
</body>  
</html>