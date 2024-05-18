<?php 

include_once "./Auth/config.php";

$id = $_GET['id'];

$sql = mysqli_query($conn, " SELECT * FROM furniture WHERE furnitureid = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                    <div>
                        <label for="uname">Furniture Name</label>
                        <input type="text" name="fname" value="'.$fetch['furniturename'].'" >
                    </div>
                    <div>
                        <label for="pass">Furniture Owner Name</label>
                        <input type="text" name="fowner" value="'.$fetch['furnitureownername'].'" >
                    </div>
                    <button type="submit" name="submit">Update</button>
                </form>';

}else{
    echo "Not selected!";
}

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $fowner = $_POST['fowner'];

    $sql = mysqli_query($conn, " UPDATE furniture SET furniturename = '{$fname}', furnitureownername = '{$fowner}' WHERE furnitureid = '{$id}' " );
    if($sql == true){
        echo "Record updated! <br/> <a href='./index.php'> Back to home </a> ";
    }else{
        echo "Not updated!";
    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE FURNITURE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        a {
            color: #70a1ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4e8cbb;
        }
    </style>
</head>
<body>
    <?php echo $form; ?>
</body>
</html>
