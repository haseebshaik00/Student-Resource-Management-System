<?php 

class Items
{
	protected $collection_items;

	public function __construct($collection_items)
		{
			$this->collection_items = $collection_items;
		}

	public function newItem($title, $category, $owner, $price, $description, $img)
	{

		$document = $this->collection_items->findOne(['title' => $title, 'category' => $category],['projection' => 
			['_id'=>1]]);

		if(is_null($document))
		{
			$insertItem = $this->collection_items->insertOne([

				'title' => $title,
				'category' => $category,
				'owner' => $owner,
				'price' => $price,
				'description' => $description,
				'image' => new MongoDB\BSON\Binary(file_get_contents($img), MongoDB\BSON\Binary::TYPE_GENERIC),
				'created_at' => new MongoDB\BSON\UTCDateTime()

			]);
		}

		else
		{		

			$f = $this->collection_items->FindOneAndUpdate(['_id' => new MongoDB\BSON\ObjectID($document->_id)],['$set' =>[

				'title' => $title,
				'category' => $category,
				'owner' => $owner,
				'price' => $price,
				'description' => $description,
				'image' => new MongoDB\BSON\Binary(file_get_contents($img), MongoDB\BSON\Binary::TYPE_GENERIC),
				'updated_at' => new MongoDB\BSON\UTCDateTime()


			]]);

		}

	}
//				style='width: 370px; margin-top:90px'

	public function display($categ='', $cursor=NULL)
	{
		if($categ == '' && is_null($cursor))
		{
			$queryitems = $this->collection_items->find([], ['sort'=>['title'=>1]]);
		}
		else if($categ != '')
		{
			$queryitems = $this->collection_items->find(['category'=>$categ], ['sort'=>['title'=>1]]);
		}

		else if(!is_null($cursor)) 
		{
			$queryitems = $cursor;
		}
		foreach ($queryitems as $val)
		{

			$picture = $val->image;
			echo "<div class='col-md-2'  style='margin : 20px 0px 20px 20px'>
				<img src='data:jpeg;base64,".base64_encode($picture->getData())."' width='100%' height: '150px'>
				<br>
				<strong>".$val->title."</strong>
				<br>
				<strong> Price: &#8377; ".$val->price."</strong>
				<br>
				<button class='col-md-5 btn btn-danger btn-sm' role='button'
				value=" . $val->_id . "
				onclick='ajaxBuy(this.value)'> Buy </button>
				<button class='col-md-5 btn btn-info btn-sm' role='button' style='float:right;' data-toggle='popover' data-content='". $val->description ."' data-placement = 'top'> Owner Info </button>

				</div>";
		}
	}

	public function search($search)
	{

		$query = $this->collection_items->find(['title'=> new MongoDB\BSON\Regex($search, 'i')], 
			['projection' => ['title'=>1,'_id'=>0]]);

		return $query;

	}

	public function findItemById($id)
	{

		$dataItem = $this->collection_items->findOne(['_id'=> new MongoDB\BSON\ObjectID($id)], ['projecton'=> ['image'=>0]]);

		return [$dataItem->_id, $dataItem->title, $dataItem->price, 1];

	}

	public function searchButton($search)
	{
		$regex = new MongoDB\BSON\Regex($search, 'i');

		$result = $this->collection_items->find(['title' => $regex]);

		return $result;
	}
}
?>