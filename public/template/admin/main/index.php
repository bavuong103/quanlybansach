<?php
        // echo '<pre>';
        // print_r($this);
        // echo '</pre>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="3600" />
    <meta name="description" content="mvc, php, zendvn" />
    <meta name="keywords" content="zend" />
    
    <title>
    <?php // xuat ra bien _title tu class View
     echo $this->_title; ?>
     </title>

    <?php //echo $this->_cssFiles ?> 
    <?php //echo $this->_jsFiles ?> 
    
    <link rel="stylesheet" type="text/css" href="public/template/admin/main/css/template.css"/>
    <link rel="stylesheet" type="text/css" href="public/template/admin/main/css/system.css"/>
    
    
    <script type="text/javascript" src="public/template/admin/main/js/jquery-1.10.2.min.js"></script>
   
    <script type="text/javascript" src="public/template/admin/main/js/custom.js"></script>
    
</head>
<body>
    
    <!-- Header -->
    <?php 
        include_once('html/header.php');
    ?>

    <!-- Content -->
    <div id="content-box">
        <?php

            // Keo vao duong dan~ trong folder views/user/login
            $path = MODULE_PATH . $this->_moduleName . DS . 'views' .  DS . $this->_fileView . '.php';
            require_once($path);

        ?>
    </div>

    <!-- Footer -->
    <?php 
        include_once('html/footer.php');
    ?>
    
       
	
</body>

	
