<?php
// Path: localhost:8081/bookstore/index.php?module=admin&controller=index&action=login

 //echo __FILE__;
 // ====================== PATHS ===========================
 define ('DS'				, '/');

 // C:/xampp/htdocs/bookstore/ (path tuyet doi)
 define ('ROOT_PATH'			, dirname(__FILE__));					// Định nghĩa đường dẫn đến thư mục gốc
 // bookstore/libs/
 define ('LIBRARY_PATH'		    , ROOT_PATH . DS . 'libs' . DS);		// Định nghĩa đường dẫn đến thư mục thư viện
 // bookstore/public/
 define ('PUBLIC_PATH'		    , ROOT_PATH . DS . 'public' . DS);		// Định nghĩa đường dẫn đến thư mục public							
 // bookstore/public/files/
 define ('UPLOAD_PATH'		    , PUBLIC_PATH . 'files' . DS);
 // bookstore/application/
 define ('APPLICATION_PATH'	    , ROOT_PATH . DS . 'application' . DS);		// Định nghĩa đường dẫn đến thư mục application							
//bookstore/application/module/
 define ('MODULE_PATH'		    , APPLICATION_PATH . 'module' . DS);	// Định nghĩa đường dẫn đến thư mục module							
 //bookstore/application/block/
 define ('BLOCK_PATH'		    , APPLICATION_PATH . 'block' . DS);	    // Định nghĩa đường dẫn đến thư mục block	
 // libs/template/
 define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);		// Định nghĩa đường dẫn đến thư mục template							
 
 // /bookstore/  (path tuong doi: Load images)
 // /bookstore
 define	('ROOT_URL'			, DS . 'bookstore');
 define	('APPLICATION_URL'	, ROOT_URL . DS . 'application' . DS);
 define	('PUBLIC_URL'		, ROOT_URL . DS . 'public' . DS);
 define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
 define	('UPLOAD_URL'		, PUBLIC_URL . 'files' . DS);
 
 define	('DEFAULT_MODULE'		, 'default');
 define	('DEFAULT_CONTROLLER'	, 'index');
 define	('DEFAULT_ACTION'		, 'index');



 //----------dataBase------

 define('DB_HOST'    , 'localhost');
 define('DB_USER'    , 'root');
 define('DB_PASS'    , '');
 define('DB_NAME'    , 'bookstore');
 define('DB_TABLE'    , 'group');

 //----------dataBase TABLE------

 define('TBL_GROUP'    , 'group');
 define('TBL_USER'    , 'user');
 define('TBL_CATEGORY'    , 'category');
 define('TBL_BOOK'    , 'book');
 define('TBL_CART'    , 'cart');

 //----------Config------

 define('TIME_LOGIN'    , 3600);
 
 






 ?>
