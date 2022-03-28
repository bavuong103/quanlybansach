<?php

    class GroupController extends Controller{

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


        // LIST GROUP
        public function indexAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','group');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = ' User Groups :: List';

            $configPagination = array('totalItemsPerPage'=>5);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            $list = $this->_model->listItems($this->_arrParams,null);
            
            $this->_view->Items = $list;

            $this->_view->render('admin','group/index',true);

        }

        // ADD / EDIT GROUP
        public function formAction()
        {
            $this->loadModel('admin','group');

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // if(empty($this->_arrParams['form']))
            // {
            //     $this->_arrParams['form'] = array('name'=>'','status'=>'','ordering'=>'','group_acp'=>'');
            //     $this->_arrParams['form']['token']=0;
                
            // }

            $this->_view->_title = 'User Groups : Add';

            // case edit
            if(isset($this->_arrParams['id']))
            {
                $this->_view->_title = 'User Groups : Edit';
                $this->_arrParams['form'] = $this->_model->infoItem($this->_arrParams);
                if(empty($this->_arrParams['form']))
                {
                    URL::redirect('admin','group','index');
                }

            }

            //Kiem tra da click vao cac nut save de submit form chua?
            if($this->_arrParams['form']['token']>0)
            {
                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                $validate = new Validate($this->_arrParams['form']);
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $validate->addRule('name','string',array('min'=>3,'max'=>255))
                        ->addRule('ordering','int',array('min'=>1,'max'=>100))
                        ->addRule('status','status',array('deny'=> array('default')))
                        ->addRule('group_acp','status',array('deny'=> array('default')));


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
                    $task = (isset($this->_arrParams['form']['id'])) ? 'edit': 'add'; 
                    //echo $task;
                    //die("stop");
                    $id = $this->_model->saveItem($this->_arrParams, array('task' => $task));
                    $type = $this->_arrParams['type'];
                    if($type == 'save-close')
                    {
                        URL::redirect('admin','group','index');
                    }
                    if($type == 'save-new')
                    {
                        URL::redirect('admin','group','form');
                    }
                    if($type == 'save')
                    {
                        URL::redirect('admin','group','form',array('id'=>$id));

                    }

                }
            }

            // Su dubg $value do khong tim duoc array [FORM] trong arrayParam
            //$this->_view->value =  $this->_arrParams['form'];
            
            $this->_view->arrParam= $this->_arrParams;

           
            
            $this->_view->render('admin','group/form',true);

        }

        //Update Status  (Ajax) (*)
        public function ajaxStatusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','group');
            //dung result chua array dc tra ve
            $result = $this->_model->changeStatus($this->_arrParams, array('task' => 'change-ajax-status'));
            echo json_encode($result);


        }

        //Update Group ACP  (Ajax) (*)
        public function ajaxGroupACPAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','group');
            //dung result chua array dc tra ve
            $result = $this->_model->changeStatus($this->_arrParams, array('task' => 'change-ajax-group-acp'));
            echo json_encode($result);


        }


        //Update STATUS (*)
        public function statusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';
            
            $this->loadModel('admin','group');
            $this->_model->changeStatus($this->_arrParams, array('task' => 'change-status'));
           //die("hihi");
            header('location: '. URL::createLink('admin','group','index'));
            exit();

        }


         // TRASH Items (*)
         public function trashAction()
         {
             //echo __METHOD__;
            //  echo '<pre>';
            //  print_r($this->_arrParams);
            //  echo '</pre>';
             
             $this->loadModel('admin','group');
             $this->_model->deleteItem($this->_arrParams);
            header('location: '. URL::createLink('admin','group','index'));
              exit();
 
         }

       // Update Ordering (*)
       public function orderingAction()
       {
           //echo __METHOD__;
        //    echo '<pre>';
        //    print_r($this->_arrParams);
        //    echo '</pre>';
           
           $this->loadModel('admin','group');
           $this->_model->ordering($this->_arrParams);
           
           //die("hihi");
           header('location: '. URL::createLink('admin','group','index'));
            exit();

       }
       


    }    

?>