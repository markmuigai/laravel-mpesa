<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MpesaController extends Controller
{
    /**
     * Generate OAuth 2.0 Access Token using the bearer as the keyword
     */
    public function generateAccessToken()
    {
        return generateAccessToken();
    }

    /**
     * Lipa na M-PESA password
     * 
     * generate the password required by the M-Pesa STK push parameter.
     * */
    public function lipaNaMpesaPassword()
    {
        // pass a value given to us by Safaricom in test credentials.
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";

        // pass the value from M-Pesa test credentials
        $BusinessShortCode = 174379;

        // get the current time using Carbon and format the time according to the M-Pesa requirement 
        $timestamp = Carbon::rawParse('now')->format('YmdHms');

        // concatenate our business short code, passkey, and timestamp using base64 encode.
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);

        // generate Lipa Na M-Pesa password
        return $lipa_na_mpesa_password;
    }

    /**
     * Lipa na M-PESA STK Push method
     * */
    public function customerMpesaSTKPush()
    {
        // pass Safaricom STK processing request for the test environment
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        // initialize curl
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        // use authorization keyword Bearer and pass our access token using the generateAccessToken () method
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));

        // pass an array of our STK push parameters
        $curl_post_data = [
            //Fill in the request parameters with test credentials
            'BusinessShortCode' => 600256,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 5,
            'PartyA' => 254717831279, // replace this with your phone number
            'PartyB' => 174379,
            'PhoneNumber' => 254728858889, // replace this with your phone number
            'CallBackURL' => 'https://localhost/',
            'AccountReference' => "Laravel Mpesa",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);

        // set curl options and we pass request parameters
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        // execute curl request.
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
}
