<?php
include "db.php";
include "auth.php";

$suppliers = $conn->query("SELECT COUNT(*) as total FROM suppliers")->fetch_assoc()['total'];
$products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
$inventory = $conn->query("SELECT COUNT(*) as total FROM inventory")->fetch_assoc()['total'];
?>

<?php include 'header.php'; ?>

<h2>Dashboard</h2>

<div class="card-container">

<div class="card" onclick="location.href='suppliers.php'">
<img src="/PPS/images/vendor.png">
<h3>Suppliers</h3>
<div class="count"><?php echo $suppliers; ?></div>
<p>Manage supplier records</p>
</div>

<div class="card" onclick="location.href='products.php'">
<img src="/PPS/images/product.png">
<h3>Products</h3>
<div class="count"><?php echo $products; ?></div>
<p>Manage product catalog</p>
</div>

<div class="card" onclick="location.href='purchase.php'">
<img src="/PPS/images/order.png">
<h3>Purchases</h3>
<div class="count"><?php echo $orders; ?></div>
<p>Create procurement orders</p>
</div>

<div class="card" onclick="location.href='inventory.php'">
<img src="/PPS/images/history.png">
<h3>Inventory</h3>
<div class="count"><?php echo $inventory; ?></div>
<p>Check stock levels</p>
</div>

</div>

<h3>Low Stock Alert</h3>

<table>
<tr>
<th>Product</th>
<th>Stock</th>
</tr>

<?php

$low = $conn->query("
SELECT products.name, inventory.quantity
FROM inventory
JOIN products ON inventory.product_id = products.id
WHERE inventory.quantity < 10
");

while($row=$low->fetch_assoc()){
echo "<tr style='background:#fdecea'>
<td>{$row['name']}</td>
<td>{$row['quantity']}</td>
</tr>";
}

?>

</table>

<h3>Recent Orders</h3>

<table>

<tr>
<th>ID</th>
<th>Supplier</th>
<th>Total</th>
<th>Date</th>
</tr>

<?php

$recent = $conn->query("
SELECT orders.id, suppliers.name, orders.total, orders.order_time
FROM orders
JOIN suppliers ON orders.supplier_id = suppliers.id
ORDER BY orders.id DESC
LIMIT 5
");

while($row=$recent->fetch_assoc()){
echo "<tr>
<td>{$row['id']}</td>
<td>{$row['name']}</td>
<td>{$row['total']}</td>
<td>{$row['order_time']}</td>
</tr>";
}

?>

</table>

<?php include 'footer.php'; ?>