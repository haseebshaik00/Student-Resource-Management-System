<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>Store</title>
  <meta name= "viewport" content = "width = device-width, initial-scale = 1.0, user-scalable = yes">
  <link rel="stylesheet" type="text/css" href="/Mongo/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <noscript>For full functionality of this page it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com" target="_blank"> instructions how to enable JavaScript in your web browser</a></noscript>
</head>

<?php 

include 'init.php';
include 'admin/orders.php';
include 'modals.php'; 


if(isset($_SESSION['user_id']))
{
  $userData = $userClass->userData($_SESSION['user_id']);

}

include 'modals.php'; 

?>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Store &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://localhost/Mongo/index.php">&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
	
      <li><a <?php 
      echo isset($_SESSION['admin_id']) ? 'data-toggle="modal" data-target="#adminModal" ' : "";
      ?> href="#">Admin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
      
      <li><a <?php 
      echo isset($_SESSION['user_id']) ? '' : ' data-toggle="modal" data-target="#registerModal" ';
      ?> href="#">Register&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
      
      <li><a <?php 
      echo isset($_SESSION['user_id']) ? '' : ' data-toggle="modal" data-target="#loginModal" ';
      ?> href="#">Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
      
      <li><a href="http://localhost/Mongo/index.php?show=modal">Cart&nbsp;&nbsp;<span id="cart" class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge" id="shopcart">
        
        <?php 
            echo isset($_SESSION['order']) ? count($_SESSION['order']) : '' ;
            echo isset($_GET['show']) && isset($_SESSION['order']) ? '<script>$("#ordersModal").modal("show");</script>' : ''; 
         ?>
      
      </span>
      </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
      <li><a href="#">Profile&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span>
        <?php echo isset($userData) ? $userData->username : ''; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
    </ul>
   


    <form method="post"  class="navbar-form navbar-left" action="">
      <div class="form-group">
      <div class="ui-widget">
        <input type="text" class="form-control" placeholder="Search" name="search" list="bar" id="searchBar">        
      <datalist id="bar">

       </datalist>
      <button type="submit" class="btn btn-success" name="search_call"><span class="glyphicon glyphicon-search"></span></button>
      </div>
      </div>
    </form>        
  </div>
</nav>

<div class="container-fluid" >
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4 >Categories</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1"></a></li>
        <li><a href="http://localhost/Mongo/index.php"> All </a></li>
      

        <?php 

        $query = $collection_items->find([],['projection'=>['category'=>1, '_id'=>0]]);

        $distinct = $collection_items->distinct('category', $query);


        foreach($distinct as $val)
          {
            echo "<li> <a href = http://localhost/Mongo/index.php?categ=$val>".$val."</a></li>";
            }

         ?>
      </ul><br>
    </div>


<?php 

    include 'ajax/pagination.php';

    if(isset($_POST['search']))
    {
      $whatToDisplay = $itemClass->searchButton($_POST['search']);
    }
    else
    {
      $whatToDisplay = $cursorPag;
    }

    $categ = (isset($_GET['categ'])) ? $_GET['categ'] : '';

    echo "<div class='row'>";
    $itemClass->display($categ, $whatToDisplay);
    echo "</div>";

 ?>

 <script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>


 <div  id="arrowsContainer" >
    <div id="arrows">
        
        <a class="btn btn-info btn-lg" href="http://localhost/Mongo/index.php<?php echo $movLeft; ?>">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a> 
        
        <a class="btn btn-info btn-lg" style="float:right;" href="http://localhost/Mongo/index.php<?php echo $movRight; ?>">
          <span class="glyphicon glyphicon-chevron-right"></span> 
        </a>
    
    </div>
</div>

      <div class = "footer" style="margin-top: 100px; height:40px;" > 
				<p>Store &copy; Copyright 2019 <br> </p>
			</div>
		
	</div>
</body>
</html>
<script src="/Mongo/js/ajax_search.js"></script>
<script src="/Mongo/js/ajax_cart.js"></script>