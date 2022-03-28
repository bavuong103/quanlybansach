<?php 
    // main/images/
    $imageURL = $this->_dirImg;

    // Menu List, Add, ...
    $arrMenu = array(
        array('link' => URL::createLink('admin','book','add'),'name'=>'Add new book','image'=>'icon-48-article-add'),
        array('link' => URL::createLink('admin','book','index'),'name'=>'Book Manager','image'=>'icon-48-article'),
        array('link' => URL::createLink('admin','category','index'),'name'=>'Category Manager','image'=>'icon-48-category'),
        array('link' => URL::createLink('admin','group','index'),'name'=>'Group Manager','image'=>'icon-48-group'),
        array('link' => URL::createLink('admin','user','index'),'name'=>'User Manager','image'=>'icon-48-user'),
        array('link' => URL::createLink('admin','cart','index'),'name'=>'Bill Manager','image'=>'icon-48-article')

    );

    $xhtml ='';
    foreach($arrMenu as $key=>$value)
    {
        $image = $imageURL. '/header/'. $value['image'].'.png';
        $xhtml .= '<div class="icon-wrapper">
                        <div class="icon">
                            <a href="'.$value['link'].'">
                                <img src="'.$image.'" alt="'.$value['name'].'">
                                <span>'.$value['name'].'</span>
                            </a>
                        </div>
                    </div>';
    }
?>

<div id="element-box">
<div class="m">
				<div class="adminform">
					<div class="cpanel-left">
						<div class="cpanel">
                            <?php echo $xhtml; ?>

							<!-- <div class="icon-wrapper">
								<div class="icon">
									<a href="#">
										<img src="<?php //echo $imageURL; ?>/header/icon-48-article-add.png" alt="">
										<span>Add New Book</span>
									</a>
								</div>
							</div>
							<div class="icon-wrapper">
								<div class="icon">
									<a href="#">
										<img src="images/header/icon-48-article.png" alt="">
										<span>Book Manager</span>
									</a>
								</div>
							</div> -->
							

						</div>
					</div>
					
				</div>
				<div class="clr"></div>
			</div>
            </div>