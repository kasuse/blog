<!DOCTYPE HTML>

<html>

<head>
    <title>Registration</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>



    <?php

   include "include/database.php"; 

    

    $op = $_POST['op']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password= password_hash($password, PASSWORD_DEFAULT);
    

    if ($op=="save")
    {
        // echo "$name - $email - $phone - $pass";
         
        $sql_e = "SELECT * FROM users WHERE email='$email'";
        $res_e = mysqli_query($link, $sql_e);

        if(mysqli_num_rows($res_e) > 0){
            $email_error = "Sorry... email already taken"; 	
          }
          else{

         $sql = "INSERT INTO users (name,email,phone,password)
                  VALUES ('$name','$email','$phone','$password')";
         mysqli_query($link,$sql);
          

         if (mysqli_error($link)) {
            echo "MySQL Error: " . mysqli_error($link);}
         else  {
             
               echo '<div class="container p-3">
               <div class="panel panel-primary">
                   <div class="panel-heading">Success!</div>
                   <div class="panel-body">Your registration was successful.</div>
               </div>
               </div>';
                
             
             echo "Success!";
         }
        }
         //exit;

    }

?>

    <div class="container p-3">

        <div class="panel panel-default">
            <div class="panel-heading">Registration form</div>
            <div class="panel-body">

                <form method=POST action=registration.php>

                <?php if ($email_error): ?>
                <ul>
                   
                   <li style="color: red;"><?= $email_error ?></li>
                   
                </ul>
                <?php endif ?>

                

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" required />
                    </div>

                    <div <?php if (isset($email_error)): ?> class="form-group" <?php endif ?>>
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" required value="<?php echo $email; ?>"/>
                        <?php if (isset($email_error)): ?>
      	                <span><?php echo $email_error; ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" class="form-control" name="phone" required />
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" required name="password"
                            onChange="form.pass2.pattern=this.value" />
                    </div>

                    

                    <div class="form-group">
                        <label>Confirm</label>
                        <input type="submit" class="btn btn-primary" value="Save data" />
                    </div>

                    <input type="hidden" name="op" value="save" />

                </form>
                <h4>Have an account</h4>
                <a href="index.php">Login</a>

            </div>
        </div>

    </div>

</body>

</html>