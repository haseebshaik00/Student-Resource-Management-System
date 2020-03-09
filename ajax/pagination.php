<?php 

		$page = isset($_GET['page']) ? $_GET['page'] : 1;

		$limit = 8;
		$sort = ['title'=>1];
		$skip = ($page - 1) * $limit;
		$next = ($page + 1);
		$prev = ($page - 1);

		$cursorPag = $collection_items->find([], ['limit'=>$limit, 'skip'=>$skip, 'sort'=>$sort ]);

		$total = $collection_items->count($cursorPag);
		$maxPages = ceil($total/$limit);
		$movRight; $movLeft;

			switch ($page) {
				
				case $maxPages:
					$movRight = '';
					$movLeft = '?page='.$prev;
					break;
				
				case 1: 
					$movRight = '?page='.$next;
					$movLeft = '';
				
				default:
					$movRight = '?page='.$next;
					$movLeft = '?page='.$prev;
					break;
			}
 ?>		