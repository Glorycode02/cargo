<?php

include_once "./Auth/config.php";
$form = '';
$sql = mysqli_query($conn, "SELECT * FROM import INNER JOIN furniture ON import.furnitureid = furniture.furnitureid ");
if ($sql == true) {
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql)) {
            $a++;
            $form .= '<tr>
                        <td>' . $a . '</td>
                        <td>' . $fetch['furniturename'] . '</td>
                        <td>' . $fetch['furnitureownername'] . '</td>
                        <td>' . $fetch['importdate'] . '</td>
                        <td>' . $fetch['quantity'] . '</td>
                        <td><a href="f_i_update.php?id=' . $fetch['furnitureid'] . '" style="color: #f76c6c;">Update</a></td>
                        <td><a href="f_i_delete.php?id=' . $fetch['furnitureid'] . '" style="color: #70a1ff;">Delete</a></td>
                        <td><a href="export.php?id=' . $fetch['furnitureid'] . '" style="color: #6ab04c;">Export</a></td>
                    </tr>';
        }
    } else {
        $tbody = '<tr> <td> No Record Found! </td> </tr>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Imports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .links ul {
            list-style-type: none;
            padding: 0;
        }

        .links ul li {
            display: inline;
            margin-right: 20px;
        }

        .links li a {
            color: #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
        }

        .action-link {
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .action-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .social-media a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>Cargo Ltd Warehouse</h1>
        <div class="links">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./import.php">Import</a></li>
                <li><a href="./export.php">Export</a></li>
                <li><a href="./Auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <h1>Imports</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
                <th>Import Date</th>
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
        </div>
    </footer>
</body>

</html>