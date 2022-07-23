<?php

if(isset($_SESSION['pass']))
{
    header('Location:admin_portal.php');
}
else
{}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<div class="container mt-5">
<div class="card text-center ">
<div class="card-body">
<form method="POST">
<div class="form-group">

<input type="number" class="form-control" name="mobile" placeHolder="Enter Your Mobile Number"></div>

<input type="password" class="form-control" name="password" placeHolder="Enter Your Password"></div>

<button type="submit" class="btn btn-primary" name="submit">Sign In</button>

</form>
</div>
</div>
</div>
<?php require('connectDB.php');

if(isset($_POST['submit']))
{
    $mobile=$_POST['mobile'];
    $pass=$_POST['password'];
    $sql="SELECT id from admin WHERE mobile='$mobile' AND pass='$pass'";
    $run=$conn->query($sql);
    if($run->num_rows>0)
    {
        session_start();
        $_SESSION['pass']=$pass;
        header('Location:admin_portal.php');
    }
    else
    {
        echo "<p style='text-align:center'>Invalid Login</p>";
    }
}


?> 
</body>
</html>