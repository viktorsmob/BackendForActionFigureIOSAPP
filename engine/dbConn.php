<?php
 /**
 * DB connection class
 *
 * @package hanapub
 */


/*
 *  Uncomment following line in php.ini to have this functions work;
    mysqli::stmt::get_result mysqli::result::fetch_all 
    
    extension=php_mysqli_mysqlnd.dll
*/

class dbConn
{
	
	/**
	 * Database Connect Object
	 *
	 * @var unknown_type
	 */
	protected $_mysqli = null;
	
	/**
	 * 
	 *
	 * @var string
	 */
	protected $_host = null;
	
	/**
	 * 
	 *
	 * @var string
	 */
	protected $_database = null;
	
	/**
	 * 
	 *
	 * @var string
	 */
	protected $_username = null;
	
	/**
	 * 
	 *
	 * @var string
	 */
	protected $_password = null;
	
	/**
	 * Public Constructor
	 *
	 * @param  array $params
	 */
	function __construct($params){
		
		// Set Params to internal variables.
		if (isset($params["host"]))
			$this -> _host = $params["localhost"];
		else 
			$this -> _host = DB_HOST;
		
		if (isset($params["database"]))
			$this -> _database = $params["andadas"];
		else 
			$this -> _database = DB_NAME;
		
		if (isset($params["username"]))
			$this -> _username = $params["kuacadem_adv"];
		else 
			$this -> _username =DB_USER;
		
		if (isset($params["password"]))
			$this -> _password= $params["yak1000abc"];
		else 
			$this -> _password = DB_PASSWORD;
		
		$this -> _connect();
	}
	
	/**
	 * データベースに接続します。
	 *
	 */
	protected function _connect(){
		try{
            $this -> _mysqli = new mysqli($this -> _host, $this -> _username, $this -> _password, $this -> _database);
            if ($this -> _mysqli ->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this -> _mysqli ->connect_errno . ") " . $this -> _mysqli ->connect_error;
            }

			// Set mysql default encoding to UTF-8
			$sql = "SET NAMES 'utf8'";
			$this -> query($sql);
		}catch (Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	/**
	 * Excute Mysql query 
	 *
	 * @param string $sql mysql query
	 * @return array
	 */
	public function query($sql){
		// Check if mysql was connected
		if (is_null($this -> _mysqli))
			$this -> _connect();
		try{
			$result = $this -> _mysqli->query($sql);
		} catch (Exception $ex){
			echo $ex -> getMessage();
			return false;
		}
		return $result;
	}

	public function getInsertId()
	{
		return $this->_mysqli->insert_id;
	}
	
	public function executeStmt(&$stmt) {
		$row = $stmt->execute();
        if (!$row) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
             return false;
        }

        $stmt->close();
        
        return $row;
    }
	
	public function prepareStmt($sql) {
        $stmt = null;
        if (!($stmt = $this -> _mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $this -> _mysqli->errno . ") " . $this -> _mysqli->error;
        }
        
        return $stmt;
    }
    
	/**
	 * Get one result from database
	 *
	 * @param string $sql
	 * @return array
	 */
	public function fetchRow($sql){
		// Check if mysql was connected
		$row=null;
		if (is_null($this -> _mysqli))
			$this -> _connect();
		
		try{
			$result = $this -> _mysqli->query($sql);
			if($result != null)
				$row = $result->fetch_assoc();
		}catch (Exception $ex){
			echo $ex -> getMessage();
			return array();
		}
		if($result != null)
			$result->free();
		return $row;
	}
	
	public function fetchRowFromStmt(&$stmt) {
        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
             return false;
        }
        if (!($result = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
            return false;
        }
        
        $row = $result->fetch_assoc();

		if($result != null)
			$result->free();

        $stmt->close();
        
        return $row;
    }
    
	/**
	 * Get  results from database
	 *
	 * @param string $sql mysql query
	 * @return array
	 */
	public function fetchAll($sql){
		// Check if mysql was connected
		if (is_null($this -> _mysqli))
			$this -> _connect();
			
		$rows = array();
		try{
			$result = $this -> _mysqli->query($sql);
			// push query results to stack
			if($result != null)
			{
				if (method_exists($result, "fetch_all")) {
					$rows = $result->fetch_all(MYSQLI_BOTH);
				} else {
					$rows = array();
					while($row = $result->fetch_assoc()) {
						$rows[] = $row;
					}
				}
			}
		}catch (Exception $ex){
			echo $ex -> getMessage();
			return array();
		}
		if($result != null)
			$result->free();
		return $rows;
	}
    
    public function fetchAllFromStmt(&$stmt) {
        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
             return false;
        }
        if (!($result = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
            return false;
        }
        
		if (method_exists($result, "fetch_all")) {
			$rows = $result->fetch_all(MYSQLI_BOTH);
		} else {
			$rows = array();
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		if($result != null)
			$result->free();

        $stmt->close();
        
        return $rows;
    }

	// Escapes string which will be stored at MySQL.
	function escape_string($str) {
		try {
			return $this -> _mysqli->escape_string($str);
		}catch (Exception $ex){
			checkValidity(false, "Error occurs in the processing MySQL string.");
		}
	}

    // Escapes string which has loaded from MySQL for HTML output.
	function escape_html(&$result) {
		if (gettype($result) == "string") {
			$result = htmlspecialchars($result, ENT_QUOTES);
		} else if (gettype($result) == "array") {
			if (count($result) > 0) {
				// The fields to be changed will be given as parameters.
				$numargs = func_num_args();
				$arg_list = func_get_args();

				if (gettype($result[0]) == "array") {	// multiple row returned from fetchAll
					foreach($result as &$row) {
					    for ($i = 1; $i < $numargs; $i++) {
					        $row[$arg_list[$i]] = htmlspecialchars($row[$arg_list[$i]], ENT_QUOTES);
					    }
					}
				} else {								// single row returned from fetchAll
					$numargs = func_num_args();
					$arg_list = func_get_args();
				    for ($i = 1; $i < $numargs; $i++) {
				        $result[$arg_list[$i]] = htmlspecialchars($result[$arg_list[$i]], ENT_QUOTES);
				    }
				}
			}
	    }
	    
	    return $result;
	}
}

?>
