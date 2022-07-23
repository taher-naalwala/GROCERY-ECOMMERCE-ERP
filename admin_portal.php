<?php
session_start();
if(isset($_SESSION['pass']))
{
   
}
else
{
    header('Location:admin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
</head>
<body>

<h3>Pickup</h3>

<table class="table">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Customer Name</th>
<th scope="col">Mobile Number</th>
<th scope="col">Payment Mode</th>
<th scope="col">Total</th>
</tr>


    <?php require('connectDB.php');

    $sql="SELECT id,name,mobile,total,payment_mode from customer_details WHERE pickup_status=0";
    $run=$conn->query($sql);
    if($run->num_rows>0)
    {
       echo "<tbody>";
      while($row=$run->fetch_assoc()) 
      {
   echo "<tr>
    <th scope='row'>";

echo $row['id']."</th><td>";

$l= "admin_customer_details.php?id=".$row['id'];
echo "<a href='$l'>".$row['name']."</a></th><td>";

echo $row['mobile']."</td><td>";
echo $row['payment_mode']."</td><td>";
echo $row['total']."</td>";


      }
     


    }
    else
    {
        echo "<p>No Pending Orders</p>";
    }

    ?>
    
    
    </th>



</tr>
    </tbody>
    


</thead>
</table>


<h3>Deliever</h3>


<table class="table">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Customer Name</th>
<th scope="col">Mobile Number</th>
<th scope="col">Payment Mode</th>
<th scope="col">Total</th>
</tr>


    <?php require('connectDB.php');

    $sql="SELECT id,name,mobile,total,payment_mode from customer_details WHERE pickup_status=1 AND deliever_status=0";
    $run=$conn->query($sql);
    if($run->num_rows>0)
    {
       echo "<tbody>";
      while($row=$run->fetch_assoc()) 
      {
   echo "<tr>
    <th scope='row'>";
    $l= "admin_customer_details.php?id=".$row['id'];
echo $row['id']."</th><td>";

echo "<a href='$l'>".$row['name']."</a></th><td>";

echo $row['mobile']."</td><td>";
echo $row['payment_mode']."</td><td>";
echo $row['total']."</td>";


      }
     


    }
    else
    {
        echo "<p>No Pending Orders</p>";
    }

    ?>
    
    
    </th>



</tr>
    </tbody>
    


</thead>
</table>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>