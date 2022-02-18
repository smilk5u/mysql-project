<?php
    $connect = mysqli_connect( 'localhost', 'ample80', 'qlalf123!@@', 'ample80' ); // 데이터베이스 연결
    $table = "snack_21st_july_minju"; // 민주 스낵테이블
    $tableLive = "snack_21st_july_minju_live"; // 민주 스낵테이블
    $query = "SELECT * FROM $table"; // 전체테이블 레코드 가져오기
    $result = mysqli_query($connect, $query);  //쿼리 결과를 담기

    // DB 데이터 베이스 연결 성공,실패
    /* if ($connect->connect_errno) {
       echo "연결실패!";
    } else {
       echo "연결성공!";
    } */

    // 기존 테이블 불러오기/스낵 테이블 배열 안에 항목 추가하기 ---------------------------------------------------------
   $snackArray = array();
    while( $snack = mysqli_fetch_array( $result ) ) {
        array_push( $snackArray, [
            "unique_id" => "$snack[unique_id]",
            "category" => "$snack[category]",
            "name" => "$snack[name]",
            "total_amount" => "$snack[total_amount]",
            "total_price" => $snack["total_price"], "good" => $snack[good],
            "dis_like" => "$snack[dis_like]", "image" => $snack[image]
        ]);
    }
    echo json_encode( $snackArray, JSON_UNESCAPED_UNICODE );

    // DB 연결 종료
    $connect->close();
?>