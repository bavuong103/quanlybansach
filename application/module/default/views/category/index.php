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
    $link = URL::createLink('default','category','index');
    $paginationHTML = $this->pagination->showPaginationPublic($link);

    $xhtml ='';
    if(!empty($this->Items))
    {
        foreach($this->Items as $key => $value)
        {
            $id = $value['id'];
            $link= URL::createLink('default','book','list',array('category_id' => $id));
            $name = $value['name'];

            // check Images exist
            $picturePath = UPLOAD_PATH. 'category' . DS . $value['picture'];
            if(file_exists($picturePath) == true)
            {
                $picture = '<img class="thumb" src="'.UPLOAD_URL. 'category' . DS . $value['picture']  .'" style="width:60px">';
            }
            else{
                $picture = '<img class="thumb" src="'.UPLOAD_URL. 'category' . DS . 'default.jpg'  .'" style="width:60px">';
            }

            $xhtml .= '<div class="new_prod_box">
                            <a href="'.$link.'">'.$name.'</a>
                            <div class="new_prod_bg">
                                <a href="'.$link.'">'.$picture.'</a>
                            </div>           
                        </div>';
        }
    }

    //$linkIndex = URL::createLink('default','category','index');


?>


 <!-- TITLE -->
<div class="title">
    <span class="title_icon">
        <img src="<?php echo $imageURL; ?>/bullet1.gif" alt="" title="" />
    </span>Category books
</div>

<div>
<form action="#" method="post" name="adminForm" id="adminForm">

    <!-- List Category -->
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

