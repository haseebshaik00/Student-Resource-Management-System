<?php 

	include '../init.php';

    if(isset($_POST['item']))
	{
		if(isset($_SESSION['user_id']))
		{

			$itemData = $itemClass->findItemById($_POST['item']);

			if(!isset($_SESSION['order']))
			{
				$_SESSION['order'] = array();

				array_push($_SESSION['order'], $itemData);
			}
			else
			{
				array_push($_SESSION['order'], $itemData);		
			}

			echo count($_SESSION['order']);
		}
	}
	else
	{
		echo "unregistered";
	}
 ?>