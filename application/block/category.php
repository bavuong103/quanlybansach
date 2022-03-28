<?php 

   // echo '<pre>';
   // print_r($this);
   // echo '</pre>';
   

   $model = new Model();
   
   $query[] = "SELECT `id`, `name`";
   $query[] = "FROM `".TBL_CATEGORY."`";
   $query[] = "Where `status` = 1" ;
   $query[] = "ORDER BY `id` DESC";
   $query = implode(" ",$query);

   $listCategory = $model->select($query);

   // echo '<pre>';
   // print_r($listCategory);
   // echo '</pre>';

   if(empty($this->arrParam['category_id']))
   {
      $cateID =0;
   }
   else{
      $cateID = $this->arrParam['category_id'];
      //echo $cateID;
   }
  

   $xhtml = '';

   if(!empty($listCategory))
   {
      
      foreach($listCategory as $key => $value)
      {
         // id cua category
         $id = $value['id'];
         $link = URL::createLink('default','book','list',array('category_id' => $id));;
         
         $name = $value['name'];

         if($id == $cateID)
         {
            $xhtml .= '<li><a class="active" href="'.$link.'">'.$name.'</a></li>';
         }
         else
         {
            $xhtml .= '<li><a href="'.$link.'">'.$name.'</a></li>';
         }
         
         
      }
   }

?>


<div class="right_box">
   <div class="title">
      <span class="title_icon">
         <img src="<?php echo $imageURL; ?>/bullet5.gif" alt="" title="" /></span>Categories
   </div> 
                
      <ul class="list">
         <?php echo $xhtml; ?>                                               
      </ul>
                            	
</div>   