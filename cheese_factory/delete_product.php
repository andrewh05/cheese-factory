<?php
include 'db.php';

// Get the product code from the URL
$code = isset($_GET['code']) ? $_GET['code'] : '';

$sql = "DELETE FROM Product WHERE Code = '$code'";

    if ($conn->query($sql) === TRUE) {
        echo "Product Deleted successfully";
        header('Location: view_products.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
