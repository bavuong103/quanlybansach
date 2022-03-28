<?php

    class UserModel extends Model{

        // all colums in table user
        private $_columns = array('id', 
                                'username', 
                                'email', 
                                'fullname',
                                'password', 
                                'created', 
                                'created_by', 
                                'modified', 
                                'modified_by', 
                                'status', 
                                'ordering',
                                'group_id');

        public function __construct()
        {
            parent :: __construct();
            //echo __METHOD__."<br>";

            $this->setTable(TBL_USER);


        }


        // Index()
        public function listItems($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";
            
            if($option['task'] == 'books-in-cart')
            {

                $cart = Session::get('cart');
                // echo '<pre>';
                // print_r($cart);
                // echo '</pre>'; 
                
                $result = array();

                if(!empty($cart))
                {
                    // ids: cac id cua books dc buy in cart
                    // ids: ('1','3','4')
                    $ids = "(";
                    foreach($cart['quantity'] as $key => $value)
                    {
                        $ids .= "'$key', ";
                    }
                    $ids .= "'0')";
                    //echo $ids;

                    $query[] = "SELECT `id`, `name`, `picture`";
                    $query[] = "FROM `".TBL_BOOK."`";
                    $query[] = "Where `status` = 1 AND `id` IN $ids" ;
                    
                    
                    // bien array -> string
                    $query = implode(" ",$query);
                    //echo $query;
                    //die("hihi");
                    
                    $result = $this->select($query);
    
                    // echo '<pre>';
                    // print_r($result);
                    // echo '</pre>';

                    foreach($result as $key => $value)
                    {
                        $result[$key]['quantity'] = $cart['quantity'][$value['id']];
                        $result[$key]['totalPrice'] = $cart['price'][$value['id']];
                        $result[$key]['unitPrice'] = $result[$key]['totalPrice'] / $result[$key]['quantity'];

                    }

                    // echo '<pre>';
                    // print_r($result);
                    // echo '</pre>';
                }

                return $result;
            }


            if($option['task'] == 'history-cart')
            {

                $userObj = Session::get('user');
                $userInfo = $userObj['info'];

                // VD: username = admin
                $username = $userInfo['username'];
        
                $query[] = "SELECT `id`, `books`,`prices`,`quantities`,`names`,`pictures`, `status`,`date`";
                $query[] = "FROM `".TBL_CART."`";
                $query[] = "Where `username` = '$username'" ;
                $query[] = "ORDER BY `date` ASC" ;
               
                // bien array -> string
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                    
                $result = $this->select($query);
    
                    // echo '<pre>';
                    // print_r($result);
                    // echo '</pre>';
                return $result;
            }
        }


        // Buy
        public function saveItem($arrParam, $option = null)
        {
            
            if($option['task']== 'books-buy')
            {
                //params gom` (module, controler, action, form[books, prices,quanitytys, names, pictures, ...]])
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                $books = json_encode($arrParam['form']['book_id']);
                //echo $books;
                $prices = json_encode($arrParam['form']['price']);
                $quantities = json_encode($arrParam['form']['quantity']);
                $names = json_encode($arrParam['form']['name']);
                $pictures = json_encode($arrParam['form']['picture']);
                $date = date('Y-m-d H:i:s' , time());

                // id of bill
                $id = $this->randomString(7);

                $userObj = Session::get('user');
                $userInfo = $userObj['info'];
                $username = $userInfo['username'];

                $query = "INSERT INTO `".TBL_CART."` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) 
                VALUES ('$id', '$username', '$books', '$prices', '$quantities', '$names', '$pictures', '0' , '$date')";

                $this->query($query);
                Session::delete('cart');
                
            }

          
        }


        private function randomString($length = 5){
	
            $arrCharacter = array_merge(range('a','z'), range(0,9),range('A','Z'));
            $arrCharacter = implode('', $arrCharacter);
            $arrCharacter = str_shuffle($arrCharacter);
        
            $result		= substr($arrCharacter, 0, $length);
            return $result;
        }

        




    }

?>