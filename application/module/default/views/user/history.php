<?php 
    // echo '<pre>';
    // print_r($this->Items);
    // echo '</pre>';

    if(!empty($this->Items))
    {
        $xhtml = '';
        foreach($this->Items as $key => $value)
        {
            $id = $value['id'];
            $date = date("H:i d/m/Y", strtotime($value['date']));

            $arrBookID = json_decode($value['books']);
            $arrPrice = json_decode($value['prices']);
            $arrName = json_decode($value['names']);
            $arrQuantity = json_decode($value['quantities']);
            $arrPicture = json_decode($value['pictures']);

            $tableContent = '';
            $sumPrices= 0;

            foreach($arrBookID as $keyB => $valueB)
            {
                $name = $arrName[$keyB];
                $unitPrice = $arrPrice[$keyB];
                $quantity = $arrQuantity[$keyB];
                $totalPrice = $unitPrice * $quantity;
                $sumPrices = $sumPrices + $totalPrice;

                $linkDetails = URL::createLink('default','book','details',array('book_id'=>$valueB));

                 // check Images exist
                 $picturePath = UPLOAD_PATH. 'book' . DS . $arrPicture[$keyB];
                 if(file_exists($picturePath) == true)
                 {
                     $picture = '<img width="30px" height="45px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . $arrPicture[$keyB]  .'">';
                 }
                 else{
                     $picture = '<img width="30px" height="50px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'" >';
                 }

                $tableContent .= '<tr>
                                        <td><a href="'.$linkDetails.'">'.$picture.'</a></td>
                                        <td>'.$name.'</td>
                                        <td>'.number_format($unitPrice).'</td>
                                        <td>'.$quantity.'</td>
                                        <td>'.number_format($totalPrice).'</td>               
                                    </tr> ';
            }

            $xhtml .= '<div class ="history-cart">
                        <h3> Mã đơn hàng: '.$id.' - Thời gian: '.$date.'</h3>
                        <table class="cart_table">
                            <tbody>    
                                <tr class="cart_title">
                                        <td>Item Picture</td>
                                        <td>Book name</td>
                                        <td>Unit price</td>
                                        <td>Qty</td>
                                        <td>Total</td>               
                                    </tr>
                                                
                                '.$tableContent.'
                                                
                                    <tr>
                                        <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
                                        <td> '.number_format($sumPrices).'</td>                
                                    </tr>                  
                            </tbody>       
                        </table>
                    </div>';
        }
    }
    else
    {
        $xhtml .= '<h3>Chưa có đơn hàng nào được mua</h3>';
    }
?>

<!-- TITLE -->
<div class="title">
    <span class="title_icon"><img src="<?php echo $imageURL?>/bullet1.gif" alt="" title="" /></span>
    History
</div>

<!-- List Bill -->
<div class="feat_prod_box_details">
    

    <?php echo  $xhtml; ?>
 

    
</div>
           