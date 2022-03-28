<?php 
    $cart = Session::get('cart');
    // echo '<pre>';
    // print_r($cart);
    // echo '</pre>';

    $totalItems = 0;
    $totalPrices = 0;

    if(!empty($cart))
    {
        $totalItems = array_sum($cart['quantity']);
        $totalPrices = array_sum(($cart['price']));
    }

    $linkViewCart = URL::createLink('default','user','cart');

?>


<div class="cart">
    <div class="title">
        <span class="title_icon"><img src="<?php echo $imageURL; ?>/cart.gif" alt="" title="" /></span>Cart
    </div>
                  
    <div class="home_cart_content">
        <?php echo $totalItems; ?> x items | 
        <span class="red">TOTAL: <?php echo number_format($totalPrices) ; ?> VND</span>
    </div>

    <a href="<?php echo $linkViewCart; ?>" class="view_cart">View Cart</a>
              
</div>