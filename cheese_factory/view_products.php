<?php
include 'db.php';

$sql = "SELECT * FROM Product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cheese Results</h1>
    <table>
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Category</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            <th>Actions</th>
        </tr>

        <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['Code']; ?></td>
                        <td><?php echo $row['Descrip']; ?></td>
                        <td><?php echo $row['Catg']; ?></td>
                        <td><?php echo $row['Type']; ?></td>
                        <td><?php echo $row['Qtty']; ?></td>
                        <td><?php echo $row['Exp_Date']; ?></td>
                        <td>
                            <a href="update_product.php?code=<?php echo $row['Code']; ?>">Edit</a>
                            <a href="delete_product.php?code=<?php echo $row['Code']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7'>0 results</td></tr>";
            }
        ?>
    </table>
    <a href="add_product.php">Add New Result</a>
</body>
<style>
    table {
            width: 100%;
            border-collapse: collapse; /* Ensures borders don't double */
        }
        th, td {
            border: 1px solid #dddddd; /* Adds border to cells */
            text-align: center; /* Center-aligns text */
            padding: 8px; /* Adds padding */
        }
        th {
            background-color: #f2f2f2; /* Light gray background for headers */
        }
</style>
</html>
