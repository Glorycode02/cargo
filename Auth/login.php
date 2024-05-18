<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "cargo");

if (!$conn) {
    echo "Not connected!";
}

if (isset($_SESSION['uid'])) {
    header("Location: ../index.php ");
}

if (isset($_POST['login'])) {
    $uname =  $_POST['uname'];
    $pass =  $_POST['password'];

    $check = mysqli_query($conn, " SELECT * FROM manager WHERE username = '{$uname}' AND `password` = '{$pass}' ");
    if (mysqli_num_rows($check) == 1) {
        $fetch = mysqli_fetch_assoc($check);
        $_SESSION['uid'] = $fetch['managerid'];
        header("Location: ../index.php");
    } else {
        echo "Username or password is incorrect!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 320px;
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #333;
            text-align: center;
            font-size: 24px;
        }

        p {
            margin: 0 0 10px;
            padding: 0;
            color: #555;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            margin: 10px 0;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            color: #721c24;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <h2>Login Form</h2>
        <?php if (isset($_POST['login']) && mysqli_num_rows($check) != 1) { ?>
            <div class="error">Username or password is incorrect!</div>
        <?php } ?>
        <p>Username</p>
        <input type="text" name="uname" placeholder="Enter your username">
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter your Password">
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>
