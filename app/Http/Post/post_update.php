<?php
if (isset($_POST['update_posts'])){
$id=$_GET['id'];
$title=$_POST['title'];
$url=$_POST['url'];
$content=$_POST['content'];
$image=$_POST['image'];
 
$sql = "UPDATE `posts` SET title='$title', '$url', content='$content', image='$image' WHERE id='$id'";
 
if ($conn->query($sql) === TRUE) {
echo "<b>Record updated successfully</b>";
} else {
echo "Error updating record: " . $conn->error;
}
 
$conn->close();
}
?>