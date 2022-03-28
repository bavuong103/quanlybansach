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
            $query[] = "Where `status` = 1" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND `name` LIKE $keyword" ;
                
            }

            // Sort
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
            

            $query[] = "SELECT `id`, `name`, `picture`";
            $query[] = "FROM `$this->table`";
            $query[] = "Where `status` = 1" ;

            //FILTER: KEYWORD
            // Khi đã nhập giá trị vào ô textbox ở phần tìm kiếm
            if(!empty($arrParam['filter_search']))
            {
                $keyword = '"%'. $arrParam['filter_search'] . '%"';
                $query[] = "AND `name` LIKE $keyword" ;
                
            }

            // Sort
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








    }



?>