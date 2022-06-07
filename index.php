<?php

    require_once "./config/database.php";
    require_once "./config/functions.php";

    $inputs_login = isset($_POST["username"]) && isset($_POST["password"]);
    $inputs_new_user = isset($_POST["new_username"]) && isset($_POST["new_password"]);

    $logedin = false;

    if($inputs_login){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(verifyUser($username, $password)){

            header("Location: login.php");
            exit();
        }
    }
    elseif($inputs_new_user){
        $sql = "SELECT * FROM workers ORDER BY id DESC";
        $last_user = select_one_SQL($sql);

        $new_username = $_POST["new_username"];
        $new_password = $_POST["new_password"];

        if($last_user["username"] == $new_username){
            header("Location: index.php");
            exit();
        }
        else{
            
    
            newUser($new_username, $new_password);
        }
        
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="text-light">

<header>
    <div class="container py-5">
        <div class="row">
            <h1 class="col-12 text-center">Login</h1>
        </div>
    </div>
</header>

<main>

    <div class="container">

        <div class="row text-center">

            <form action="" id="login-form" method="POST">

                <?php if(!$logedin && $inputs_login): ?>
                
                    <h4 class="col-12 text-danger text-center">Login invalid</h4>

                <?php endif; ?>

                <input type="text" name="username" placeholder="Username" required>
                <br><br>
                <input type="password" name="password" placeholder="Password" required>
                <br><br>
                <input type="submit" value="Login" class="btn btn-primary">

            </form>
        
        </div>

    </div>

    <div class="container">

        <div class="row text-center">

            <form action="" id="new-user-form" method="POST">

                <?php if($inputs_new_user): ?>
                
                    <h4 class="col-12 text-danger text-center">New user crested successfully</h4>

                <?php endif; ?>

                <input type="text" name="new_username" placeholder="Username" required>
                <br><br>
                <input type="password" name="new_password" placeholder="Password" required>
                <br><br>
                <input type="submit" value="Create" class="btn btn-primary">

            </form>
        
        </div>

    </div>

</main>

    
    





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>