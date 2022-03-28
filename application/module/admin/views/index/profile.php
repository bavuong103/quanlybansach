<!-- Toolbar -->
<?php
    include_once(MODULE_PATH. 'admin/views/toolbar.php');
?>



<?php
    //echo __FILE__;

	// case moi vao` add
	if(empty($this->arrParam['form']))
	{
		$this->arrParam['form'] = array('username'=>'','fullname'=>'','email'=>'','password'=>'','status'=>'','ordering'=>'','group_id'=>'');
	}
	// echo '<pre>';
	// print_r($this->arrParam);
	// echo '</pre>';
	

	$data = $this->infoUser;

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
    
	$inputEmail = Helper::cmsInput('text','form[email]','email',$data['email'],'inputbox required',40);
    $inputFullName = Helper::cmsInput('text','form[fullname]','fullname',$data['fullname'],'inputbox',40);
    $inputID = Helper::cmsInput('text','form[id]','id',$data['id'],'inputbox readonly',40);

    // Row (label, <input>, required ?)
    
	$rowEmail = Helper::cmsRowForm('Email',$inputEmail,true);
	$rowFullName = Helper::cmsRowForm('Full Name',$inputFullName);
	$rowID = Helper::cmsRowForm('ID',$inputID);


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
                            <?php echo $rowEmail. $rowFullName.  $rowID; ?>
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
