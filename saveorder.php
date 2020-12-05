<?php
session_start();

include('config.php');
$memid=$_POST['id'];
$qty=$_POST['qty'];
$name=$_POST['name'];
$id=$_POST['but'];
$transcode=$_POST['transcode'];
$ingre=$_POST['ingre'];
$ids=$_POST['ids'];

$resultq = mysqli_query($db,"SELECT * FROM inventory WHERE product_id LIKE '%".$id."%'");

			while($rows = mysqli_fetch_array($resultq))
			{
			$pql=$rows['qtyleft'];
			$pqs=$rows['qtysold'];
			$left=$pql-$qty;
			$solds=$pqs+$qty;
			mysqli_query($db,"UPDATE inventory SET qtyleft='$left', qtysold='$solds' WHERE product_id LIKE '%".$id."%'");
			}


$resulta = mysqli_query($db,"SELECT * FROM marias_products WHERE id = '$id'");

			while($row = mysqli_fetch_array($resulta))
			{
			$pprice=$row['product_price'];
			$psize=$row['product_size_name'];
			}
$total=$pprice*$qty;
mysqli_query($db,"INSERT INTO orderdetails (customer, qty, price, total, pizzaname, pizasize, transactioncode) VALUES('$memid', '$qty', '$pprice', '$total', '$name', '$psize', '$transcode')");
header("location: order.php");
?> 