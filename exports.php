<?php 

    include_once "./Auth/config.php";
    $form ='';
    $sql = mysqli_query($conn, " SELECT * FROM export INNER JOIN furniture ON  export.furnitureid = furniture.furnitureid " );
    if($sql == true){
        $num_rows = mysqli_num_rows($sql);
        if($num_rows > 0){
            $a = 0;
            while($fetch = mysqli_fetch_assoc($sql)){
                $a++;
                $form .= '<tr>
                            <td>'.$a.'</td>
                            <td>'.$fetch['furniturename'].'</td>
                            <td>'.$fetch['furnitureownername'].'</td>
                            <td>'.$fetch['exportdate'].'</td>
                            <td>'.$fetch['quantity'].'</td>
                            <td> <a href="e_update.php?id='.$fetch['furnitureid'].'">Update</a></td>
                            <td> <a href="e_delete.php?id='.$fetch['furnitureid'].'">Delete</a></td>
                            <td> <a href="export.php?id='.$fetch['furnitureid'].'">Export</a></td>
                        </tr>';
            }
        }else{
            $tbody = '<tr> <td> No Record Found! </td> </tr>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Exports</title>
    <link rel="stylesheet" href="./style/exports.css">


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

    <h1>Exports</h1>
    <table border='1'>
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
                <th>Date</th>
                <th>Quantity</th>
                <th colspan='3'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form; ?>
        </tbody>
    </table>

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