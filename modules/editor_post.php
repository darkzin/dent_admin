<?php
$file_name = $_FILES['thumb']['name'];
$tmp_file = $_FILES['thumb']['tmp_name'];

$file_path = '../../images/event/'.$file_name;
$image_url = '../../images/event/'.$file_name;

$r = move_uploaded_file($tmp_file, $file_path);

$file_size = $_FILES["upload_file"]["size"];

$title = $_POST['title'];
$content = $_POST['content'];

//mysql connect.
$mysqli = new mysqli('localhost', 'dent_admin', 'skyseed', 'dent_mobile');

// 접속 실패시 처리
if(mysqli_connect_errno()) {
  // 여기에 접속 실패시 처리 코드 추가
}

$datetime = strtotime($row->createdate);
$mysqldate = date("Y-m-d H:i:s", $datetime);

$q = "INSERT INTO event (title, content, popup_image, created_at) VALUES ('".$title."', '".$content."', '".$file_name."', '".$mysqldate."')";

$result = $mysqli->query($q);

?>

<?php
echo var_dump($_POST);
echo var_dump($_FILES);
?>