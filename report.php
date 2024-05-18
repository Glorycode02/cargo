<?php
include_once "./Auth/config.php";

// Fetch Imports
$form_imports = '';
$sql_imports = mysqli_query($conn, "SELECT * FROM import INNER JOIN furniture ON import.furnitureid = furniture.furnitureid ");
if ($sql_imports == true) {
    $num_rows = mysqli_num_rows($sql_imports);
    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql_imports)) {
            $a++;
            $form_imports .= '<tr>
                        <td>' . $a . '</td>
                        <td>' . $fetch['furniturename'] . '</td>
                        <td>' . $fetch['furnitureownername'] . '</td>
                        <td>' . $fetch['importdate'] . '</td>
                        <td>' . $fetch['quantity'] . '</td>
                    </tr>';
        }
    } else {
        $tbody_imports = '<tr> <td colspan="5"> No Record Found! </td> </tr>';
    }
}

// Fetch Exports
$form_exports = '';
$sql_exports = mysqli_query($conn, "SELECT * FROM export INNER JOIN furniture ON export.furnitureid = furniture.furnitureid ");
if ($sql_exports == true) {
    $num_rows = mysqli_num_rows($sql_exports);
    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql_exports)) {
            $a++;
            $form_exports .= '<tr>
                            <td>' . $a . '</td>
                            <td>' . $fetch['furniturename'] . '</td>
                            <td>' . $fetch['furnitureownername'] . '</td>
                            <td>' . $fetch['exportdate'] . '</td>
                            <td>' . $fetch['quantity'] . '</td>
                        </tr>';
        }
    } else {
        $tbody_exports = '<tr> <td colspan="5"> No Record Found! </td> </tr>';
    }
}

// Fetch Products
$form_products = '';
$sql_products = mysqli_query($conn, "SELECT * FROM furniture");
if ($sql_products == true) {
    $num_rows = mysqli_num_rows($sql_products);
    if ($num_rows > 0) {
        $i = 0;
        while ($fetch = mysqli_fetch_assoc($sql_products)) {
            $i++;
            $form_products .= '<tr>
                            <td>' . $i . '</td>
                            <td>' . $fetch['furniturename'] . '</td>
                            <td>' . $fetch['furnitureownername'] . '</td>
                        </tr>';
        }
    } else {
        $form_products = '<tr> <td colspan="3"> No Products </td> </tr>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Report</title>
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
            transition: background-color 0.3;
        }

        .print-button {
            background-color: #333;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
        }

        .print-button:hover {
            background-color: #45a049;
            /* Darker Green */
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <h1>Cargo Ltd Warehouse</h1>
        <div class="links">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./import.php">Import</a></li>
                <li><a href="./exports.php">Export</a></li>
                <li><a href="./Auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!-- Imports Table -->
    <button class="print-button" onclick="printPage()">Print</button>
    <h1>Imports</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
                <th>Import Date</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form_imports; ?>
        </tbody>
    </table>

    <!-- Exports Table -->
    <h1>Exports</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
                <th>Export Date</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form_exports; ?>
        </tbody>
    </table>

    <!-- Products Table -->
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Furniture Name</th>
                <th>Furniture Owner Name</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form_products; ?>
        </tbody>
    </table>
    

        <script>
            function printPage() {
                window.print();
    }
    </script>

</body>

</html>