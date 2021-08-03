<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>minju 첨부파일</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <style>
        .image-container .img-wrap { width:200px; height:200px; overflow:hidden; background-color:#eee; }
        .img-wrap img { width:100%; }
        .image-container input { display:block; }
        .image-popup { width:100%; height:100%; overflow:hidden; position:absolute; top:0; left:0; background-color:rgba(0,0,0, .85); display: flex; justify-content: center; align-items: center; display:none; }
        .image-popup img { width:500px; }
    </style>
</head>
<body>
    <div class="image-container">
        <div class="img-wrap" id="imgWrap">
            <img class="preview-image">
        </div>
        <input type="file" id="inputImage">
    </div>
    <div class="image-popup" id="popupImage">
        <img class="preview-image" id="eventImg">
    </div>
    <script>
        const inputImage = document.getElementById("inputImage"),
             popupImage = document.getElementById("popupImage"),
             imgWrap = document.getElementById("imgWrap"),
             eventImg = document.getElementById("eventImg");
        const previewImage = $(".preview-image");

        function readImage(input) {
            console.log(input.files);
            // 인풋 태그에 파일이 있는 경우
            if(input.files && input.files[0]) {
                // 이미지 파일인지 검사 (생략)
                // FileReader 인스턴스 생성 (업로드된 파일을 읽을 수 있다.  컴퓨터에 저장)
                const reader = new FileReader();
                // 이미지가 로드가 된 경우
                reader.onload = e => {
//                     previewImage.src = e.target.result
                    previewImage.attr("src",e.target.result);
                }
                // reader가 이미지 읽도록 하기
                reader.readAsDataURL(input.files[0]);
            }
        }
        /* input 의 이미지가 바뀔 시에 readImage 함수가 실행된다 */
        inputImage.addEventListener("change", e => {
            console.log("input 이 바뀜");
            readImage(e.target)
        });
        imgWrap.addEventListener("click", e => {
            popupImage.style.display = "flex";
        });
        popupImage.addEventListener("click", e => {
            popupImage.style.display = "none";
        });
    </script>
</body>
</html>