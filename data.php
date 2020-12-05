<?php
function timeline ($to , $nums) {

   if ($to <= $nums)
    return $to;
   else
     return $nums;
 }
 
if (isset($_GET['p_n'])) {
      include("model/DB.php");
      
      include("model/model.php");
      $page_number = $_GET['p_n'];
      $item_count = $_GET['i_c'];
      $from = $page_number*$item_count - ($item_count - 1);
      $to = $page_number*$item_count;
      $response = array();
         
         
         $post_images  = DB::query('SELECT * FROM products  ORDER BY id DESC ', array(  ));
         $nums = count($post_images);
         $piids = str_shuffle(time()."yuhruireiurejkdsjdjhkfjf");

         $count = $from;
          while ($count <= timeline($to , $nums)) { 
          $pst_img = $post_images[$count - 1];
           if ($pst_img['quantity'] == 0) {
              $sold_out = "Sold Out";
           } else {
              $sold_out = "";
           }
             ?> 
            <div class="columnsmi" >
             <a href = <?php echo "product.php?post=".$pst_img['id']; ?> >
             <img src= <?php  echo "admin/images/".$pst_img['image']; ?> class= "image"> 
             <ul class='ul_list_body'>
             <li><?php  echo $pst_img['product_name']; ?></li>
             <li><?php  echo $pst_img['price']; ?></li>
             <li style="color : red;"><?php  echo $sold_out; ?></li>
             </ul>
             </a>
            </div>
          
      
    <?php  
           $count = $count +1;


    }
} 
       //  echo <div class='container'><img id='image' style='width: 80%;'></div>;
      
  
   ?> 