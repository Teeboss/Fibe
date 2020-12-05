
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
     
    
   <input type="hidden" id="row" value="0">
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




  

  })
         

               var p_n = 1
               var i_c = 4
               $.ajax({
                  url: "data.php?p_n="+p_n+"&i_c="+4,
                  type: 'GET',
                  success: function(response){
                  $('.ajax-load').hide();
                  $(".rowsmi").append(response);
                  }
               })



               $(window).scroll(()=>{

               var position = $(window).scrollTop() ;
               var bottom = $(document).height() - $(window).height();
               var working = false;
               var nextPage = p_n+1
               if (position == bottom) {
                  $('.ajax-load').show();
            if (working == false) {    
                     working = true;
                     $(".ajax-load").show()
                     $.ajax({
                     url: "data.php?p_n="+nextPage+"&i_c="+i_c,
                     type: 'GET',
                     success: function(response){
                        if (response == "end") {
                         alert("no more data")  
                        } else {
                     $('.ajax-load').hide();
                     $(".rowsmi").append(response);
                     p_n = nextPage
                     setTimeout(()=> {
                        working = false
                     } , 500)
                     }
                  }
                     }); 
               }
            }
            })


    </script>
</html>