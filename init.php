<?php 
		session_start();

		require 'vendor/autoload.php';
		
		include 'classes/Users.php';
		include 'classes/items.php';
		include 'classes/orders.php';		

		$connection = new MongoDB\Client;
		$db = $connection->bookstore;
		
		$collection_users = $db->users;
		$collection_items = $db->items;
		$collection_orders = $db->orders;

		$userClass = new Users($collection_users);
		$itemClass = new Items($collection_items);
		$orderClass = new Orders($collection_orders);

?>