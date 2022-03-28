<?php 
    // public/template/default/main/images
     $imageURL =  $this->_dirImg;

     //links
     $linkHome = URL::createLink('default','index','index');
     $linkCategories = URL::createLink('default','category','index');
     $linkMyAccount = URL::createLink('default','user','index');
     $linkRegister = URL::createLink('default','index','register');
     $linkLogin = URL::createLink('default','index','login');
     $linkLogout = URL::createLink('default','index','logout');
     $linkAdmin = URL::createLink('admin','index','index');

     $userObj = Session::get('user');
    // echo '<pre>';
    // print_r($userObj);
    // echo '</pre>';
?>

<div class="header">
    <div class="logo"><a href="<?php echo $linkHome; ?>"><img src="<?php echo $imageURL; ?>/logo.gif"/></a></div>            
    <div id="menu">

    <!-- MeNU -->
    <ul>                                                                       
            <li class="index-index"><a href="<?php echo $linkHome; ?>">Home</a></li>
            <li class="category-index"><a href="<?php echo $linkCategories; ?>">Categories</a></li>
            
           
           <?php 
                    if($userObj['login'] == false)
                    {
            ?>            
                        <li class="index-register"><a href="<?php echo $linkRegister; ?>">Register</a></li>
                        <li class="index-login"><a href="<?php echo $linkLogin; ?>">Login</a></li>

            <?php
                    }
            ?>

            <?php 
                    if($userObj['login'] == true)
                    {
            ?>            
                        <li class="user-index user-cart user-history"><a href="<?php echo $linkMyAccount; ?>">My account</a></li>
                        <li class="index-logout"><a href="<?php echo $linkLogout; ?>">Logout</a></li>

            <?php
                    }
            ?>


            <?php 
                    if($userObj['group_acp'] == true)
                    {
            ?>            
                        <li class=""><a href="<?php echo $linkAdmin; ?>">Admin Control Panel</a></li>
                        
            <?php
                    }
            ?>

            
            
    </ul>
    </div>     
</div> 