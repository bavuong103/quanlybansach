<?php 

   // echo '<pre>';
   // print_r($this);
   // echo '</pre>';
   

   $model = new Model();

   $query2[] = "SELECT `id`, `name`, `picture`";
   $query2[] = "FROM `".TBL_BOOK."`";
   $query2[] = "Where `status` = 1 AND `sale_off` > 0" ;
   $query2[] = "ORDER BY `id` DESC";
   $query2[] = "LIMIT 0,3";
   $query2 = implode(" ",$query2);

   $listBook = $model->select($query2);

   // echo '<pre>';
   // print_r($listCategory);
   // echo '</pre>';

   $xhtml = '';

   if(!empty($listBook))
   {
      
      foreach($listBook as $key => $value)
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


         $xhtml .= '<div class="new_prod_box">
                        <a href="'.$link.'">'.$name.'</a>
                        <div class="new_prod_bg">
                            <span class="new_icon"><img src="'.$imageURL.'/promo_icon.gif" alt="" title="" /></span>
                            <a href="'.$link.'">'.$picture.'</a>
                        </div>           
                    </div>';
         
         
      }
   }
  
  
   
   

?>

<div class="right_box">
    <div class="title">
        <span class="title_icon">
            <img src="<?php echo $imageURL; ?>/bullet4.gif" alt="" title="" />
        </span>Promotions
    </div> 

    <?php echo $xhtml; ?>
  </div>