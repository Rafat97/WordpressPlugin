
<?php 
session_start();
require_once('config.php'); 

if (isset($_POST['stripeToken']) && isset($_POST['stripeEmail'])) {
	$token  = $_POST['stripeToken'];
	$email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
     
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => 10000,
      'currency' => 'usd',
      'description' => 'Example charge',
      'receipt_email' => $email,
  ]);
  
  

  
    $to = $email;
   // $from = 'login@example.com';
 
  
    $subject = 'Website Change Request';
   // $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    $message = '<html><body>';
    $message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . "Rafat" . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
    $message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . "Google.com". "</td></tr>";
    $message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . "OK" . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";



   mail($to, $subject, $message, $headers);
  
 print_r($customer);
  echo '<h1>Successfully charged $100.00!</h1>';
  print_r($charge);
}





 ?>

<br>
<br>
<br>
<br>
<br>
<br>
 <form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="<?php echo $price?>"
    data-name="Demo Site"
    data-description="Example charge"
    data-zip-code="true"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>