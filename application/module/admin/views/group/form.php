<!-- Toolbar -->
<?php
    include_once(MODULE_PATH. 'admin/views/toolbar.php');
?>

<?php
    include_once('submenu/index.php');
?>

<?php
    //echo __FILE__;

	// case moi vao` add
	if(empty($this->arrParam['form']))
	{
		$this->arrParam['form'] = array('name'=>'','status'=>'','ordering'=>'','group_acp'=>'');
	}
	// echo '<pre>';
	// print_r($this->arrParam);
	// echo '</pre>';
	

	$data = $this->arrParam['form'];

	// case bỏ trống giá trị khi save
	// if(empty($data['name']))
	// {
	// 	$data['name']= '';
	// }
	// if(empty($data['ordering']))
	// {
	// 	$data['ordering']= '';
	// }
	// if(empty($data['status']))
	// {
	// 	$data['status']= '';
	// }
	// if(empty($data['group_acp']))
	// {
	// 	$data['group_acp']= '';
	// }
    

    // INPUT TAB (type, $name, $id, $value, $class, $size)
    $inputName = Helper::cmsInput('text','form[name]','name',$data['name'],'inputbox required',40);
    $inputOrdering = Helper::cmsInput('text','form[ordering]','ordering',$data['ordering'],'inputbox',40);

    //SelectBox (name,class, arrValue, keySelect, style)
    $selectStatus = Helper::cmsSelectbox('form[status]', null, array('default' =>"- Select Status -", 1=>'Publish',0=>'Unpublish'), $data['status'], 'width:150px');
    $selectGroupACP = Helper::cmsSelectbox('form[group_acp]', null, array('default' =>"- Select GroupACP -", 1=>'Yes',0=>'No'), $data['group_acp'], 'width:150px');

    // Row (label, <input>, required ?)
    $rowName = Helper::cmsRowForm('Name',$inputName,true);
    $rowOrdering = Helper::cmsRowForm('Ordering',$inputOrdering);
    $rowStatus = Helper::cmsRowForm('Status',$selectStatus);
    $rowGroupACP = Helper::cmsRowForm('Group ACP',$selectGroupACP);

	$inputID ='';
	$rowID = '';
	if(isset($this->arrParam['id']))
	{
		$inputID = Helper::cmsInput('text','form[id]','id',$data['id'],'inputbox readonly',40);
		$rowID = Helper::cmsRowForm('ID',$inputID);
	}

	// Message
	$message = Session::get('message');
    Session::delete('message');

    $strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container">
	<?php 
	if(isset($this->errors))
	{
		echo $this->errors ;
	}
	else{
		echo $strMessage; 
	}
	
	 
	 
	 ?>
</div>

<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
            <!-- FORM LEFT -->
            <div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
						<ul class="adminformlist">
							<!-- <li>
								<label>Name<span class="star">&nbsp;*</span></label>
								<input type="text" name="form[name]" id="name" value="" class="inputbox required" size="40">
							</li> -->
                            <?php echo $rowName . $rowStatus . $rowGroupACP . $rowOrdering . $rowID; ?>
							<!-- <li>
								<label>Status</label>
								<select name="form[status]" class="">
									<option value="default">- Select Status -</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
								</select>
							</li> -->
							
						
							
						</ul>
						<div class="clr"></div>
						    <div>
								<input type="hidden" name="form[token]" value="1384158288">
							</div>
				</fieldset>
			</div>
			<div class="clr"></div>
			<div>
			</div>			
		</form>
	<div class="clr"></div>
	</div>
</div>