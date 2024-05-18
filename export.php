<?php 

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./import.php");
}
$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM import INNER JOIN furniture ON import.furnitureid = furniture.furnitureid WHERE furniture.furnitureid = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);


    $form = '<form action="" method="POST">
                <div>
                    <label for="fname">Furniture Name</label>
                    <input type="text" name="fname" value="'.$fetch['furniturename'].'" disabled >
                </div>
                <div>
                    <label for="pass">Furniture Owner Name</label>
                    <input type="text" name="fowner" value="'.$fetch['furnitureownername'].'" disabled >
                </div>

                <div>
                <label for="date">Date</label>
                <input type="date" name="dt" required>
                </div>

                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="'.$fetch['quantity'].'"  required>
                </div>
                <div>
            </div>
                <button type="submit" name="submit">Export</button>
            </form>';



if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $date =$_POST['dt'];
    

    $check = mysqli_query($conn, " SELECT * FROM export WHERE furnitureid = '{$id}'" );
    if(mysqli_num_rows($check) > 0){
        $fetch = mysqli_fetch_assoc($check);

        $new_quantity = $fetch['quantity'] + $quantity;
        

        $sql = mysqli_query($conn, " UPDATE export SET quantity = '{$new_quantity}', `exportdate`='{$date}' WHERE furnitureid = '{$id}'  " );
        if($sql == true){
            $sql1 = mysqli_query($conn, "SELECT * FROM import WHERE furnitureid = '{$id}'"); 
            $fetch = mysqli_fetch_assoc($sql1);

            $new_impo_quantity = $fetch['quantity'] - $quantity;

            $sql = mysqli_query($conn, " UPDATE import SET quantity = '{$new_impo_quantity}', `importdate`='{$date}' WHERE furnitureid = '{$id}'  " );
            if($sql == true){
                echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
            }else{
                echo "Not exported!";
            }

        }else{
            echo "not updated";
        }

    }else{
        $sql = mysqli_query($conn, "INSERT INTO export(furnitureid,exportdate, quantity) VALUES ('{$id}','{$date}','{$quantity}') " );
        if($sql == true){
            $sql1 = mysqli_query($conn, "SELECT * FROM import WHERE furnitureid = '{$id}'"); 
            $fetch = mysqli_fetch_assoc($sql1);

            $new_impo_quantity = $fetch['quantity'] - $quantity;

            $sql = mysqli_query($conn, " UPDATE import SET quantity = '{$new_impo_quantity}',`importdate`='{$date}' WHERE furnitureid = '{$id}'  " );
            if($sql == true){
                echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
            }else{
                echo "Not exported!";
            }

        }else{
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
    <link rel="stylesheet" href="./style/export.css">
    <style>
        
    </style>

</head>
<body>

<header class="links">
        <h2>WELCOME TO <br>  </h1> <h2>CARGO LTD WAREHOUSE</h3>
        <div class = "links">
            <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./import.php">Import</a></li>
            <li><a href="./export.php">Export</a></li>
            <li><a href="./Auth/logout.php">logout</a></li>
            </ul>
        </div>
</header>


    <?php echo $form; ?>


<footer>
    <div class="contact-info">
        <p>Contact Us: info@cargoltd.com | Phone: +123456789</p>
    </div>
    <div class="social-media">
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
        <!-- Add more social media links as needed -->
    </div>
</footer>

    
</body>
</html>