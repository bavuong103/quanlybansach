<?php

$linkChangePass = URL::createLink('default','user','index');
$linkViewCart = URL::createLink('default','user','cart');
$linkHistory = URL::createLink('default','user','history');
$linkLogout = URL::createLink('default','index','logout');


?>

<div class="new_products">
           
    <div class="new_prod_box">
        <a href="<?php echo $linkChangePass; ?>">Change PassWord</a>
        <div class="new_prod_bg">
            <a href="<?php echo $linkChangePass; ?>"><img src="<?php echo $imageURL; ?>/changepass.png" alt="" title="" class="thumb" border="0" /></a>
        </div>           
    </div>

    <div class="new_prod_box">
        <a href="<?php echo $linkViewCart; ?>">View Cart</a>
        <div class="new_prod_bg">
            <a href="<?php echo $linkViewCart; ?>"><img src="<?php echo $imageURL; ?>/cart.png" alt="" title="" class="thumb" border="0" /></a>
        </div>           
    </div>

    <div class="new_prod_box">
        <a href="<?php echo $linkHistory; ?>">History</a>
        <div class="new_prod_bg">
            <a href="<?php echo $linkHistory; ?>"><img src="<?php echo $imageURL; ?>/history.png" alt="" title="" class="thumb" border="0" /></a>
        </div>           
    </div>

    <div class="new_prod_box">
        <a href="<?php echo $linkLogout; ?>">Logout</a>
        <div class="new_prod_bg">
            <a href="<?php echo $linkLogout; ?>"><img src="<?php echo $imageURL; ?>/logout.png" alt="" title="" class="thumb" border="0" /></a>
        </div>           
    </div>

</div>