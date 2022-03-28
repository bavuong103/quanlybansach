<?php

    class Controller{

        //View Object
        public $_view;
        //Model Object
        protected $_model;
        //Template Object
        protected $_templateObj;   
        
        //Params (GET - POST)
        protected $_arrParams;

        // Pagination
        protected $_pagination = array(
                                        'totalItemsPerPage' => 3,

                                    );

        // Muốn bỏ tham số ($arrParams) thì vào class boostrap dong` 41
        // -> $controllerOject -> bỏ tham số ($params)
        public function __construct($arrParams)
        {
            // echo '<pre>';
            // print_r($arrParams);
            // echo '</pre>';
            
            // ket noi den Class View
            //Set View()
            $this->_view = new View();

            // ket noi den Template, voi $this la name 1 Controller
            //Set Template()
            $this->_templateObj = new Template($this);

            //$this->loadModel($arrParams['module'], $arrParams['controller']);

            // echo '<pre>';
            // print_r($this->_view);
            // echo '</pre>';

            // echo '<pre>';
            // print_r($this->_templateObj);
            // echo '</pre>';

            //GET['page']
            $this->_pagination['currentPage'] = (isset($arrParams['filter_page'])) ? $arrParams['filter_page'] : 1;
            $arrParams['pagination'] = $this->_pagination;

            

            $this->setParams($arrParams);

            $this->_view->arrParam = $arrParams;
                  
        }


        
        // SetModel()
        // ham` keo Model vao Controller
        // ten module va ten controller
        public function loadModel($moduleName, $modelName){
            //echo $moduleName.',';
            //echo $modelName;

            //IndexModel.php
            $modelName = ucfirst($modelName) . 'Model';

            // application/admin/models/IndexModel.php
            $path = MODULE_PATH . $moduleName . DS . 'models' . DS . $modelName. '.php';

            if(file_exists($path))
            {
                require_once($path);
                $this->_model = new $modelName;
            }
        }


        //chuyen trang
        public function redirect($controller = 'index', $action = 'index'){
            header("location: index.php?controller=$controller&action=$action");
            exit();
        }

        //Get Model
        public function getModel()
        {
            return $this->_model;
        }


        //Get View
        public function getView()
        {
            return $this->_view;
        }


        //Get Template
        public function getTemplate()
        {
            return $this->_templateObj;
        }

        //Set Params
        public function setParams($params)
        {
            $this->_arrParams= $params;
        }

        //Get Params
        public function getParams()
        {
            return $this->_arrParams;
        }

         //Set Pagination
         public function setPagination($config)
         {
            $this->_pagination['totalItemsPerPage'] = $config['totalItemsPerPage'];
            //echo $this->_pagination['totalItemsPerPage'];
            //update lai _pagination
            $this->_arrParams['pagination'] =  $this->_pagination;
            $this->_view->arrParam = $this->_arrParams;
         
        }
        
        
    }

?>