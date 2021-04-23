<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <?php header("Content-Type: text/html; charset=UTF-8");?>
    <title>主页</title>
    <script type="text/javascript" src=".\javascript\page_list.js"></script>
</head>
<body>
    <div id="container">
    <?php include('./includes/menu.inc.php'); ?>
    <!-- home -->
        <?php include('./includes/help_list.inc.php'); ?>
        <?php include('./includes/norify_news.inc.php'); ?>
        <?php include('./includes/activity_news.inc.php'); ?>
    <?php include('./includes/footer.inc.php'); ?>
    </div>
</body>  
</html>