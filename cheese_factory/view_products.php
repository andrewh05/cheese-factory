<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM Product");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cheese Products</h1>
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
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['Code']); ?></td>
            <td><?php echo htmlspecialchars($product['Descrip']); ?></td>
            <td><?php echo htmlspecialchars($product['Catg']); ?></td>
            <td><?php echo htmlspecialchars($product['Type']); ?></td>
            <td><?php echo htmlspecialchars($product['Qtty']); ?></td>
            <td><?php echo htmlspecialchars($product['Exp_Date']); ?></td>
            <td>
                <a href="update_product.php?code=<?php echo urlencode($product['Code']); ?>">Edit</a>
                <a href="delete_product.php?code=<?php echo urlencode($product['Code']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_product.php">Add New Product</a>
</body>
</html>
