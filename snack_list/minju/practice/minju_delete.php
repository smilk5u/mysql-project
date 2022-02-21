<?php include "./minju_config.php";?>
<?php
    $id = $_REQUEST["id"];
    // 테이블의 행을 제거한다
    $sql = "delete from $mysql_table where id = $id";

    if ($connect->query($sql) === true) {
        echo(json_encode(array( "id" => $id )));
    } else {
        echo "삭제실패";
    }
    $connect->close();
?>