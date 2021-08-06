<?php
    $mysql_hostname = "localhost";
    $mysql_username = "ample80";
    $mysql_password = "qlalf123!@@";
    $mysql_database = "ample80";
    $mysql_table = "snack_21st_july_minju";
    $query = "SELECT * FROM $mysql_table";
    $connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
    mysqli_select_db($connect, $mysql_database) or die("DB 선택 실패");
    $result = mysqli_query($connect, $query);

    /*if ($connect->connect_errno) {
        echo "연결실패!";
    } else {
        echo "연결성공!";
    }*/

    /*insert*/ //image 포함




    // 접속 끊는 메소드
    /*$mysqli->close();*/
?>