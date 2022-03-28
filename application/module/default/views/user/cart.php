
<!-- TITLE -->
<div class="title">
    <span class="title_icon"><img src="<?php echo $imageURL?>/bullet1.gif" alt="" title="" /></span>My cart
</div>

<!-- List products -->
<div class="feat_prod_box_details">
    <?php 
        // echo '<pre>';
        // print_r($this->Items);
        // echo '</pre>';

        $linkCategory = URL::createLink('default','category','index');
        $linkCheckOut = URL::createLink('default','user','buy');


        if(!empty($this->Items))
        {
            $xhtml = '';
            $sumPrices = 0;

            foreach($this->Items as $key => $value)
            {
                $id = $value['id'];
                $linkDetails = URL::createLink('default','book','details',array('book_id'=>$id));
                $name = $value['name'];
                $quantity = $value['quantity'];
                $unitPrice = number_format($value['unitPrice']);
                $totalPrice = number_format($value['totalPrice']);
                $sumPrices = $sumPrices + $value['totalPrice'];

                // check Images exist
                $picturePath = UPLOAD_PATH. 'book' . DS . $value['picture'];
                if(file_exists($picturePath) == true)
                {
                    $picture = '<img width="60px" height="90px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . $value['picture']  .'">';
                }
                else{
                    $picture = '<img width="60px" height="90px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'" >';
                }

                // <input> (type, name, id, value)
                $inputBookID = Helper::cmsInput('hidden', 'form[book_id][]', 'input_book_id_' . $id, $id);
                $inputQuantity = Helper::cmsInput('hidden', 'form[quantity][]', 'input_quantity_' . $id, $value['quantity']);
                $inputPrice = Helper::cmsInput('hidden', 'form[price][]', 'input_price_' . $id, $value['unitPrice']);
                $inputName = Helper::cmsInput('hidden', 'form[name][]', 'input_name_' . $id, $value['name']);
                $inputPicture = Helper::cmsInput('hidden', 'form[picture][]', 'input_picture_' . $id, $value['picture']);



                $xhtml .= ' <tr>
                                <td><a href="'.$linkDetails.'">'.$picture.'</a></td>
                                <td>'.$name.'</td>
                                <td>'.$unitPrice.' VND</td>
                                <td>'.$quantity.'</td>
                                <td>'.$totalPrice.' VND</td>               
                            </tr> ';
                
                $xhtml .= $inputBookID . $inputQuantity . $inputPrice . $inputName . $inputPicture;
            }

?>

<form action="#" method="POST" name="adminForm" id="adminForm">
    <table class="cart_table">
        <tr class="cart_title">
            <td>Item picture</td>
            <td>Book name</td>
            <td>Unit price</td>
            <td>Qty</td>
            <td>Total</td>               
        </tr>
                
        <?php echo $xhtml; ?>
             	
        <tr>
            <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
            <td> <?php echo number_format($sumPrices); ?> VND</td>                
        </tr>                  
            
    </table>

    <a href="<?php echo $linkCategory; ?>" class="continue">&lt; continue</a>
    <a onclick="javascript:submitForm('<?php echo $linkCheckOut; ?>')" href="#" class="checkout">checkout &gt;</a>
</form>

<?php
        }else{
?>
    <h3>Bạn chưa mua gì trong giỏ hàng</h3>
<?php
        }
?>
    
            

             
            
</div>	