<?php include "./config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>minju table</title>
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
						<td scope="row"> <?=$info["total_amount"]?> 개 </td>
						<td scope="row"> <?=$info["total_amount"]?> 개 </td>
						<td scope="row"> <?=$info["total_price"]?> 원 </td>
						<td scope="row"> <?=$info["good"]?> </td>
						<td scope="row"> <?=$info["dis_like"]?> </td>
						<td class="preference">
						    <button class="like-btn" type="button"> 좋아요 </button>
						    <button class="dont-like-btn" type="button"> 싫어요 </button>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
<script>

    /*전체 클릭시*/


    /*3층 클릭시*/
    /*4층 클릭시*/

</script>
</body>
</html>
