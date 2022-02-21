<?php
    $connect = mysqli_connect( 'localhost', 'ample80', 'qlalf123!@@', 'ample80' ); // 데이터베이스 연결
    $table = "snack_21st_july_minju"; // 민주 스낵테이블
    $tableLive = "snack_21st_july_minju_live"; // 민주 스낵테이블 라이브 재고
    $query = "SELECT * FROM $table"; // 전체테이블 레코드 가져오기
    $result = mysqli_query($connect, $query);  //쿼리 결과를 담기



    // insert
    if ( $_REQUEST["role"] === "insert" ) {
        $category = $_REQUEST["category"]; //카테고리
        $snackName = $_REQUEST["snackName"]; //과자이름
        $purchaseQuantity = $_REQUEST["purchaseQuantity"]; //구매수량
        $snackPrice = $_REQUEST["snackPrice"]; //총 구매가격
        $thereStock = $_REQUEST["thereStock"]; //3층재고
        $fourStock = $_REQUEST["fourStock"]; //4층재고
        $therePrice = $snackPrice / $purchaseQuantity * $thereStock; // 3층 가격
        $fourPrice = $snackPrice / $purchaseQuantity * $fourStock;// 4층 가격

        $sql = "insert into $table ( unique_id, category, name, total_price, three_price, four_price, total_amount, three_amount, four_amount ) values ( '$uniqueId', '$category', '$snackName', '$purchaseQuantity', '$therePrice', '$fourPrice', '$snackPrice', '$thereStock', '$fourStock' )";
        if ($connect->query($sql) === true) {
            $last_table = "select * from $table order by unique_id DESC LIMIT 1";
            $result = mysqli_query($connect, $last_table);
            $uniqueId = mysqli_fetch_assoc($result);
            echo(json_encode(array( "unique_id" => $uniqueId[unique_id], "category" => $category, "name" => $snackName, "total_price" => $purchaseQuantity, "total_amount" => $snackPrice, "three_amount" => $thereStock, "four_amount" => $fourStock, )));
        }
    }



    // delete
    if ( $_REQUEST["role"] === "delete" ) {
        $uniqueId = $_REQUEST["unique_id"];
        $sql = "delete from $table where unique_id = $uniqueId";
        if ($connect->query($sql) === true) {
            echo(json_encode(array( "unique_id" => $uniqueId )));
        } else {
            echo "삭제실패";
        }
    }















    // DB 연결 종료
    $connect->close();
?>