
		
        <!-- Toolbar -->
        <?php
            include_once(MODULE_PATH. 'admin/views/toolbar.php');
        ?>

        <?php
            include_once('submenu/index.php');
        ?>
		
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
            
            //SelectBox Status
            if(isset($this->arrParam['filter_state']))
            {
                $filter_state = $this->arrParam['filter_state'];
            }
            else
            {
                $filter_state = 'default';
            }

            
            //SelectBox Status
            $arrStatus = array('default' =>"- Select Status -", 1=>'Publish',0=>'Unpublish');
            $selectboxStatus = Helper::cmsSelectbox('filter_state', 'inputbox', $arrStatus, $filter_state);
        
            // PAGINATION
            $link = URL::createLink('admin','category','index');
            $paginationHTML = $this->pagination->showPagination($link);
            
            // echo '<pre>';
            // print_r($this->pagination);
            // echo '</pre>';

            // Message
            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';
            $message = Session::get('message');
            Session::delete('message');

            $strMessage = Helper::cmsMessage($message);
            
            $linkIndex = URL::createLink('admin','category','index');

        
        ?>


        
        <div id="system-message-container">

            <!-- <dl id= "system-message">
                <dt class="success">Error</dt>
                <dd class="success message">
                    <ul>
                        <li><?php //echo $message; ?></li>
                    </ul>
                </dd> 
            </dl> -->

            <?php echo $strMessage; ?>
        </div>
        
		<div id="element-box">
			<div class="m">
				<form action="<?php echo $linkIndex; ?>" method="post" name="adminForm" id="adminForm">
                	<!-- FILTER -->
                    <fieldset id="filter-bar">
                        <div class="filter-search fltlft">
                            <label class="filter-search-lbl" for="filter_search">Filter:</label>
                            <input type="text" name="filter_search" id="filter_search" value="<?php echo $filter_search;?>">
                            <button type="submit" name="submit-keyword">Search</button>
                            <button type="button" name="clear-keyword">Clear</button>
                        </div>
                        <div class="filter-select fltrt">
                            
                            <!-- SELECT BOX
                            <select name="filter_state" class="inputbox" >
                                <option value="">- Select Status -</option>
                                <option value="">- Publish -</option>
                                <option value="">- UnPublish -</option>
                            </select>
                            -->
                        <?php echo $selectboxStatus; ?>


                            
                        </div>
                    </fieldset>
					<div class="clr"> </div>

                    <table class="adminlist" id="modules-mgr">
                    	<!-- HEADER TABLE -->
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" name="checkall-toggle" value="" onclick="javascipt:void(0)"></th>
                                <th class="title"width="10%"><a href="#" onclick="javascript:submit();">Name</a></th>
                                <th width="10%"><a href="#">Picture</a></th>
                                <th width="10%"><a href="#">Status</a></th>
                                <th width="10%"><a href="#">Ordering</a></th>
                                <th width="10%"><a href="#">Created</a></th>
                                <th width="10%"><a href="#">Created By</a></th>
                                <th width="10%"><a href="#">Modified</a></th>
                                <th width="10%"><a href="#">Modified By</a>	</th>
                                <th width="1%" class="nowrap"><a href="#">ID</a></th>
                            </tr>
                        </thead>
                        <!-- FOOTER TABLE -->
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <!-- PAGINATION -->
                                    <div class="container">
                                        <?php echo $paginationHTML; ?>
                                    </div>				
                                </td>
                            </tr>
                        </tfoot>
                        <!-- BODY TABLE -->
						<tbody>
                        <?php 
                            if(!empty($this->Items))
                            {
                                $i = 0;
                                foreach($this->Items as $key => $value)
                                {
                                    $id = $value['id'];
                                
                                    $ckb = '<input type="checkbox" name="cid[]" value="'.$id.'"';
                                    $name = $value['name'];

                                    // check Images exist
                                    $picturePath = UPLOAD_PATH. 'category' . DS . $value['picture'];
                                    if(file_exists($picturePath) == true)
                                    {
                                        $picture = '<img src="'.UPLOAD_URL. 'category' . DS . $value['picture']  .'" style="width:90px">';
                                    }
                                    else{
                                        $picture = '<img src="'.UPLOAD_URL. 'category' . DS . 'default.jpg'  .'" style="width:90px">';
                                    }

                                    $row = '';
                                    if($i % 2 ==0)
                                    {
                                        $row = 'row0';
                                    }
                                    else{
                                        $row = 'row1';
                                    }

                                    // cmsStatus(value, link, id)
                                    // link = index.php?module=admin&controller=category&action=ajaxStatus&id=2&status=0
                                    $status = Helper::cmsStatus($value['status'], URL::createLink('admin','category','ajaxStatus', array('id'=>$id, 'status'=>$value['status'])),$id);
                                    $ordering = '<input type="text" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-area-order">';
                                    $created = Helper::formatDate('d-m-Y', $value['created']);
                                    $modified = Helper::formatDate('d-m-Y', $value['modified']);
                                    $created_by = $value['created_by'];
                                    $modified_by = $value['modified_by'];
                                    $linkEdit = URL::createLink('admin','category','form',array('id'=>$id));
                        
                                

                                    echo '<tr class="'. $row.'">
                                            <td class="center">'.$ckb.'</td>
                                            <td><a href="'.$linkEdit.'">'.$name.'</a></td>
                                            <td class="center">'.$picture.'</td>
                                            <td class="center">'.$status.'</td>
                                            <td class="order">'.$ordering.'</td> 
                                            <td class="center">'.$created.'</td>
                                            <td class="center">'.$created_by.'</td>
                                            <td class="center">'.$modified.'</td>
                                            <td class="center">'.$modified_by.'</td>
                                            <td class="center">'.$id.'</td>
                                        </tr>';

                        

                                    $i++;
                                }
                            }
                        
                        ?>
                        

						</tbody>
					</table>

                    <div>
                        <input type="hidden" name="filter_column" value="name">
                        <input type="hidden" name="filter_column_dir" value="ASC">
                        <input type="hidden" name="filter_page" value="1">
                    </div>
                        
                </form>

				<div class="clr"></div>
			</div>
		</div>
