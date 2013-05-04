<?php
//require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>

<?php
$file_server_path = realpath(__FILE__);
// PHP 파일 이름이 들어간 절대 서버 경로

$php_filename = basename(__FILE__);
// PHP 파일 이름

$server_path = str_replace(basename(__FILE__), "", $file_server_path);
// PHP 파일 이름을 뺀 절대 서버 경로

$server_root_path = $_SERVER['DOCUMENT_ROOT'];
// 서버의 웹 뿌리(루트) 경로(절대 경로)

$relative_path = eregi_replace("\/[^/]*\.php$", "/", $_SERVER['PHP_SELF']); 
// 웹 문서의 뿌리 경로를 뺀 상대 경로

$relative_file_server_path = $relative_path.$php_filename;
// PHP 파일 이름이 들어간 상대 경로

$base_URL = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$base_URL .= ($_SERVER['SERVER_PORT'] != '80') ? $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'] : $_SERVER['HTTP_HOST'];
// 바탕 URL

$web_path = $base_URL.$relative_path;
// PHP 파일이 있는 곳의 웹 경로

$full_URL = $web_path.$php_filename;
$full_URI = $base_URL.$_SERVER['REQUEST_URI'];

$file_name = $_FILES['event_thumb']['name'];
$tmp_file = $_FILES['event_thumb']['tmp_name'];

$file_path = '../../images/event/'.$file_name;
$image_url = 'images/event/'.$file_name;

$r = move_uploaded_file($tmp_file, $file_path);

$file_size = $_FILES["event_thumb"]["size"];

if( $fh = @fopen( "logfile.txt", "w+" ) )
{
  fputs( $fh, var_dump($_POST), 20 );
  fclose( $fh );
}
echo 'images/event/'.$file_name;
?>

