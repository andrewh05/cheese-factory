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

    $sql = "INSERT INTO Product (Code, Descrip, Catg, Type, Qtty, Exp_Date) VALUES ($code, '$description', '$category', '$type', $quantity, $expiry_date)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

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
        <select id="category" name="category" required>
            <option value="">Select</option>
            <option value="soft">soft</option>
            <option value="semi-soft">semi-soft</option>
            <option value="semi-hard">semi-hard</option>
            <option value="hard">hard</option>
        </select>

        <label>Type:</label><br>
        <input type="radio" id="type1" name="type" value="Fat Free" required>Fat Free<br>
        
        <input type="radio" id="type2" name="type" value="Low Fat" required>Low Fat<br>
        
        <input type="radio" id="type3" name="type" value="Full Fat" required>Full Fat<br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="expiry_date">Expiry Date (YYYY-MM-DD):</label>
        <input type="date" id="expiry_date" name="expiry_date" required><br>

        <input type="submit" value="Add Product">
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
