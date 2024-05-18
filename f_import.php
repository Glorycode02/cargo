<?php 

include_once "./Auth/config.php";

$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM furniture WHERE furnitureid = '{$id}' ");

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);

    $form = '<form action="" method="POST" style="max-width: 400px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <div class="form-group">
                    <label for="fname">Furniture Name</label>
                    <input type="text" name="fname" value="'.$fetch['furniturename'].'" disabled>
                </div>
                <div class="form-group">
                    <label for="fowner">Furniture Owner Name</label>
                    <input type="text" name="fowner" value="'.$fetch['furnitureownername'].'" disabled>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" required>
                </div>
                <button type="submit" name="submit">Import</button>
            </form>';
}

if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];

    $check = mysqli_query($conn,"SELECT * FROM import WHERE furnitureid = '{$id}'");
    if(mysqli_num_rows($check) > 0){
        $fetch = mysqli_fetch_assoc($check);
        $new_quantity = $fetch['quantity'] + $quantity;

        $sql = mysqli_query($conn, "UPDATE import SET importdate = '{$date}', quantity = '{$new_quantity}' WHERE furnitureid='{$id}' ");
        if($sql == true){
            echo "Record added! <a href='./import.php'>View import</a>";
        }else{
            echo "Record not added";
        }
    }else{
        $sql = mysqli_query($conn,"INSERT INTO import(furnitureid,importdate,quantity) VALUES('{$id}','{$date}','{$quantity}')");
        if($sql == true){
            echo "Record added! <a href='./import.php'>View import</a>";
        }else{
            echo "Not Added";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Furniture</title>
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

    <?php echo $form; ?>

</body>
</html>
