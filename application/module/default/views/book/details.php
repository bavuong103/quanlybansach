<?php 
    // echo '<pre>';
    // print_r($this->infoBook);
    // echo '</pre>';  

    // echo '<pre>';
    // print_r($this->booksRelative);
    // echo '</pre>';  

    $infoBook = $this->infoBook;
    
    $name = $infoBook['name'];

    $description = substr($infoBook['description'],0,100);

    // check Images exist
    $picturePath = UPLOAD_PATH. 'book' . DS . $infoBook['picture'];
    if(file_exists($picturePath) == true)
    {
        $picture = '<img width="98px" height="150px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . $infoBook['picture']  .'">';
    }
    else{
        $picture = '<img width="98px" height="150px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'" >';
    }

    $priceReal = 0;
    if($infoBook['sale_off']>0)
    {
        $priceReal = ((100-$infoBook['sale_off'])*$infoBook['price']/100);
        $price = '<span class="red">'.number_format($priceReal).' VND</span>
                <span class="red-through">'.number_format($infoBook['price']).' VND</span>';
    }
    else
    {
        $priceReal = $infoBook['price'];
        $price = '<span class="red">'.number_format($priceReal).' VND</span>';
    }

    $id = $infoBook['id'];
    
$linkAddToCart = URL::createLink('default','user','addtoCart',array('book_id' => $id, 'price' => $priceReal));


?>


<!-- Book Infomation -->
<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet1.gif" alt="" title="" />
    </span><?php echo $name; ?>
</div>

<div class="feat_prod_box_details">
            
    <div class="prod_img">
        <a href="#">
            <?php echo $picture; ?>
        </a>
        <br /><br />
        <a href="#" rel="lightbox">
            <img src="<?php echo $imageURL; ?>/zoom.gif" alt="" title=""/>
        </a>
    </div>
                
    <div class="prod_det_box">
        <div class="box_top"></div>
        <div class="box_center">
            <div class="prod_title">Details</div>
                <p class="details"><?php echo $description; ?></p>
            <div class="price"><strong>PRICE:</strong> 
                <?php echo $price; ?>
            </div>

            <a href="<?php echo $linkAddToCart; ?>" class="more">
                Buy
                <!-- <img src="<?php echo $imageURL; ?>/order_now.gif" alt="" title="" border="0" /> -->
            </a>
            <div class="clear"></div>
        </div>
                    
        <div class="box_bottom"></div>
    </div>    
    <div class="clear"></div>
</div>


<!-- Relative Books -->

<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet2.gif" alt="" title="" />
    </span>Sách cùng loại
</div>

<?php 

$xhtmlRelativeBooks ='';
if(!empty($this->booksRelative))
{
    foreach($this->booksRelative as $key => $value)
    {
        $id = $value['id'];
        $link= URL::createLink('default','book','details',array('book_id' => $id));
        $name = $value['name'];

        // check Images exist
        $picturePath = UPLOAD_PATH. 'book' . DS . $value['picture'];
        if(file_exists($picturePath) == true)
        {
            $picture = '<img width="60px" height="90px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . $value['picture']  .'">';
        }
        else{
            $picture = '<img width="60px" height="90px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'" >';
        }

        $xhtmlRelativeBooks .= '<div class="new_prod_box">
                                <a href="'.$link.'">'.$name.'</a>
                                <div class="new_prod_bg">
                                    <a href="'.$link.'">'.$picture.'</a>
                                </div>           
                            </div>';

        
    }

    
}

?>

<div class="new_products">
    <?php echo $xhtmlRelativeBooks; ?>
           
 </div>

