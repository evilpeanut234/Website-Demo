<?php
include 'posts_connect.php';
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM posts WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
echo "Xoá thành công!";
} else {
echo "Error updating record: " . $conn->error;
}
$conn->close();
}
header("Location: posts_add.php");
?>