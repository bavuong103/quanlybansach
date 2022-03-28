<?php

    class BookController extends Controller{

        public function __construct($arrParams)
        {
            // Chua View Va Template
            parent:: __construct($arrParams);
            //=> _view vs _templateObj

            $this->_templateObj->setFolderTemplate('default/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
            
        }


        // LIST BOOK
        public function listAction()
        {
            
            // Xuat ra array (module, controleer, action, category_id)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('default','book');

            $totalItems = $this->_model->countItem($this->_arrParams, null);
            //echo $totalItems; 

            //$this->_view->setTitle('Login');
            $this->_view->_title = ' Book List';

            $configPagination = array('totalItemsPerPage'=>3);
            $this->setPagination($configPagination);

            $this->_view->pagination = new Pagination($totalItems, $this->_pagination);

            $this->_view->categoryName = $this->_model->infoItem($this->_arrParams, array('task' => 'get-cate-name'));

            $list = $this->_model->listItems($this->_arrParams, array('task' => 'books-in-cate'));
            
            $this->_view->Items = $list;

            $this->_view->render('default','book/list',true);

        }


        // Info BOOK
        public function detailsAction()
        {
            
            // Xuat ra array (module, controleer, action, book_id)
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            // keo vao model
            // ten module va ten controller
            $this->loadModel('default','book');

            $this->_view->_title = ' Book Info';

            $this->_view->infoBook = $this->_model->infoItem($this->_arrParams, array('task' => 'book-info'));
           
            $this->_view->booksRelative = $this->_model->listItems($this->_arrParams, array('task' => 'books-relative'));

            $this->_view->render('default','book/details',true);

        }



    }    

?>