<?php
session_start();
if(isset($_SESSION['name']))
{

}
else
{
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
@media (max-width: 600px)
{
    img {

        width:"50%";
        height:"50%";
    }
}
</style>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful</title>
</head>
<body>

<?php require('connectDB.php');
session_start();
$name=$_SESSION['name'];
$mobile_number=$_SESSION['mobile_number'];
$address=$_SESSION['address'];

$t=0;

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
                    $s2="INSERT INTO order_details VALUES('$id','$item_name',$item_quantity,$item_price) ";
                   if(mysqli_query($conn,$s2))
                   {
                   
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
    $sql="INSERT INTO customer_details VALUES('','$name',$mobile_number,'$address','Online','$total',0,0)";
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

               }
               else
               {
                   echo "Failed to place Order";
               }
            }
        }
    }
}

?>

<div class="container">
<div class="card text-center mt-5">
  
    <div class="card-body">
    <h1>Order Successful</h1>
    <img src="images.png" width="10%" height="10%">

    <h4>Your Order will be delievered <b>Day After Tomorrow</b> on <?php
    $date = strtotime("+2 day");
   echo $cc=date("Y-m-d",$date); ?> between 8:00 AM to 10:00 PM</h4>
   <br>
   <button onclick="location.href='index.php';" class="btn btn-primary">Go Back to Home</button>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
<?php

?>