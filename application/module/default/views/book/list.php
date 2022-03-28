<?php 
    // echo '<pre>';
    // print_r($this->Items);
    // echo '</pre>';  

    //Search
    if(!empty($this->arrParam['filter_search']))
    {
        $filter_search = $this->arrParam['filter_search'];
    }
    else
    {
        $filter_search = '';
    }

    // PAGINATION
    $link = URL::createLink('default','book','list');
    $paginationHTML = $this->pagination->showPaginationPublic($link);

    $xhtml ='';
    if(!empty($this->Items))
    {
        foreach($this->Items as $key => $value)
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
                            <div class="prod_img">
                                <a href="'.$link.'">'.$picture.'</a>
                            </div>
                                
                            <div class="prod_det_box">
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
    }
    else{
        $xhtml = '<div class="feat_prod_box">Nội dung đang cập nhật</div>';
    }

    //$linkIndex = URL::createLink('default','book','list');


?>


 <!-- Category Name -->
<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet1.gif" alt="" title="" />
    </span><?php echo $this->categoryName; ?>
</div>

<div>
<form action="#" method="post" name="adminForm" id="adminForm">

    <!-- List Books -->
    
    <div class="new_products">
        <!-- Search -->
        <div>
            <label>Filter:</label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $filter_search;?>">
            <button type="submit" name="submit-keyword">Search</button>
            <button type="button" name="clear-keyword">Clear</button>
        </div>    

        <!-- List -->
        
            <?php echo $xhtml; ?> 
        
       

        <!-- PAGINATION -->      
        <div class="pagination">
            <?php echo $paginationHTML; ?>
        </div>  

        <div>
            <input type="hidden" name="filter_page" value="1">
        </div>
                
    </div>
</form>
</div>

