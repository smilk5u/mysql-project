<?php include "./config.php";?>
<?php
    $snackName = $_REQUEST["snackName"]; // input value "스낵"
    $purchaseQuantity = $_REQUEST["purchaseQuantity"]; // input value "금액"
    $snackPrice = $_REQUEST["snackPrice"]; // input value "금액"
    $thereStock = $_REQUEST["thereStock"]; // input value "금액"
    $fourStock = $_REQUEST["fourStock"]; // input value "금액"

    $sql = "insert into $mysql_table ( name, total_amount, total_price, there_price, four_price ) values ( '$snackName', '$purchaseQuantity', '$snackPrice', '$thereStock', '$fourStock' )";

    if ($connect->query($sql) === true) {
        echo "추가성공";
        echo $fourStock;
    } else {
        echo "추가실패";
    }

    // 접속 끊는 메소드
    $mysqli->close();
?>