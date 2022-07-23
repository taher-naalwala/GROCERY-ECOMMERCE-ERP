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
    <title>Customer Details</title>
</head>
<body>

<div class="card">
<div class="card-body">

<div class="form-group">
<form method="POST">

<select class="form-control" name="status">

<option value="P">Pickup</option>
<option value="D">Delievered</option>

</select>
<br>

<button class="btn btn-primary" type="submit" name="submit">Submit</button>

</form>
</div>
</div>
</div>

<?php require('connectDB.php');

if(isset($_POST['submit']))
{
    $id=$_GET['id'];
    $s=$_POST['status'];
    if($s=="P")
    {
        $s1="UPDATE customer_details SET pickup_status=1 WHERE id=$id";
        if(mysqli_query($conn,$s1))
        {
            echo "Pickup Successful";
        }
        else
        {
            echo "Error";
        }
    }
    else if($s=="D")
    {
        $s1="UPDATE customer_details SET deliever_status=1 WHERE id=$id";
        if(mysqli_query($conn,$s1))
        {
            echo "DelieverSuccessful";
        }
        else
        {
            echo "Error";
        }
    }
    else
    {
        echo "Select something";
    }
}

?>


<table class="table">
<thead>
<tr>

<th scope="col">Product Name</th>
<th scope="col">Product Quantity</th>
<th scope="col">Product Price</th>

</tr>

<?php require('connectDB.php');

$id=$_GET['id'];

$sql="SELECT p_name,p_quantity,p_price FROM order_details WHERE customer_id=$id";
$run=$conn->query($sql);
echo "<tbody>";
while($row=$run->fetch_assoc())
{
    echo "<tr>
    <th scope='row'>";
    echo $row['p_name']."</td><td>";
echo $row['p_quantity']."</td><td>";
echo $row['p_price']."</td>";

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