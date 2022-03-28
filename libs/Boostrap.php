<?php

class Boostrap{

    private $_params;

    public function __construct()
    {
        // nhan cac gia trij module, action, controller tu URL
        $params = array_merge($_GET, $_POST);


        // lay ten mudule nhap tu URL : module = admin
        $module     = isset($params['module']) ? $params['module'] : DEFAULT_MODULE;
        //$module = $params['module'];
        //echo $module;

        // lay ten controller nhap tu URL : controller = index
        $controller = isset($params['controller']) ? $params['controller'] : DEFAULT_CONTROLLER;
        //echo $controller;

        // lay ten action nhap tu URL : action = index
        $action     = isset($params['action']) ? $params['action'] : DEFAULT_ACTION;
        //echo $action;
        //$this->setParam();


        //IndexController.php
        $controllerName = ucfirst($controller) . 'Controller';

        // filePath = mvc/application/module/admin/controllers/IndexController.php
        $filePath = MODULE_PATH . $module . DS . 'controllers' . DS . $controllerName . '.php';
        //echo $filePath;

        if(file_exists($filePath))
        {
            //keo vao controllers
            require_once($filePath);

            // $a = new UserController()
            $controllerOject = new $controllerName($params);
            
            // ham` load Model tu dong
            //$controllerOject->loadModel($module, $controller);

            // loginAction
            $actionName = $action . 'Action';
            

            // Kiem tra 1 function co ton tai trong 1 controller ko
            if(method_exists($controllerOject, $actionName)==true)
            {

                // Phan` Login 
                $module = isset($params['module']) ? $params['module'] : DEFAULT_MODULE;
                $controller = isset($params['controller']) ? $params['controller'] : DEFAULT_CONTROLLER;
                $action = isset($params['action']) ? $params['action'] : DEFAULT_ACTION;

                $userInfo = Session::get('user');
                //Session::delete('user');
                // echo '<pre>';
                // print_r($userInfo);
                // echo '</pre>';
                
                // check login = true vs time luc Login + 3600s >= time()
                $logged     = ($userInfo['login']== true && $userInfo['time'] + TIME_LOGIN >= time());
                //echo $logged;
                //$pageLogin  = ($controller == 'index') && ($action == 'login');

                // MODULE ADMIN
                if($module=='admin')
                {
                    // case Login Admin
                    if($logged == true)
                    {
                        // case da login thanh` cong
                        if($userInfo['group_acp'] == 1)
                        {
                               // cho user truy cap trang theo URL bth
                                $controllerOject->$actionName();
                        }
                        else{
                            URL::redirect('default','index','notice',array('type'=>'not-permission'));
                        }
                    }
                    else{
                        Session::delete('user');

                        // application/module/admin/controllers/IndexController
                        require_once(MODULE_PATH . $module . DS . 'controllers' . DS . 'IndexController.php');
                        $indexController = new IndexController($params);
                        $indexController->loginAction();



                        

                    }

                // MODULE DEFAULT    
                }else if($module == 'default')
                {
                    if($controller == 'user')
                    {
                        if($logged==true)
                        {
                            $controllerOject->$actionName();
                        }
                        else{
                            Session::delete('user');
                            // application/module/admin/controllers/IndexController
                            require_once(MODULE_PATH . $module . DS . 'controllers' . DS . 'IndexController.php');
                            $indexController = new IndexController($params);
                            $indexController->loginAction();
                        }
                    }
                    else{
                        $controllerOject->$actionName();
                    }
                    
                }


                // case ko check Login 
                // UserController -> indexAction
                //$controllerOject->$actionName();
            }
            else{
                URL::redirect('default','index','notice',array('type'=>'not-url'));
            }


        }
        else{
            //$this->_error();

            URL::redirect('default','index','notice',array('type'=>'not-url'));
            
        
        }


        

    }


    // Error Controller
    public function _error()
    {
        require_once(MODULE_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController.php');
        $error = new ErrorController();
        $error->indexAction();
    }

    // Load Default controller
    // public function loadDefaultController()
    // {
    //     $controllerName = ucfirst(DEFAULT_CONTROLLER) . 'Controller';
    //     $actionName = DEFAULT_ACTION . 'Action';

    //     //application/default/controllers/UserController.php
    //     $path = APPLICATION_PATH . DEFAULT_MODULE . DS . 'controllers' . DS . $controllerName . '.php';
    //     //echo $path;

    //     if(file_exists($path))
    //     {
    //         //keo vao controllers
    //         require_once($path);

    //         // = new UserController()
    //         $controllerOject = new $controllerName();

    //         // ->indexAcion()
    //         $controllerOject->{$actionName}();

    //     }

    // }


    // SET PARAMS
	public function setParam(){
		$this->_params 	= array_merge($_GET, $_POST);
		$this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
		$this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
		$this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
	}

}


?>