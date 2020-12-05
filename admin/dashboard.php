<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" id="form">
    <input type="file" name="upload" id="upload" >
    <input type="text" name="product_name" id="product_name">
    <input type="text" name="price"  id="price">
    <input type="text" name="quantity"  id="quantity">
    <button>SUBMIT PRODUCT</button>
    </form>
</body>
<script src="../js/jquery.js"></script>
<script>
     var price = document.getElementById("price")
     price.addEventListener("keyup" , () => {
         price.value.split(/(?=(?:\d{3})+$)/).join(",")
     })
   
    
    var form = document.getElementById("form")
    form.addEventListener("submit" , (e) => {
        e.preventDefault()
        $.ajax({
        url: "controller.php",
        type: "POST",
        data: new FormData(document.getElementById("form")),
        processData: false,
        cache: false,
        contentType: false,
        error: function name(params) {
            alert("could not connect");
        },
        success: function (data) {
            if (data ==  "success") {
                location.reload()
            } else {
                alert(data)
            }
        }
    })	
    })
</script>
</html>