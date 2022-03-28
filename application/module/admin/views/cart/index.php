
		
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
            $link = URL::createLink('admin','cart','index');
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
            
            $linkIndex = URL::createLink('admin','cart','index');

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
                        <?php echo $selectboxStatus ; ?>


                            
                        </div>
                    </fieldset>
					<div class="clr"> </div>

                    <table class="adminlist" id="modules-mgr">
                    	<!-- HEADER TABLE -->
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" name="checkall-toggle" value="" onclick="javascipt:void(0)"></th>
                                <th width="1%" class="nowrap"><a href="#">ID</a></th>
                                <th width="10%"><a href="#">UserName</a></th>
                                <th width="10%"><a href="#">BookIDs</a></th>
                                <th width="10%"><a href="#">Prices</a></th>
                                <th width="10%"><a href="#">Quantities</a></th>
                                <th width="10%"><a href="#">Names</a></th>
                                <th width="10%"><a href="#">Status</a></th>
                                <th width="10%"><a href="#">Date</a>	</th>
                                
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
                                    $username = $value['username'];
                                    $row = '';
                                    if($i % 2 ==0)
                                    {
                                        $row = 'row0';
                                    }
                                    else{
                                        $row = 'row1';
                                    }

                                    // cmsStatus(value, link, id)
                                    // link = index.php?module=admin&controller=cart&action=ajaxStatus&id=2&status=0
                                    $status = Helper::cmsStatus($value['status'], URL::createLink('admin','cart','ajaxStatus', array('id'=>$id, 'status'=>$value['status'])),$id);
                                    $date = Helper::formatDate('H:i d-m-Y', $value['date']);
                                    
                                    $books = $value['books'];
                                    $prices = $value['prices'];
                                    $quantites = $value['quantities'];
                                    $names = $value['names'];

                                    //check Images exist
                                    // $picturePath = UPLOAD_PATH. 'book' . DS . $value['pictures'];
                                    // if(file_exists($picturePath) == true)
                                    // {
                                    //     $picture = '<img width="60px" height="90px" src="'.UPLOAD_URL. 'book' . DS . $value['pictures']  .'">';
                                    // }
                                    // else{
                                    //     $picture = '<img width="60px" height="90px" src="'.UPLOAD_URL. 'book' . DS . 'default.jpg'  .'">';
                                    // }

                                    
                                    //$linkEdit = URL::createLink('admin','cart','form',array('id'=>$id));
                        
                                

                                    echo '<tr class="'. $row.'">
                                            <td class="center">'.$ckb.'</td>
                                            <td><a href="#">'.$id.'</a></td>
                                            <td class="center">'.$username.'</td>
                                            <td class="center">'.$books.'</td>
                                            <td class="order">'.$prices.'</td> 
                                            <td class="center">'.$quantites.'</td>
                                            <td class="center">'.$names.'</td>
                                            <td class="center">'.$status.'</td>
                                            <td class="center">'.$date.'</td>
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
