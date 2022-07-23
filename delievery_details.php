<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
p{
    text-align:center;
    font-size:40px;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indore Kirana Delievery</title>
</head>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-body">
    <form method="POST">
    <div class="form-group">
    <input name="full_name" class="form-control" type="text" placeHolder="Enter Your Full Name" required></div>
    <div class="form-group">
    <input name="mobile_number" class="form-control" id="mobile" type="number" placeHolder="Enter Your Mobile Number" required></div>
    
    <div class="form-group">
    <textarea name="address" class="form-control" placeHolder="Enter Your Full Address" required></textarea></div>

    <h3>Total Price (incl. tax): <?php  
    $total_price = 0;
    
    foreach ($_SESSION["cart_item"] as $item){
        $total_price += ($item["price"]*$item["quantity"]);
        }
       echo  "Rs. ".number_format(($total_price+50), 2);
    
    ?></h3>

  <br>  <h4>Payment Mode: </h4>

<select class="form-control" name="payment_mode" >
<option value="COD">Cash On Delievery</option?>
</select>
<br>
<br>
    <button name="submit" class="btn btn-primary btn-lg btn-block" type="submit" value="Place Order">Place Order</button>
    </form>
    </div>
    </div>
    </div>
<?php require('connectDB.php');

$t=0;
if(isset($_POST['submit']))
{
    
   if(count($_SESSION['cart_item']) == 0)
   {
       echo "<br><p>Empty Cart</p>";
   }
   else
   {
       
       if(strlen($_POST['mobile_number']) == '10')
       {
        $name=$_POST['full_name'];
        $mobile_number=$_POST['mobile_number'];
        $address=$_POST['address'];
           if($_POST['payment_mode']=="COD")
           {

        
        
         foreach ($_SESSION["cart_item"] as $item){
            $t += ($item["price"]*$item["quantity"]);
            }
            $total=$t+50;

            
            $s1="SELECT id,total from customer_details WHERE mobile='$mobile_number' AND pickup_status=0 AND deliever_status=0";
            $run=$conn->query($s1);
            if($run->num_rows>0)
            {
                while($row=$run->fetch_assoc())
                {
                    $l=0;
                    $to=0;
                    $total_sql=0;
                    $id=$row['id'];
                $total_sql=$row['total'];
                    foreach ($_SESSION["cart_item"] as $item){
                        $l += ($item["price"]*$item["quantity"]);
                        }
                   $to=$l+ 50 + (double)$total_sql;

                 
                

                  
                    $s3="UPDATE customer_details SET total='$to' WHERE id=$id";
                    if(mysqli_query($conn,$s3))
                    {
                        foreach ($_SESSION["cart_item"] as $item){
                            $item_name=$item['name'];
                            $item_quantity=$item['quantity'];
                            $item_price=$item['price'];
                            if(isset($_SESSION['ref']))
                            {
                            $ref=$_SESSION['ref'];
                            }
                            else
                            {
                                $ref="";
                            }
                            $s2="INSERT INTO order_details VALUES('$id','$item_name',$item_quantity,$item_price,'$ref') ";
                           if(mysqli_query($conn,$s2))
                           {
                               $h="ko";
                               $_SESSION['cod']=$h;
                            header('Location:successful.php');
                           }
                           else
                           {
                               echo "Failed";
                           }

                    }
                }
                    else
                    {

                    }



                }
                

            }
            else
            {

            $sql="INSERT INTO customer_details VALUES('','$name',$mobile_number,'$address','COD','$total',0,0)";
            if(mysqli_query($conn,$sql))
            {
                
                    $s4="SELECT id,total from customer_details WHERE name='$name' AND mobile=$mobile_number AND pickup_status=0 AND deliever_status=0";
                    $run1=$conn->query($s4);
               
                while($row1=$run1->fetch_assoc())
                {
                    $id=$row1['id'];
                    foreach ($_SESSION["cart_item"] as $item){
                        $item_name=$item['name'];
                        $item_quantity=$item['quantity'];
                        $item_price=$item['price'];
                        $s2="INSERT INTO order_details VALUES('$id','$item_name',$item_quantity,$item_price) ";
                       if(mysqli_query($conn,$s2))
                       {
                        $_SESSION['cod']="cod";
                        header('Location:successful.php');
                       }
                       else
                       {
                           echo "Failed";
                       }
                        }

                
                    }

                
            }
            else{
               
            }
        }
        }
        else
        {

            $_SESSION['name']=$name;
            $_SESSION['mobile_number']=$mobile_number;
            $_SESSION['address']=$address;
            $_SESSION['po']="po";
            foreach ($_SESSION["cart_item"] as $item){
                $t += ($item["price"]*$item["quantity"]);
                }
                $total=$t+50;
                $_SESSION['total']=$total;
            header('Location:checkout.php');
        }
        

    
    
   }
   else
   {
    echo "<br><p>Invalid Mobile Number</p>";
   }
}
}


?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>