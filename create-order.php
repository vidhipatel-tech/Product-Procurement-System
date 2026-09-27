<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Create Order</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
  <img src="images/logo.png" height="50">
  <h2>Create Order</h2>
</header>

<div class="container">

<form method="post">
    <label>Product Name</label><br>
    <input type="text" name="product" required><br><br>

    <label>Quantity</label><br>
    <input type="number" name="quantity" required><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if(isset($_POST['submit'])){
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO orders (product_name, quantity, price)
            VALUES ('$product', '$quantity', '$price')";

    if($conn->query($sql)){
        echo "<p style='color:green;'>Order Created Successfully!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

</div>
</body>
</html>