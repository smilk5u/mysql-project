<?php include "./config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>MINJU Snack</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/common.css">

	<script type="text/javascript" defer src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" defer src="//maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrap">
	<header>
		<h1> AMPLE SNACK LIST </h1>
		<div class="menu">
			<ul class="floors_wrap">
				<li class="active">
					<button>3 / 4층</button>
				</li>
				<li>
					<button>3층</button>
				</li>
				<li>
					<button>4층</button>
				</li>
			</ul>
			<ul class="categories_wrap">
				<li class="active">
					<button>전체</button>
				</li>
				<li>
					<button>과자</button>
				</li>
				<li>
					<button>사탕 / 껌</button>
				</li>
				<li>
					<button>초콜렛</button>
				</li>
				<li>
					<button>커피</button>
				</li>
				<li>
					<button>시리얼</button>
				</li>
				<li>
					<button>음료</button>
				</li>
				<li>
					<button>아이스크림</button>
				</li>
				<li>
					<button>간식 외</button>
				</li>
			</ul>
		</div>
	</header>
	<div class="container container1">
		<table class="table table-striped">
			<thead>
			<tr>
				<th scope="col">카테고리</th>
				<th scope="col">과자이름</th>
				<th scope="col">구매 수량</th>
				<th scope="col">현재 재고</th>
				<th scope="col">총 구매 가격</th>
				<th scope="col">좋아요</th>
				<th scope="col">싫어요</th>
				<th scope="col">선호도 조사</th>
			</tr>
			</thead>
			<tbody id="tableBody">
                <?php while ($info = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td scope="row"> <?=$info["category"]?> </td>
                        <td scope="row"> <?=$info["name"]?> </td>
                        <td scope="row"> <?=$info["total_amount"]?> 개</td>
                        <td scope="row"> <?=$info["total_amount"]?> 개</td>
                        <td scope="row"> <?=$info["total_price"]?> 원</td>
                        <td scope="row"> <?=$info["good"]?> </td>
                        <td scope="row"> <?=$info["dis_like"]?> </td>
                        <td class="preference">
                            <button class="like-btn" type="button"> 좋아요</button>
                            <button class="dont-like-btn" type="button"> 싫어요</button>
                        </td>
                    </tr>
                <?php }?>
			</tbody>
		</table>
		<div class="bottom_popup">
			<form id="snackInsert" class="insert-form" name="snackInsert" method="POST">
				<fieldset>
					<div>
						<select name="category" id="category" class="category_select">
							<option value="">전체</option>
							<option value="">과자</option>
							<option value="">사탕 / 껌</option>
							<option value="">초콜렛</option>
							<option value="">커피</option>
							<option value="">시리얼</option>
							<option value="">음료</option>
							<option value="">아이스크림</option>
							<option value="">간식 외</option>
						</select>
						<input id="snackName" type="text" name="snackName" placeholder="과자 이름을 입력하세요." required>
						<input id="purchaseQuantity" type="number" name="purchaseQuantity" placeholder="구매 수량을 입력하세요." required>
						<input id="snackPrice" type="number" name="snackPrice" placeholder="총 구매 가격을 입력하세요." required>
					</div>
					<div>
						<input id="thereStock" type="number" name="thereStock" placeholder="3층 재고를 입력하세요." required>
						<input id="fourStock" type="number" name="fourStock" placeholder="4층 재고를 입력하세요." required>
						<input type="submit" value="추가" value="post" onclick="insert('post');">
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script>

	/*전체 클릭시*/
	function insert(method) {
	    console.log(method);
        $.ajax({
            type: method,
            url : "./config.php",
            data: $("#snackInsert").serialize(),
            dataType:"text",
            success : function(data, status, xhr) {
                console.log(data);
                console.log("추가 성공");
            },
            error: (jqXHR, textStatus, errorThrown) => {
                console.log("추가 실패");
            }
        })
	}


	/*3층 클릭시*/
	/*4층 클릭시*/

</script>
</body>
</html>
