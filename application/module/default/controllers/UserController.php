<?php

    class UserController extends Controller{

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


        // My Profile
        public function indexAction()
        {
            // Load Model
            $this->loadModel('default','user');
            
            // dan den trang My Profile
            $this->_view->render('default','user/index');

        }

        // List Books In Cart
        public function cartAction()
        {
            // Load Model
            $this->loadModel('default','user');

            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';

            $this->_view->_title = 'My Cart';

            $this->_view->Items = $this->_model->listItems($this->_arrParams, array('task' => 'books-in-cart'));

            // dan den trang My Cart
            $this->_view->render('default','user/cart');

        }


        // Add Books to Cart
        public function addtoCartAction()
        {
            // Load Model
            $this->loadModel('default','user');

            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';
            // die("stop");


           $cart    = Session::get('cart');
           $bookID  = $this->_arrParams['book_id'];
           $price   = $this->_arrParams['price'];
           
           if(empty($cart))
           {
                $cart['quantity'][$bookID] = 1;
                $cart['price'][$bookID] = $price;
           }else{
               // case 1 quyen sach do da ton tai trong cart
               if(key_exists($bookID, $cart['quantity']))
               {
                    $cart['quantity'][$bookID] ++ ;
                    $cart['price'][$bookID] = $price * $cart['quantity'][$bookID];
               }
               else{
                // case 1 quyen sach chua co trong cart 
                    $cart['quantity'][$bookID] = 1;
                    $cart['price'][$bookID] = $price;
               }

           }

            // echo '<pre>';
            // print_r($cart);
            // echo '</pre>';
            // die("stop");

            Session::set('cart', $cart);
            URL::redirect('default','book','details',array('book_id' => $bookID));


        }

        // CheckOut
        public function buyAction()
        {
            // Load Model
            $this->loadModel('default','user');
            
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->_model->saveItem($this->_arrParams, array('task' => 'books-buy'));

            URL::redirect('default','index','index');
        }


        // View Bill
        public function historyAction()
        {
            // Load Model
            $this->loadModel('default','user');

            $this->_view->_title = 'History';
            
            // echo '<pre>';
            // print_r($this->_arrParams);
            // echo '</pre>';

            $this->_view->Items = $this->_model->listItems($this->_arrParams, array('task' => 'history-cart'));

            $this->_view->render('default','user/history');
        }

  
       


    }    

?>