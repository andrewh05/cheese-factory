<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    // Validate inputs (add your validation logic here)

    $stmt = $pdo->prepare("INSERT INTO Product (Code, Descrip, Catg, Type, Qtty, Exp_Date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$code, $description, $category, $type, $quantity, $expiry_date]);

    header('Location: view_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Cheese Product</h1>
    <form method="post">
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" required><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="expiry_date">Expiry Date (YYYY-MM-DD):</label>
        <input type="date" id="expiry_date" name="expiry_date" required><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
