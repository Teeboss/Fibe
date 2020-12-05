<!DOCTYPE html>
<html lang="en">
<head>
 <title>Infinite scroll pagination using php jquery and ajax - Webprogrammingtutorials.com</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
 $(window).scroll(function(){
 var position = $(window).scrollTop();
 var bottom = $(document).height() - $(window).height();
 if( position == bottom ){
 var row = Number($('#row').val());
 var allcount = Number($('#all_product_count').val());
 var rowperpage = 10;
 row = row + rowperpage;
 if(row <= allcount){
 $('.ajax-load').show();
 var url = "pagination.php";
 $('#row').val(row);
 $.ajax({
 url: url,
 type: 'post',
 data: {row:row},
 success: function(response){
 $('.ajax-load').hide();
 $(".product:last").after(response).show().fadeIn("slow");
 }
 });
 }
 else{
 $('#remove').remove();
 $(".product:last").after('<tr id="remove"><td colspan="4" style="text-align: center;"><b>No Data Available</b></td></tr>');
 }
 }
 });
 });
 </script>
 <style>
 table {
 border-collapse: collapse;
 border-spacing: 0;
 width: 100%;
 border: 1px solid #ddd;
 }
 th,td {
 text-align: left;
 padding: 8px;
 }
 tr:nth-child(even){background-color: #f2f2f2}
 </style>
</head>
<body>
 <?php
 include('config.php'); 
 $row= 0;
 $row_per_page = 10;
 $count_product_query = "SELECT count(*) as allcount FROM products";
 $count_product_result = mysqli_query($conn,$count_product_query);
 $count_product_fetch = mysqli_fetch_array($count_product_result);
 $all_product_count = $count_product_fetch['allcount'];
 ?>
 <div class="container">
 <h2>Product Table</h2>
 <div style="overflow-x:auto;">
 <table class="table table-bordered">
 <thead>
 <tr>
 <th>Product Name</th>
 <th>Description</th>
 <th>Price</th>
 <th>Create</th>
 </tr>
 </thead>
 <tbody>
 <?php
 $query = "select * from products order by id desc limit $row,$row_per_page ";
 $result = mysqli_query($conn,$query);
 while($row = mysqli_fetch_array($result)){
 ?>
 <tr class="product" id="product_<?php echo $row['id']; ?>">
 <td><?php echo $row['title']; ?></td>
 <td><?php echo $row['description']; ?></td>
 <td><?php echo $row['price']; ?></td>
 <td><?php echo $row['created_at']; ?></td>
 </tr>
 <?php } ?>
 </tbody>
 </table>
 <input type="hidden" id="row" value="0">
 <input type="hidden" id="all_product_count" value="<?php echo $all_product_count; ?>">
 </div>
 <div class="row ajax-load" style="display:none;">
 <div class="col-lg-12" style="text-align: center;"><img src="loader.gif" width"100px" height="100px"/></div>
 </div>
 </div>
</body>
</html>

































































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our store</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>  
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
      <div class="nav">
         <ul class="ul_list">
         <li><img src="images/logo_fibe.png" class="nav_logo" alt="logo"></li>
         <li><input type="text" name="search" id="search" class="padding_nav1" placeholder="Search"  value=""  autocomplete="off" >
         <div id="result" class="result"></div>
					  <div class="clearfix"></div>
      </li>
         <li> <p class="padding_nav2">OUR PROFILE</p></li>
         </ul>
      </div>

      <div class="index-body"><br><br><br><b><br><br>
      <div  class="ads">
       
      </div>
      <div class="rowsmi">
   <?php
      include("model/DB.php");
      
      include("model/model.php");
      $rows = 0;
      if (isset($_POST['row'])) {
         $row_perpage = $_POST['row'];
      } else {
         $row_perpage = 4;
      }
      $post_images = DB::query('SELECT * FROM products  ORDER BY id DESC LIMIT '.$rows.','.$row_perpage.'', array(  ));
      $piids = str_shuffle(time()."yuhruireiurejkdsjdjhkfjf");
      
      foreach ($post_images as $pst_img) {
           if ($pst_img['quantity'] == 0) {
              $sold_out = "Sold Out";
           } else {
              $sold_out = "";
           }
             ?> 
            <div class="columnsmi" >
             <a href = <?php echo "product.php?=".$pst_img['id']; ?> >
             <img src= <?php  echo "admin/images/".$pst_img['image']; ?> class= "image"> 
             <ul class='ul_list_body'>
             <li><?php  echo $pst_img['product_name']; ?></li>
             <li><?php  echo $pst_img['price']; ?></li>
             <li style="color : red;"><?php  echo $sold_out; ?></li>
             </ul>
             </a>
            </div>
          
         ";
    <?php  }
       //  echo <div class='container'><img id='image' style='width: 80%;'></div>;
      
   ?> 
   <input type="hidden" id="row" value="0">
 <input type="hidden" id="all_product_count" value="<?php echo count($post_images); ?>">
   </div>
   <div class="row ajax-load" style="display:none;">
 <div class="col-lg-12" style="text-align: center;"><img src="images/loader.gif" width"100px" height="100px"/></div>
   </div>
</body>
<script src="js/jquery.js"></script>
<script>
  $(document).ready(()=>{
   $("#search").keyup(function(){
     	var c = $("#search").val()
     	if (c != "") {
     		$.ajax({
     			url: "model/model.php",
     			type: "POST",
     			data: {c : c},
     			success: function (data) {
     				$("#result").html(data).show()
     			} 
     		})
     	} else {
     	$("#result").html("").hide()		
     	}
     })




   $(window).scroll(()=>{
      var position = $(window).scrollTop();
      var bottom = $(document).height() - $(window).height();
      if (position == bottom) {
         var row = Number($("#row").val())
         var allcount = Number($("#all_product_count").val())
         var rowperpage = 4
         row = row + rowperpage;
         if (row <= allcount) {
            $(".ajax-load").show()
            $("#row").val(row)
            $.ajax({
            url: "index.php",
            type: 'post',
            data: {row:row},
            success: function(response){
            $('.ajax-load').hide();
            $(".columnsmi:last").after(response).show().fadeIn("slow");
            }
            }); 
         } else{
            $('#remove').remove();
            $(".columnsmi:last").after('<tr id="remove"><td colspan="4" style="text-align: center;"><b>No Data Available</b></td></tr>');
            }
         
      }
   })

  })
</script>
</html>





































































<?php
function timeline ($to , $nums) {

   if ($to <= $nums)
    return $to;
   else
     return $nums;
 }
 
if (isset($_GET['p_n'])) {
      include("model/DB.php");
       $_SESSION['p_n'] = $_GET['p_n'];
      include("model/model.php");
      $page_number =$_SESSION['p_n'];;
      $item_count = $_GET['i_c'];
      $from = $page_number*$item_count - ($item_count - 1);
      $to = $page_number*$item_count;
      $response = array();
      $post_image  = DB::query('SELECT * FROM products  ', array(  ));
      $froms = $from -  1;
      if ($page_number > 0 && count($post_image)  ) {
         # code...
      }
      
         $post_images  = DB::query('SELECT * FROM products  ORDER BY id DESC  LIMIT '.$froms.', 4 ', array(  ));
         $nums = count($post_images);
         $piids = str_shuffle(time()."yuhruireiurejkdsjdjhkfjf");
         foreach ($post_images as $pst_img) {
           if ($pst_img['quantity'] == 0) {
              $sold_out = "Sold Out";
           } else {
              $sold_out = "";
           }
             ?> 
            <div class="columnsmi" >
             <a href = <?php echo "product.php?=".$pst_img['id']; ?> >
             <img src= <?php  echo "admin/images/".$pst_img['image']; ?> class= "image"> 
             <ul class='ul_list_body'>
             <li><?php  echo $pst_img['product_name']; ?></li>
             <li><?php  echo $pst_img['price']; ?></li>
             <li style="color : red;"><?php  echo $sold_out; ?></li>
             </ul>
             </a>
            </div>

    <?php  

         
    }
}  else if ($item_count > $nums){
   include("model/DB.php");
  echo "end";
       //  echo <div class='container'><img id='image' style='width: 80%;'></div>;

}
       //  echo <div class='container'><img id='image' style='width: 80%;'></div>;
      
   ?> 