<?php include "./minju_config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>minju snack</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <style>
        body { margin:20px; }
        h1 { border:0; margin:0; padding:0 0 20px; }
        table { border:1px solid #c1c1c1; }
        table th { text-align:left; }
        table td:nth-of-type(3) { text-align:right; }
        .insert-form { padding:10px 0 0; }
    </style>
</head>
<body>
    <h1> MINJU SNACK </h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>이름</th>
                    <th>가격</th>
                    <th>단위</th>
                    <th>삭제</th>
                    <th>수정</th>
                </tr>
            </thead>
            <tbody id="tableBody">
               <?php while ($info = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="td-id">
                           <?=$info["id"]?>
                        </td>
                        <td class="td-snack">
                            <?=$info["snack"]?>
                        </td>
                        <td class="td-price">
                            <?=$info["price"]?>
                        </td>
                        <td>원</td>
                        <td>
                            <form class="delete-form" name="delete-form" method="post">
                                <input type="hidden" name="id" value="<?=$info["id"]?>">
                                <input type="button" value="삭제">
                            </form>
                        </td>
                        <td class="td-modify">
                           <form method="post" class="modify-form">
                               <input type="text" class="snack" name="snack" placeholder="<?=$info["snack"]?>" required>
                               <input type="text" class="price" name="price" placeholder="<?=$info["price"]?>" required>
                               <input type="hidden" name="id" value="<?=$info["id"]?>">
                               <input type="submit" value="수정" class="modify-btn">
                           </form>
                        </td>
                        <td>
                            <form action="./minju_img_insert.php" method="post" class="file-form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=$info["id"]?>">
                                <input type="file" name="upload_image" class="file-input" accept="image/gif, image/jpeg, image/png">
                                <input type="submit" value="업로드" class="file-btn">
                           </form>
                        </td>
                        <td class="td-img">
                            <img style="width:50px; max-height:50px;" src="<?=$info["image_url"]?>" alt="<?=$info["image_name"]?>"/>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <form id="insertForm" class="insert-form" name="insertForm" method="POST">
        <input id="insertName" type="text" name="snack" placeholder="이름을 입력하세요" required>
        <input id="insertPrice" type="text" name="price" placeholder="가격을 입력하세요" required>
        <input type="submit" value="추가" value="post" onclick="AjaxInsert('post');">
    </form>
    <script>
        const tableBody = $("#tableBody"),
              insertName = $("#insertName"),
              insertPrice = $("#insertPrice"),
              insertForm = $("#insertForm");

        /* insert,modify submit event none */
        $(document).on("click","#insertForm, .modify-form",(event) => {
            event.preventDefault();
        });

        /* image file insert Ajax */
        $(document).on("click",".file-btn", function(event){
            event.preventDefault();
            let _this = $(this);
            let formData = new FormData(_this.parent()[0]);
            let img = _this.parents("tr").find("img");
            const $fileInput = _this.parent().find(".file-input");

             // 선택된 파일이 없을 경우에 업로드 클릭이 안되는 조건문
             if( $fileInput.val() !== "" && $fileInput.val() !== null ) {
                $.ajax({
                    type: "post",
                    url : "./minju_img_insert.php",
                    data : formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    // 파일이나 이미지를 서버로 전송할 때 사용하는 방식
                    enctype: 'multipart/form-data',
                    success : function(data, status, xhr) {
                        console.log(data);
                        console.log("이미지 추가 성공");
                        // 서버의 저장한 곳의 경로를 찾아 클릭한 form 현재 td 안의 img src 에 삽입
                        img.attr("src",data.image_url);
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        console.log("이미지 추가 실패");
                    }
                })
             } else {
                alert("파일을 선택하세요!");
             }

        });

        /* insert Ajax */
        function AjaxInsert(method) {
            let inputNumber = isNaN(insertPrice.val());
            let FormData = $("#insertForm").serialize();

            if( insertName.val() === "" || insertPrice.val() === "" ) {
                alert("이름 or 가격을 입력하세요!");

            } else if( inputNumber !== false ) {
                alert("가격 입력란에 숫자를 입력하세요!");
                insertPrice.css("outlineColor","#e20101");

            } else {
                insertPrice.css("outlineColor","#000");
                $.ajax({
                    type: method,
                    url : "./minju_insert.php",
                    data: FormData,
                    dataType:"json",
                    success : function(data) {
                        console.log("추가 성공");
                        console.log(data);
                        let insertInfo = "";
                        const appendText = () => {
                            insertInfo += "<tr>";
                            insertInfo += "<td class='td-id'>"+ data.id +"</td>";
                            insertInfo += "<td class='td-snack'>"+ data.snack +"</td>";
                            insertInfo += "<td class='td-price'>"+ data.price +"</td>";
                            insertInfo += "<td>원</td>";
                            insertInfo += "<td> <form class='delete-form' name='delete-form' method='post'><input type='hidden' name='id' value='"+ data.id +"'> <input type='button' value='삭제'></form> </td>";
                            insertInfo += "<td class='td-modify'> <form method='post' class='modify-form'> <input type='text' class='snack' name='snack' placeholder='"+ data.snack +"' required> <input type='text' class='price' name='price' placeholder='"+ data.price +"' required> <input type='hidden' name='id' value='"+ data.id +"'> <input type='submit' value='수정' class='modify-btn'> </form> </td>";
                            insertInfo += "</tr>";
                            return insertInfo;
                        }
                        tableBody.append(appendText);
                    },
                    error: (data) => {
                        console.log("추가 실패");
                    },
                    complete: () => {
                        insertName.val("");
                        insertPrice.val("");
                    }
                })
            }
        }

        /* delete Ajax */
        $(document).on("click", ".delete-form", function() {
            let _this = $(this);
            let IdData = _this.serialize();
            $.ajax({
                type: "post",
                url : "./minju_delete.php",
                data : IdData,
                dataType: "json",
                success : function(data, status, xhr) {
                    console.log(data);
                    console.log("삭제 성공");
                    _this.parents("tr").remove();
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    console.log("삭제 실패");
                },
                complete: () => {
                    alert("삭제가 완료 되었습니다!");
                }
            })
        });

        /* modify Ajax */
        $(document).on("click", ".modify-btn", function() {
            let _this = $(this);
            let FormData = _this.parent().serialize();

            let snackTd = _this.parents("tr").find(".td-snack"),
                priceTd = _this.parents("tr").find(".td-price"),
                snackInput = _this.parent().find(".snack"),
                priceInput = _this.parent().find(".price");
            let modifyPrice = isNaN(priceInput.val());

            if( snackInput.val() === "" || priceInput.val() === "" ) {
                alert("이름 or 가격을 입력하세요!");

            } else if ( modifyPrice !== false ) {
                alert("숫자 입력하시송");
                priceInput.css("outlineColor","#e20101");

            } else {
                priceInput.css("outlineColor","#000");
                $.ajax({
                    type: "post",
                    url : "./minju_modify.php",
                    data : FormData,
                    dataType: "json",
                    success : function(data, status, xhr) {
                        console.log(data);
                        /* td 테이블에는 입력 */
                        snackTd.text(data.snack);
                        priceTd.text(data.price);
                        /* input에 입력 */
                        snackInput.attr("placeholder",data.snack);
                        priceInput.attr("placeholder",data.price);
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        console.log("수정 실패");
                    },
                    complete: () => {
                        alert("수정이 완료 되었습니다!");
                        snackInput.val("");
                        priceInput.val("");
                    }
                })
            }
        });


    </script>
</body>
</html>
