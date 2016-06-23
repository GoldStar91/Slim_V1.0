<?php
/*------------------------------------------------------------------------------
** File:        class.mysql.php
** Class:       Simply Class 2
** Description: PHP MySQLi wrapper class to handle common database queries and operations 
** Version:     1.0.0
** Updated:     22-Jun-2016
** Author:      expert
** Comment:		include all queries
**------------------------------------------------------------------------------
*/
require_once( 'class.mysql.php' );

class Class2 
{
	//get Order function. param: id -  order id
	public static function getOrder($id = 0){
		$dbmng = new DBManager();
		$query = 'select * from class2 as c2 LEFT JOIN class1 as c1 ON c1.userid = c2.userid where c2.orderid='.$id.' order by c2.orderid asc';
		
		 $order = $dbmng->select($query);
		if(empty($order)){  // if empty
			$response = array( 'code'=>101, 'order'=>'', 'error_msg'=>'"There is not data."' );
			return json_encode($response);
		}else{   //else is not empty
			$response = array( 'code'=>200, 'order'=>$order, 'error_msg'=>'' );
			return json_encode($response);
		} 
	}
	//cancel Order function. param: id -  order id
	public static function cancelOrder($id = 0){
		$dbmng = new DBManager();
		$query = 'select * from class2 where orderid='.$id;		
		$order = $dbmng->select($query);
		if(!empty($order)){  // if exist.
			if($order[0]['orderstatus'] != 2){   // if is not already cancelled
				$query = 'update class2 set orderstatus=2 where orderid='.$id;		
				$result = $dbmng->update('class2', array('orderstatus'=>2), array('orderid'=>$id));
				if($result == 1){	// if cancel is ok
					$response = array( 'code'=>200, 'order'=>'Successfully cancelled.', 'error_msg'=>'' );
					return json_encode($response);
				}else{				 // if cancel error
					$response = array( 'code'=>103, 'order'=>'', 'error_msg'=>'"Cancel error."' );
					return json_encode($response);
				}
			}else{	 // if is already cancelled
				$response = array( 'code'=>102, 'order'=>'', 'error_msg'=>'"Already cancelled"' );
				return json_encode($response);
			}			
		}else{  //if is not record
			$response = array( 'code'=>101, 'order'=>'', 'error_msg'=>'"There is not data."' );
			return json_encode($response);
		}
	}
}