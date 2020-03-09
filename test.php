<?php 

	include 'init.php';
	$document = $collection_users->findOne(['username'=>"byron", 'password'=>"code"], ['projection' => ['_id'=> 0, 'admin'=>0 ]    ]);
	$document = $collection_users->find();	
	
	foreach($document as $val) {
	}
	$document = $collection_users->find([], [ 'projection' => ['_id'=> 0, 'admin'=> 0 ], 'limit' => 2 ] );

	foreach($document as $val) {
		echo "<pre>";
		var_dump($val);
		echo "</pre>";
	}

	$document = $collection_items->findOne(['title' => 'test', 'category' => 'test'],['projection' => 
			['_id'=>1]]);

	echo "<br>";

	$query = $collection_items->find([],['projection'=>['category'=>1, '_id'=>0]]);

	$distinct = $collection_items->distinct('category', $query);

	foreach($distinct as $val)
          {
            var_dump($val);
          }


?>