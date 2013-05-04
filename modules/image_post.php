<?php
$subject = $_POST['subject'];
$content = $_POST['content'];
$event_thumb = $_POST['event_thumb'];

$datetime = strtotime($row->createdate);
$mysqldate = date("Y-m-d H:i:s", $datetime);

$q = "INSERT INTO event(title, content, popup_image) VALUES ('".$subject."', '".$content"', '".$event_thumb."', '".$mysqldate."')";

//mysql connect.
$mysqli = new mysqli('localhost', 'dent_admin', 'skyseed', 'dent_mobile');

// 접속 실패시 처리
if(mysqli_connect_errno()) {
  // 여기에 접속 실패시 처리 코드 추가
}

$result = $mysqli->query($q);
?>