<?php

    class CartController extends Controller{

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


        // LIST Cart
        public function indexAction()
        {
            
            // Xuat ra array (module, controleer, action)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('admin','cart');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = ' Cart :: List';

            $configPagination = array('totalItemsPerPage'=>5);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            $list = $this->_model->listItems($this->_arrParams,null);
            
            $this->_view->Items = $list;

            $this->_view->render('admin','cart/index',true);

        }

        

        //Update Status  (Ajax) (*)
        public function ajaxStatusAction()
        {
            //echo __METHOD__;
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->loadModel('admin','cart');
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
            
            $this->loadModel('admin','cart');
            $this->_model->changeStatus($this->_arrParams, array('task' => 'change-status'));
           //die("hihi");
            header('location: '. URL::createLink('admin','cart','index'));
            exit();

        }


    
    }    

?>