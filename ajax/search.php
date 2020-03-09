<?php 

	include '../init.php';

	if(isset($_POST['data_to_send']))
	{
		$founditems = $itemClass->search($_POST['data_to_send']);

		foreach($founditems as $item)
		{
			echo $item->title.";";
		}
	}
 ?>