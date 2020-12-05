<?php
  if (isset($_POST["c"])) {
    include('../model/DB.php');
    $productname = $_POST["c"];
    $product = DB::query('SELECT product_name ,id FROM products WHERE product_name LIKE :productname', array(':productname'=>'%'.$_POST["c"].'%'));

    foreach ($product as $products) {
    	echo '<a href="product.php?post='.$products['id'].'">'.$products['product_name'].'</a>';
    	echo "<br><br><hr>";    
    }
 if (!DB::query('SELECT product_name FROM products WHERE product_name  LIKE :productname', array(':productname'=>'%'.$_POST["c"].'%'))) {
	echo "product is not available , call us for special order <a href='https://wa.me/+2348160107126' style='font-weight: 900; color: blue;'> click me</a>";
}
} 
?>