<?php
include 'db.php';

$code = $_GET['code'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    $stmt = $pdo->prepare("UPDATE Product SET Descrip = ?, Catg = ?, Type = ?, Qtty = ?, Exp_Date = ? WHERE Code = ?");
    $stmt->execute([$description, $category, $type, $quantity, $expiry_date, $code]);

    header('Location: view_products.php');
}

$stmt = $pdo->prepare("SELECT * FROM Product WHERE Code = ?");
$stmt->execute([$code]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update Cheese Product</h1>
    <form method="post">
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($product['Descrip']); ?>" required><br>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['Catg']); ?>" required><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($product['Type']); ?>" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['Qtty']); ?>" required><br>

        <label for="expiry_date">Expiry Date (YYYY-MM-DD):</label>
        <input type="date" id="expiry_date" name="expiry_date" value="<?php echo htmlspecialchars($product['Exp_Date']); ?>" required><br>

        <input type="submit" value="Update Product">
    </form>
</body>
</html>
