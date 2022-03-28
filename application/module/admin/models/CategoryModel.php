<?php

    class CategoryModel extends Model{

    private $_columns = array('id', 'name', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');

        public function __construct()
        {
            parent :: __construct();
            //echo __METHOD__."<br>";

            $this->setTable(TBL_CATEGORY);


        }

        // Index()
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
                $query[] = "AND `name` LIKE $keyword" ;
                
            }

            //FILTER: Status
            // Khi chon 1 status tu selectBox
            if(isset($arrParam['filter_state']) && $arrParam['filter_state']!='default')
            {
                // Khi da~ exist menh de` where roi`
                
                    $query[] = "AND `status` = '".$arrParam['filter_state']."'";

            }

            // Sort
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


        // Index()
        public function listItems($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";

            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';    
            

            $query[] = "SELECT `id`, `name`, `picture`,`status`, `ordering`, `created`, `created_by`, `modified`, `modified_by`";
            $query[] = "FROM `$this->table`";
            $query[] = "Where `id` > 0" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND `name` LIKE $keyword" ;
                
            }

            //FILTER: Status
            // Khi chon 1 status tu selectBox
            if(isset($arrParam['filter_state']) && $arrParam['filter_state']!='default')
            {
                
                    $query[] = "AND `status` = '".$arrParam['filter_state']."'";

            }

            // Sort
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
            // else
            // {
            //     // Truong hop mac dinh khi chua bam vao column Name
            //     $query[] = "ORDER BY `id` DESC";
            // }

            // Sort default (delete)
            $query[] = "ORDER BY `id` DESC";

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


        // status() vs ajaxStatus()
        public function changeStatus($arrParam, $option = null)
        {
            $userObj = Session::get('user');
            $userInfo = $userObj['info'];

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
                $modified = date('Y-m-d',time());
                $modified_by = $userInfo['username'];
                $id = $arrParam['id'];
                $query = "UPDATE `$this->table` SET `status` = $status, `modified` ='$modified', `modified_by` = '$modified_by' WHERE `id`= '".$id."'";
                //echo $query; 
                //die("hihi");
                $this->query($query);
                
                $result = array($id, $status, URL::createLink('admin','category','ajaxStatus', array('id'=>$id, 'status'=>$status)));
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
                $modified = date('Y-m-d',time());
                $modified_by = $userInfo['username'];

                // [cid] la array chua cac id nhan dc
                if(!empty($arrParam['cid']))
                {
                    $ids = $this->createWhereDeleteSQL($arrParam['cid']);
                    $query = "UPDATE `$this->table` SET `status` = $status, `modified` ='$modified', `modified_by` = '$modified_by' WHERE `id` IN ($ids)";
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

        // trash()
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


        // form(edit)
        public function infoItem($arrParam, $option = null)
        {
            

            if($option== null)
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                //params gom` (module, controler, action, id)

                $query[] = "SELECT `id`, `name`, `picture`, `ordering`, `status`";
                $query[] = "FROM `$this->table`";
                $query[] = "Where `id` = '".$arrParam['id']."'";
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                
                $result = $this->singleRecord($query);
    
                return $result;
                

            }

            
        }


        // form(add/edit)
        public function saveItem($arrParam, $option = null)
        {
            $userObj = Session::get('user');
            $userInfo = $userObj['info'];

            // echo '<pre>';
            // print_r($userInfo);
            // echo '</pre>';

            // die('stop');


            if($option['task']== 'add')
            {
                //params gom` (module, controler, action, form[name, status, ordering])
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
                //params gom` (module, controler, action, form[name, status, ordering])
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
                    $userObj = Session::get('user');
                    $userInfo = $userObj['info'];
                    $modified = date('Y-m-d',time());
                    $modified_by = $userInfo['username'];

                    foreach($arrParam['order'] as $id => $ordering)
                    {
                        $i++;
                        $query = "UPDATE `$this->table` SET `ordering` = $ordering, `modified` ='$modified', `modified_by` = '$modified_by' WHERE `id`= '".$id."'";
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