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
    <link rel="stylesheet" href="./style/f_update.css">
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