<?php 
 class Database1
	{
	    private $servername ;
	    private $username;
	    private $password;
	    private $dbname;

	    public function __construct()
	    {
	        $this->servername = "localhost";
	        $this->username = "root";
	        $this->password = "";
	        $this->dbname = "iwp_project";
	    }
	    public function connect()
	    {  
	    	$conn =  mysqli_connect($this->servername, $this->username, $this->password);
            
	    	if ($conn->connect_error) 
	    	{
	    		die("Connection failed: " . $conn->connect_error);
	    	} 
	    	else
	    	{
				mysqli_select_db($conn,$this->dbname);
	    		return $conn;
	    	}
	    }
	}
?>