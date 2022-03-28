<?php

    class CartModel extends Model{

    private $_columns = array('id', 'username', 'books', 'prices', 'quantities', 'names', 'pictures', 'status', 'date');



        public function __construct()
        {
            parent :: __construct();
            //echo __METHOD__."<br>";

            $this->setTable(TBL_CART);


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
                $query[] = "AND `username` LIKE $keyword" ;
                
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
            $query[] = "ORDER BY `date` ASC";
    
            // bien array -> string
            $query = implode(" ",$query);
            //echo $query;
            // neu co loi thi dugn query()
            $result = $this->singleRecord($query);

           
            return $result['total'];

        }


        public function listItems($arrParam, $option = null)
        {
            //echo __METHOD__."<br>";

            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';    
            

            $query[] = "SELECT `id`, `books`, `username`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`";
            $query[] = "FROM `$this->table`";
            $query[] = "Where `id` <> '000000'" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND `username` LIKE $keyword" ;
                
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
            $query[] = "ORDER BY `date` ASC";

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
                
                $result = array($id, $status, URL::createLink('admin','cart','ajaxStatus', array('id'=>$id, 'status'=>$status)));
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

  
    }



?>