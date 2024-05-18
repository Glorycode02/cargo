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
                            <td> <a href="e_delete.php?id='.$fetch['furnitureid'].'" class="delete">Delete</a></td>
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

        h1 {
            text-align: center;
            margin-top: 30px;
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
            color: #70a1ff;
        }

        a:hover {
            color: #4e8cbb;
        }

        .delete{
            color: red;
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
                <li><a href="./exports.php">Export</a></li>
                <li><a href="./Auth/logout.php">Logout</a></li>
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
                <th colspan='2'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form; ?>
        </tbody>
    </table>

</footer>


</body>
</html>
