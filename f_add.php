<?php 

include_once "./Auth/config.php";

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $fowner = $_POST['fowner'];

    $sql = mysqli_query($conn, " INSERT INTO furniture(furniturename, furnitureownername) VALUES('{$fname}','{$fowner}') " );
    if($sql == true){
        echo "Record Added Successfully! <br/> <a href='./index.php'>Back To Home</a> ";
    }else{
        echo "Not Inserted";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD FURNITURE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <form action="" method="POST">
        <div>
            <label for="fname">Furniture Name</label>
            <input type="text" name="fname">
        </div>
        <div>
            <label for="fowner">Furniture Owner Name</label>
            <input type="text" name="fowner">
        </div>
        <button type="submit" name="submit">Add</button>
    </form>

</body>
</html>
