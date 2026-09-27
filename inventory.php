<?php
include 'db.php';
include 'auth.php';
?>

<?php include 'header.php'; ?>

<h2>Inventory</h2>

<table>

<tr>
<th>ID</th>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total Amount</th>
<th>Status</th>
</tr>

<?php

$res=$conn->query("
SELECT products.id,
products.name,
products.price,
inventory.quantity
FROM products
JOIN inventory ON products.id = inventory.product_id
");

while($row=$res->fetch_assoc()){

$q=$row['quantity'];
$price=$row['price'];
$total=$price*$q;

$total_formatted="₹".number_format($total);

if($q==0){
$status="<span style='color:red;'>Out of Stock</span>";
}
else if($q<10){
$status="<span style='color:orange;'>Low Stock</span>";
}
else{
$status="<span style='color:green;'>In Stock</span>";
}

echo "<tr>

<td>{$row['id']}</td>
<td>{$row['name']}</td>
<td>₹".number_format($row['price'])."</td>
<td>{$row['quantity']}</td>
<td>{$total_formatted}</td>
<td>$status</td>

</tr>";
}

?>

</table>

<?php include 'footer.php'; ?>