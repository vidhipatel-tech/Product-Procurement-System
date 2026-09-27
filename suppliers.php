<?php
include 'db.php';
include 'auth.php';

if(isset($_POST['add'])){

$n=$_POST['name'];
$p=$_POST['phone'];
$e=$_POST['email'];
$a=$_POST['address'];

$stmt=$conn->prepare("INSERT INTO suppliers(name,phone,email,address) VALUES(?,?,?,?)");
$stmt->bind_param("ssss",$n,$p,$e,$a);
$stmt->execute();
}

$res=$conn->query("SELECT * FROM suppliers");
?>

<?php include 'header.php'; ?>

<h2>Suppliers</h2>

<form method="POST">

<input name="name" placeholder="Supplier Name" required>
<input name="phone" placeholder="Phone">
<input name="email" placeholder="Email">
<input name="address" placeholder="Address">

<button name="add">Add Supplier</button>

</form>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Action</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['address']; ?></td>

<td>
<a href="edit.php?type=supplier&id=<?php echo $row['id']; ?>">Edit</a> |
<a href="delete.php?type=supplier&id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

<?php include 'footer.php'; ?>