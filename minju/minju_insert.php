<?php include "./minju_config.php";?>
<?php
    $snack = $_REQUEST["snack"]; // input value "스낵"
    $price = $_REQUEST["price"]; // input value "금액"

    // minju3 테이블에 스낵,금액 행에 value 값을 삽입해라
    $sql = "insert into $mysql_table ( snack, price ) values ( '$snack', '$price' )";
    // $result = mysqli_query($connect,$last_table);
    // $a = mysqli_fetch_assoc($result);
    // echo $a[id];
    // id 칼럼 내림차순 출력 1개 (제일 마지막 id 값 추출)


    if ($connect->query($sql) === true) {
        $last_table = "select * from $mysql_table order by id DESC LIMIT 1";
        // 데이터 베이스 쿼리를 실행하는 문
        $result = mysqli_query($connect, $last_table);
        // mysqli_query 통해 얻은 리절트 셋 레코드를 1개씩 리턴해주는 함수이다.
        $lastId = mysqli_fetch_assoc($result);
        echo(json_encode(array( "id" => $lastId[id], "price" => $price, "snack" => $snack)));
    } else {
        echo "추가실패";
    }
    // DB 연결 종료
    $connect->close();
?>
