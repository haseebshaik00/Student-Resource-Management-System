
<!-- LOGIN Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <!-- Modal content login-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">

                      <div class="form-group">
                        <label for="email">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                      </div>
                      <div class="checkbox">
                        <label>
                        <input type="checkbox" name="admin" value = "yes"> Login as Admin 
                        </label>
                      </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" name ="login" value="Submit">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php 

  $status = (isset($_POST['admin'])) ? 'admin' : 'notadmin';
  
  if(isset($_POST['login'])) {

    $username = $userClass->checkInput($_POST['username']);
    $password = $userClass->checkInput($_POST['password']);

    if(empty($username) || empty($password)) {

      echo "<script>
          $(document).ready(function(){
              $('#loginError').modal('show');
          });
      </script>";

    }
    else{

        switch ($status) {

          case 'admin': $userClass->checkAdmin($username, $password);

            break;

          case 'notadmin' : $userClass->login($username, $password);
                      break;

          
          default: '';
  
            break;
        }   
    }
  }
?>

<!-- REGISGTER Modal -->
<div id="registerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content login-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Your Account</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">

                      <div class="form-group">
                        <label for="email">Enter Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Enter Password:</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                      </div>
                      <div class="form-group">
                        <label for="pwd">Enter E-mail:</label>
                        <input type="text" class="form-control" id="pwd" name = "email">
                      </div>
                      <div class="form-group">
                        <label for="address">Enter Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                      </div>
                  
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default" name = "register" value="Submit">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php 

  if(isset($_POST['register']))
  {

    $username = $userClass->checkInput($_POST['username']);
    $password = $userClass->checkInput($_POST['password']);
    $email = $userClass->checkInput($_POST['email']);
    $address = $userClass->checkInput($_POST['address']);

  }

  if(empty($username) || empty($password) || empty($email) || empty($address))
  {
    $error = true ;
  }
  else
  {
      $userClass->register($username, $password, $email, $address);
      unset($error);
  }

  if(isset($error) && isset($_POST['register']))
  {
    echo "<script>

      $(document).ready(function(){

        $('#errorModal').modal('show');

      });
      </script>";
  }

 ?>

<!--error modal-->
<div id="errorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content login-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Your Account</h4>
      </div>
      <div class="modal-body">
        <p> All fields are required<p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>


<!--error modal for Login-->
<div id="loginError" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content login-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login Error</h4>
      </div>
      <div class="modal-body">
        <p> All fields are required<p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>


<!-- ADMIN Modal -->
<div id="adminModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content ADMIN-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter a new Item</h4>
      </div>
      <div class="modal-body">
        <form action="admin/admin.php" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="title">TITLE:</label>
                        <input type="text" class="form-control" name="title">
                      </div>
                      <div class="form-group">
                        <label for="category">CATEGORY:</label>
                        <input type="text" class="form-control" name="category">
                      </div>
                      <div class="form-group">
                        <label for="author">OWNER:</label>
                        <input type="text" class="form-control" name="owner">
                      </div>
                      <div class="form-group">
                        <label for="amount">PRICE: </label>
                        <input type="text" class="form-control" name = "price">
                      </div>
                      <div class="form-group">
                        <label for="amount">DESCRIPTION: </label>
                        <input type="text" class="form-control" name = "description">
                      </div>
                      <div class="form-group">
                        <label for="amount">IMG: </label>
                        <input type="file" class="form-control" name = "cover_img">
                      </div>
                  
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-default" name = "insert_item" value="Submit">INSERT</button>
        </form>
      </div>
    </div>

  </div>
</div>



<!-- ORDERS Modal -->
<div id="ordersModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content ADMIN-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Orders Modal</h4>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post" enctype="multipart/form-data">

                      <div class="form-group"  style="overflow: scroll; height: 300px;">
                        <label for="title">Cart Items:</label><br>
                        <table id="table" class="table table-hover table-fixed">
                          <tr>
                            <th>Title</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Delete</th>
                          </tr>
                          
                          <?php 

                          if(isset($_SESSION['order']))
                          {
                          
                          $totalTablePrice = array();
                          
                          foreach (($_SESSION['order']) as $val)
                         
                         {

                          array_push($totalTablePrice, $orderClass->getTotals($val[2], $val[3]));
                          echo '<tr>
                                <td>' . $val[1] . '</td>
                                <td>' . $val[3] . '</td>
                                <td> &#8377;' . $val[2] . '</td>
                                <td type="button" 
                                id="'.$val[0].'"
                                price="'.$val[2].'"
                                class="remove btn btn-danger">Delete</td>
                              </tr>';
                          }
                          }
                           ?>

                           <tr>
                            <td><strong>Total</strong></td>
                            <td></td>
                            <td>&#8377;<strong id="total">
                              <?php 
                                    echo isset($_SESSION['order']) ? array_sum($totalTablePrice) : '';
                                    //$totalTablePrice = array();

                                    $_SESSION['totalPrice'] = isset($_POST['total']) ? $_POST['total'] : 
                                    array_sum($totalTablePrice);
                               ?>
                            </strong></td>
                            <td></td>
                          </tr>
                        </table>
                      </div>
                  
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-default" name="empty_cart" value="Submit" >Empty Cart</button>
          <button type="submit" class="btn btn-default" name = "newOrder" value="Submit">Confirm Order</button>
        </form>
      </div>
    </div>

  </div>
</div>
  

<script >
    
  $(document).ready(function(){

    $("#ordersModal").on('hide.bs.modal', function()
    {
      location.replace("http://localhost/Mongo/index.php");
    });

    $(".remove").click(function()
    {
        var item_price = $(this).attr("price");
        var itemId = $(this).attr("id");
        var total = $("#total").text();
        var total_sum = total - item_price;

        $(this).closest("tr").remove();
        $("#total").text(total_sum);

        $.post('http://localhost/Mongo/index.php', {remove_id: itemId, total: total_sum}, function(data)

    });

  });


</script>

<?php 

    if(isset($_POST['remove_id']))
    {
      $orderClass->removeItem($_SESSION['order'], $_POST['remove_id']);
    }

 ?>

<?php 
    
    $finalUserData =isset($_SESSION['user_id']) ? $userClass->userData($_SESSION['user_id']) : '';

 ?>

 <!--Confirmation Modal-->

<div id="confirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation Details</h4>
      </div>
      <div class="modal-body">

                      <div class="form-group">
                        <label for="userData">Thank you, <?php echo  $finalUserData->username; ?> for purchasing from our store</label><br>
                      </div>

                      <div class="form-group">
                        <label for="address">Shipping Address : <?php echo $finalUserData->address; ?></label><br>
                      </div>
                      <div class="form-group">
                        <label for="total">Total Price : <?php echo $_SESSION['totalPrice']; ?></label><br>
                      </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" name ="ok" data-dismiss="modal" >OK</button>
        </div>
    </div>
  </div>
</div>

<script >
  $(document).ready(function(){

    $("#confirmationModal").on('hide.bs.modal', function()
    {
      location.replace("http://localhost/Mongo/admin/unset.php");
    });
</script>


<!--error modal for Login cart-->
<div id="loginWarning" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content login cart-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User not logged in</h4>
      </div>
      <div class="modal-body">
        <p> You need to Login First<p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>