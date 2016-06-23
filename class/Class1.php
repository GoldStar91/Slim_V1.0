<?php
/*------------------------------------------------------------------------------
** File:        class.mysql.php
** Class:       Simply Class 1
** Description: PHP MySQLi wrapper class to handle common database queries and operations 
** Version:     1.0.0
** Updated:     22-Jun-2016
** Author:      expert
** Comment:		include all queries
**------------------------------------------------------------------------------
*/

require_once( 'class.mysql.php' );

class Class1 
{
	// get user function
	public static function getUser($id = 0){
		$dbmng = new DBManager();
		$query = 'select * from class1 where userid='.$id.' order by userid asc';
		
		$user = $dbmng->select($query);
		if(empty($user)){   // if dont exist user
			$response = array( 'code'=>101, 'user'=>'', 'error_msg'=>'"There is not data."' );
			return json_encode($response);
		}else{  // if user exist
			$response = array( 'code'=>200, 'user'=>$user, 'error_msg'=>'' );
			return json_encode($response);
		}
	}
}