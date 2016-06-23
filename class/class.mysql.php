<?php
/*------------------------------------------------------------------------------
** File:        class.mysql.php
** Class:       Simply MySQLi
** Description: PHP MySQLi wrapper class to handle common database queries and operations 
** Version:     1.0.0
** Updated:     22-Jun-2016
** Author:      expert
** Comment:		include all queries
**------------------------------------------------------------------------------
*/

require_once( 'class.db.php' );

class DBManager{
	// database object
	public $database = null;
	
	//construct function.
	public function __construct()
    {
        $this->connect();
    }
	
	// db connection function
	private function connect(){
		$this->database = DB::getInstance();
	}
	
	//select function
	public function select($query = '')
	{
		if(!empty($query))
		{
			$results = $this->database->get_results( $query );
			if(empty($results))
			{
				return array();
			}else
			{
				return $results;
			}			
		}else{
			return array();
		}
	}

	//insert function
	/*
	$dataArray = array(
		'name' => 'World Star',
		'Email' => 'yangwesong@yahoo.com'
	);
	*/
	public function insert($table = '', $dataArray = array())
	{
		if(!empty($table) && !empty($dataArray))
		{
			$query = $this->database->insert( $table, $dataArray );
			if( $query )
			{
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	//multi insert function
	/*
	$fields = array(
		'name', 
		'email'
	);
	$dataArraies = array(
		array(
			'World Star', 'yangwesong@yahoo.com'
		), 
		array(
			'World Star', 'yangwesong@yahoo.com'
		), 
		array(
			'World Star', 'yangwesong@yahoo.com'
		), 
		array(
			'World Star', 'yangwesong@yahoo.com'
		)
	);
	*/
	public function multiInsert($table = '', $fields = array(), $dataArraies = array())
	{
		if(!empty($table) && !empty($fields) && !empty($dataArray))
		{
			$queries = $this->database->insert_multi( $tables, $fields, $dataArraies );
			if( $queries )
			{
				return 1;
			}else{
				return null;
			}
		}else{
			return null;
		}
	}
	
	//update function
	/*
	$updatedata = array(
		'name' => 'World Star', 
		'email' => 'yangwesong@yahoo.com'
	);
	$where_clause = array(
		'id' => 1
	);
	*/
	public function update($table = '', $updatedata = array(), $where_clause = array(), $limit = '')
	{
		if(!empty($table) && !empty($updatedata) && !empty($where_clause))
		{
			$queries = $this->database->update( $table, $updatedata, $where_clause, $limit );
			if( $queries )
			{
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	//delete function
	/*	
	$where_clause = array(
		'id' => 1,
		'name' => 'World Star'
	);
	*/
	public function delete($table = '', $where_clause = array(), $limit = '')
	{
		if(!empty($table) && !empty($where_clause))
		{
			$query = $this->database->delete( $table, $where_clause, $limit );
			if( $query )
			{
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	//check value function
	/*	
	$check_column = 'id';
	$check_for = array( 'name' => 'World Star' );
	*/
	public function deleteRecord($table = '', $check_column = '', $check_for = array())
	{
		if(!empty($table) && !empty($check_column) && !empty($check_for))
		{
			$exists = $this->database->exists( $table, $check_column,  $check_for );
			if( $exists )
			{
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	
	
}//end class mysql

