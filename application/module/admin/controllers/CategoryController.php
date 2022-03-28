<?php

    class CategoryController extends Controller{

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


        // LIST CATEGORY
        public function indexAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','category');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = ' Catagory Manager :: List';

            $configPagination = array('totalItemsPerPage'=>5);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            $list = $this->_model->listItems($this->_arrParams,null);
            
            $this->_view->Items = $list;

            $this->_view->render('admin','category/index',true);

        }

        // ADD / EDIT Category
        public function formAction()
        {
            $this->loadModel('admin','category');

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->_view->_title = 'category : Add';
            if(!empty($_FILES)) 
            {
                $this->_arrParams['form']['picture'] = $_FILES['picture'];
            }

            // case edit
            if(isset($this->_arrParams['id']))
            {
                $this->_view->_title = 'Category : Edit';
                $this->_arrParams['form'] = $this->_model->infoItem($this->_arrParams);
                if(empty($this->_arrParams['form']))
                {
                    URL::redirect('admin','category','index');
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
                        ->addRule('picture','file',array('min'=>100,'max'=>1000000000,'extension'=> array('png','jpg','jpeg')),false);

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
                        URL::redirect('admin','category','index');
                    }
                    if($type == 'save-new')
                    {
                        URL::redirect('admin','category','form');
                    }
                    if($type == 'save')
                    {
                        URL::redirect('admin','category','form',array('id'=>$id));

                    }

                }
            }

            // Su dubg $value do khong tim duoc array [FORM] trong arrayParam
            //$this->_view->value =  $this->_arrParams['form'];
            
            $this->_view->arrParam= $this->_arrParams;

           
            
            $this->_view->render('admin','category/form',true);

        }

        //Update Status  (Ajax) (*)
        public function ajaxStatusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','category');
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
            
            $this->loadModel('admin','category');
            $this->_model->changeStatus($this->_arrParams, array('task' => 'change-status'));
           //die("hihi");
            header('location: '. URL::createLink('admin','category','index'));
            exit();

        }


         // TRASH Items (*)
         public function trashAction()
         {
             //echo __METHOD__;
            //  echo '<pre>';
            //  print_r($this->_arrParams);
            //  echo '</pre>';
             
             $this->loadModel('admin','category');
             $this->_model->deleteItem($this->_arrParams);
            header('location: '. URL::createLink('admin','category','index'));
              exit();
 
         }

       // Update Ordering (*)
       public function orderingAction()
       {
           //echo __METHOD__;
        //    echo '<pre>';
        //    print_r($this->_arrParams);
        //    echo '</pre>';
           
           $this->loadModel('admin','category');
           $this->_model->ordering($this->_arrParams);
           
           //die("hihi");
           header('location: '. URL::createLink('admin','category','index'));
            exit();

       }
       


    }    

?>