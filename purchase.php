<?php
include 'db.php';
include 'auth.php';

if(isset($_POST['add'])){

$supplier=$_POST['supplier_id'];
$product=$_POST['product_id'];
$qty=$_POST['quantity'];
$price=$_POST['price'];
$delivery=$_POST['delivery_type'];
$location=$_POST['delivery_location'];

$subtotal=$qty*$price;

$conn->query("INSERT INTO orders(supplier_id,total,order_time,delivery_type,delivery_location)
VALUES('$supplier','$subtotal',NOW(),'$delivery','$location')");

$order_id=$conn->insert_id;

$conn->query("INSERT INTO order_items(order_id,product_id,quantity,price,subtotal,total)
VALUES('$order_id','$product','$qty','$price','$subtotal','$subtotal')");

$conn->query("UPDATE inventory SET quantity = quantity + $qty WHERE product_id='$product'");
}

?>

<?php include 'header.php'; ?>

<h2>Purchase</h2>

<form method="POST">

<select name="supplier_id">

<?php
$s=$conn->query("SELECT * FROM suppliers");
while($r=$s->fetch_assoc()){
echo "<option value='{$r['id']}'>{$r['name']}</option>";
}
?>

</select>

<select name="product_id">

<?php
$p=$conn->query("SELECT * FROM products");
while($r=$p->fetch_assoc()){
echo "<option value='{$r['id']}'>{$r['name']}</option>";
}
?>

</select>

<input type="number" name="quantity" placeholder="Quantity" required>

<input type="number" step="0.01" name="price" placeholder="Price" required>

<select name="delivery_type">
<option>Pickup</option>
<option>Delivery</option>
</select>

<input name="delivery_location" placeholder="Delivery Address">

<button name="add">Create Order</button>

</form>

<hr>

<h3>Orders</h3>

<table>

<tr>
<th>ID</th>
<th>Supplier</th>
<th>Total</th>
<th>Date</th>
<th>Location</th>
<th>Map</th>
<th>Action</th>
</tr>

<?php

$q=$conn->query("
SELECT orders.*,suppliers.name as supplier
FROM orders
JOIN suppliers ON orders.supplier_id=suppliers.id
ORDER BY orders.id DESC
");

while($row=$q->fetch_assoc()){

echo "<tr>

<td>{$row['id']}</td>
<td>{$row['supplier']}</td>
<td>{$row['total']}</td>
<td>{$row['order_time']}</td>
<td>{$row['delivery_location']}</td>

<td>
<iframe
width='200'
height='120'
style='border:0'
loading='lazy'
src='https://maps.google.com/maps?q=".urlencode($row['delivery_location'])."&output=embed'>
</iframe>
</td>

<td>
<a href='delete.php?type=order&id={$row['id']}'>Delete</a>
</td>

</tr>";
}
?>

</table>

<script>
let type=document.querySelector("select[name='delivery_type']");
let addr=document.querySelector("input[name='delivery_location']");

type.addEventListener("change",function(){

if(this.value=="Pickup"){
addr.style.display="none";
}else{
addr.style.display="block";
}

});
</script>

<?php include 'footer.php'; ?>