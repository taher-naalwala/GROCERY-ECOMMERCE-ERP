<?php
session_start();
if(isset($_SESSION['cod']))
{
unset($_SESSION['cod']);
}
else if(isset($_SESSION['po']))
{
    header('Location:online_successful.php');
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

<div class="container">
<div class="card text-center mt-5">
  
    <div class="card-body">
    <h1>Order Successful</h1>
    <img src="images.png" width="10%" height="10%">

    <h4>Your Order will be delievered <b>within 7 days</b> between 8:00 AM to 10:00 PM</h4>
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