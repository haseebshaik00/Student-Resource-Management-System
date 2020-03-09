<?php 

	if(isset($_SESSION['order']))
	{
		if(isset($_POST['empty_cart']))
		{
			unset($_SESSION['order']);

			header("Location: http://localhost/Mongo/index.php");
		}

		if(isset($_POST['newOrder']))
		{
			$insert = $collection_orders->insertOne([
				"customerID" => $_SESSION['user_id'],
				"details" => $_SESSION['order'], 
				"totalPrice" => $_SESSION['totalPrice'],
				"orderDate" => new MongoDB\BSON\UTCDateTime()]);

			$lastInsertedId = $insert->getInsertedId();

			$updateUserProfile = $collection_users->FindOneAndUpdate(["_id"=> $_SESSION['user_id']], ['$push' => ["ordersIDS" => $lastInsertedId]]);

			echo "<script>
						$(document).ready(function(){

								$('#confirmationModal').modal('show');
						});
			</script>";

			//unset($_SESSION['order']);
		}
	}

 ?>