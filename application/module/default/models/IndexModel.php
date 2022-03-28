<?php

    class IndexModel extends Model{

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

        public function saveItem($arrParam, $option = null)
        {
            
            if($option['task']== 'user-register')
            {
                //params gom` (module, controler, action, form[username, fullname, passowrd, email]])
                // echo '<pre>';
                // print_r($arrParam['form']);
                // echo '</pre>';

                //$arrParam['form']['register_date'] = date('Y-m-d H:m:s',time());
                
                // Ma hoa password
                $arrParam['form']['password'] = md5($arrParam['form']['password']);
                $arrParam['form']['status'] = 0;

                // Lấy các khóa chung giữa 2 mảng array1 vs array2
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';

                $this->insert($data);
                //Session::set('message', array('class' => 'success','content'=>'Dữ liệu được lưu thành công!'));
                
                return $this->lastID();
            }

            

            
        }

        
        public function infoItem($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";
            if($option==null)
            {
                $username = $arrParam['form']['username'];
                $password = md5($arrParam['form']['password']);
                $query[] = "Select `u`.`id`, `u`.`fullname`,`u`.`username`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`";
                $query[] = "from `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
                $query[] = "where `username` = '$username' and `password`= '$password'";
            
                $query = implode(" ",$query);

                $result = $this->singleRecord($query);
                return $result;
            }

        }

        // Index()
        public function listItems($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";
            
            if($option['task'] == 'books-special')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';    
                
                $query[] = "SELECT `id`, `name`, `picture`, `description`";
                $query[] = "FROM `".TBL_BOOK."`";
                $query[] = "Where `status` = 1 AND `special` = '1'" ;
                $query[] = "ORDER BY `id` DESC";
                $query[] = "LIMIT 0,2";
                // bien array -> string
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                // neu co loi thi dugn query()
                $result = $this->select($query);

                // echo '<pre>';
                // print_r($result);
                // echo '</pre>';

                return $result;
            }


            if($option['task'] == 'books-new')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';    
                
                $query[] = "SELECT `id`, `name`, `picture`";
                $query[] = "FROM `".TBL_BOOK."`";
                $query[] = "Where `status` = 1" ;
                $query[] = "ORDER BY `id` DESC";
                $query[] = "LIMIT 0,3";
                // bien array -> string
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                // neu co loi thi dugn query()
                $result = $this->select($query);

                // echo '<pre>';
                // print_r($result);
                // echo '</pre>';

                return $result;
            }
            

        }




    }

?>