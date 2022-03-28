<?php

    class BookModel extends Model{

    private $_columns = array('id', 'name', 'picture', 'special','description','price','sale_off', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering','category_id');


        //protected $_tableName = TBL_GROUP ; 

        public function __construct()
        {
            parent :: __construct();
            //echo __METHOD__."<br>";

            $this->setTable(TBL_BOOK);


        }

        public function countItem($arrParam, $option = null)
        {
            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';    
    
            $query[] = "SELECT Count(`id`) AS `total`";
            $query[] = "FROM `$this->table`";
            $query[] = "Where `id` > 0" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND (`name` LIKE $keyword)" ;
                
            }

            //FILTER: Status
            // Khi chon 1 status tu selectBox
            if(isset($arrParam['filter_state']) && $arrParam['filter_state']!='default')
            {
                
                    $query[] = "AND `status` = '".$arrParam['filter_state']."'";
            }

             //FILTER: Special
            // Khi chon 1 special tu selectBox
            if(isset($arrParam['filter_special']) && $arrParam['filter_special']!='default')
            {
                
                    $query[] = "AND `special` = '".$arrParam['filter_special']."'";
    
            }

            //FILTER: Category id
            // Khi chon 1 Category id tu selectBox
            if(isset($arrParam['filter_category_id']) && $arrParam['filter_category_id']!='default')
            {
                
                    $query[] = "AND `category_id` = '".$arrParam['filter_category_id']."'";
    
            }

        
            //Sort
            // Khi đã click vào tên cột muốn sort
            // if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir']))
            // {
            //     // Name Column to sort (name)
            //     $column = $arrParam['filter_column'];
            //     // Action Sort : asc/ desc
            //     $columnDir = $arrParam['filter_column_dir'];
            //     // Sort ASC
            //     $query[] = "ORDER BY `$column` $columnDir";

            // }

            // Sort Default (delete)
            $query[] = "ORDER BY `id` DESC";
    
            // bien array -> string
            $query = implode(" ",$query);
            //echo $query;
            // neu co loi thi dugn query()
            $result = $this->singleRecord($query);

           
            return $result['total'];

        }

        // chuyền data từ db vào selectBox
        public function itemInSelectbox($arrParam, $option=null)
        {
            if($option==null)
            {
                $query = "Select `id`, `name` From `". TBL_CATEGORY ."`";

                //  chuyền data vào hàm createSelectBox từ Model
                $result = $this->fetchPairs($query);
                // echo '<pre>';
                // print_r($result);
                // echo '</pre>';

                $result['default'] = "- Select Category - ";
                ksort($result);

            }
            return $result;
        }

        public function listItems($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";

            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';    
            

            $query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`picture`,`b`.`special`, `b`.`price`, `b`.`sale_off`, `b`.`status`, `b`.`ordering`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `c`.`name` AS `category_name`";
            $query[] = "FROM `$this->table` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
            $query[] = "Where `b`.`id` > 0" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND (`b`.`name` LIKE $keyword)" ;
                
            }

            //FILTER: Status
            // Khi chon 1 status tu selectBox
            if(isset($arrParam['filter_state']) && $arrParam['filter_state']!='default')
            {
                
                    $query[] = "AND `b`.`status` = '".$arrParam['filter_state']."'";
    
            }

            //FILTER: Special
            // Khi chon 1 special tu selectBox
            if(isset($arrParam['filter_special']) && $arrParam['filter_special']!='default')
            {
                
                    $query[] = "AND `b`.`special` = '".$arrParam['filter_special']."'";
    
            }

            //FILTER: Category id
            // Khi chon 1 Category id tu selectBox
            if(isset($arrParam['filter_category_id']) && $arrParam['filter_category_id']!='default')
            {
                
                    $query[] = "AND `b`.`category_id` = '".$arrParam['filter_category_id']."'";
    
            }

            
        
            //Sort
            // Khi đã click vào tên cột muốn sort
            // if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir']))
            // {
            //     // Name Column to sort (name)
            //     $column = $arrParam['filter_column'];
            //     // Action Sort : asc/ desc
            //     $columnDir = $arrParam['filter_column_dir'];
            //     // Sort ASC
            //     $query[] = "ORDER BY `b`.`$column` $columnDir";

            // }
            // else
            // {
            //     // Truong hop mac dinh khi chua bam vao column Name
            //     $query[] = "ORDER BY `b`.`id` DESC";
            // }

            // Sort Default (delete)
            $query[] = "ORDER BY `b`.`id` DESC";

            // PAGINATION
            $pagination = $arrParam['pagination'];
            $totalItemsPerPage = $pagination['totalItemsPerPage'];
            $currentPage = $pagination['currentPage'];
            if($totalItemsPerPage>0)
            {
                $position = ($currentPage-1)*$totalItemsPerPage;
                //$query[] = "LIMIT 0,3";
                 $query[] = "LIMIT $position,$totalItemsPerPage";
            }

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


        public function changeStatus($arrParam, $option = null)
        {
            // case status icon
            if($option['task'] == 'change-ajax-status')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, status. id)

                // lay tu URL
                // chyen doi status tu 1 -> 0 va 0->1
                $status = ($arrParam['status']==0) ? 1 : 0;
                $id = $arrParam['id'];
                $query = "UPDATE `$this->table` SET `status` = $status WHERE `id`= '".$id."'";
                //echo $query; 
                //die("hihi");
                $this->query($query);
                
                $result = array($id, $status, URL::createLink('admin','book','ajaxStatus', array('id'=>$id, 'status'=>$status)));
                //Session::set('message', array('class' => 'success','content'=>'Phần tử được thay đổi trạng thái! '));
                
                
                // tra ve array(id, status, link)
                return $result;

            }

            // case Pubslish button
            if($option['task'] == 'change-status')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, type , )

                // trong truong hop unpublish (type=0) thi cac icon thanh` 0
                $status = ($arrParam['type']==0) ? 0 : 1;

                // [cid] la array chua cac id nhan dc
                if(!empty($arrParam['cid']))
                {
                    $ids = $this->createWhereDeleteSQL($arrParam['cid']);
                    $query = "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                    //echo $query; 
                    //die("hihi");
                    $this->query($query);
                    //Session::set('message', 'Có ' .$this->affectedRows(). ' phần tử được thay đổi trạng thái! ');
                    Session::set('message', array('class' => 'success','content'=>'Có ' .$this->affectedRows(). ' phần tử được thay đổi trạng thái! '));
                }
                else{
                    Session::set('message', array('class' => 'error','content'=>'Vui lòng chọn vào phần tử muốn thay đổi trạng thái! '));
                }
                

            }

        }

        public function changeSpecial($arrParam, $option = null)
        {
            // case status icon
            if($option['task'] == 'change-ajax-special')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, status. id)

                // lay tu URL
                // chyen doi status tu 1 -> 0 va 0->1
                $special = ($arrParam['special']==0) ? 1 : 0;
                $id = $arrParam['id'];
                $query = "UPDATE `$this->table` SET `special` = $special WHERE `id`= '".$id."'";
                //echo $query; 
                //die("hihi");
                $this->query($query);
                
                $result = array($id, $special, URL::createLink('admin','book','ajaxSpecial', array('id'=>$id, 'special'=>$special)));
                //Session::set('message', array('class' => 'success','content'=>'Phần tử được thay đổi trạng thái! '));
                
                
                // tra ve array(id, status, link)
                return $result;

            }

        }


        public function deleteItem($arrParam, $option = null)
        {
            

            if($option== null)
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, cid)

                // [cid] la array chua cac id nhan dc
                if(!empty($arrParam['cid']))
                {
                    $ids = $this->createWhereDeleteSQL($arrParam['cid']);
                    $query = "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                    //echo $query; 
                    //die("hihi");
                    $this->query($query);
                    Session::set('message', array('class' => 'success','content'=>'Có ' .$this->affectedRows(). ' phần tử được xóa! '));

                }else{
                    Session::set('message', array('class' => 'error','content'=>'Vui lòng chọn vào phần tử muốn xóa! '));
                }
                

            }

            
        }


        public function infoItem($arrParam, $option = null)
        {
            

            if($option== null)
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, id)

                // Không xuất ra thông tin password trong câu quẻry
                $query[] = "SELECT `id`, `name`,`picture`,`description`,`price`, `sale_off`,`special`, `category_id`, `ordering`, `status`";
                $query[] = "FROM `$this->table`";
                $query[] = "Where `id` = '".$arrParam['id']."'";
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                
                $result = $this->singleRecord($query);
    
                return $result;
                

            }

            
        }


        public function saveItem($arrParam, $option = null)
        {
            $userObj = Session::get('user');
            $userInfo = $userObj['info'];
            
            if($option['task']== 'add')
            {
                //params gom` (module, controler, action, form[name, status, ordering, group_acp])
                // echo '<pre>';
                // print_r($arrParam['form']);
                // echo '</pre>';

                // name: abc.jpg
                $arrParam['form']['picture'] = $arrParam['form']['picture']['name'];
                $arrParam['form']['created'] = date('Y-m-d',time());
                $arrParam['form']['created_by'] = $userInfo['username'];
                
                // Lấy các khóa chung giữa 2 mảng array1 vs array2
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';

                $this->insert($data);
                Session::set('message', array('class' => 'success','content'=>'Dữ liệu được lưu thành công!'));
                
                return $this->lastID();
            }

            if($option['task']== 'edit')
            {
                //params gom` (module, controler, action, form[name, status, ordering, group_acp])
                // echo '<pre>';
                // print_r($arrParam['form']);
                // echo '</pre>';

                $arrParam['form']['modified'] = date('Y-m-d',time());
                $arrParam['form']['modified_by'] = $userInfo['username'];
                // case ko change images
                if($arrParam['form']['picture']['name'] == null)
                {
                    unset($arrParam['form']['picture']);
                }
                else{
                    // case change images
                    $arrParam['form']['picture'] = $arrParam['form']['picture']['name'];

                }

                // Lấy các khóa chung giữa 2 mảng array1 vs array2
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->update($data, array(array('id', $arrParam['form']['id'])));
                Session::set('message', array('class' => 'success','content'=>'Dữ liệu được lưu thành công!'));
                
                return $arrParam['form']['id'];
            }

            
        }


        public function ordering($arrParam, $option = null)
        {
            
            if($option== null)
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, order)

                // [order] la array chua cac value ordering
                if(!empty($arrParam['order']))
                {
                    $i=0;
                    foreach($arrParam['order'] as $id => $ordering)
                    {
                        $i++;
                        $query = "UPDATE `$this->table` SET `ordering` = $ordering WHERE `id`= '".$id."'";
                        //echo $query;
                         //die("hhihi");
                        $this->query($query);

                    }

                    Session::set('message', array('class' => 'success','content'=>'Có ' .$i. ' phần tử được thay đổi ordering! '));

                }
                

            }

            
        }






    }



?>