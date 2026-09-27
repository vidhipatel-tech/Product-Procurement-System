<?php
include 'db.php';
include 'auth.php';

if(isset($_POST['add'])){

$name=$_POST['name'];
$price=$_POST['price'];
$supplier=$_POST['supplier'];

$stmt=$conn->prepare("INSERT INTO products(name,price,supplier_id) VALUES(?,?,?)");
$stmt->bind_param("sdi",$name,$price,$supplier);
$stmt->execute();

$pid=$conn->insert_id;

$conn->query("INSERT INTO inventory(product_id,quantity) VALUES('$pid',0)");
}

$sup=$conn->query("SELECT * FROM suppliers");

$res=$conn->query("
SELECT products.id,products.name,products.price,suppliers.name as sname
FROM products
JOIN suppliers ON products.supplier_id=suppliers.id
");
?>

<?php include 'header.php'; ?>

<h2>Products</h2>

<form method="POST">

<input name="name" placeholder="Product Name" required>
<input name="price" placeholder="Price">

<select name="supplier">

<?php while($s=$sup->fetch_assoc()){ ?>

<option value="<?php echo $s['id']; ?>">
<?php echo $s['name']; ?>
</option>

<?php } ?>

</select>

<button name="add">Add Product</button>

</form>

<table>

<tr>
<th>ID</th>
<th>Product</th>
<th>Price</th>
<th>Supplier</th>
<th>Action</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $row['sname']; ?></td>

<td>
<a href="edit.php?type=product&id=<?php echo $row['id']; ?>">Edit</a> |
<a href="delete.php?type=product&id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

<?php include 'footer.php'; ?>