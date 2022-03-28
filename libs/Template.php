<?php
    class Template{
        
        // File config (/admin/main/template.ini)
        private $_fileConfig;

        // File template (/admin/main/index.php)
        private $_fileTemplate;

        // Folder (/admin/main/)
        private $_folderTemplate;

        // Controller Object
        private $_controller;

        public function __construct($controller)
        {
            // xac dinh name 1 controller dc keo den
            $this->_controller = $controller;
            // template = new Template($this)
        }

        // Load Template vao Controller
        public function load(){

            // template.ini
             $fileConfig 	= $this->getFileConfig();
            //admin/ main
             $folderTemplate = $this->getFolderTemplate();
             // index.php
             $fileTemplate 	= $this->getFileTemplate();
            
            // Path to File Config : template/admin/main/template.ini
            $pathFileConfig	= TEMPLATE_PATH . $folderTemplate . $fileConfig;
            //echo $pathFileConfig.'<br>';    
            
            if(file_exists($pathFileConfig))
            {
                //P1:
                // parse_ini_file: read content in file config
                $arrConfig = parse_ini_file($pathFileConfig);

                // Xuat ra cac content trong file config
                // echo '<pre>';
                // print_r($arrConfig);
                // echo '</pre>';

                //P2:
                // keo file template(main/index.php) vao controller
                // public/default/admin/main/index.php
                $path = TEMPLATE_PATH . $folderTemplate . $fileTemplate;
                
                $view = $this->_controller->_view;
                $view->_title = $arrConfig['title'];
                
                $view->_cssFiles 	= $this->createLinkCSS($arrConfig['dirCss'], $arrConfig['fileCss']);
                $view->_jsFiles 	= $this->createLinkJS($arrConfig['dirJs'], $arrConfig['fileJs']);

                $view->_dirImg = TEMPLATE_URL . $this->_folderTemplate . $arrConfig['dirImg'];


                // Cach 2: dan vao class View
                $view->setTemplatePath($path);

                //Cach 1: truyen template vao view 
                //$view->_templatePath = $path;
                //echo $view->_templatePath;

                
                


            }

        
        }

        // tao file ql Css : path: /css/, file: .css
        public function createLinkCSS($pathCSS, $fileCSS){
            $xhtml = '';
            if(!empty($fileCSS)){
                $path = TEMPLATE_URL .$this->_folderTemplate . $pathCSS;
                foreach($fileCSS as $css){
                    $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path.DS.$css.'"/>';
                    
                }
            }
            return $xhtml;
        }

        // tao file ql JS : path: /js/, file: .js
        public function createLinkJS($pathJS, $fileJS){
            $xhtml = '';
            if(!empty($fileJS)){
                $path = TEMPLATE_URL .$this->_folderTemplate . $pathJS;
                foreach($fileJS as $js){
                    $xhtml .= '<script type="text/javascript" src="'.$path.DS.$js.'"></script>';
                    
                }
            }
            return $xhtml;
        }


        // SET FILE TEMPLATE ('index.php')
        public function setFileTemplate($value = 'index.php'){
            $this->_fileTemplate = $value;
        }
        
        // GET FILE TEMPLATE
        public function getFileTemplate(){
            return $this->_fileTemplate;
        }
        
        // SET FILE CONFIG ('template.ini)
        public function setFileConfig($value = 'template.ini'){
            $this->_fileConfig = $value;
        }
        
        // GET FILE CONFIG
        public function getFileConfig(){
            return $this->_fileConfig;
        }
        
        
        // SET FOLDER TEMPLATE (default/main/)
        public function setFolderTemplate($value = 'default/main/'){
            $this->_folderTemplate = $value;
        }
        
        // GET FOLDER CONFIG
        public function getFolderTemplate(){
            return $this->_folderTemplate;
        }




    }



?>