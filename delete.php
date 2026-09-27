<?php
include "db.php";

$type = $_GET['type'];
$id = $_GET['id'];

if($type == "supplier"){

    // delete order items of that supplier's orders
    $orders = $conn->query("SELECT id FROM orders WHERE supplier_id=$id");
    while($o = $orders->fetch_assoc()){
        $oid = $o['id'];
        $conn->query("DELETE FROM order_items WHERE order_id=$oid");
    }

    // delete orders
    $conn->query("DELETE FROM orders WHERE supplier_id=$id");

    // get products of supplier
    $products = $conn->query("SELECT id FROM products WHERE supplier_id=$id");
    while($p = $products->fetch_assoc()){
        $pid = $p['id'];
        $conn->query("DELETE FROM inventory WHERE product_id=$pid");
    }

    // delete products
    $conn->query("DELETE FROM products WHERE supplier_id=$id");

    // delete supplier
    $conn->query("DELETE FROM suppliers WHERE id=$id");

    header("Location: suppliers.php");
    exit();
}


if($type == "product"){

    // delete order items containing that product
    $conn->query("DELETE FROM order_items WHERE product_id=$id");

    // delete inventory record
    $conn->query("DELETE FROM inventory WHERE product_id=$id");

    // delete product
    $conn->query("DELETE FROM products WHERE id=$id");

    header("Location: products.php");
    exit();
}


if($type == "order"){

    // delete order items
    $conn->query("DELETE FROM order_items WHERE order_id=$id");

    // delete order
    $conn->query("DELETE FROM orders WHERE id=$id");

    header("Location: purchase.php");
    exit();
}
?>