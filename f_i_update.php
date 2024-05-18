<?php  

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./import.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn,"SELECT * FROM import INNER JOIN  furniture ON import.furnitureid = furniture.furnitureid = '{$id}' ");
if($sql == true){
    $fetch = mysqli_fetch_Assoc($sql);
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
                <button type="submit" name="submit">Import</button>
            </form>';

}

if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];

    $sql = mysqli_query($conn,"UPDATE import SET `date` = '{$date}',quantity = '{$quantity}' WHERE furnitureid = '{$id}' ");
    if($sql == true){
        echo " Record Updated! <a href='./import.php'>View Imports</a> ";
}else{
    echo "Not Added";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/f_i_update.css">
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