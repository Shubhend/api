<?php
    class DB {
        public $con;
      private $connection;
      private static $_instance;
      private $dbhost = "localhost"; // Ip Address of database if external connection.
      private $dbuser = "tag31_mig"; // Username for DB
      private $dbpass = "tag31_cart_mig"; // Password for DB
      private $dbname = "api"; // DB Name
      /*
      Get an instance of the Database
      @return Instance
      */	
      public static function getInstance(){
        if(!self::$_instance) {
              self::$_instance = new self();
           }
          return self::$_instance;
        }
      // Constructor
      protected function connection() {
        try{
        $r=$this->connection = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	return $r;
	// Error handling
        }catch(PDOException $e){
          die("Failed to connect to DB: ". $e->getMessage());
        }
      }
      // Magic method clone is empty to prevent duplication of connection
   protected function closeConnection() {
 
   	$this->connection = null;
 
	}
      
      // Get the connection	
     
    }


class easyfeature extends DB{
	#fetch data
	public function fetch($sql){
		
		$db = DB::getInstance();

		$result=$this->connection()->query($sql);
	     return $result;
		$this->closeConnection();
	}
	#insert data
	public function insert($sql){
			$db = DB::getInstance();
            $result=$this->connection()->query($sql);
		    if($result==true){
			return "Data Has succesfully Recorded";
			}else{
				return "Try Again There Is Some Problem";
			}
			$this->closeConnection();
	}
	#data duplication checkdat
	public function checkduplicate($sql){
			$db = DB::getInstance();
			 
            $result=$this->connection()->query($sql)->rowCount();
		   return $result;
	     $this->closeConnection();
	}
	#delete function
	public function update($sql){
			$db = DB::getInstance();
			 
            $result=$this->connection()->query($sql);
		 if($result==true){
			return "Data Has succesfully Updated";
			}else{
				return "Try Again, There Is Some Problem";
			}
	     $this->closeConnection();
	}
	
	public function deleter($sql){
			$db = DB::getInstance();
			 
            $result=$this->connection()->query($sql);
		 if($result==true){
			return "Data Has succesfully Removed";
			}else{
				return "Try Again There Is Some Problem";
			}
	     $this->closeConnection();
	}
	#get min 
	public function minmaxelement($sql){
			$db = DB::getInstance();
			 
            $result=$this->connection()->query($sql)->fetchColumn();
		 return $result;
	     $this->closeConnection();
	}
	#fetch single row column
	public function fetchrow($sql,$colm){
		
		$db = DB::getInstance();

		$result=$this->connection()->query($sql);
	    foreach($result as $row) {
        return $row[$colm];
    }
		$this->closeConnection();
	}
		public function rowcount($sql){
		
		$db = DB::getInstance();

		$result=$this->connection()->query($sql)->fetchColumn();
	   return $result;
		$this->closeConnection();
	}
	
	
	
}



#$sql="INSERT INTO  posts VALUES(NULL,'4','TITLE','CONTENT','12/12/12')";
//$sql="SELECT * FROM posts Where cat_id='6'";
//$sql="UPDATE posts SET id='20' WHERE id=18";
//$sql="DELETE FROM posts
//WHERE id = '17'";
//$sql="SELECT MIN(cat_id)
 // FROM posts";
//$r=$easydb->fetchrow($sql,'id');
//echo $r;


/*foreach($r as $row) {
        echo $row['id'];
    }*/


?>