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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckOut</title>
</head>
<body>
<div class="container mt-5">
<div class="card text-center">
<div class="card-body">
<form action="successful.php" method="POST">
<h3>Click Here to Pay Your Bill Online</h3>
<br>

<h4>Total Amount to be Paid : Rs. <b>
<?php
$total =0;
session_start();
echo $total=$_SESSION['total'];


?>

</b></h4><br>

<form action="online_successful.php" method="POST">
<script


src="https://checkout.razorpay.com/v1/checkout.js"    
data-key="rzp_test_13zHzeI1yNvl1O"    
data-amount="<?php echo ($total*100) ?>"
 data-currency="INR"
  
  
 data-buttontext="Pay Online"    data-name="Indore Kirana Delievery"    
 data-description=""    
      
     data-theme.color="#F37254"></script><input type="hidden" custom="Hidden Element" name="hidden"></form>
</div>
</div>
</div>
</body>
</html>