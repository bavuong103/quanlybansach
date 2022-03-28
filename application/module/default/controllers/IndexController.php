<?php

    class IndexController extends Controller{

        public function __construct($arrParams)
        {
            // connect View va Template
            parent:: __construct($arrParams);

            $this->_templateObj->setFolderTemplate('default/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
            
        }


        public function indexAction()
        {
            // Load Model
            // ten module va ten controller
            $this->loadModel('default','index');

            $this->_view->_title = ' Book Store';

            $this->_view->SpecialsBooks = $this->_model->listItems($this->_arrParams, array('task' => 'books-special'));

            $this->_view->NewBooks = $this->_model->listItems($this->_arrParams, array('task' => 'books-new'));

            // dan den trang Home
            $this->_view->render('default','index/index');


        }


        // Register
        public function registerAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('default','index');

            $userInfo = Session::get('user');
            // check login = true vs time luc Login + 3600s >= time()
            if($userInfo['login']== true && $userInfo['time'] + TIME_LOGIN >= time())
            {
                URL::redirect('default','user','index');
            }

            // Kiem tra da bam nut [Register] chua?
            if(isset($this->_arrParams['form']['submit']))
            {
                
                // Ngăn user save double khi user nhan F5 sau khi da dang ky thanh` cong
                // Khi user save lan` 2 by F5
                URL::checkRefreshPage($this->_arrParams['form']['token'],'default','user','register');

                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                // KT username exist trong db
                $queryUserName  = "select `id` from `".TBL_USER."` where `username` = '".$this->_arrParams['form']['username']."'";
                $queryEmail     = "select `id` from `".TBL_USER."` where `email` = '".$this->_arrParams['form']['email']."'";

                $validate = new Validate($this->_arrParams['form']);
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $validate->addRule('username','string-notExistRecord',array('database'=> $this->_model,'query'=>$queryUserName,'min'=>3,'max'=>25))
                        ->addRule('email','email-notExistRecord',array('database'=> $this->_model,'query'=>$queryEmail))
                        ->addRule('password','password',array('action' => 'add'));
                        

                $validate->run();
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $this->_arrParams['form'] = $validate->getResult();

                if($validate->isValid() == false)
                {
                    $this->_view->errors = $validate->showErrorsPublic();
                }
                else{
                    // Insert database
                   
                    //die("stop");
                    $id = $this->_model->saveItem($this->_arrParams, array('task' => 'user-register'));
                    URL::redirect('default','index','notice',array('type' => 'register-success'));

                }
            
            
            }

            $this->_view->render('default','index/register',true);

        }

        // LOGIN IN
        public function loginAction()
        {
            //load model
            $this->loadModel('default','index');

            // case da login thanh` cong
            $userInfo = Session::get('user');
            // check login = true vs time luc Login + 3600s >= time()
            if($userInfo['login']== true && $userInfo['time'] + TIME_LOGIN >= time())
            {
                URL::redirect('default','user','index');
            }


            // case chua login
            
            $this->_view->_title = 'Login';

            // khi da bam nut Login roi`
            if($this->_arrParams['form']['token'] >0 )
            {
                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                $validate = new Validate($this->_arrParams['form']);
                $username = $this->_arrParams['form']['username'];
                $password = md5($this->_arrParams['form']['password']);
                $query = "Select `id` from `user` where `username` = '$username' and `password`= '$password'";

                // kiem tra username co ton` tai trong db ko
                $validate->addRule('username','existRecord',array('database'=>$this->_model,'query'=>$query));

                $validate->run();

                if($validate->isValid()==true)
                {
                    $infoUser = $this->_model->infoItem($this->_arrParams);
                    $arraySession = array(
                                            'login' => true,
                                            'info'  => $infoUser,
                                            'time'  => time(),
                                            'group_acp' => $infoUser['group_acp']

                    );

                    Session::set('user',$arraySession);
                    URL::redirect('default','user','index');
                    // chuyen den file (Boostrap) de xu ly URL khi login 
                }
                else{
                    $this->_view->errors = $validate->showErrorsPublic();
                }


            }

            $this->_view->render('default','index/login',true);


        }


        // Logout
        public function logoutAction()
        {
            

            // keo vao model
            $this->loadModel('default','index');
            
            Session::delete('user');
            URL::redirect('default','index','index');
            

        }


        public function noticeAction()
        {
            // keo model

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo view
            $this->_view->render('default','index/notice');

        }



       


    }    


?>