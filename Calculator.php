<?php

$page_title = 'calculator';

 include('header.inc');

   if (isset($_POST['submitted'])) {

    if (is_numeric($_POST['quantity'])  && is_numeric($_POST['price']) && is_numeric($_POST['tax'])
       && is_numeric($_POST['discount']) && is_numeric($_POST['payments'])){

         $price = $_POST['price'];
         $quantity = $_POST['quantity'];
         $discount = $_POST['discount'];
         $tax = $_POST['tax'];
         $shipping = $_POST['shipping'];
         $payments = $_POST['payments'];

          // Calculate the total:
             $total =(($price * $quantity)+ $shipping) - $discount;
          
              // Determine the tax rate:
                 $taxrate = ($tax/100) + 1;
                 $taxrate++;
             // Factor in the tax rate:
                 $total = $total * $taxrate;

            // Calculate the monthly payments:
                 $monthly = $total / $payments;


          print "<p>You have selected to purchase:<br />
                     <span class=\"number\">$quantity </span> widget(s) at <br />
                    $<span class=\"number\">$price</span> price each plus a <br />
                    $<span class=\"number\">$shipping</span> shipping cost and a <br />
                     <span class=\"number\">$tax</span>percent tax rate.<br />
                     After your $<span class=\"number\">$discount</span> discount, the total cost is $<span class=\"number\">".number_format($total,2)."</span>.<br />
                     Divided over <span class=\"number\">$payments</span> monthly payments,that would be $<span class=\"number\">".number_format($monthly,2)."</span> each. 1</p>";

 } else {

   echo '<center>

          <h1 id="mainhead">

           Error!

          </h1>

         <p class="error">

          Please enter a valid quantity, price, and   tax.

         </p>

         </center>';

 }

}
?>

<center>

<h2>Widget Cost Calculator</h2>

 <form action="Calculator.php" method="post">

  <p>Quantity: <input type="text" name="quantity" size="5" maxlength="10" value="<?php
  if(isset($_POST['quantity'])){ echo $_POST['quantity'];}?>" /></p>

  <p>Price: <input type="text" name="price" size="5" maxlength="10" value="<?php
  if(isset($_POST['price'])){echo $_POST['price'];}?>"/></p>
  
  <p>Disscount: <input type="text" name="discount" size="5" maxlength="10" value="<?php
  if(isset($_POST['discount'])){echo $_POST['discount'];}?>"/></p>

  <p>Tax : <input type="text" name="tax" size="5" maxlength="10" value="<?php
  if(isset($_POST['tax'])){echo $_POST['tax'];}?>"/>(%)</p>
  
  <p>Shipping method: <select name="shipping">

          <option value="5.00">Slow and steady</option>
          <option value="8.95">Put a move on it.</option>
          <option value="19.36">I need it  yesterday!</option>
          
      </select></p>
      
  <p>Number of payments to make: <input type="text" name="payments" size="3" value="<?php
  if(isset($_POST['payments'])){echo $_POST['payments'];}?>"/> </p>
      
  <p><input type="submit" name="submit" value="Calculate!" /></p>

  <input type="hidden" name="submitted" value="TRUE" />

  </form>

</center>

<?php
include_once('footer.inc');
?>