
<?php
use Twilio\Rest\Client;

if(!function_exists('run'))
{
    function run($number,$otp)
    {
        $twilioSid=env('ACCOUNT_SID');
        $twilioToken=env('AUTH_TOKEN');
        $twilioPhoneNumber=env('PHONE_NUMBER');
        $client = new Client($twilioSid, $twilioToken);
       
            $data = $client->messages->create('+91'.$number,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $otp
                ]
            );
    }
}


?>