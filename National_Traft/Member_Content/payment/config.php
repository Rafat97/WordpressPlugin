<?php 

require_once('stripe-php/init.php'); 

$price = (int)$_SESSION["price"] * 100 ;
unset($_SESSION["price"]);

$stripe = [
  "secret_key"      => "sk_test_BZgcrdGKVbfwrvoY2bmz5maI",
  "publishable_key" => "pk_test_cmWFIpSsraM6HY0Nw85E89xW",
  "price"           => $price,
];

/*
$stripe = [
  "secret_key"      => "sk_live",
  "publishable_key" => "pk_live",
  "price"           => $price,
];
*/
\Stripe\Stripe::setApiKey($stripe['secret_key']);


//print_r($stripe);


 ?>