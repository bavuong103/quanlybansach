<?php

    class BookModel extends Model{

        private $_columns = array('id', 'name', 'picture', 'special','description','price','sale_off', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering','category_id');

        public function __construct()
        {
            parent :: __construct();
            //echo __METHOD__."<br>";

            $this->setTable(TBL_BOOK);


        }

        // Index()
        public function countItem($arrParam, $option = null)
        {
            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';    

            $cateID = $arrParam['category_id'];
    
            $query[] = "SELECT Count(`id`) AS `total`";
            $query[] = "FROM `$this->table`";
            $query[] = "Where `status` = 1 AND `category_id` = '$cateID'" ;

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
            
            if($option['task'] == 'books-in-cate')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';    
                
                $cateID = $arrParam['category_id'];

                $query[] = "SELECT `id`, `name`, `picture`, `description`";
                $query[] = "FROM `$this->table`";
                $query[] = "Where `status` = 1 AND `category_id` = '$cateID'" ;

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


            if($option['task'] == 'books-relative')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';    

                // B1 : search CategoryID cua this book
                $bookID = $arrParam['book_id'];
                $queryCate = "Select `category_id` From `".TBL_BOOK."` Where `id` = '$bookID'";
                $resultCate = $this->singleRecord($queryCate);

                // B2 : search books relative cung` categoryID 
                
                $cateID = $resultCate['category_id'];

                $query[] = "SELECT `id`, `name`, `picture`";
                $query[] = "FROM `$this->table`";
                $query[] = "Where `status` = 1 AND `category_id` = '$cateID' AND `id` <> '$bookID'" ;
                $query[] = "ORDER BY `id` DESC";


                // bien array -> string
                $query = implode(" ",$query);
                
                $result = $this->select($query);

                return $result;
            }
            

        }


        public function infoItem($arrParam, $option = null)
        {
            

            if($option['task'] == 'get-cate-name')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                $cateID = $arrParam['category_id'];
                
                $query[] = "SELECT `name`";
                $query[] = "FROM `".TBL_CATEGORY."`";
                $query[] = "Where `id` = '$cateID'";
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                
                $result = $this->singleRecord($query);
    
                return $result['name'];
                

            }

            if($option['task'] == 'book-info')
            {
                // echo '<pre>';
                // print_r($arrParam);
                // echo '</pre>';

                $bookID = $arrParam['book_id'];
                
                $query[] = "SELECT `id`,`name`,`picture`,`description`,`price`,`sale_off`";
                $query[] = "FROM `".TBL_BOOK."`";
                $query[] = "Where `id` = '$bookID'";
                $query = implode(" ",$query);
                //echo $query;
                //die("hihi");
                
                $result = $this->singleRecord($query);
    
                return $result;
                

            }

            
        }






    }



?>