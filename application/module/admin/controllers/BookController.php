<?php

    class BookController extends Controller{

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


        // LIST BOOK
        public function indexAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','book');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = 'Book manager :: List';

            $configPagination = array('totalItemsPerPage'=>5);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            // chuyen` data tu` db vao` selectBox
            $this->_view->selectBoxCategory = $this->_model->itemInSelectbox($this->_arrParams,null);

            $list = $this->_model->listItems($this->_arrParams,null);

            $this->_view->Items = $list;

            $this->_view->render('admin','book/index',true);

        }


        // ADD / EDIT BOOK
        public function formAction()
        {
            $this->loadModel('admin','book');

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->_view->_title = 'Book : Add';
            if(!empty($_FILES)) 
            {
                $this->_arrParams['form']['picture'] = $_FILES['picture'];
            }

            // chuyen` data tu` db vao` selectBox
            $this->_view->selectBoxCategory = $this->_model->itemInSelectbox($this->_arrParams,null);

            // case edit
            if(isset($this->_arrParams['id']))
            {
                $this->_view->_title = 'Book : Edit';
                $this->_arrParams['form'] = $this->_model->infoItem($this->_arrParams);
                if(empty($this->_arrParams['form']))
                {
                    URL::redirect('admin','book','index');
                }
            }

            //Kiem tra da click vao cac nut save de submit form chua?
            if($this->_arrParams['form']['token']>0)
            {
                // echo '<pre>';
                // print_r($this->_arrParams);
                // echo '</pre>';

                $task = 'add'; 
                
                if(isset($this->_arrParams['form']['id']))
                {
                    $task = 'edit';
                    //echo $task;
                }

                $validate = new Validate($this->_arrParams['form']);
                // echo '<pre>';
                // print_r($validate);
                // echo '</pre>';

                $validate->addRule('name','string',array('min'=>1,'max'=>255))
                        ->addRule('price','int',array('min'=>1000,'max'=>1000000))
                        ->addRule('ordering','int',array('min'=>1,'max'=>100))
                        //->addRule('sale_off','int',array('min'=>0,'max'=>100))
                        ->addRule('status','status',array('deny'=> array('default')))
                        ->addRule('special','status',array('deny'=> array('default')))
                        ->addRule('picture','file',array('min'=>100,'max'=>1000000000,'extension'=> array('png','jpg','jpeg')),false)
                        ->addRule('category_id','status',array('deny'=> array('default')));


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
                        URL::redirect('admin','book','index');
                    }
                    if($type == 'save-new')
                    {
                        URL::redirect('admin','book','form');
                    }
                    if($type == 'save')
                    {
                        URL::redirect('admin','book','form',array('id'=>$id));

                    }

                }
            }

            
            $this->_view->arrParam= $this->_arrParams;

            $this->_view->render('admin','book/form',true);

        }

        //Update Status  (Ajax) (*)
        public function ajaxStatusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','book');
            //dung result chua array dc tra ve
            $result = $this->_model->changeStatus($this->_arrParams, array('task' => 'change-ajax-status'));
            echo json_encode($result);


        }

        //Update Status  (Ajax) (*)
        public function ajaxSpecialAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','book');
            //dung result chua array dc tra ve
            $result = $this->_model->changeSpecial($this->_arrParams, array('task' => 'change-ajax-special'));
            echo json_encode($result);


        }


        //Update STATUS (*)
        public function statusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';
            
            $this->loadModel('admin','book');
            $this->_model->changeStatus($this->_arrParams, array('task' => 'change-status'));
           //die("hihi");
            header('location: '. URL::createLink('admin','book','index'));
            exit();

        }


         // TRASH Items (*)
         public function trashAction()
         {
             //echo __METHOD__;
            //  echo '<pre>';
            //  print_r($this->_arrParams);
            //  echo '</pre>';
             
             $this->loadModel('admin','book');
             $this->_model->deleteItem($this->_arrParams);
            header('location: '. URL::createLink('admin','book','index'));
              exit();
 
         }

       // Update Ordering (*)
       public function orderingAction()
       {
           //echo __METHOD__;
        //    echo '<pre>';
        //    print_r($this->_arrParams);
        //    echo '</pre>';
           
           $this->loadModel('admin','book');
           $this->_model->ordering($this->_arrParams);
           
           //die("hihi");
           header('location: '. URL::createLink('admin','book','index'));
            exit();

       }


        

    }    

?>