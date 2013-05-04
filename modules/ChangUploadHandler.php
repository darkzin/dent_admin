<?php
require('UploadHandler.php');

class ChangUploadHandler extends UploadHandler {

  public function handle_file_upload($uploaded_file, $name, $size, $type, $error,
					$index = null, $content_range = null) {
    parent::handle_file_upload($uploaded_file, $name, $size, $type, $error,
			       $index, $content_range);

    /*    //mysql connect.
    $mysqli = new mysqli('localhost', 'dent_admin', 'skyseed', 'dent_mobile');

    // 접속 실패시 처리
    if(mysqli_connect_errno()) {
      // 여기에 접속 실패시 처리 코드 추가
    }

    $fileName = $this->get_file_name($name, $type, $index, $content_range);

    $result = $mysqli->query("SELECT * FROM slide");

    $mysqli->query("insert into slide set name = '".$fileName."', priority = ".($result->num_rows + 1).", full_tag = '<img src=\"slide_images/".$fileName."\"/>'");


    // 데이터 연결을 해제합니다. (개발자가 명시해도 되고, 안해도 PHP가 알아서 해제해 줍니다.)
    $mysqli->close();*/
    }

  public function delete($print_response = true) {
    parent::delete($print_response);
    
    /*//mysql connect.
    $mysqli = new mysqli('localhost', 'dent_admin', 'skyseed', 'dent_mobile');

    // 접속 실패시 처리
    if(mysqli_connect_errno()) {
      // 여기에 접속 실패시 처리 코드 추가
    }

    $fileName = $this->get_file_name_param();
    $mysqli->query("delete from slide where name ='".$fileName."'");*/
    }
}
?>