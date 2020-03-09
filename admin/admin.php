<?php 

	include '../init.php';
	//title, category, owner, price, description, cover_img, insert_item

	if(isset($_POST['insert_item']))
	{
		if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['owner']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_FILES['cover_img']))
		{

			$itemClass->newItem(

				$_POST['title'],
				$_POST['category'],
				$_POST['owner'],
				$_POST['price'],
				$_POST['description'],
				$_FILES['cover_img']['tmp_name']

			);
		}

		header ('Location: ../index.php');
	}
 ?>