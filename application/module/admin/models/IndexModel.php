<?php

    class IndexModel extends Model{

        private $_columns = array('id', 'username', 'email', 'fullname','password', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering','group_id');

        public function __construct()
        {
            parent :: __construct();
            $this->setTable(TBL_USER);
            
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

        public function saveItem($arrParam, $option = null)
        {
            
            if($option['task']== 'edit')
            {
                //params gom` (module, controler, action, form[name, status, ordering, group_acp])
                // echo '<pre>';
                // print_r($arrParam['form']);
                // echo '</pre>';

                $arrParam['form']['modified'] = date('Y-m-d',time());
                $arrParam['form']['modified_by'] = 13;

                // Lấy các khóa chung giữa 2 mảng array1 vs array2
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
               
                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';

                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success','content'=>'Dữ liệu được lưu thành công!'));
                
                return $arrParam['form']['id'];
            }

            
        }

    }



?>