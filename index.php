<?php 
ini_set("display_errors", 1);
session_start(); 
if(isset($_SESSION['name'])) {
    header("location: dashboard.php");
    exit();
}

include "include/database.php";

$error = [];

if (isset($_POST['name']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    
    $uname = validate($_POST['name']);
    $password = validate($_POST['password']);

    if (empty($uname)) {

    array_push($error, "User Name is required");

    }else if(empty($password)){

        array_push($error,  "Password is required");

    }else{

        $sql = "SELECT * FROM `users` WHERE `name`='$uname' ";

        $result = mysqli_query($link, $sql);

        if ($result) {

            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {

                echo "Logged in!";

                $_SESSION['uname'] = $row['name'];

                $_SESSION['uname'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: dashboard.php");

            }else{

                array_push($error, "Incorect User name or password");

            }

        }else{

            array_push($error, "Oops, account does not exist! Please register!");

        }

    }

}

?>

<!DOCTYPE HTML>

<html>

<head>
    <title>Login</title>

            <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="include/validate.js"></script>

</head>

<body>



<div class="container p-3 col-md-4">

   

    <div class="container p-3">
    <div class="panel-heading">Login page</div>
    <div class="panel-body">


        <form method=POST action="index.php">

        <?php if ($error): ?>
            <ul>
            <?php foreach($error as $err): ?>
                <li style="color: red;"><?= $err ?></li>
            <?php endforeach ?>
            </ul>
        <?php endif ?>

            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" autocomplete=off name="name"/>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control"  name="password"/>
            </div>


            <div class="form-group">
                <label></label>
                <input type="submit" class="btn btn-primary" value="Login"/>
            </div>

            <input type="hidden" name="op" value="login"  />

        </form>
        <h3>Register if you don't have an account</h3>
        <a href="registration.php">Register</a>
        
    </div>
    </div>
</div>

</body>

</html>