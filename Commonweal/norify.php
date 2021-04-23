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
    <title>通知</title>
    <script type="text/javascript" src=".\javascript\page_list.js"></script>
</head>  
<body>
    <!-- norify -->
    <div id="container" >
    <?php include('./includes/menu.inc.php'); ?>
        <?php if($_SESSION["user_type"] == '1') include('./includes/norify_self.inc.php'); ?>
        <?php include('./includes/norify_news.inc.php'); ?>
        <?php include('./includes/norify_list.inc.php'); ?>
    <?php include('./includes/footer.inc.php'); ?>
    </div>
</body>  
</html>