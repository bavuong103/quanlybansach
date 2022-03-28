<?php

    class ErrorController extends Controller{

        public function __construct()
        {
             // Chua View Va Template
            //parent:: __construct($arrParams);
            //echo __METHOD__."<br>";
            $this->_view = new View();
            $this->_templateObj = new Template($this);

            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
        }


        public function indexAction()
        {
            //load model
            //$this->loadModel('default','error');

            // load view
            $this->_view->msg = 'This is an error!';
            $this->_view->render('default','error/index');
        }

    }


?>