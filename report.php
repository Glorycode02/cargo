<?php 

include_once "./Auth/config.php";

$sql = mysqli_query($conn, " SELECT *, import.quantity AS p_in_quantity, 
                                       export.quantity AS p_out_quantity,  
                                       export.exportdate AS p_out_date, 
                                       import.importdate AS p_in_date FROM products
                                      INNER JOIN export ON furniture.furnitureid = import.furnitureid
                                      INNER JOIN export ON furniture.furnitureid = export.furnitureid " );
$form = '';

if($sql == true){

    $num_rows = mysqli_num_rows($sql);
    if($num_rows > 0){
        $a = 0;
        while($fetch = mysqli_fetch_assoc($sql)){
            $a++;
            $form .= ' <tr>
                        <td>'.$a.'</td>
                        <td>'.$fetch['furniturename'].'</td>
                        <td>'.$fetch['furnitureownername'].'</td>
                        <td>'.$fetch['p_in_quantity'].'</td>
                        <td>'.$fetch['p_out_quantity'].'</td>
                        <td>'.$fetch['p_in_date'].'</td>
                        <td>'.$fetch['p_out_date'].'</td>
                    </tr>';
        }

    }else{
        $tbody = '<tr> <td> No record! </td> </tr>';  
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
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


 
    <H1>STORE Report</H1><button onclick="print()">Print</button>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
                <th>Import Quantity</th>
                <th>Export Quantity</th>
                <th>Import Date</th>
                <th>Export Date</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form; ?>
            <tr>
                <td>Total: </td>
                <td colspan="8"> <?php echo $num_rows; ?></td>
            </tr>
        </tbody>
    </table>


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