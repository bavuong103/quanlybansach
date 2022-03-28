<?php

    class UserController extends Controller{

        public function __construct($arrParams)
        {
            // Chua View Va Template
            parent:: __construct($arrParams);
            //=> _view vs _templateObj

            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
            
        }


        // LIST USER
        public function indexAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','user');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = 'User manager :: List';

            $configPagination = array('totalItemsPerPage'=>5);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            // chuyen` data tu` db vao` selectBox
            $this->_view->selectBoxGroup = $this->_model->itemInSelectbox($this->_arrParams,null);

            $list = $this->_model->listItems($this->_arrParams,null);

            $this->_view->Items = $list;

            $this->_view->render('admin','user/index',true);

        }


        // ADD / EDIT User
        public function formAction()
        {
            $this->loadModel('admin','user');

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->_view->_title = 'Users : Add';

            // chuyen` data tu` db vao` selectBox
            $this->_view->selectBoxGroup = $this->_model->itemInSelectbox($this->_arrParams,null);

            // case edit
            if(isset($this->_arrParams['id']))
            {
                $this->_view->_title = 'User : Edit';
                $this->_arrParams['form'] = $this->_model->infoItem($this->_arrParams);
                if(empty($this->_arrParams['form']))
                {
                    URL::redirect('admin','user','index');
                }
            }

            //Kiem tra da click vao cac nut save de submit form chua?
            if($this->_arrParams['form']['token']>0)
            {
                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                $task = 'add'; 
                $requirePass = true;
                
                // Check userName co exist trong db chua?
                $queryUserName  = "select `id` from `".TBL_USER."` where `username` = '".$this->_arrParams['form']['username']."'";
                $queryEmail     = "select `id` from `".TBL_USER."` where `email` = '".$this->_arrParams['form']['email']."'";

                if(isset($this->_arrParams['form']['id']))
                {
                    $task = 'edit';
                    //echo $task;
                    $requirePass = false;

                    // vô hiệu hóa câu kiểm tra username exist trong db
                    $queryUserName  .= "AND `id` <> '".$this->_arrParams['form']['id']."'";
                    $queryEmail  .= "AND `id` <> '".$this->_arrParams['form']['id']."'";
                }

                $validate = new Validate($this->_arrParams['form']);
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $validate->addRule('username','string-notExistRecord',array('database'=> $this->_model,'query'=>$queryUserName,'min'=>3,'max'=>25))
                        ->addRule('email','email-notExistRecord',array('database'=> $this->_model,'query'=>$queryEmail))
                        ->addRule('password','password',array('action' => $task),$requirePass)
                        ->addRule('ordering','int',array('min'=>1,'max'=>100))
                        ->addRule('status','status',array('deny'=> array('default')))
                        ->addRule('group_id','status',array('deny'=> array('default')));


                $validate->run();
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $this->_arrParams['form'] = $validate->getResult();

                if($validate->isValid() == false)
                {
                    $this->_view->errors = $validate->showErrors();
                }
                else{
                    // Insert database
                   
                    // echo '<pre>';
                    // print_r($this->_arrParams);
                    // echo '</pre>';
                    
                    // die("stop");
                    $id = $this->_model->saveItem($this->_arrParams, array('task' => $task));
                    $type = $this->_arrParams['type'];
                    if($type == 'save-close')
                    {
                        URL::redirect('admin','user','index');
                    }
                    if($type == 'save-new')
                    {
                        URL::redirect('admin','user','form');
                    }
                    if($type == 'save')
                    {
                        URL::redirect('admin','user','form',array('id'=>$id));

                    }

                }
            }

            
            $this->_view->arrParam= $this->_arrParams;

            $this->_view->render('admin','user/form',true);

        }

        //Update Status  (Ajax) (*)
        public function ajaxStatusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','user');
            //dung result chua array dc tra ve
            $result = $this->_model->changeStatus($this->_arrParams, array('task' => 'change-ajax-status'));
            echo json_encode($result);


        }


        //Update STATUS (*)
        public function statusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';
            
            $this->loadModel('admin','user');
            $this->_model->changeStatus($this->_arrParams, array('task' => 'change-status'));
           //die("hihi");
            header('location: '. URL::createLink('admin','user','index'));
            exit();

        }


         // TRASH Items (*)
         public function trashAction()
         {
             //echo __METHOD__;
            //  echo '<pre>';
            //  print_r($this->_arrParams);
            //  echo '</pre>';
             
             $this->loadModel('admin','user');
             $this->_model->deleteItem($this->_arrParams);
            header('location: '. URL::createLink('admin','user','index'));
              exit();
 
         }

       // Update Ordering (*)
       public function orderingAction()
       {
           //echo __METHOD__;
        //    echo '<pre>';
        //    print_r($this->_arrParams);
        //    echo '</pre>';
           
           $this->loadModel('admin','user');
           $this->_model->ordering($this->_arrParams);
           
           //die("hihi");
           header('location: '. URL::createLink('admin','user','index'));
            exit();

       }


    }    

?>