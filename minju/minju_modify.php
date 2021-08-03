<?php include "./minju_config.php";?>
<?php
    $snack = $_REQUEST["snack"];
    $price = $_REQUEST["price"];
    $id = $_REQUEST["id"];
    $sql = "update $mysql_table set snack = '$snack', price = '$price' where id = '$id' ";

    if ($connect->query($sql) === true) {
        echo(json_encode(array( "id" => $id, "price" => $price, "snack" => $snack)));
    } else {
        echo "수정실패";
    }
    $connect->close();
?>

