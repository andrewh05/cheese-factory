<?php
include 'db.php';

// Get the product code from the URL
$code = isset($_GET['code']) ? $_GET['code'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];

    // Validate inputs (add your validation logic here)

    $sql = "UPDATE Product SET Descrip = '$description', Catg = '$category', Type = '$type', Qtty = $quantity, Exp_Date = '$expiry_date' WHERE Code = '$code'";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
        header('Location: view_products.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch the current product data
$sql = "SELECT * FROM Product WHERE Code = '$code'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" value="<?php echo htmlspecialchars($row['Code']); ?>" readonly required><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($row['Descrip']); ?>" required><br>
        
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="">Select</option>
            <option value="soft" <?php echo ($row['Catg'] == 'soft') ? 'selected' : ''; ?>>soft</option>
            <option value="semi-soft" <?php echo ($row['Catg'] == 'semi-soft') ? 'selected' : ''; ?>>semi-soft</option>
            <option value="semi-hard" <?php echo ($row['Catg'] == 'semi-hard') ? 'selected' : ''; ?>>semi-hard</option>
            <option value="hard" <?php echo ($row['Catg'] == 'hard') ? 'selected' : ''; ?>>hard</option>
        </select>

        <label>Type:</label><br>
        <input type="radio" id="type1" name="type" value="Fat Free" <?php echo ($row['Type'] == 'Fat Free') ? 'checked' : ''; ?> required>Fat Free<br>
        <input type="radio" id="type2" name="type" value="Low Fat" <?php echo ($row['Type'] == 'Low Fat') ? 'checked' : ''; ?> required>Low Fat<br>
        <input type="radio" id="type3" name="type" value="Full Fat" <?php echo ($row['Type'] == 'Full Fat') ? 'checked' : ''; ?> required>Full Fat<br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($row['Qtty']); ?>" required><br>

        <label for="expiry_date">Expiry Date (YYYY-MM-DD):</label>
        <input type="date" id="expiry_date" name="expiry_date" value="<?php echo htmlspecialchars($row['Exp_Date']); ?>" required><br>

        <input type="submit" value="Update Product">
    </form>
</body>

<style>
    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="radio"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        box-sizing: border-box;
    }
    input[type="radio"] {
        width: auto;
    }
    input[type="submit"] {
        background-color: #e68a00;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 15px;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #e67a00;
    }
</style>
</html>
