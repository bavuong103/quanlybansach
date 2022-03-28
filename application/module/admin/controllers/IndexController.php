<?php

    class IndexController extends Controller{

        public function __construct($arrParams)
        {
             // Chua View Va Template
            parent:: __construct($arrParams);
            //echo __METHOD__."<br>";


        }


        public function indexAction()
        {
            //echo __METHOD__."<br>";

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','index');

            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';

            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();

            $this->_view->_title = 'Index';

            $this->_view->render('admin','index/index',true);


        }

        public function loginAction()
        {
            //load model
            $this->loadModel('admin','index');

            // case da login thanh` cong
            $userInfo = Session::get('user');
            // check login = true vs time luc Login + 3600s >= time()
            if($userInfo['login']== true && $userInfo['time'] + TIME_LOGIN >= time())
            {
                URL::redirect('admin','index','index');
            }


            // case chua login
            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('login.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();

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
                    URL::redirect('admin','index','index');
                    // chuyen den file (Boostrap) de xu ly URL khi login 
                }
                else{
                    $this->_view->errors = $validate->showErrors();
                }


            }

            $this->_view->render('admin','index/login',true);


        }

        function logoutAction()
        {
            Session::delete('user');
            URL::redirect('admin','index','login');
        }

        function profileAction()
        {
            // load Model
            $this->loadModel('admin','index');

            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();

            $this->_view->_title = 'Profile';

            $userObj = Session::get('user');

            $this->_view->infoUser = $userObj['info'];

            //$this->_arrParams['form'] = $this->_model->infoItem($this->_arrParams);

            // case edit
            //Kiem tra da click vao cac nut [save] ?
            if($this->_arrParams['form']['token']>0)
            {
                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                // Kiem tra email exist
                $queryEmail[]   = "select `id` from `".TBL_USER."` where `email` = '".$this->_arrParams['form']['email']."'";
                $queryEmail[]   = "AND `id` <> '".$this->_arrParams['form']['id']."'";
                $queryEmail     = implode(" ",$queryEmail);
                //echo $queryEmail;

                $validate = new Validate($this->_arrParams['form']);

                $validate->addRule('email','email-notExistRecord',array('database'=> $this->_model,'query'=>$queryEmail));

                $validate->run();

                $this->_arrParams['form'] = $validate->getResult();

                if($validate->isValid() == false)
                {
                    $this->_view->errors = $validate->showErrors();
                }
                else{

                    //die('stop');
                    $id = $this->_model->saveItem($this->_arrParams, array('task' => 'edit'));
                    $type = $this->_arrParams['type'];
                    // if($type == 'save-close')
                    // {
                    //     URL::redirect('admin','user','index');
                    // }
                    
                    if($type == 'save')
                    {
                        URL::redirect('admin','index','profile',array('id'=>$id));

                    }

                }
            }

            ///$this->_view->infoUser = $this->_arrParams;

            $this->_view->render('admin','index/profile',true);
        }

        


    }    


?>