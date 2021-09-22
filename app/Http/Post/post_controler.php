<head>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<div class="noidung">
<table border="1">
<tr>
<td>Tiêu đề:</td>
<td>Nội dung:</td>
<td>Hình ảnh:</td>
<td>Sửa:</td>
<td>Xoá:</td>
</tr>
<?php
require 'posts_connect.php';
// Up bài viết
if (isset($_POST['btn_submit'])) {
    $id=$_GET['id'];
    $title = $_POST['title'];
$url = $_POST['url'];
    $content = $_POST['content'];
// Upload ảnh 
    $image = $_FILES['image']['name'];
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
           
    $expensions= array("jpeg","jpg","png");
           
    if(in_array($file_ext,$expensions)=== false){
        $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
           
    if($file_size > 2097152) {
        $errors[]='Kích thước file không được lớn hơn 2MB';
    }
    $target = "photo/".basename($image);
    $sql = "INSERT INTO posts( title,url,content,image ) VALUES ( '$title','$url', '$content', '$image' )";
    if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES['image']['tmp_name'], $target) && empty($errors)==true) {
            echo '<script language="javascript">alert("Đăng bài viết thành công!");</script>';
            } else{
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý");</script>';
    }
}
    $sql = "SELECT * FROM posts WHERE id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td><h2>".$row['title']."</h2></td>";
        echo "<td><p>".$row['content']."</p></td>";
        echo "<td><img src='photo/".$row['image']."' height=100></td>";
        echo '<td><a href="posts_edit.php?id='.$row['id'].'">Edit</a></td> | <td><a href="posts_delete.php?id='.$row['id'].'">Delete</a></td>';
        echo "</tr>";
    }
?>
</table>
</div>
</body>
</html>