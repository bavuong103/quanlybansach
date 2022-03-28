<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>
    <?php // xuat ra bien _title tu class View
    echo $this->_title; ?>
</title>

<link rel="stylesheet" type="text/css" href="public/template/default/main/css/style.css"/>
<link rel="stylesheet" type="text/css" href="public/template/default/main/css/lightbox.css"/>
   
<script type="text/javascript" src="public/template/default/main/js/jquery.js"></script>

<script type="text/javascript" src="public/template/default/main/js/custom.js"></script>

</head>
<body>
<div id="wrap">

    <?php include_once('html/header.php');?> 

    <div class="center_content">
       	<div class="left_content">
        	<!-- Content -->
            <?php
                // Keo vao duong dan~ trong folder views/user/login
                $path = MODULE_PATH . $this->_moduleName . DS . 'views' .  DS . $this->_fileView . '.php';
                require_once($path);
            ?>
        </div>
        
        <div class="right_content">	
        <?php include_once(BLOCK_PATH . 'language.php');?>  
        <?php include_once(BLOCK_PATH . 'cart.php');?>  
        <?php include_once(BLOCK_PATH . 'promotion.php');?> 
        <?php include_once(BLOCK_PATH . 'category.php');?>   
        </div>
 
       <div class="clear"></div>
    </div>
        
    <?php include_once('html/footer.php'); ?>
    

</div>

</body>
</html>