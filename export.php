<?php

include_once "./Auth/config.php";

if (!isset($_GET['id'])) {
    header("Location: ./import.php");
}
$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM import INNER JOIN furniture ON import.furnitureid = furniture.furnitureid WHERE furniture.furnitureid = '{$id}' ");

if ($sql == true) {
    $fetch = mysqli_fetch_assoc($sql);


    $form = '<form action="" method="POST">
                <div>
                    <label for="fname">Furniture Name</label>
                    <input type="text" name="fname" value="' . $fetch['furniturename'] . '" disabled >
                </div>
                <div>
                    <label for="pass">Furniture Owner Name</label>
                    <input type="text" name="fowner" value="' . $fetch['furnitureownername'] . '" disabled >
                </div>

                <div>
                <label for="date">Date</label>
                <input type="date" name="dt" required>
                </div>

                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="' . $fetch['quantity'] . '"  required>
                </div>
                <div>
            </div>
                <button type="submit" name="submit">Export</button>
            </form>';



    if (isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $date = $_POST['dt'];


        $check = mysqli_query($conn, " SELECT * FROM export WHERE furnitureid = '{$id}'");
        if (mysqli_num_rows($check) > 0) {
            $fetch = mysqli_fetch_assoc($check);

            $new_quantity = $fetch['quantity'] + $quantity;


            $sql = mysqli_query($conn, " UPDATE export SET quantity = '{$new_quantity}', `exportdate`='{$date}' WHERE furnitureid = '{$id}'  ");
            if ($sql == true) {
                $sql1 = mysqli_query($conn, "SELECT * FROM import WHERE furnitureid = '{$id}'");
                $fetch = mysqli_fetch_assoc($sql1);

                $new_impo_quantity = $fetch['quantity'] - $quantity;

                $sql = mysqli_query($conn, " UPDATE import SET quantity = '{$new_impo_quantity}', `importdate`='{$date}' WHERE furnitureid = '{$id}'  ");
                if ($sql == true) {
                    echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
                } else {
                    echo "Not exported!";
                }

            } else {
                echo "not updated";
            }

        } else {
            $sql = mysqli_query($conn, "INSERT INTO export(furnitureid,exportdate, quantity) VALUES ('{$id}','{$date}','{$quantity}') ");
            if ($sql == true) {
                $sql1 = mysqli_query($conn, "SELECT * FROM import WHERE furnitureid = '{$id}'");
                $fetch = mysqli_fetch_assoc($sql1);

                $new_impo_quantity = $fetch['quantity'] - $quantity;

                $sql = mysqli_query($conn, " UPDATE import SET quantity = '{$new_impo_quantity}',`importdate`='{$date}' WHERE furnitureid = '{$id}'  ");
                if ($sql == true) {
                    echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
                } else {
                    echo "Not exported!";
                }

            } else {
                echo "not updated";
            }
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
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
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        a {
            color: ##333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4e8c3b;
        }
    </style>
</head>

<body>
    <?php echo $form; ?>
    <a href="./index.php">Back to home</a>
</body>

</html>