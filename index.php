<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
  <img src="images/logo.png" height="50">
  <h2>Product Procurement System</h2>
</header>

<div class="container">
<h3>Dashboard</h3>

<div class="grid">

<div class="card" onclick="location.href='create-order.php'">
    <img src="images/vendor.png" width="80">
    <h4>Create Order</h4>
    <p>Create procurement request</p>
</div>

<div class="card" onclick="location.href='view-orders.php'">
    <img src="images/history.png" width="80">
    <h4>View Orders</h4>
    <p>Check previous orders</p>
</div>

<div class="card" onclick="location.href='inventory.php'">
    <img src="images/product.png" width="80">
    <h4>Inventory</h4>
    <p>View stock status</p>
</div>

</div>
</div>

</body>
</html>