<?php

    class Model{
    protected $connect;
    protected $database;
    protected $table;
    protected $resultQuery;


    // Connect database 
    public function __construct($params=null)
    {
        
        // echo '<pre>';
        // print_r($params);
        // echo '/<pre>';

        if($params==null)
        {
            $params['server'] = DB_HOST;
            $params['username'] = DB_USER;
            $params['password'] = DB_PASS;
            $params['database'] = DB_NAME;
            $params['table'] = DB_TABLE;


        }

        $link = mysqli_connect($params['server'],$params['username'],$params['password']);
        if(!$link)
        {
            die('Failed connect: '.mysqli_errno(mysqli_connect($params['server'],$params['username'],$params['password'])) );
        }
        else{
            $this->connect = $link;
            $this->database = $params['database'];
            $this->table = $params['table'];
            
            $this->setDatabase();
            //echo "success";
        }


    }

    // set connect
    public function setConnect($connect)
    {
        $this->connect = $connect;
    }

    // set database
    public function setDatabase($database = null)
    {
        if($database != null)
        {
            $this->database = $database;
        }

        mysqli_select_db($this->connect,$this->database);
    }


    // set table
    public function setTable($table)
    {
        $this->table = $table;
    }

    // ham huy ket noi
    public function __destruct()
    {
        mysqli_close($this->connect);
    }

    //ham insert dung` ham` co san
    public function insert($data, $type='single')
    {
        // echo '<pre>';
        // print_r($data);
        // echo '/<pre>';
        if($type=='single')
        {
            $newQuery = $this->createInsertSQL($data);
            $query =  "INSERT INTO `$this->table`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
            //echo $query;
            
            //die("hihi");
            mysqli_query($this->connect,$query);
            
        
        }

        return $this->lastID();

    }

   


    // ham insert co san~ Create Insert SQL
    public function createInsertSQL($data)
    {
        $newQuery = array();
        $cols="";
        $vals="";
        if(!empty($data))
        {
            foreach($data as $key=>$value)
            {
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
        }

        $newQuery['cols'] = substr($cols,2);
        $newQuery['vals']= substr($vals,2);

        return $newQuery;
    }



    public function update($data,$where)
    {
    
        
        $newQuery = $this->createUpdatetSQL($data);

        //echo $newQuery;

        $newWhere = $this->createWhereUpdateSQL($where);

        //echo $newWhere;

        $query = "Update `$this->table` SET " . $newQuery . " where $newWhere";
        //echo $query;

        //die('Failed');
        //echo $query;

        mysqli_query($this->connect,$query);

        return $this->affectedRows();

        
    }




    // Create Update SQL
    public function createUpdatetSQL($data)
    {
        $newQuery = "";
        if(!empty($data))
        {
            foreach($data as $key=>$value)
            {
                $newQuery .= ", `$key` = '$value'";
            }
        }

        $newQuery = substr($newQuery,2);

        return $newQuery;
    }

    // Create Where Update SQL
    public function createWhereUpdateSQL($data)
    {
        //$newWhere = '';
        if(!empty($data))
        {
            foreach($data as $value)
            {
                $newWhere[] = "`$value[0]` = '$value[1]'";
                $newWhere[] = $value[2];
            }

            $newWhere = implode(" ", $newWhere);
        }
        
        
        return $newWhere;
    }



    // ham delete N id
    public function deleteIDs($where)
    {
        $newQuery = $this->createWhereDeleteSQL($where);

        $query = "Delete from `$this->table` where `id` IN ($newQuery)";

        //echo $query;

        //die('faile');

        mysqli_query($this->connect,$query);

        return $this->affectedRows();
    }


    // Create Where Delete SQL (delete nhieu` id cung` 1 luc)
    public function createWhereDeleteSQL($data)
    {
        $newWhere = '';
        if(!empty($data))
        {
            // echo '<pre>';
            // print_r($data);
            // echo '/<pre>';

            foreach($data as $id)
            {
                $newWhere .= "'".$id."', ";
            }
            $newWhere .= "'0'";
        }
        
        
        return $newWhere;
    }



    // Last ID (tra ve id moi dc them)
    public function lastID()
    {
        return mysqli_insert_id($this->connect);
    }

    // Affected Rows
    public function affectedRows()
    {
        return mysqli_affected_rows($this->connect);
    }


    


    // ham` Query
    public function query($query)
    {
        $this->resultQuery = mysqli_query($this->connect,$query);
        return $this->resultQuery;

    }


    // ham Fetch_All
    public function select($resultQuery=null)
    {
        $result = array();
        $resultQuery = ($resultQuery==null) ? $this->resultQuery : mysqli_query($this->connect,$resultQuery);
        
        if(mysqli_num_rows($resultQuery)>0){
            while($row = mysqli_fetch_assoc($resultQuery))
            {
                $result[] = $row;
            }
        
        // giai phong bo nho
        mysqli_free_result($resultQuery);

        }
        return $result;

    }

    // ham select chi 1 dong data dau tien
    public function singleRecord($resultQuery=null)
    {
        $result = array();
        $resultQuery = ($resultQuery==null) ? $this->resultQuery : mysqli_query($this->connect,$resultQuery);
        
        if(mysqli_num_rows($resultQuery)>0){
            $result = mysqli_fetch_assoc($resultQuery);
        
        // giai phong bo nho
        mysqli_free_result($resultQuery);

        }
        return $result;

    }

    // ham` tao selectBox thu gon
	public function fetchPairs($query){
		$result = array();
		if(!empty($query)){
			$resultQuery = $this->query($query);
			if(mysqli_num_rows($resultQuery) > 0){
				
				while($row = mysqli_fetch_assoc($resultQuery)){
					// lay id cua group => name cua group
                    $result[$row['id']] = $row['name'];
				}
				
				mysqli_free_result($resultQuery);
			}
		}
		
		return $result;

	}


    // ham` selectBox don gian
    public function listSelectBox($query)
    {
        $result = array();
        if(!empty($query))
        {
        $resultQuery =  $this->query($query);
        
        if(mysqli_num_rows($resultQuery)>0){
            while($row = mysqli_fetch_assoc($resultQuery))
            {
                // lay id cua group => name cua group
                $result[$row['id']] = $row['name'];
            }
        
                // giai phong bo nho
                mysqli_free_result($resultQuery);

            }

        }
        // Khoi tao gia tri mac dinh cho select Box
        $result[0] = "Select a value";
        // Sap xep de cho gia tri mac dinh o vi tri thu 1
        ksort($result);
        return $result;

    }


    // EXIST Kiểm tra có tồn tại hay không
	public function isExist($query){
        // kiem tra cau sql có dạng rỗng ("")  ko
		if($query != null) {
			$this->resultQuery = $this->query($query);
		}

        // trong trường hợp đã tồn tại trong db với row >0
		if(mysqli_num_rows($this->resultQuery ) > 0) return true;
        // trong trường hợp ko tồn tại vởi row = 0
		return false;
	}
    

    // Total Item trong 1 table
    public function totalIems($query)
    {
        
        if(!empty($query))
        {
            $resultQuery = $this->query($query);
        
            if(mysqli_num_rows($resultQuery)>0){
                $result = mysqli_fetch_assoc($resultQuery);
                //  echo '<pre>';
                // print_r($result);
                // echo '/<pre>';

        }
        
        
        // giai phong bo nho
        mysqli_free_result($resultQuery);

        }
        
        // bien totalItems lay tu cau Select Count(id) as totalItems
        return $result['totalItems'];

    }



        
        
}

?>