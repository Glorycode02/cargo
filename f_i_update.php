<?php  

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./import.php");
    exit(); // Ensure script termination after redirection
}
$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM import INNER JOIN furniture ON import.furnitureid = furniture.furnitureid WHERE import.furnitureid = '{$id}' ");
if($sql){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                <div>
                    <label for="uname">Furniture Name</label>
                    <input type="text" name="fname" value="'.$fetch['furniturename'].'" disabled >
                </div>
                <div>
                    <label for="pass">Furniture Owner Name</label>
                    <input type="text" name="fowner" value="'.$fetch['furnitureownername'].'" disabled >
                </div>
                <div>
                    <label for="pass">Date</label>
                    <input type="date" name="date" >
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" >
                </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}

if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];

    $sql_update = mysqli_query($conn,"UPDATE import SET importdate = '{$date}', quantity = '{$quantity}' WHERE furnitureid = '{$id}' ");
    if($sql_update){
        echo "Record Updated! <a href='./import.php'>View Imports</a> ";
    } else {
        echo "Update Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        }

        input[type="text"],
        input[type="date"] {
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
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php echo $form; ?>
</body>
</html>
