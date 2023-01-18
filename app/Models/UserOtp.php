<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Exception;
use Twilio\Rest\Client;

class UserOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expire_at'
    ];
    public function sendSMS($receivernumber)
    {
        $message = "Your OTP is: " . $this->otp;

        try {
            $account_id = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            $client = new Client($account_id, $auth_token);

            $client->messages->create($receivernumber, [
                'from' => $twilio_number,
                'body' => $message

            ]);
            info('SMS Sent Successfully');
        } catch (\Exception $e) {
            info('Error:' . $e->getMessage());
        }
    }
}
