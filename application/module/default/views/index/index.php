
<!-- Special Books -->

<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet1.gif" alt="" title="" />
    </span>Special Books
</div>

<?php 

$xhtml ='';
if(!empty($this->SpecialsBooks))
{
    foreach($this->SpecialsBooks as $key => $value)
    {
        $id = $value['id'];
        $link= URL::createLink('default','book','details',array('book_id' => $id));
        $name = $value['name'];

        // cat chuoi voi 50 ky tu o vi tri 0
        $description = substr($value['description'], 0 ,50);

        // check Images exist
        $picturePath = UPLOAD_PATH. 'book' . DS . $value['picture'];
        if(file_exists($picturePath) == true)
        {
            $picture = '<img width="98px" height="150px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . $value['picture']  .'">';
        }
        else{
            $picture = '<img width="98px" height="150px" class="thumb" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'" >';
        }

        $xhtml .= '<div class="feat_prod_box">
            
                        <div class="prod_img"><a href="'.$link.'">'.$picture.'</a></div>
                        
                        <div class="prod_det_box">
                            <span class="special_icon"><img src="'.$imageURL.'/special_icon.gif" alt="" title="" /></span>
                            <div class="box_top"></div>
                            <div class="box_center">
                            <div class="prod_title">'.$name.'</div>
                            <p class="details">'.$description.'</p>
                            <a href="'.$link.'" class="more">- more details -</a>
                            <div class="clear"></div>
                            </div>
                            
                            <div class="box_bottom"></div>
                        </div>    
                    <div class="clear"></div>
                    </div>';

        
    }

    echo $xhtml;
}

?>

<!-- New Books -->

<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet2.gif" alt="" title="" />
    </span>New Books
</div>

<?php 

$xhtmlNewBooks ='';
if(!empty($this->NewBooks))
{
    foreach($this->NewBooks as $key => $value)
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

        $xhtmlNewBooks .= '<div class="new_prod_box">
                                <a href="'.$link.'">'.$name.'</a>
                                <div class="new_prod_bg">
                                    <a href="'.$link.'">'.$picture.'</a>
                                </div>           
                            </div>';

        
    }

    
}

?>

<div class="new_products">
    <?php echo $xhtmlNewBooks; ?>
           
 </div>



            
            
            
        	