<?php
   
   if (isset($_FILES['upload']['name'])) {
       include('../model/DB.php');
       $image = $_FILES['upload']['name'];
       $text = $_POST['product_name'];
       $quantity = $_POST['quantity'];
       $price = $_POST['price'];
       $rename =  "fibe_product_".str_shuffle(md5('hjkuiytrrt3456')).".jpg";
       $image_path = "images/".$rename;
       DB::query('INSERT INTO products VALUES (\'\' , :image , :product_name , :price , :quantity )' , array(':image' => $rename , ':product_name'=> $text , ':price' => $price , ':quantity'=>$quantity));
       move_uploaded_file($_FILES['upload']['tmp_name'] , $image_path);
   }

 



?>