<?php include "./minju_config.php";?>
<?php
    $image_name = $_FILES['upload_image']['name']; // 업로드한 파일명
    $image_tmp_name = $_FILES['upload_image']['tmp_name']; // 임시 디렉토리에 저장된 파일명
    $image_size = $_FILES['upload_image']['size']; // 업로드한 파일의 크기
    $image_type = $_FILES['upload_image']['type'];  // 업로드한 파일의 MIME Type
    $id = $_REQUEST["id"]; //아이디
    $uploadTarget = './imgFile/'.$image_name;  //서버 이미지 경로
    // 이미지 DB 저장
    $sql = "UPDATE $mysql_table SET image_name = '$image_name', image_size = '$image_size', image_type = '$image_type', image_url = '$uploadTarget'  WHERE id = $id";
    // 이미지 서버 임시 디렉토리에 저장
    $d = move_uploaded_file( $image_tmp_name, $uploadTarget );

    if ($connect->query($sql) === true) {
         echo(json_encode(array( "image_name" => $image_name, "image_url" => $uploadTarget )));
    } else {
        echo "수정실패";
    }
    $connect->close();
?>

