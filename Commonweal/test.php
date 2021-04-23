<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>
    <?php header("Content-Type: text/html; charset=UTF-8");?>
    <title>考核</title>
    <script type="text/javascript" src=".\javascript\page_list.js"></script>
</head>  
<body>
    <?php include('./includes/menu.inc.php'); ?>
    <div id="container" >
        <?php if($_SESSION['user_type']=='1') include('./includes/test_self.inc.php'); ?>
        <?php if($_SESSION['user_type']=='2')  include('./includes/test_list.inc.php'); ?>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</body>  
</html>