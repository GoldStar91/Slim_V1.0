<!DOCTYPE html>
<?php
/*------------------------------------------------------------------------------
** File:        index.php
** Class:       Simply MySQLi
** Description: PHP MySQLi wrapper class to handle common database queries and operations 
** Version:     1.0.0
** Updated:     22-Jun-2016
** Author:      World Star
** Email:       yangwesong@yahoo.com
** Comment:		view page
**------------------------------------------------------------------------------
*/
require_once( 'class.mysql.php' );
?>
<html>

<head>
	<title>Very Simple PHP & MYSQL Demo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link href="css/custom.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/bootstrap.min.css">	
	<script type="text/javascript" src="js/jquery.min.js"></script> 
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/paging.js"></script> 
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php
// DB Manager object
$dbmng = new DBManager();

// get all cities
$query = 'select * from star_cities order by id asc';
$cities = $dbmng->select($query);

//error variable
$error = '';

//variable for order by
$order = 0;

// if there is add/update/delete
if(isset($_POST) && !empty($_POST['order'])){
	//variable for add/update/delete mark
	$type = $_POST['type'];
	
	//record id
	$id = $_POST['id'];
	
	//order by id
	$order = $_POST['order'];
	
	
	if($type == 'delete'){  //if delete,
		$where_clause = array('id'=>$id);
		if($dbmng->delete('star_users', $where_clause)){
			$error = 'Successfully deleted.';
		}else{
			$error = 'Failed. Please try again.';
		}
	}else{
		$name = $_POST['name'];
		$firstname = $_POST['firstname'];
		$street = $_POST['street'];
		$zipcode = $_POST['zipcode'];
		$city_id = $_POST['city_id'];
		
		if($type == 'add'){  //if add,
			$dataArray = array('name'=>$name, 'firstname'=>$firstname, 'street'=>$street, 'zipcode'=>$zipcode, 'city_id'=>$city_id);
			if($dbmng->insert('star_users', $dataArray)){
				$error = 'Successfully added.';
			}else{
				$error = 'Failed. Please try again.';
			}
		}else if($type == 'edit'){  //if update,
			$updatedata = array('name'=>$name, 'firstname'=>$firstname, 'street'=>$street, 'zipcode'=>$zipcode, 'city_id'=>$city_id);
			$where_clause = array('id'=>$id);
			if($dbmng->update( 'star_users', $updatedata, $where_clause)){
				$error = 'Successfully updated.';
			}else{
				$error = 'Failed. Please try again.';
			}
		}
	}
}
// order by array
$orders = array('ID', 'Name', 'First Name', 'Street', 'Zip code', 'City');
?>
<body>
  <!-- error display for add/update/delete-->
  <div class="error"><?php $error;?></div>
  <!-- form create -->
  <form id="recordform" action="index.php" method="post" enctype="multipart/form-data">
    <input type="hidden" id="type" name="type">
    <input type="hidden" id="id" name="id" value="0">
	
	<div class="container">
	
	<h1 class="title">Very Simple PHP & MYSQL Demo</h1>
	
	<!-- select order by -->
	<div class="headbar">
	  <button id="addbutton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">Add record</button>
	  <select id="order" name="order" onchange="submit()">
		 <?php
		   foreach($orders as $key=>$name){
			   if($order == $key)
					echo '<option value="'.$key.'" selected>'.$name.'</option>';
			   else
				   echo '<option value="'.$key.'">'.$name.'</option>';
		   }
		 ?>
	  </select>
	</div>
	<!--  Record table -->
	</div>
		<table id="tableData" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th class="thfield">No</th>
					<th class="thfield">Name</th>
					<th class="thfield">First name</th>
					<th class="thfield">Street</th>
					<th class="thfield">Zip Code</th>
					<th class="thfield">City</th>
					<th class="thfield">Edit</th>
					<th class="thfield">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$orderby = 'u.id DESC';
					if($order == 0)
						$orderby = 'u.id DESC';
					else if($order == 1)
						$orderby = 'u.name asc';
					else if($order == 2)
						$orderby = 'u.firstname asc';
					else if($order == 3)
						$orderby = 'u.street asc';
					else if($order == 4)
						$orderby = 'u.zipcode asc';
					else if($order == 5)
						$orderby = 'u.city_id asc';
					$query = 'SELECT u.id, u.name, u.firstname, u.street, u.zipcode, u.city_id, c.name AS city FROM star_users AS u LEFT JOIN star_cities AS c ON c.id=u.city_id ORDER BY '.$orderby;
					
					$results = $dbmng->select($query);
					$i = 0;
					foreach($results as $row)
					{
						$i++;
				?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row['name']?></td>
							<td><?php echo $row['firstname']?></td>
							<td><?php echo $row['street']?></td>
							<td><?php echo $row['zipcode']?></td>
							<td><?php echo $row['city']?></td>
							<td>
							  <button id="editbutton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal" onclick="showEdit(<?php echo $row['id'];?>, '<?php echo $row['name'];?>', '<?php echo $row['firstname'];?>', '<?php echo $row['street'];?>', '<?php echo $row['zipcode'];?>', <?php echo $row['city_id'];?>)">Edit</button>
							</td>
							<td>
							  <button id="deletebutton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deleteModal" onclick="showDelete(<?php echo $row['id'];?>)">Delete</button>
							</td>
						</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<!-- add/update Modal content-->
	<div class="modal fade" id="addModal" role="dialog">
		<div class="modal-dialog">
		
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Add record</h4>
			</div>
			<div class="modal-body">
			  <p>Name</p><input type="text" id="name" name="name" value="" placeholder="Name">
			</div>
			<div class="modal-body">
			  <p>First name</p><input type="text" id="firstname" name="firstname" value="" placeholder="First name">
			</div>
			<div class="modal-body">
			  <p>Street</p><textarea id="street" name="street" cols="40" placeholder="Street"></textarea>
			</div>
			<div class="modal-body">
			  <p>Zip Code</p><input type="number" id="zipcode" name="zipcode" value="" placeholder="Zip Code">
			</div>
			<div class="modal-body">
			  <p>City</p>
			  <select id="city_id" name="city_id">
				 <option value="0" selected="selected">Select City</option>
				 <?php
				   foreach($cities as $city){
					   echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
				   }
				 ?>
			  </select>
			</div>
			
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="add()">Add</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  
		</div>
	</div>
	
	<!-- delete Modal content-->
	<div class="modal fade" id="deleteModal" role="dialog">
		<div class="modal-dialog">
		
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Delete record</h4>
			</div>
			<div class="modal-body">
			  <p>Do you really want to delete?</p>
			</div>				
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="deleteRecord()">Delete</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tableData').paging({limit:5});
		});
		function add(){
			var id = $("#id").val();
			if(id == 0){
				$("#type").val("add");
			}else{
				$("#type").val("edit");
			}
			$("#recordform").submit();
		}
		function deleteRecord(){
			$("#type").val("delete");
			$("#recordform").submit();
		}
		function showEdit(id, name, firstname, street, zipcode, city_id){
			$("#id").val(id);
			$("#name").val(name);
			$("#firstname").val(firstname);
			$("#street").val(street);
			$("#zipcode").val(zipcode);
			$("#city_id").val(city_id);
		}
		function showDelete(id){
			$("#id").val(id);
		}
	</script>
	</div>
  </form>
</body>
</html>
<!-- index.php view page end-->