<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our store</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>  
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/w3.css">
</head>
<body>
      <div class="nav">
         <ul class="ul_list">
         <li><img src="images/logo_fibe.png" class="nav_logo" alt="logo"></li>
         <li><input  type="hidden" name="search" id="search" class="padding_nav1" placeholder="Search"  value=""  autocomplete="off" >
         <div id="result" class="result"></div>
					  <div class="clearfix"></div>
      </li>
         <li> <p class="padding_nav2" style="margin-left: 754px;">OUR PROFILE</p></li>
         </ul>
      </div>

      <div class="i-body" style="height: 1000px;"><br><br><br><b><br><br>
      <div  class="ads">
       
      </div>
      <div class="rowsmi" style="margin-left: 400px;">
   <?php
   if (isset($_GET['post'])) {
     $postid =  $_GET['post'];
  
      include("model/DB.php");
      
      include("model/model.php");
      $post_images = DB::query('SELECT * FROM products  WHERE id = :postid ', array(':postid' => $postid ));
      $piids = str_shuffle(time()."yuhruireiurejkdsjdjhkfjf");
              if ($post_images[0]['quantity'] == 0) {
                $sold_out = "Sold Out";
                $type = "none";
            } else {
                $sold_out = "";
                $type = "block";
              }
     
          echo "
            <div class='columnsmi' >
             <img src='admin/images/".$post_images[0]['image']."' id = '".$piids."' class= 'image'> 
             <ul class='ul_list_body'>
             <li>".$post_images[0]['product_name']."</li>
             <li>".$post_images[0]['price']."</li>
             <li style='color : red;'>".$sold_out."</li>
             <li style =' display: ".$type."'> <button class='w3-button w3-green' id='buy-button'>BUY NOW  </button></li>
             </ul>
            </div>
          
         ";
  
       //  echo <div class='container'><img id='image' style='width: 80%;'></div>;
      } 
   ?> 
    <div id="id01" class="w3-modal">
    <div class="w3-modal-content" style="width: 360px; height: 10px; background: none; margin-top: -80px;">
      <div class="w3-container" >
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <div style="height: 40px;">
        <form id="paymentForm" class="w3-container w3-card-4 w3-light-grey" >
        <h2>Your Details</h2>
         <p>Please endeavour to insert your correct email address.</p>

          <p>
            <label for="email">Email Address</label>
            <input type="email" id="email-address"  class="w3-input w3-border w3-round" required />
          </p>
          <p>
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity"  class="w3-input w3-border w3-round" required />
          </p>
          <p>
           <p>
            <label for="first-name">Amount</label>
            <input type="number" id="amount" class="w3-input w3-border w3-round"  disabled required />
            </p>
            <input type="hidden" id="cal" class="w3-input w3-border w3-round"  value ="<?php echo $post_images[0]['price'];?>"  />

          <p>
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" class="w3-input w3-border w3-round" />
          </p>

          <p>
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name"  class="w3-input w3-border w3-round"/>
          </p>
          <p>
            <label for="details">Details of your product</label>
            <textarea name="details" id="" cols="30" rows="2" class="w3-textarea w3-border w3-round"></textarea>
          </p>
            <input type="hidden" id="last-name" value="<?php echo $post_images[0]['id'] ;?>" />
          <div class="form-submit">
            <button type="submit" onclick="payWithPaystack()"> Pay </button><br><br>
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>

<script src="https://js.paystack.co/v1/inline.js"></script> 

   </div>
   </div>
  
</div>
</body>
<script src="js/jquery.js"></script>
<script>
    
   var x = document.getElementById("buy-button")

   x.onclick = (e) => {
     e.preventDefault()
    document.getElementById("id01").style.display="block"
   }



   $(document).ready(()=>{
     $("#buy_button").click((e) => {
       e.preventDefault()
      $("#paymentForm").show()
     })
   })
   const cal = document.getElementById("cal").value
   const quantity = document.getElementById("quantity")
   const amount_val = document.getElementById("amount")
 quantity.addEventListener("keyup" , (e)=> {
     e.preventDefault()
     amount_val.value = cal * document.getElementById("quantity").value
   })
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'Your-public-key', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
    }
  });
  handler.openIframe();
}
</script>
</html>
