<?php 

    if(empty($this->arrParam['form']))
    {
        $this->arrParam['form'] = array('username'=>'','fullname'=>'','email'=>'','password'=>'');
    }

    $dataForm = $this->arrParam['form'];

    // <imput >
    $inputUserName = Helper::cmsInput('text','form[username]','username',$dataForm['username'],'contact_input');
    $inputFullName = Helper::cmsInput('text','form[fullname]','fullname',$dataForm['fullname'],'contact_input');
    $inputEmail = Helper::cmsInput('text','form[email]','email',$dataForm['email'],'contact_input');
    $inputPassword = Helper::cmsInput('text','form[password]','password',$dataForm['password'],'contact_input');
    $inputSubmit = Helper::cmsInput('submit','form[submit]','submit','register','register');
    $inputToken = Helper::cmsInput('hidden','form[token]','token',time());

    // row (label, <input>, requirre ?)
    $rowUserName = Helper::cmsRow('UserName',$inputUserName);
    $rowFullName = Helper::cmsRow('Full Name',$inputFullName);
    $rowEmail = Helper::cmsRow('Email',$inputEmail);
    $rowPassword = Helper::cmsRow('Password',$inputPassword);
    // case type = submit>
    $rowSubmit = Helper::cmsRow('',$inputToken . $inputSubmit,true);


    $linkAction = URL::createLink('default','index','register');


?>
        <div class="title">
            <span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet1.gif" /></span>Register
        </div>
        
        <div class="feat_prod_box_details">
            
            
            <div class="contact_form">
                <div class="form_subtitle">create new account</div>
                <?php 
                    if(isset($this->errors))
                    {
                        echo $this->errors; 
                    }
                   
                ?>
                 <form name="adminform" action="<?php echo $linkAction;?>" method="POST"> 

                    <?php 
                        echo $rowUserName . $rowFullName . $rowEmail . $rowPassword . $rowSubmit;
                    ?>         
  
                    <!-- <div class="form_row">
                    <input type="submit" class="register" value="register" />
                    </div> -->

                </form>     
            </div>  
            
        </div>	
        
        <div class="clear"></div>
        