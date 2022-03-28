<?php

    class View{

        // module name
        public $_moduleName;

        //user/login
        public $_fileView;

        public $_templatePath;
        public $_title;
        public $_dirImg;

        public $_cssFiles;
        public $_jsFiles;  
        

        public function __construct()
        {
            
            
        }

        // hàm kéo các file View vào Controller voi ten module va user/login
        public function render($module, $fileInclude, $loadFull=true)
        {
            // path = ('application/module/admin/views/user/login.php')
            $path = MODULE_PATH . $module . DS . 'views' .  DS . $fileInclude . '.php';
            if(file_exists($path))
            {
                if($loadFull == true)
                {
                    $this->_fileView = $fileInclude;
                    $this->_moduleName = $module;
                    // Keo vao duong dan~ trong folder 
                    //require_once($path);

                    // Keo Template vao View: admin/main/index.php
                    require_once($this->_templatePath);
                }
                else{
                    // Keo vao duong dan~ trong folder va khong keo vao Template
                    // require_one('application/admin/views/user/login.php')
                    require_once($path);
                }
     
            }
            else{
                echo 'Error';
            }

            

        }


        //Thiet lap duong` dan~ den Template: template/admin/main/index.php
        // su dung trong file Template.php
        public function setTemplatePath($path)
        {
            
            $this->_templatePath = $path;
            //echo $this->_templatePath = $path;
        }

        //Thiet lap Title
        public function setTitle($value)
        {
            $this->_title = $value;
        }

        





        
    }

?>