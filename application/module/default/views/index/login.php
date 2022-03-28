<?php 



    // <imput >
    $inputUserName = Helper::cmsInput('text','form[username]','username',null,'contact_input');
    //$inputEmail = Helper::cmsInput('text','form[email]','email',null,'contact_input');
    $inputPassword = Helper::cmsInput('text','form[password]','password',null,'contact_input');
    $inputSubmit = Helper::cmsInput('submit','form[submit]','submit','Login','register');
    $inputToken = Helper::cmsInput('hidden','form[token]','token',time());

    // row (label, <input>, requirre ?)
    $rowUserName = Helper::cmsRow('UserName',$inputUserName);
    //$rowEmail = Helper::cmsRow('Email',$inputEmail);
    $rowPassword = Helper::cmsRow('Password',$inputPassword);
    // case type = submit>
    $rowSubmit = Helper::cmsRow('',$inputToken . $inputSubmit,true);


    $linkAction = URL::createLink('default','index','login');


?>
        <div class="title">
            <span class="title_icon"><img src="<?php echo $imageURL; ?>/bullet1.gif" /></span>Login
        </div>
        
        <div class="feat_prod_box_details">
            
            
            <div class="contact_form">
                <div class="form_subtitle">Login</div>
                <?php 
                    if(isset($this->errors))
                    {
                        echo $this->errors; 
                    }
                   
                ?>
                 <form name="adminform" action="<?php echo $linkAction;?>" method="POST"> 

                    <?php 
                        echo $rowUserName . $rowPassword . $rowSubmit;
                    ?>         
  
                    <!-- <div class="form_row">
                    <input type="submit" class="register" value="register" />
                    </div> -->

                </form>     
            </div>  
            
        </div>	
        
        <div class="clear"></div>