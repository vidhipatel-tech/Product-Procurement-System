<?php
include "db.php";

$type=$_GET['type'];
$id=$_GET['id'];

if($type=="supplier"){

if(isset($_POST['update'])){

$n=$_POST['name'];
$p=$_POST['phone'];
$e=$_POST['email'];
$a=$_POST['address'];

$conn->query("UPDATE suppliers SET name='$n',phone='$p',email='$e',address='$a' WHERE id=$id");

header("Location: suppliers.php");
}

$res=$conn->query("SELECT * FROM suppliers WHERE id=$id");
$row=$res->fetch_assoc();
?>

<form method="POST">

<input name="name" value="<?php echo $row['name']; ?>">
<input name="phone" value="<?php echo $row['phone']; ?>">
<input name="email" value="<?php echo $row['email']; ?>">
<input name="address" value="<?php echo $row['address']; ?>">

<button name="update">Update Supplier</button>

</form>

<?php
}

if($type=="product"){

if(isset($_POST['update'])){

$n=$_POST['name'];
$p=$_POST['price'];

$conn->query("UPDATE products SET name='$n',price='$p' WHERE id=$id");

header("Location: products.php");
}

$res=$conn->query("SELECT * FROM products WHERE id=$id");
$row=$res->fetch_assoc();
?>

<form method="POST">

<input name="name" value="<?php echo $row['name']; ?>">
<input name="price" value="<?php echo $row['price']; ?>">

<button name="update">Update Product</button>

</form>

<?php
}
?>