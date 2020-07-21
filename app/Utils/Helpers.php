<?php
/**
 * Sum of numbers
 */
function generateAccessToken()
{
    // Define consumer key daraja
  $consumer_key= \Config::get('api_keys.MPESA_CONSUMER_KEY');

  // Define consumer key in daraja
  $consumer_secret=\Config::get('api_keys.MPESA_CONSUMER_SECRET');;

  // User base64 to combine consumer key and consumer secret
  //  Base64 is simply a group of binary-to-text encoding schemes that represent binary data in an ASCII string format.
  $credentials = base64_encode($consumer_key.":".$consumer_secret);

  // return $credentials;
  // Define a url to generate access token provided by safaricom mpesa api
  $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

  // return $response = Http::get($url);
  
  // we use curl_setopt to set our options for our curl transfer. Learn more about curl option.
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic QXpzMktlalUxQVJ2SUw1SmRKc0FSYlYyZ0RyV21wT0I6aGlwR3ZGSmJPeHJpMzMwYw=="));
  curl_setopt($curl, CURLOPT_HEADER,false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // create a variable in which we pass the response from Safaricom M-pesa API.
  $curl_response = curl_exec($curl);

  // convert a JSON object to a php object.
  $access_token=json_decode($curl_response);

  // access generated M-pesa access token.
  return $access_token->access_token;  
}