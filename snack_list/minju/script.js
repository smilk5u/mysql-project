/*'use strict';*/
const $tableBody = $("#tableBody");

/* insert,modify submit event none */
$("#insertSubmit").on("click", (event) => {
    event.preventDefault();
});
$(".insert_button").on("click", () => {
    $(".bottom_popup").css("display","block");
});
$(".close_btn").on("click", () => {
    $(".bottom_popup").css("display","none");
});

// Default / Load
$.ajax({
    type: "post",
    url : "./default.php",
    dataType: "json",
    success : function(data) {
        console.log("기본데이터 추가 성공");
        for( let key in data ) {
            let tableInfo = "";
            const appendText = () => {
                tableInfo += `<tr>`;
                tableInfo += ` <td scope="row" class="td-id"> ${data[key].unique_id} </td> `;
                tableInfo += `<td scope="row" class="category"> ${data[key].category} </td>`;
                tableInfo += `<td scope="row" class="snack-name"> ${data[key].name} </td>`;
                tableInfo += `<td scope="row" class="total-amount"> ${data[key].total_amount}개 </td>`;
                tableInfo += `<td scope="row" class="total-amount">${data[key].total_amount}개 </td>`;
                tableInfo += `<td scope="row" class="total-price"> ${data[key].total_price}원 </td>`;
                tableInfo += `<td scope="row" class="good"> ${data[key].good}개 (10%) </td>`;
                tableInfo += `<td scope="row" class="dis-like"> ${data[key].dis_like}개 (10%) </td>`;
                tableInfo += `<td class="preference"> <button class="like-btn" type="button"> 좋아요 </button> <button class="dont-like-btn" type="button"> 싫어요</button> </td>`;
                tableInfo += `
              <td class="manager"> 
                    <button class="modify-btn" type="button"> 수정 </button>
                       <form class="delete-form" name="delete-form" method="post">
                            <input type="button" name="role" value="delete">
                            <input type="hidden" name="uniqueId" value="${data[key].unique_id}">
                        </form>
                </td>`;
                tableInfo += `</tr>`;
                return tableInfo;
            }
            $tableBody.append(appendText);
        }
    },
    error: () => {
        console.log("기본데이터 추가 실패");
    }
})

// Insert
function insertForm(dataType) {
    console.log($("#snackInsert").serialize());
    $.ajax({
        type: dataType,
        url : "./config.php",
        data : $("#snackInsert").serialize(),
        dataType: "json",
        success : function(data) {
            console.log("insert 데이터 전달 성공");
            console.log(data);
            let tableInfo = "";
            const appendText = () => {
                tableInfo += `<tr>`;
                tableInfo += `<td scope="row" class="td-id"> ${data.unique_id} </td>`;
                tableInfo += `<td scope="row" class="category"> ${data.category} </td>`;
                tableInfo += `<td scope="row" class="snack-name"> ${data.name} </td>`;
                tableInfo += `<td scope="row" class="total-amount"> ${data.total_amount}개 </td>`;
                tableInfo += `<td scope="row" class="total-amount">${data.total_amount}개 </td>`;
                tableInfo += `<td scope="row" class="total-price"> ${data.total_price}원 </td>`;
                tableInfo += `<td scope="row" class="good"> 0개 (0%) </td>`;
                tableInfo += `<td scope="row" class="dis-like"> 0개 (0%) </td>`;
                tableInfo += `<td class="preference"> <button class="like-btn" type="button"> 좋아요 </button> <button class="dont-like-btn" type="button"> 싫어요</button> </td>`;
                tableInfo += `<td class="manager"> <button class="modify-btn" type="button"> 수정 </button>
                  <button class="delete-btn" type="button">
                   삭제
                   <input type="text" name="uniqueId" value="${data.unique_id}">
                   </button> 
                  </td>`;
                tableInfo += `</tr>`;
                return tableInfo;
            }
            $tableBody.append(appendText);
        },
        error: () => {
            console.log("insert 데이터 전달 실패");
        }
    })
}

// Delete
$(document).on("click", ".delete-form", function(){
    let _this = $(this);
    let IdData = _this.serialize();
    console.log(IdData);
    $.ajax({
        type: "post",
        url : "./config.php",
        data: IdData,
        dataType: "text",
        success : function(data) {
            console.log(data);
            _this.parents("tr").remove();
            // alert("삭제되었습니다.")
        },
        error: () => {
            console.log("delete 데이터 전달 실패");
        }
    })
})









































