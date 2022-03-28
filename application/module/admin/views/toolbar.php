<?php
    $controller = $this->arrParam['controller'];

    //New Button
    // index.php?module=admin&controller=user&action=form
    $linkNew = URL::createLink('admin',$controller,'form');
    $btnNew = Helper::cmsButton('New', 'toolbar-popup-new', $linkNew, 'icon-32-new' );

    //Publish Button
    $linkPublish = URL::createLink('admin',$controller,'status', array('type'=>1));
    $btnPublish = Helper::cmsButton('Publish', 'toolbar-publish', $linkPublish, 'icon-32-publish', 'submit');

    //Unpublish Button
    $linkUnPublish = URL::createLink('admin',$controller,'status', array('type'=>0));
    $btnUnPublish = Helper::cmsButton('UnPublish', 'toolbar-unpublish', $linkUnPublish, 'icon-32-unpublish','submit' );

    //Ordring Button
    $linkOrdering = URL::createLink('admin',$controller,'ordering');
    $btnOrdering = Helper::cmsButton('Ordering', 'toolbar-checkin', $linkOrdering, 'icon-32-checkin','submit' );

    // Trash Button
    $linkTrash = URL::createLink('admin',$controller,'trash');
    $btnTrash = Helper::cmsButton('Trash', 'toolbar-trash', $linkTrash, 'icon-32-trash','submit' );

    // Save Button
	$linkSave	= URL::createLink('admin', $controller, 'form',array('type'=>'save'));
	$btnSave	= Helper::cmsButton('Save', 'toolbar-apply', $linkSave, 'icon-32-apply','submit');

    // Save & Close Button
	$linkSaveClose	= URL::createLink('admin', $controller, 'form',array('type'=>'save-close'));
	$btnSaveClose	= Helper::cmsButton('Save & Close', 'toolbar-save', $linkSaveClose, 'icon-32-save','submit');
	
	// Save & New Button
	$linkSaveNew	= URL::createLink('admin', $controller, 'form',array('type'=>'save-new'));
	$btnSaveNew		= Helper::cmsButton('Save & New', 'toolbar-save-new', $linkSaveNew, 'icon-32-save-new','submit');
	
	// Cancel Button
	$linkCancel		= URL::createLink('admin', $controller, 'index');
	$btnCancel		= Helper::cmsButton('Cancel', 'toolbar-cancel', $linkCancel, 'icon-32-cancel');
    
    // Save Button Profile (admin/index/profile)
	$linkSaveProfile	= URL::createLink('admin', $controller, 'profile',array('type'=>'save'));
	$btnSaveProfile	= Helper::cmsButton('Save', 'toolbar-apply', $linkSaveProfile, 'icon-32-apply','submit');

    // echo '<pre>';
    // print_r($this);
    // echo '</pre>';

    //echo $this->arrParam['action'];

    switch($this->arrParam['action']){
        case 'index':
            $strButton = $btnNew . $btnPublish . $btnUnPublish . $btnOrdering .$btnTrash;
            break;
        case 'form':
            $strButton = $btnSave . $btnSaveClose . $btnSaveNew . $btnCancel;
            break;
        case 'profile':
            $strButton = $btnSaveProfile . $btnSaveClose . $btnCancel;
            break;

        

    }
    

?>


<div id="toolbar-box">
			<div class="m">
            	<!-- TOOLBAR -->
				<div class="toolbar-list" id="toolbar">
                    <ul>
                        <!--
                        <li class="button" id="toolbar-publish">
                            <a class="modal" href="#" onclick="javascript:submitForm('index.php?module=admin&controller=group&action=status&type=1')"><span class="icon-32-publish"></span>Publish</a>
                        </li>
                        -->
                
                        <?php 
                            echo $strButton;
                        ?>
                        
                        
                    
                        
                    </ul>
					<div class="clr"></div>
				</div>
                <?php
                // echo '<pre>';
                // print_r($this);
                // echo '</pre>';
                ?>

				<!-- TITLE -->
                <div class="pagetitle icon-48-groups"><h2><?php echo $this->_title;?></h2></div>
			</div>
		</div>