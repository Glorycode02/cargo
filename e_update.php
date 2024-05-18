<?php 


include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./import.php");
}
$id = $_GET['id'];
 
$sql = mysqli_query($conn, " SELECT * FROM export INNER JOIN furniture ON export.furnitureid = furniture.furnitureid WHERE furnitureid = '{$id}' " );
if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                <div>
                    <label for="uname">Product Name</label>
                    <input type="text" name="pname" value="'.$fetch['pname'].'" disabled >
                </div>
                <div>
                    <label for="pass">Product Owner</label>
                    <input type="text" name="powner" value="'.$fetch['powner'].'" disabled >
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="'.$fetch['quantity'].'" >
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="price_per_unit" value="'.$fetch['price_per_unit'].'"  >
                </div>
                <div>
                <label for="pass">Date</label>
                <input type="date" name="date" value="'.$fetch['date'].'" >
            </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}

if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['price_per_unit'];
    $date = $_POST['date'];
    $total_price = $quantity * $price_per_unit;

    $sql = mysqli_query($conn, " UPDATE product_out SET price_per_unit = '{$price_per_unit}', total_price = '{$total_price}', `date` = '{$date}', quantity= '{$quantity}'  WHERE id = '{$id}' " );
    if($sql == true){
        echo " Record Updated! <a href='./imports.php'>View Imports</a> ";
    }else{
        echo "Not Updated!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Update</title>
    <link rel="stylesheet" href="./style/e_update.css">
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
    </div>
</footer>

</body>
</html>