<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>View Orders</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
  <img src="images/logo.png" height="50">
  <h2>Order History</h2>
</header>

<div class="container">

<table border="1">
<tr>
<th>ID</th>
<th>Product</th>
<th>Quantity</th>
<th>Price</th>
<th>Date</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM orders");

while($row = $result->fetch_assoc()){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['product_name']}</td>
        <td>{$row['quantity']}</td>
        <td>{$row['price']}</td>
        <td>{$row['created_at']}</td>
    </tr>";
}
?>

</table>

</div>
</body>
</html>