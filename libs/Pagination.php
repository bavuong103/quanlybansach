<?php
class Pagination{

        private  $totalItems ; // Tong so Phan tu trong 1 table

        // Tong so phan tu xuat hien tren 1 trang
        private $totalItemsPerPage = 3;
    
        // Trang hien tai
        private $currentPage = 1; 
    
        private $totalPages ; //Tong so trang

        public function Pagination($totalItems, $pagination)
        {
            $this->totalItems = $totalItems;
            $this->totalItemsPerPage = $pagination['totalItemsPerPage'];
            $this->currentPage = $pagination['currentPage'];
            $this->totalPages = ceil($totalItems/$pagination['totalItemsPerPage']);
        }

    

        public function showPagination($link)
        {
            // Bat dau` phan trang
            // neu trang > 1 moi tien hanh` phan trang
            $paginationHTML = '';
            if($this->totalPages > 1)
            {
                // button Start va previous mac dinh
                $start = '<div class="button2-right off"> <div class="start"><span>Start</span></div> </div>';
                $prev = '<div class="button2-right off"> <div class="prev"><span>Previous</span></div> </div>';
                if($this->currentPage>1)
                {
                    // <div class="button2-right"> <div class="start"><a href="?page=1">Start</a></div> </div>
                    $start = '<div class="button2-right"> <div class="start"><a href="#" onclick="javascript:changePage(1)">Start</a></div> </div>';
                    $prev = '<div class="button2-right"> <div class="prev"><a href="#" onclick="javascript:changePage('.($this->currentPage-1).')">Previous</a></div> </div>';
                }

                $next = '<div class="button2-left off"> <div class="next"><span>Next</span></div> </div>';
                $end = '<div class="button2-left off"> <div class="end"><span>End</span></div> </div>';
                if($this->currentPage<$this->totalPages)
                {
                    $end = '<div class="button2-left"> <div class="next"><a href="#" onclick="javascript:changePage('.($this->totalPages).')">End</a></div> </div>';
                    $next = '<div class="button2-left"> <div class="end"><a href="#" onclick="javascript:changePage('.($this->currentPage+1).')">Next</a></div> </div>';
                }

                //$listPages ='';
                $listPages = '<div class="button2-left"><div class="page">';
                for($i=1; $i<=$this->totalPages;$i++)
                {
                    
                    //truong hop lam` noi bat trang current
                    if($i == $this->currentPage)
                    {
                         $listPages .= '<span>'.$i.'</span>';
                     }
                    else{
                        $listPages .= '<a href="#" onclick="javascript:changePage('.$i.')">'.$i.'</a>';
                    }

                }

                $listPages .= '</div></div>';

                $endPagination = '<div class="limit"> Page '.$this->currentPage.' of '.$this->totalPages.' </div>';

                $paginationHTML = '<div class="pagination">' . $start . $prev .$listPages . 
                                                $next . $end  . $endPagination . '</div>';
                
            }



            return $paginationHTML;
        }


        // Su dung <a href=""> cho don gian
        public function showPaginationPublic($link)
        {
            
            $paginationHTML = '';
            if($this->totalPages > 1)
            {
                // button Start va previous mac dinh
                $prev = '<span class="disabled"><<</span>';
                if($this->currentPage>1)
                {
                    // su dung <a href=""> de chuyen trang
                    $prev = '<a href="#" onclick="javascript:changePage('.($this->currentPage-1).')"><<</a>';
                }

                $next = '<span class="disabled">>></span>';
                if($this->currentPage<$this->totalPages)
                {
                    $next = '<a href="#" onclick="javascript:changePage('.($this->currentPage+1).')">>></a>';
                }

                //$listPages ='';
                $listPages = '';
                for($i=1; $i<=$this->totalPages;$i++)
                {
                    
                    //truong hop lam` noi bat trang current
                    if($i == $this->currentPage)
                    {
                         $listPages .= '<span class="current">'.$i.'</span>';
                     }
                    else{
                        $listPages .= '<a href="#" onclick="javascript:changePage('.$i.')">'.$i.'</a>';
                    }

                }

                $listPages .= '';

                $endPagination = 'Page '.$this->currentPage.' of '.$this->totalPages.' ';

                $paginationHTML = '<div class="pagination">' . $prev .$listPages . 
                                                $next  . $endPagination . '</div>';
                
            }



            return $paginationHTML;
        }



    }


?>